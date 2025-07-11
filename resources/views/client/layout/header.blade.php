<header id="header" class="header-default">
    <div class="header-top">
        <div class="container">
            <div class="row wrapper-header align-items-center">
                <div class="col-md-4 col-3 d-xl-none">
                    <a href="#mobileMenu" class="mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
                        <i class="icon icon-categories1"></i>
                    </a>
                </div>
                <div class="col-xl-5 d-none d-xl-block">
                    <div class="header-language">
                        <div class="tf-languages">
                            <select class="image-select center style-default type-languages">
                                <option>Tiếng Việt</option>
                                <option>English</option>
                                <option>العربية</option>
                                <option>简体中文</option>
                                <option>اردو</option>
                            </select>
                        </div>
                        <div class="tf-currencies">
                            <select class="image-select center style-default type-currencies">
                                <option selected data-thumbnail="{{ asset('client/images/country/vn.png') }}">Việt Nam (VNĐ ₫)
                                </option>
                                <option data-thumbnail="{{ asset('client/images/country/fr.png') }}">United States (USD $)</option>
                                <option data-thumbnail="{{ asset('client/images/country/fr.png') }}">France (EUR €)</option>
                                <option data-thumbnail="{{ asset('client/images/country/ger.png') }}">Germany (EUR €)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-6 text-center">
                    <a href="home-electronic.html" class="logo-header">
                        <img src="{{ asset('client/images/logo/logo.svg') }}" alt="logo" class="logo">
                    </a>
                </div>
                <div class="col-xl-5 col-md-4 col-3">
                    <ul class="nav-icon d-flex justify-content-end align-items-center">
                        <li class="nav-search">

                            <a href="#search" data-bs-toggle="modal" class="nav-icon-item">

                                <i class="icon icon-search"></i>
                            </a>
                        </li>
                        <li class="nav-account">
                            <a href="{{ route('client.account') }}" class="nav-icon-item">
                                <i class="icon icon-user"></i>
                            </a>
                        </li>
                        <li class="nav-wishlist">
                            <a href="#" class="nav-icon-item">
                                <i class="icon icon-heart"></i>
                                <span class="count-box">0</span>
                            </a>
                        </li>
                        <li class="nav-cart">
                            <a href="#shoppingCart" data-bs-toggle="offcanvas" class="nav-icon-item position-relative">
                                <i class="icon icon-cart fs-4 bi bi-cart-fill"></i>
                                <!-- Tôi thêm class bi-cart-fill để có icon -->
                                <span
                                    class="count-box position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    0
                                </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div class="header-bottom d-none d-xl-block">
        <div class="container">
            <nav class="box-navigation text-center">
                <ul class="box-nav-menu">
                    <li class="menu-item">
                        <a href="{{route('client.homeClient')}}" class="item-link">Home</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('client.listProducts')}}" class="item-link">Shop</a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="item-link">Products</a>
                    </li>
                    <li class="menu-item position-relative">
                        <a href="#" class="item-link">Pages</a>
                    </li>
                    <li class="menu-item position-relative">
                        <a href="#" class="item-link">Blog</a>

                    </li>
                    <li class="menu-item"><a
                            href="https://themeforest.net/item/vince-multipurpose-ecommerce-html5-template/57202368?s_rank=5"
                            target="_blank" class="item-link">Buy Theme!</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
