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
                                Đơn Hàng: {{$order->order_code}}
                            </h5>
                            <a class="text-md mb-4" href="{{route('client.showOder')}}">back</a>
                            <div class="wrap-account-order">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="text-md fw-medium">Sản Phẩm</th>
                                            <th class="text-md fw-medium">Tên sản phẩm</th>
                                            <th class="text-md fw-medium">Size</th>
                                            <th class="text-md fw-medium">Màu</th>
                                            
                                            <th class="text-md fw-medium">Số Lượng</th>
                                            <th class="text-md fw-medium">Giá</th>
                                            <th class="text-md fw-medium"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderDetails as $item)
                                            @php
                                                $product = optional(optional($item->variant)->product);
                                                $variantData = is_array($item->variant_data) ? $item->variant_data : json_decode($item->variant_data, true);
                                            @endphp
                                            <tr class="tf-order-item">
                                                <td class="text-md">
                                                    <img src="{{ $product->image_primary ?? '/default.jpg' }}" alt="" style="width: 80px;">
                                                </td>
                                                <td class="text-md">
                                                    {{ $product->name ?? 'Không có tên' }}
                                                </td>
                                                <td class="text-md">
                                                    {{ $variantData['size'] ?? '' }}
                                                </td>
                                                <td class="text-md">
                                                    {{ $variantData['color'] ?? '' }}
                                                </td>
                                                <td class="text-md">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td class="text-md">
                                                    {{ number_format($item->unit_price) }} đ
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                              
                            </div>
                           
                        </div>
                        <div class="row"><a href="" class="text-end text-md mt-4">Tổng Giá: {{$order->total_price}}</a></div>
                        
                    </div>
                </div>
                <!-- /Account -->
            </div>
        </div>
        <!-- /Main Content -->






    </div>
@endsection
