@extends('client.layout.layout')
@section('content')
  
<div id="wrapper">

  

    <!-- Main Content -->
    <div class="flat-spacing-13">
        <div class="container-7">
            <!-- sidebar-account -->
            <div class="btn-sidebar-mb d-lg-none">
                <button data-bs-toggle="offcanvas" data-bs-target="#mbAccount">
                    <i class="icon icon-sidebar"></i>
                </button>
            </div>
            <!-- /sidebar-account -->
            <!-- Section-acount -->
            <div class="main-content-account">
                <div class="sidebar-account-wrap sidebar-content-wrap sticky-top d-lg-block d-none">
                    <ul class="my-account-nav">
                        <li>
                            <a href="account-page.html"
                                class="text-sm link fw-medium my-account-nav-item">Dashboard</a>
                        </li>
                        <li>
                            <a href="account-orders.html"
                                class="text-sm link fw-medium my-account-nav-item active">My Orders</a>
                        </li>
                        <li>
                            <a href="wish-list.html" class="text-sm link fw-medium my-account-nav-item">My
                                Wishlist</a>
                        </li>
                        <li>
                            <a href="account-addresses.html"
                                class="text-sm link fw-medium my-account-nav-item">Addresses</a>
                        </li>
                        <li>
                            <a href="account-details.html"
                                class="text-sm link fw-medium my-account-nav-item">Account Details</a>
                        </li>
                        <li>
                            <a href="index.html" class="text-sm link fw-medium my-account-nav-item">Log
                                Out</a>
                        </li>
                    </ul>
                </div>
                <div class="my-acount-content account-orders">
                    <div class="account-no-orders-wrap">
                        <img class="lazyload" data-src="images/section/account-no-order.png"
                            src="images/section/account-no-order.png" alt="">
                        <div class="display-sm fw-medium title">You haven’t placed any order yet</div>
                        <div class="text text-sm">It’s time to make your first order</div>
                        <a href="shop-fullwidth.html"
                            class="tf-btn animate-btn d-inline-flex bg-dark-2 justify-content-center">Shop
                            Now</a>
                    </div>
                    <div class="account-orders-wrap">
                        <h5 class="title">
                            Order History
                        </h5>
                        <div class="wrap-account-order">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="text-md fw-medium">Order ID</th>
                                        <th class="text-md fw-medium">Date</th>
                                        <th class="text-md fw-medium">Status</th>
                                        <th class="text-md fw-medium">Total</th>
                                        <th class="text-md fw-medium">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr class="tf-order-item">
                                        <td class="text-md">
                                            {{$order->order_code}}
                                        </td>
                                        <td class="text-md">
                                            {{$order->created_at}}
                                        </td>
                                        <td class="text-md text-delivered">
                                            
                                            @if ($order->order_status == 'confirming')
                                                <span class="text-warning">confirming</span>
                                            @elseif ($order->order_status == 'pending')
                                                <span class="text-info">pending</span>
                                            @elseif ($order->order_status == 'delivered')
                                                <span class="text-primary">delivered</span>
                                            @elseif ($order->order_status == 'canceled')
                                                <span class="text-success">canceled</span>
                                            @elseif ($order->order_status == 'shipping')
                                                <span class="text-danger">shipping</span>
                                            @endif
                                        </td>
                                        <td class="text-md">
                                            {{$order->total_price}} VND
                                        </td>
                                        <td>
                                            <a href="{{route('client.OderDetail', $order->id)}}"  
                                                class="view-detail" >Detail</a>
                                                @if ($order->order_status == 'confirming')
                                                <button class="view-detail btn btn-danger"  >Hủy</button>
                                                @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Account -->
        </div>
    </div>
    <!-- /Main Content -->




  

</div>
    @endsection

        