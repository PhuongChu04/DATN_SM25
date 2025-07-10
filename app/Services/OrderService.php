<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    //
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function getAllOrders()
    {
        $orders = Order::all();
    }
    public function getAllOrder(){
        $orders = Order::all();
        return $orders;
    }
    
    public function getOrderById($id){
        $order = Order::find($id);
        return $order;
    }

    
    public function getOrdersByUser($userId)
    {
        return Order::where('user_id', $userId)->latest()->get();
    }
    
    public function getOrderDetail($orderId, $userId)
    {
        return Order::with(['orderDetails.variant.product'])
            ->where('id', $orderId)
            ->where('user_id', $userId)
            ->firstOrFail();
    }
    // public function createOrder($request){
    //     $order = Order::create($request->all());
    //     return $order;
    // }
    // public function updateOrder($request, $id){
    //     $order = Order::find($id);
    //     $order->update($request->all());
    //     return $order;
    // }
    // public function deleteOrder($id){
    //     $order = Order::find($id);
    //     $order->delete();
    //     return $order;
    // }
}
