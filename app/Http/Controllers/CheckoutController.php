<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Giả sử bạn có model Product

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        // 1. Lấy dữ liệu giỏ hàng từ input ẩn
        $cartDataJson = $request->input('cart_data');
        if (!$cartDataJson) {
            return redirect()->back()->with('error', 'Giỏ hàng rỗng hoặc có lỗi xảy ra.');
        }

        // 2. Chuyển chuỗi JSON thành mảng PHP
        $cartItems = json_decode($cartDataJson, true);

        // 3. Xử lý logic thanh toán
        // **QUAN TRỌNG:** KHÔNG BAO GIỜ tin tưởng vào giá tiền (`price`) gửi từ client.
        // Luôn lấy lại giá từ database dựa trên `id` để đảm bảo an toàn.
        
        $totalAmount = 0;
        $order_details = [];

        foreach ($cartItems as $item) {
            $product = Product::find($item['id']);
            if ($product) {
                // Lấy giá từ database, không phải từ request
                $real_price = $product->price; 
                $totalAmount += $real_price * $item['quantity'];

                // Thêm vào chi tiết đơn hàng để lưu sau này
                $order_details[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $real_price, // Lưu giá tại thời điểm mua
                ];
            }
        }
        
        // DÙNG dd() ĐỂ KIỂM TRA DỮ LIỆU NHẬN ĐƯỢC
        // dd($cartItems, $order_details, $totalAmount);

        // 4. Các bước tiếp theo (ví dụ)
        // - Tạo một bản ghi Order mới trong database.
        // - Lưu các `order_details` vào bảng chi tiết đơn hàng.
        // - Tích hợp với cổng thanh toán (Momo, VNPay...).
        // - Trừ số lượng tồn kho của sản phẩm.
        // - Gửi email xác nhận đơn hàng cho khách.
        // - Xóa giỏ hàng ở client bằng cách xóa localStorage sau khi thanh toán thành công.
        
        // Sau khi xử lý xong, chuyển hướng đến trang cảm ơn
        return redirect()->route('thankyou.page')->with('success', 'Đặt hàng thành công!');
    }
    public function add(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] += 1;
    } else {
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->firstVariant->price,
            'image' => $product->image_primary,
            'quantity' => 1
        ];
    }

    session()->put('cart', $cart);
    return response()->json(['success' => true, 'cart' => $cart]);
}
}