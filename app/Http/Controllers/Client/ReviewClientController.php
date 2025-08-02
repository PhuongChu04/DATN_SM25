<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class ReviewClientController extends Controller
{
    /**
     * Lấy người dùng đã đăng nhập thông qua Sentinel
     */
    protected function getUser()
    {
        return Sentinel::check(); // Trả về người dùng đã đăng nhập
    }

    /**
     * Hiển thị form tạo đánh giá cho sản phẩm trong đơn hàng.
     */
 public function create($orderId, $productId)
{
    $user = $this->getUser();

    if (!$user) {
        return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để đánh giá.');
    }

    // Lấy đơn hàng mà người dùng muốn đánh giá
    $order = Order::where('id', $orderId)->where('user_id', $user->id)->first();
    if (!$order) {
        return redirect()->route('client.orders.index')->with('error', 'Đơn hàng không hợp lệ.');
    }

    // Lấy chi tiết đơn hàng, bao gồm sản phẩm
    $orderDetail = $order->details->where('product_id', $productId)->first();

    if (!$orderDetail) {
        return redirect()->route('client.orders.index')->with('error', 'Sản phẩm không hợp lệ hoặc không thuộc đơn hàng này.');
    }

    // Lấy variant của sản phẩm từ order detail
    $variant = $orderDetail->variant;

    // Lấy sản phẩm tương ứng
    $product = $orderDetail->product;

    // Kiểm tra xem variant có tồn tại không, nếu có lấy màu và kích thước
    $size = $variant ? $variant->size : null;
    $color = $variant ? $variant->color : null;

    // Trả về view và truyền thông tin sản phẩm, màu sắc, kích thước
    return view('client.reviews.create', compact('order', 'product', 'size', 'color'));
}




    /**
     * Lưu đánh giá của người dùng.
     */
    public function store(Request $request, $orderId)
    {
        $user = $this->getUser();

        if (!$user) {
            return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để đánh giá.');
        }

        // Lấy đơn hàng mà người dùng muốn đánh giá
        $order = Order::where('id', $orderId)->where('user_id', $user->id)->first();
        if (!$order) {
            return redirect()->route('client.orders.index')->with('error', 'Đơn hàng không hợp lệ.');
        }

        // Kiểm tra trạng thái đơn hàng (chỉ cho phép đánh giá khi đơn hàng đã hoàn thành)
        if ($order->order_status != 'delivered') {
            return redirect()->route('client.orders.index')->with('error', 'Bạn chỉ có thể đánh giá các sản phẩm đã được giao.');
        }

        // Kiểm tra xem người dùng đã có đánh giá cho sản phẩm trong đơn hàng này chưa
        $existingReview = Review::where('user_id', $user->id)
            ->where('order_id', $orderId)
            ->where('product_id', $request->input('product_id'))  // Kiểm tra sản phẩm đang được đánh giá
            ->first();

        

        if ($existingReview) {
            return redirect()->route('client.orders.index')->with('error', 'Bạn đã đánh giá cho sản phẩm này rồi.');
        }

        // Lưu đánh giá mới
        $review = new Review();
        $review->user_id = $user->id;
        $review->product_id = $request->input('product_id');
        $review->order_id = $orderId;
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->save();

        return redirect()->route('client.orders.index')->with('success', 'Đánh giá của bạn đã được ghi nhận.');
    }
}
