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
            return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để xem đơn hàng.');
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
    // Lấy đơn hàng theo ID
    $order = Order::findOrFail($id);

    // Validate dữ liệu đầu vào
    $request->validate([
        'order_status' => ['required', Rule::in(OrderStatus::values())],
        'note' => 'nullable|string|max:1000',
    ]);

    $newStatus = $request->order_status;
    $currentStatus = $order->order_status;

    // Log trạng thái mới khi submit form
    Log::info('Order status submitted: ' . $newStatus);

    // Cho phép chuyển sang trạng thái 'Cancelled' từ bất kỳ trạng thái nào, trừ khi đã thanh toán
    if ($newStatus === OrderStatus::Cancelled->value) {
        if ($order->payment_status === 'paid') {
            return back()->with('error', 'Không thể hủy đơn hàng đã thanh toán.');
        }
        $order->order_status = $newStatus;
    } else {
        // Kiểm tra trạng thái chỉ cho tiến lần lượt từng bước một
        $currentLevel = $this->statusLevel($currentStatus);
        $newLevel = $this->statusLevel($newStatus);

        if ($newLevel - $currentLevel !== 1) {
            return back()->with('error', 'Chỉ có thể cập nhật trạng thái lần lượt theo từng bước.');
        }

        // Nếu trạng thái mới là "Đã giao" thì cập nhật trạng thái thanh toán thành "paid"
        if ($newStatus === OrderStatus::Delivered->value && $order->payment_status === 'unpaid') {
            $order->payment_status = 'paid';
        }

        // Cập nhật trạng thái đơn hàng mới
        $order->order_status = $newStatus;
    }

    // Lưu trạng thái mới của đơn hàng vào database
    $order->save();

    // Ghi lại lịch sử thay đổi trạng thái
    OrderStatusLog::create([
        'order_id'   => $order->id,
        'status'     => $newStatus,
        'note'       => $request->note,
        'changed_by' => Auth::id(),
    ]);

    return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
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
