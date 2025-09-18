<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\CartDetail;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Models\Address;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use App\Models\ProductVariant;

class CheckoutController extends Controller
{
    // Phương thức hiển thị form checkout, thanh toán
 public function showForm()
{
    $user = Sentinel::check();
    $cartItems = [];
    $addresses = [];
    $defaultAddress = null;

    // Nếu user đã login thì luôn load địa chỉ
    if ($user) {
        $addresses = Address::where('user_id', $user->id)->get();
        $defaultAddress = Address::where('user_id', $user->id)
                                ->where('is_default', 1)
                                ->first();
    }
    if (!session()->has('buy_now')) {
        session()->forget(['buy_now', 'buy_now_cart']);
    }

    // Ưu tiên: nếu có session "buy now" thì lấy luôn
    if (session('buy_now') && session()->has('buy_now_cart')) {
        $cartItems = session('buy_now_cart');
    } else {
        if ($user) {
            $cart = Cart::with('details.variant.product')
                        ->where('id_user', $user->id)
                        ->first();

            if ($cart && $cart->details->isNotEmpty()) {
                $cartItems = $cart->details;
            } else {
                return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng trống');
            }
        } else {
            $cartSession = session()->get('cart', []);
            if (empty($cartSession)) {
                return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng trống');
            }
            $cartItems = $cartSession;
        }
    }

    return view('client.checkout.form', compact('cartItems', 'user', 'addresses', 'defaultAddress'));
}



    // Phương thức lưu đơn hàng và xử lý thanh toán (COD và VNPay)
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
    $fromBuyNow = false;
    $cart = null;

    // 👉 Ưu tiên: nếu có session "buy now"
    if (session('buy_now') && session()->has('buy_now_cart')) {
        $cartItems = session('buy_now_cart');
        $fromBuyNow = true;
    } else {
        if ($user) {
            $cart = Cart::with('details.variant.product')
                        ->where('id_user', $user->id)
                        ->first();

            if (!$cart || $cart->details->isEmpty()) {
                return redirect()->back()->with('error', 'Giỏ hàng trống');
            }
            $cartItems = $cart->details;
        } else {
            $cartSession = session()->get('cart', []);
            if (empty($cartSession)) {
                return redirect()->back()->with('error', 'Giỏ hàng trống');
            }
            $cartItems = $cartSession;
        }
    }

    // Kiểm tra địa chỉ giao hàng
    $address = $request->address;
    if (!$address) {
        return back()->with('error', 'Vui lòng chọn địa chỉ giao hàng.');
    }

    DB::beginTransaction();
    try {
        // Tạo đơn hàng
        $order = Order::create([
            'user_id'        => $user ? $user->id : null,
            'order_code'     => 'DH' . strtoupper(Str::random(6)),
            'name'           => $request->name,
            'phone'          => $request->phone,
            'email'          => $user ? $user->email : null,
            'address'        => $address,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method === 'vnpay' ? 'failed' : 'unpaid',
            'order_status'   => 'pending',
            'total_price'    => 0,
        ]);

        $total = 0;

        // Nếu là "Mua ngay" → cartItems là array
        if ($fromBuyNow) {
            foreach ($cartItems as $item) {
                $variant = ProductVariant::with('product')->find($item['id_variant']);
                if (!$variant || !$variant->product) continue;

                $quantity = (int)$item['quantity'];
                if ($variant->quantity < $quantity) {
                    DB::rollBack();
                    return back()->with('error', 'Số lượng vượt quá tồn kho cho ' . $variant->product->name);
                }

                $price = $variant->price;
                $lineTotal = $price * $quantity;

                OrderDetail::create([
                    'order_id'     => $order->id,
                    'product_id'   => $variant->product->id,
                    'variant_id'   => $variant->id,
                    'product_name' => $variant->product->name,
                    'quantity'     => $quantity,
                    'unit_price'   => $price,
                    'total'        => $lineTotal,
                ]);

                $total += $lineTotal;

                $variant->decrement('quantity', $quantity);
            }
        } else {
            // Nếu từ giỏ hàng (DB hoặc session)
            foreach ($cartItems as $item) {
                $variant = $item->variant ?? null;
                if (!$variant) continue;

                $product = $variant->product;
                $quantity = $item->quantity;
                if ($variant->quantity < $quantity) {
                    DB::rollBack();
                    return back()->with('error', 'Số lượng vượt quá tồn kho cho ' . $product->name);
                }

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

                $variant->decrement('quantity', $quantity);
            }
        }

        // Cập nhật tổng tiền
        $order->update(['total_price' => $total]);

        // Thanh toán VNPay
        if ($request->payment_method === 'vnpay') {
            DB::commit();

            $this->clearCart($fromBuyNow, $cart);

            return $this->processVNPay($order, $total);
        }

        // Thanh toán COD
        if ($request->payment_method === 'cod') {
            DB::commit();

            $this->clearCart($fromBuyNow, $cart);

            return redirect()->route('client.cart.index')
                             ->with('success', 'Đặt hàng thành công! Vui lòng thanh toán khi nhận hàng.');
        }

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Lỗi: ' . $e->getMessage());
    }
}

