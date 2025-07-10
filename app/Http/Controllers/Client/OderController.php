<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Services\ProductService;    
class OderController extends Controller
{
    //
    protected $orderService;
    protected $productService;
    public function __construct(OrderService $orderService, ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
    }
    public function OderDetail($id){
        $orderService = new OrderService(new Order());
        $order = $orderService->getOrderById($id);
        return view('client.order.order-detail', compact('order'));
    }
    public function showOder(){
        $orderService = new OrderService(new Order());
        $order = $orderService->getAllOrder();
        return view('client.order.order', compact('order'));
    }
    public function index()
    {
        $user = Sentinel::getUser(); // lấy user đang đăng nhập

        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập');
        }

        $orders = $this->orderService->getOrdersByUser($user->id);
        
        return view('client.order.order', compact('orders'));
    }
    public function showDetail($id)
    {
        $user = Sentinel::getUser();
    
        $order = $this->orderService->getOrderDetail($id, $user->id);
    
        return view('client.order.orderdetails', compact('order'));
    }
    
}
