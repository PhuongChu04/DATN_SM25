<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->latest()->get();
        

        $order_cancel = Order::where('order_status', 'canceled')->count();
        $order_delivering = Order::where('order_status', 'delivering')->count();
        $pending_payment = Order::where('payment_status', 'unpaid')->count();
        $delivered = Order::where('order_status', 'completed')->count();

        return view('admin.orders.index', compact('orders', 'order_cancel', 'order_delivering', 'pending_payment', 'delivered'));
    }

    public function show( Order $order)
    {
     $order->load('customer', 'orderDetails.product');

    return view('admin.orders.partials.detail', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function updateStatus(Request $request, $id)
{
   $order = Order::findOrFail($id);

    // Không cho cập nhật nếu đã hoàn thành
    if ($order->order_status === 'completed') {
        return back()->with('error', 'Order already completed and cannot be modified.');
    }

    $request->validate([
        'order_status' => 'required|in:draft,completed,delivering,canceled',
    ]);

    $order->order_status = $request->order_status;
    $order->save();

    return back()->with('success', 'Order status updated successfully.');
}
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order deleted successfully.');
    }
}
