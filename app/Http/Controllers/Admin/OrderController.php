<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderStatusLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Lấy người dùng đã đăng nhập thông qua Sentinel
        $user = Sentinel::check();

        // Kiểm tra người dùng đã đăng nhập chưa
        if (!$user) {
            return redirect()->route('admin.auth.loginAdmin')->with('message', 'Vui lòng đăng nhập để xem đơn hàng.');
        }

        // Tạo query để tìm kiếm đơn hàng của người dùng
        $query = Order::where('user_id', $user->id);

        // Lọc theo mã đơn hàng
        if ($request->has('order_code') && !empty($request->order_code)) {
            $query->where('order_code', 'like', '%' . $request->order_code . '%');
        }

        // Lọc theo khách hàng
        if ($request->has('customer') && !empty($request->customer)) {
            $query->whereHas('user', function ($subQuery) use ($request) {
                $subQuery->where('email', 'like', '%' . $request->customer . '%');
            });
        }

        // Lọc theo trạng thái thanh toán
        if ($request->has('payment_status') && !empty($request->payment_status)) {
            $query->where('payment_status', $request->payment_status);
        }

        // Lọc theo trạng thái đơn hàng
        if ($request->has('order_status') && !empty($request->order_status)) {
            $query->where('order_status', $request->order_status);
        }

        // Lấy kết quả và phân trang
        $orders = $query->with('user') // Quan hệ với model User
                        ->latest()  // Sắp xếp theo thời gian mới nhất
                        ->paginate(10);

        // Tính toán các thống kê đơn hàng
        $orderCancel     = Order::where('order_status', OrderStatus::Cancelled->value)->count();
        $orderDelivering = Order::where('order_status', OrderStatus::Shipped->value)->count();
        $pendingPayment  = Order::where('payment_status', 'unpaid')->count();
        $orderDelivered  = Order::where('order_status', OrderStatus::Delivered->value)->count();

        return view('admin.orders.index', compact(
            'orders',
            'orderCancel',
            'orderDelivering',
            'pendingPayment',
            'orderDelivered'
        ));
    }

    public function show(Order $order)
    {
        $order->load([
                'user',
                'details.variant.product',
                'details.variant.size',
                'details.variant.color',
            ]);
        return view('admin.orders.details', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

 public function updateStatus(Request $request, $id)
{
    // Lấy đơn hàng
    $order = Order::findOrFail($id);

    // Kiểm tra nếu đơn hàng đã thanh toán, không cho phép hủy
    if ($order->payment_status === 'paid' && $request->order_status === OrderStatus::Cancelled->value) {
        return back()->with('error', 'Không thể hủy đơn hàng đã thanh toán.');
    }

    // Kiểm tra nếu thanh toán thất bại thì không cho sửa trạng thái trừ khi chuyển sang "Đã hủy"
    if ($order->payment_status === 'failed' && $request->order_status !== OrderStatus::Cancelled->value) {
        return back()->with('error', 'Đơn hàng thanh toán thất bại chỉ có thể chuyển sang trạng thái "Đã hủy".');
    }

    if ($order->order_status === OrderStatus::WaitingForCancellation->value && $request->order_status !== OrderStatus::Cancelled->value) {
    return back()->with('error', 'Đơn hàng đang chờ hủy, chỉ có thể chuyển sang trạng thái "Đã hủy".');
}


    // Kiểm tra trạng thái đầu vào
    $request->validate([
        'order_status' => ['required', Rule::in(OrderStatus::values())],
        'note' => 'nullable|string|max:1000',
    ]);

    // In giá trị của order_status khi form được submit
    Log::info('Order status submitted: ' . $request->order_status);  // Log giá trị

    // Kiểm tra trạng thái mới có thể tiến lên hay không
    $newStatus = $request->order_status;

    // Kiểm tra trạng thái mới có thể tiến lên hay không
    if ($this->statusLevel($newStatus) <= $this->statusLevel($order->order_status)) {
        return back()->with('error', 'Không thể quay lại trạng thái trước. Chỉ có thể tiến lên.');
    }

    // Nếu trạng thái mới là "Đã giao", cập nhật phương thức thanh toán thành "Đã thanh toán" (paid)
    if ($newStatus === OrderStatus::Delivered->value && $order->payment_status === 'unpaid') {
        $order->payment_status = 'paid'; // Cập nhật thanh toán khi nhận hàng thành đã thanh toán
    }

    // Cập nhật trạng thái đơn hàng
    $order->order_status = $newStatus;
    $order->save();

    // Ghi log
    OrderStatusLog::create([
        'order_id'   => $order->id,
        'status'     => $newStatus,
        'note' => $request->note,
        'changed_by' => Auth::id(),
    ]);

    return back()->with('success', 'Cập nhật trạng thái thành công.');
}




    public function destroy(Order $order)
{

    if ($order->order_status !== OrderStatus::Cancelled->value) {
        return back()->with('error', 'Chỉ có thể xóa đơn hàng đã huỷ.');
    }


    $order->delete();

    return back()->with('success', 'Đơn hàng đã được xóa.');
}


    private function statusLevel($status): int
    {
        // Chuẩn hóa: nếu là enum thì lấy ->value
        $value = is_object($status) ? $status->value : $status;

        return match ($value) {

            OrderStatus::Pending->value    => 1,
            OrderStatus::Processing->value => 2,
            OrderStatus::Shipped->value   => 3,
            OrderStatus::Delivered->value  => 4,
            OrderStatus::Cancelled->value   => 4,
            default => 0,
        };
    }
}
