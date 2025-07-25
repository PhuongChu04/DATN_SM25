<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel; // Import Sentinel

class OrderClientController extends Controller
{
    /**
     * Lấy người dùng đã đăng nhập thông qua Sentinel
     */
    protected function getUser()
    {
        return Sentinel::check(); // Trả về người dùng đã đăng nhập
    }

    /**
     * Hiển thị danh sách đơn hàng của người dùng
     */
    public function index()
    {
        $user = $this->getUser();  // Lấy người dùng đã đăng nhập

        // Kiểm tra người dùng đã đăng nhập chưa
        if (!$user) {
            return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để xem đơn hàng.');
        }

        // Lấy danh sách đơn hàng của người dùng và sắp xếp theo thời gian tạo (sớm nhất lên đầu), sau đó phân trang
        $orders = Order::where('user_id', $user->id)
                       ->orderBy('created_at', 'desc')  // Thay 'desc' thành 'asc' để hiển thị đơn hàng từ sớm nhất
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
    $order->order_status = 'waiting_for_cancellation';
    $order->save(); // Lưu lại thay đổi

    // Quay lại trang danh sách đơn hàng với thông báo thành công
    return redirect()->route('client.orders.index')->with('success', 'Đơn hàng đã được chuyển sang trạng thái chờ huỷ.');
}

    /**
     * Huỷ thao tác và quay lại trạng thái cũ
     */
    public function cancelAction($id)
    {
        $user = $this->getUser();  // Lấy người dùng đã đăng nhập

        // Kiểm tra người dùng đã đăng nhập chưa
        if (!$user) {
            return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để huỷ thao tác.');
        }

        // Tìm đơn hàng và kiểm tra quyền sở hữu của người dùng
        $order = Order::where('id', $id)->where('user_id', $user->id)->first();

        if (!$order) {
            return redirect()->route('client.orders.index')->with('error', 'Đơn hàng không tồn tại hoặc không thuộc quyền sở hữu của bạn.');
        }

        // Trường hợp người dùng chỉ hủy thao tác mà không thay đổi trạng thái
        // Không thay đổi trạng thái đơn hàng, chỉ quay lại danh sách đơn hàng
        return redirect()->route('client.orders.index');
    }
}
