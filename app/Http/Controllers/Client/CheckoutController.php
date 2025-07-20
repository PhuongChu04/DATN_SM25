<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Address;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function showForm()
    {
        $user = Sentinel::check();
        $defaultAddress = null;
        $cartItems = [];

        if ($user) {
            // Lấy giỏ hàng từ database
            $cart = Cart::with('details.variant.product')
                        ->where('id_user', $user->id)
                        ->first();

            if ($cart && $cart->details->isNotEmpty()) {
                $cartItems = $cart->details;
            } else {
                return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng trống');
            }

            // Lấy địa chỉ mặc định
            $defaultAddress = Address::where('user_id', $user->id)
                                     ->where('is_default', 1)
                                     ->first();
        } else {
            // Lấy giỏ hàng từ session
            $cartSession = session()->get('cart', []);
            if (empty($cartSession)) {
                return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng trống');
            }
            $cartItems = $cartSession;
        }

        return view('client.checkout.form', compact('cartItems', 'user', 'defaultAddress'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string',
            'phone'           => 'required|string',
            'address'         => 'required|string',
            'email'           => 'nullable|email',
            'payment_method'  => 'required|in:vnpay,cod',
        ]);

        $user = Sentinel::check();
        $cartItems = [];

        if ($user) {
            // Lấy giỏ hàng từ database
            $cart = Cart::with('details.variant.product')
                        ->where('id_user', $user->id)
                        ->first();

            if (!$cart || $cart->details->isEmpty()) {
                return redirect()->back()->with('error', 'Giỏ hàng trống');
            }
            $cartItems = $cart->details;
        } else {
            // Lấy giỏ hàng từ session
            $cartSession = session()->get('cart', []);
            if (empty($cartSession)) {
                return redirect()->back()->with('error', 'Giỏ hàng trống');
            }
            $cartItems = $cartSession;
        }

        DB::beginTransaction();
        try {
            // Tạo đơn hàng
            $order = Order::create([
                'user_id'         => $user ? $user->id : null,
                'order_code'      => 'DH' . strtoupper(Str::random(6)), // Ví dụ: DH4F6G8
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

            if ($user) {
                // Lưu từ DB giỏ hàng
                foreach ($cartItems as $item) {
                    $variant = $item->variant;
                    $product = $variant->product;

                    if (!$variant || !$product) continue;

                    $quantity = $item->quantity;
                    $price = $variant->price;
                    $lineTotal = $price * $quantity;

                    OrderDetail::create([
                        'order_id'     => $order->id,
                        'product_id'   => $product->id,
                        'variant_id'   => $variant->id,
                        'product_name' => $product->name,
                        'quantity'     => $quantity,
                        'unit_price'   => $price,
                        'total'        => $lineTotal,
                    ]);

                    $total += $lineTotal;

                    // Trừ tồn kho
                    $variant->decrement('quantity', $quantity);
                }

                // Xóa giỏ hàng DB sau khi đặt hàng
                CartDetail::where('id_cart', $cart->id)->delete();
            } else {
                // Lưu từ session giỏ hàng
                foreach ($cartItems as $variantId => $item) {
                    $variant = ProductVariant::find($variantId);
                    $product = $variant->product ?? null;

                    if (!$variant || !$product) continue;

                    $quantity = $item['quantity'];
                    $price = $variant->price;
                    $lineTotal = $price * $quantity;

                    OrderDetail::create([
                        'order_id'     => $order->id,
                        'product_id'   => $product->id,
                        'variant_id'   => $variant->id,
                        'product_name' => $product->name,
                        'quantity'     => $quantity,
                        'unit_price'   => $price,
                        'total'        => $lineTotal,
                    ]);

                    $total += $lineTotal;

                    // Trừ tồn kho
                    $variant->decrement('quantity', $quantity);
                }

                // Xóa giỏ hàng session
                session()->forget('cart');
            }

            $order->update(['total_price' => $total]);

            DB::commit();
            return redirect()->route('client.cart.index')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
