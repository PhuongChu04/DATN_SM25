@extends('client.layout.layout')

@section('content')
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
                                    class="text-sm link fw-medium my-account-nav-item active">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('client.orders.index')}}" class="text-sm link fw-medium my-account-nav-item">My
                                    Orders</a>
                            </li>
                            <li>
                                <a href="wish-list.html" class="text-sm link fw-medium my-account-nav-item">My
                                    Wishlist</a>
                            </li>
                            <li>

                                <a href="{{ route('client.addresses.index') }}"
                                class="text-sm link fw-medium my-account-nav-item">Addresses</a>
                            </li>
                            <li>
                                <a href="{{ route('client.accountDetail') }}"
                                    class="text-sm link fw-medium my-account-nav-item">Account Details</a>
                            </li>
                            <li>
                                <a href="{{ route('auth.logoutClient') }}" class="text-sm link fw-medium my-account-nav-item" onclick="return(confirm('Bạn có muốn đăng xuất không'))">Log
                                    Out</a>
                            </li>
                        </ul>
                    </div>
                    <div class="my-acount-content account-dashboard">
                        <div class="box-account-title">
                            <p class="hello-name display-sm fw-medium">
                                Hello  {{ $user->first_name ?? '' }}

                                <span>(not <span class="name"> {{ $user->first_name ?? '' }}</span>?</span>
                                <a href="{{ route('auth.logoutClient') }}" class="text-decoration-underline link" onclick="return(confirm('Bạn có muốn đăng xuất không'))">Log Out</a>
                                <span>)</span>
                            </p>
                            <p class="notice text-sm">
                                Today is a great day to check your account page. You can check <a
                                    href="account-orders.html" class="text-primary text-decoration-underline">your
                                    last orders</a> or
                                have a look to <a href="wish-list.html"
                                    class="text-primary text-decoration-underline">your
                                    wishlist</a> . Or maybe you can start to shop
                                <a href="shop-default.html" class="text-primary text-decoration-underline">our
                                    latest
                                    offers</a> ?
                            </p>
                        </div>
                        <div class="content-account">
                            <ul class="box-check-list flex-sm-nowrap">
                                <li>
                                    <a href="{{route('client.orders.index')}}" class="box-check text-center">
                                        <div class="icon">
                                            <i class="icon-order"></i>
                                            <span class="count-number text-sm text-white fw-medium">1</span>
                                        </div>
                                        <div class="text">
                                            
                                            <div class=" link name-type text-xl fw-medium">Orders</div>
                                            <p class="sub-type text-sm">Check the history of all your orders
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="wish-list.html" class="box-check text-center">
                                        <div class="icon">
                                            <i class="icon-heart"></i>
                                            <span class="count-number text-sm text-white fw-medium">1</span>
                                        </div>
                                        <div class="text">
                                            <div class="link name-type text-xl fw-medium">Wishlist</div>
                                            <p class="sub-type text-sm">Check your wishlist</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="banner-account">
                                <div class="image">
                                    <img src="images/banner/account-1.jpg" data-src="images/banner/account-1.jpg" alt=""
                                        class="lazyload">
                                </div>
                                <div class="banner-content-right">
                                    <div class="banner-title">
                                        <p class="display-md fw-medium">
                                            Free Shipping
                                        </p>
                                        <p class="text-md">
                                            for all orders over $300.00
                                        </p>
                                    </div>
                                    <div class="banner-btn">
                                        <a href="shop-default.html" class="tf-btn animate-btn">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="banner-account banner-acc-countdown bg-linear d-flex align-items-center">
                                <div class="banner-content-left">
                                    <div class="banner-title">
                                        <p class="sub text-md fw-medium">
                                            SUMMER SALE
                                        </p>
                                        <p class="display-xl fw-medium">
                                            50% OFF
                                        </p>
                                        <p class="sub text-md fw-medium">
                                            WITH PROMOTE CODE: 12D34E
                                        </p>
                                    </div>
                                    <div class="banner-btn">
                                        <a href="shop-default.html" class="tf-btn btn-white animate-btn animate-dark">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                                <div class="banner-countdown">
                                    <div class="wg-countdown-2">
                                        <span class="js-countdown" data-timer="46556"
                                            data-labels="Days,Hours,Mins,Secs"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Account -->
            </div>
        </div>

@endsection
