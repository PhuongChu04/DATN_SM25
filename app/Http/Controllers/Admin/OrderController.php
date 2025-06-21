<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderStatusLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();


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
            'orderDetails.variant.product',
            'orderDetails.variant.size',
            'orderDetails.variant.color',
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
        $order = Order::findOrFail($id);

        // Không cho cập nhật nếu đã hoàn thành
        if (in_array($order->order_status, [
            OrderStatus::Delivered->value,
            OrderStatus::Canceled->value,
            OrderStatus::Returned->value,
        ])) {
            return back()->with('error', 'Đơn hàng đã kết thúc, không thể thay đổi tiếp.');
        }

        // Cho validate target trong tất cả statuses
        $request->validate([
            'order_status' => ['required', Rule::in(OrderStatus::values())],
        ]);

        $order->order_status = $request->order_status;
        $order->save();

        // Log
        OrderStatusLog::create([
            'order_id'   => $order->id,
            'status'     => $order->order_status,
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

        if ($order->payment_status !== 'paid') {
            return back()->with('error', 'Không thể hoàn tiền đơn chưa thanh toán hoặc đã hoàn.');
        }

        $order->payment_status = 'refund';
        $order->save();

        // Ghi log dòng thời gian hoàn tiền
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
}
