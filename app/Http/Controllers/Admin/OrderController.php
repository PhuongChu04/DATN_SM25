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
        $orderCancel     = Order::where('order_status', OrderStatus::Canceled->value)->count();
        $orderDelivering = Order::where('order_status', OrderStatus::Shipping->value)->count();
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
        $progressStatus = $this->mapStatusToProgress($order->order_status);

        return view('admin.orders.details', compact('order', 'progressStatus'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function updateStatus(Request $request, $id)
{
    // Lấy đơn hàng
    $order = Order::findOrFail($id);

    // Nếu đơn đã kết thúc, không cho thay đổi
    if (in_array($order->order_status, [
        OrderStatus::Delivered->value,
        OrderStatus::Canceled->value,
        OrderStatus::Returned->value,
    ])) {
        return back()->with('error', 'Đơn hàng đã kết thúc, không thể thay đổi tiếp.');
    }

    // Validate trạng thái đầu vào
    $request->validate([
        'order_status' => ['required', Rule::in(OrderStatus::values())],
        'note' => 'nullable|string|max:1000',
    ]);

    $newStatus = $request->order_status;

    // Kiểm tra trạng thái mới có thể tiến lên hay không
    if ($this->statusLevel($newStatus) <= $this->statusLevel($order->order_status)) {
        return back()->with('error', 'Không thể quay lại trạng thái trước. Chỉ có thể tiến lên.');
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
        $order->delete();
        return back()->with('success', 'Order deleted successfully.');
    }

    public function print($id)
    {
        $order = Order::with([
            'user',
            'orderDetails.variant.product',
            'orderDetails.variant.size',
            'orderDetails.variant.color',
        ])->findOrFail($id);

        return view('admin.orders.invoice', compact('order'));
    }

    public function refund($id)
    {
        $order = Order::findOrFail($id);

        // Điều kiện không cho hoàn tiền
        if ($order->order_status === OrderStatus::Shipping->value) {
            return back()->with('error', 'Không thể hoàn tiền khi đơn hàng đang giao.');
        }

        if ($order->order_status === OrderStatus::Canceled->value) {
            return back()->with('error', 'Đơn hàng đã bị hủy, không thể hoàn tiền.');
        }

        if ($order->payment_status !== 'paid') {
            return back()->with('error', 'Đơn hàng chưa thanh toán, không thể hoàn tiền.');
        }

        // Điều kiện cho hoàn tiền
        if (!in_array($order->order_status, [OrderStatus::Delivered->value, OrderStatus::Returned->value])) {
            return back()->with('error', 'Chỉ có thể hoàn tiền đơn hàng đã giao hoặc trả hàng.');
        }

        // Cập nhật trạng thái hoàn tiền
        $order->payment_status = 'refund';
        $order->save();

        // Ghi log
        OrderStatusLog::create([
            'order_id' => $order->id,
            'status' => 'refund',
            'note' => 'Hoàn tiền đơn hàng bởi admin',
            'changed_by' => Auth::id(),
        ]);

        return back()->with('success', 'Đã hoàn tiền cho đơn hàng.');
    }

    /**
     * Ánh xạ trạng thái cũ sang tiến trình 5 bước mới
     */
    private function mapStatusToProgress($status)
    {
        return match ($status) {
            'draft' => 'confirming',
            'pending' => 'pending',
            'processing' => 'processing',
            'shipping', 'delivering' => 'shipping',
            'completed', 'delivered' => 'delivered',
            'canceled' => 'confirming', // hoặc tùy bạn muốn nhảy bước nào
            'returned' => 'delivered', // hoặc giữ nguyên, nếu không cần progress
            default => 'pending',
        };
    }

    private function statusLevel($status): int
    {
        // Chuẩn hóa: nếu là enum thì lấy ->value
        $value = is_object($status) ? $status->value : $status;

        return match ($value) {
            OrderStatus::Confirming->value => 1,
            OrderStatus::Pending->value    => 2,
            OrderStatus::Processing->value => 3,
            OrderStatus::Shipping->value   => 4,
            OrderStatus::Delivered->value  => 5,
            OrderStatus::Returned->value   => 6,
            OrderStatus::Canceled->value   => 7,
            default => 0,
        };
    }
}
