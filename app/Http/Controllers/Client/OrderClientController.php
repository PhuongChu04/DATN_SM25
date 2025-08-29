<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel; // Import Sentinel

class OrderClientController extends Controller
{
    /**
     * Đơn hàng
     * Lấy người dùng đã đăng nhập thông qua Sentinel
     */
    protected function getUser()
    {
        return Sentinel::check(); // Trả về người dùng đã đăng nhập
    }

    /**
     * Hiển thị danh sách đơn hàng của người dùng
     */
   public function index(Request $request)
{
    $user = $this->getUser();  // Lấy người dùng đã đăng nhập

    // Kiểm tra người dùng đã đăng nhập chưa
    if (!$user) {
        return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để xem đơn hàng.');
    }

    // Tạo query cơ bản để lấy đơn hàng của người dùng
    $query = Order::where('user_id', $user->id);

    // Tìm kiếm theo mã đơn hàng (order_code)
    if ($request->has('order_code') && !empty($request->order_code)) {
        $query->where('order_code', 'like', '%' . $request->order_code . '%');
    }

    // Tìm kiếm theo trạng thái đơn hàng (order_status)
    if ($request->has('order_status') && !empty($request->order_status)) {
        $query->where('order_status', $request->order_status);
    }

    // Tìm kiếm theo trạng thái thanh toán (payment_status)
    if ($request->has('payment_status') && !empty($request->payment_status)) {
        $query->where('payment_status', $request->payment_status);
    }

    // Lấy danh sách đơn hàng của người dùng và sắp xếp theo thời gian tạo (sớm nhất lên đầu), sau đó phân trang
    $orders = $query->orderBy('created_at', 'desc')  // Thay 'desc' thành 'asc' để hiển thị đơn hàng từ sớm nhất
                    ->paginate(10);  // Phân trang với 10 đơn hàng mỗi trang

    return view('client.orders.index', compact('orders')); // Trả về view với danh sách đơn hàng đã sắp xếp và phân trang
}


    /**
     * Hiển thị chi tiết đơn hàng của người dùng
     */
    public function show($id)
    {
        $user = $this->getUser(); // Lấy người dùng đã đăng nhập

        // Kiểm tra người dùng đã đăng nhập chưa
        if (!$user) {
            return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để xem chi tiết đơn hàng.');
        }

        // Lấy chi tiết đơn hàng, bao gồm các sản phẩm trong đơn hàng
        $order = Order::with('details')->where('user_id', $user->id)->findOrFail($id);

        return view('client.orders.show', compact('order')); // Trả về view chi tiết đơn hàng
    }

    /**
     * Huỷ đơn hàng
     */
    public function cancel($id)
    {
        $user = $this->getUser();  // Lấy người dùng đã đăng nhập

        // Kiểm tra người dùng đã đăng nhập chưa
        if (!$user) {
            return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để huỷ đơn hàng.');
        }

        // Tìm đơn hàng theo id và kiểm tra xem người dùng có quyền sở hữu đơn hàng không
        $order = Order::where('id', $id)->where('user_id', $user->id)->first();

        if (!$order) {
            return redirect()->route('client.orders.index')->with('error', 'Đơn hàng không tồn tại hoặc không thuộc quyền sở hữu của bạn.');
        }

        // Chuyển hướng đến trang xác nhận huỷ
        return redirect()->route('client.orders.cancelConfirm', $order->id);
    }

    /**
     * Hiển thị trang xác nhận huỷ đơn hàng
     */
    public function cancelConfirm($id)
    {
        // Lấy đơn hàng với trạng thái chưa thay đổi (vẫn là 'pending' hoặc 'processing')
        $order = Order::where('id', $id)->where('order_status', '!=', 'waiting_for_cancellation')->first();

        if (!$order) {
            return redirect()->route('client.orders.index')->with('error', 'Đơn hàng không tìm thấy hoặc không phải đơn hàng huỷ.');
        }

        // Trả về view xác nhận huỷ đơn hàng
        return view('client.orders.cancelConfirm', compact('order'));
    }

    /**
     * Xác nhận huỷ đơn hàng và cập nhật trạng thái đơn hàng
     */
   public function cancelFinalize($id, Request $request)
{
    // Lấy đơn hàng với trạng thái 'pending' hoặc 'processing'
    $order = Order::where('id', $id)
                  ->whereIn('order_status', ['pending', 'processing'])  // Chỉ cho phép trạng thái 'pending' và 'processing'
                  ->first();

    if (!$order) {
        return redirect()->route('client.orders.index')->with('error', 'Đơn hàng không tồn tại, không phải trạng thái hợp lệ hoặc đã bị huỷ.');
    }

    // Kiểm tra phương thức thanh toán nếu là vnpay
    if ($order->payment_method == 'vnpay') {
        return redirect()->route('client.orders.index')->with('error', 'Đơn hàng sử dụng VNPAY không thể huỷ.');
    }

    // Cập nhật lý do huỷ đơn hàng
    $order->cancel_reason = $request->input('cancel_reason');  // Lưu lý do huỷ

    // Cập nhật trạng thái đơn hàng thành 'waiting_for_cancellation'
    $order->order_status = 'cancelled';
    $order->save(); // Lưu lại thay đổi

    // Quay lại trang danh sách đơn hàng với thông báo thành công
    return redirect()->route('client.orders.index')->with('success', 'Đơn hàng đã được chuyển sang trạng thái huỷ.');
}


  public function cancelAction($id)
{
    return redirect()->route('client.orders.index')->with('success', 'Đã huỷ thao tác, trạng thái đơn hàng không thay đổi.');
}


}