/**
 * Xóa giỏ hàng hoặc session sau khi đặt hàng
 */
private function clearCart($fromBuyNow, $cart = null)
{
    if ($fromBuyNow) {
        session()->forget(['buy_now', 'buy_now_cart']);
    } else {
        if ($cart) {
            CartDetail::where('id_cart', $cart->id)->delete();
        } else {
            session()->forget('cart');
        }
    }
}


    // Xử lý thanh toán VNPay
    private function processVNPay($order, $total)
    {
        $vnp_TmnCode = "RJBK6J49";
        $vnp_HashSecret = "0FFMB5EJI6AL35QE35TKCP18SYKI6N30";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_ReturnUrl = route('checkout.vnpay.callback');

        // Dữ liệu thanh toán VNPay
        $inputData = [
            "vnp_Version"   => "2.1.0",
            "vnp_TmnCode"   => $vnp_TmnCode,
            "vnp_Amount"    => $total * 100, // VNPay yêu cầu số tiền tính bằng cent
            "vnp_Command"   => "pay",
            "vnp_CreateDate"=> now()->format('YmdHis'),
            "vnp_CurrCode"  => "VND",
            "vnp_IpAddr"    => request()->ip(),
            "vnp_Locale"    => "vn",
            "vnp_OrderInfo" => "Thanh toán đơn hàng #" . $order->order_code,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef"    => (string) $order->order_code,
        ];

        // Sắp xếp dữ liệu theo thứ tự
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        // Tạo URL thanh toán VNPay
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); // Tạo chữ ký
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // Chuyển hướng người dùng đến VNPay
        return redirect()->away($vnp_Url);
    }

    // Phương thức xử lý phản hồi từ VNPay
    public function paymentReturn(Request $request)
    {
        // Lấy cấu hình VNPay
        $vnp_HashSecret = "0FFMB5EJI6AL35QE35TKCP18SYKI6N30";
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $inputData = $request->except('vnp_SecureHash', 'vnp_SecureHashType');

        // Sắp xếp dữ liệu và tạo chuỗi hash
        ksort($inputData);
        $hashData = [];
        foreach ($inputData as $key => $value) {
            $hashData[] = urlencode($key) . '=' . urlencode($value);
        }
        $queryString = implode('&', $hashData);

        // Tính toán lại hash
        $calculatedHash = hash_hmac('sha512', $queryString, $vnp_HashSecret);

        // Kiểm tra nếu hash không hợp lệ
        if ($calculatedHash !== $vnp_SecureHash) {
            return redirect()->route('client.cart.index')->with('error', 'Xác thực thanh toán không hợp lệ!');
        }

        // Kiểm tra mã giao dịch phản hồi
        $txnRef = $request->input('vnp_TxnRef');
        $responseCode = $request->input('vnp_ResponseCode');
        $order = Order::where('order_code', $txnRef)->first();

        if (!$order) {
            return redirect()->route('client.cart.index')->with('error', 'Không tìm thấy đơn hàng!');
        }

        // Kiểm tra nếu đơn hàng đã thanh toán
        if ($order->payment_status == 'paid') {
            return redirect()->route('client.cart.index')->with('success', 'Đơn hàng đã thanh toán!');
        }

        if ($responseCode === '00') {
            DB::beginTransaction();
            try {
                $order->update([
                    'payment_status' => 'paid', // Cập nhật trạng thái thanh toán
                    'order_status' => 'pending',
                ]);
                DB::commit();

                return redirect()->route('client.cart.index')->with('success', 'Thanh toán thành công!');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('client.cart.index')->with('error', 'Lỗi khi cập nhật trạng thái thanh toán!');
            }
        } else {
            return redirect()->route('client.cart.index')->with('error', 'Thanh toán không thành công: ' . $request->input('vnp_ResponseMessage'));
        }
    }
    public function continuePayment($orderId)
{
    $order = Order::findOrFail($orderId);

    // Chỉ cho phép retry nếu trạng thái là thất bại hoặc chưa thanh toán
    if (!in_array($order->payment_status, ['failed', 'unpaid'])) {
        return redirect()->route('client.orders.index')
            ->with('error', 'Đơn hàng này không thể thanh toán lại.');
    }

    // Tính lại tổng tiền
    $total = $order->total_price;

    // Gọi lại processVNPay
    return $this->processVNPay($order, $total);
}

}
