<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Address;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class CheckoutController extends Controller
{
    public function showForm()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng trống');
        }

        $user = Sentinel::check();
        $defaultAddress = null;

        if ($user) {
            $defaultAddress = Address::where('user_id', $user->id)
                                     ->where('is_default', 1)
                                     ->first();
        }

        return view('client.checkout.form', compact('cart', 'user', 'defaultAddress'));
    }

    public function store(Request $request)
    {
        dd($request->all(), session()->get('cart'));

        $request->validate([
            'name'            => 'required|string',
            'phone'           => 'required|string',
            'address'         => 'required|string',
            'email'           => 'nullable|email',
            'payment_method'  => 'required|in:vnpay,cod',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống');
        }

        DB::beginTransaction();
        try {
            $user = Sentinel::check();

            $order = Order::create([
                'user_id'         => $user ? $user->id : null,
                'order_code'      => 'ORD-' . strtoupper(uniqid()),
                'name'            => $request->name,
                'phone'           => $request->phone,
                'email'           => $request->email,
                'address'         => $request->address,
                'payment_method'  => $request->payment_method,
                'payment_status'  => 'unpaid',
                'order_status'    => 'pending',
                'total_price'     => 0,
            ]);

            $total = 0;
            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);
                if (!$product) continue;

                $quantity = $item['quantity'];
                $price = $product->price;
                $lineTotal = $price * $quantity;

                OrderDetail::create([
                    'id_order'   => $order->id,
                    'id_product' => $product->id,
                    'quantity'   => $quantity,
                    'unit_price' => $price,
                    'total'      => $lineTotal,
                ]);

                $total += $lineTotal;
            }

            $order->update(['total_price' => $total]);
            session()->forget('cart');
            DB::commit();

            return redirect()->route('client.cart.index')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
