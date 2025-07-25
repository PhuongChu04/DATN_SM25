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
                   ->orderBy('created_at', 'asc')  // Thay 'desc' thành 'asc' để hiển thị đơn hàng từ sớm nhất
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
        $user = $this->getUser(); // Lấy người dùng đã đăng nhập

        // Kiểm tra người dùng đã đăng nhập chưa
        if (!$user) {
            return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để huỷ đơn hàng.');
        }

        // Tìm đơn hàng theo id và kiểm tra xem người dùng có quyền sở hữu đơn hàng không
        $order = Order::where('id', $id)->where('user_id', $user->id)->first();

        if (!$order) {
            return redirect()->route('client.orders.index')->with('error', 'Đơn hàng không tồn tại hoặc không thuộc quyền sở hữu của bạn.');
        }

        // Kiểm tra trạng thái đơn hàng, chỉ cho phép huỷ đơn hàng khi đơn hàng có trạng thái 'pending' hoặc 'processing'
        if (in_array($order->order_status, ['pending', 'processing'])) {
            $order->order_status = 'cancelled';  // Cập nhật trạng thái đơn hàng thành 'cancelled'
            $order->save(); // Lưu lại thay đổi

            return redirect()->route('client.orders.index')->with('success', 'Đơn hàng đã được huỷ thành công.');
        } else {
            return redirect()->route('client.orders.index')->with('error', 'Không thể huỷ đơn hàng với trạng thái này.');
        }
    }
}
