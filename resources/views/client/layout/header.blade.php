<header id="header" class="header-default">
    <div class="header-top">
        <div class="container">
            <div class="row wrapper-header align-items-center">
                <div class="col-md-4 col-3 d-xl-none">
                    <a href="#mobileMenu" class="mobile-menu" data-bs-toggle="offcanvas"
                        aria-controls="mobileMenu">
                        <i class="icon icon-categories1"></i>
                    </a>
                </div>
                <div class="col-xl-5 d-none d-xl-block">
                    <div class="header-language">
                        <div class="tf-languages">
                            <select class="image-select center style-default type-languages">
                                <option>English</option>
                                <option>العربية</option>
                                <option>简体中文</option>
                                <option>اردو</option>
                            </select>
                        </div>
                        <div class="tf-currencies">
                            <select class="image-select center style-default type-currencies">
                                <option selected data-thumbnail="{{ asset('client/images/country/us.png') }}">United States (USD $)
                                </option>
                                <option data-thumbnail="{{ asset('client/images/country/fr.png') }}">France (EUR €)</option>
                                <option data-thumbnail="{{ asset('client/images/country/ger.png') }}">Germany (EUR €)</option>
                                <option data-thumbnail="{{ asset('client/images/country/vn.png') }}">Vietnam (VND ₫)</option>
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
                            <a href="#login" data-bs-toggle="offcanvas" class="nav-icon-item">
                                <i class="icon icon-user"></i>
                            </a>
                        </li>
                        <li class="nav-wishlist">
                            <a href="wish-list.html" class="nav-icon-item">
                                <i class="icon icon-heart"></i>
                                <span class="count-box">0</span>
                            </a>
                        </li>
                        <li class="nav-cart">
                            <a href="#shoppingCart" data-bs-toggle="offcanvas" class="nav-icon-item">
                                <i class="icon icon-cart"></i>
                                <span class="count-box">0</span>
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
                        <a href="#" class="item-link">Home<i class="icon icon-arr-down"></i></a>
                        <div class="sub-menu mega-menu mega-home">
                            <div class="box-search">
                                <div class="tf-select">
                                    <select name="pagetype" id="pagetype">
                                        <option value="">Page Type</option>
                                        <option value="fashion">Fashion</option>
                                        <option value="furniture">Furniture</option>
                                        <option value="electronics">Electronics</option>
                                        <option value="accessories">Accessories</option>
                                        <option value="food">Food & Drink</option>
                                        <option value="georgia">Other</option>
                                    </select>
                                </div>
                                <form class="form-search">
                                    <input type="text" placeholder="Search demo..." tabindex="0"
                                        aria-required="true" required="">
                                    <button type="submit"><i class="icon icon-search"></i></button>
                                </form>
                            </div>
                            <div class="row-demo">
                                <div class="demo-item">
                                    <a href="index.html" class="demo-image">
                                        <img class="lazyload" data-src="{{ asset('client/images/demo/fashion-1.jpg') }}"
                                            src="{{ asset('client/images/demo/fashion-1.jpg') }}" alt="home-fashion">
                                        <div class="demo-label">
                                            <span>New</span>
                                            <span class="demo-hot">Hot</span>
                                        </div>
                                    </a>
                                    <a href="index.html" class="demo-name link">Fashion Style 1</a>
                                </div>
                                <div class="demo-item">
                                    <a href="home-fashion-02.html" class="demo-image">
                                        <img class="lazyload" data-src="{{ asset('client/images/demo/fashion-2.jpg') }}"
                                            src="{{ asset('client/images/demo/fashion-2.jpg') }}" alt="home-fashion">
                                    </a>
                                    <a href="home-fashion-02.html" class="demo-name link">Fashion Style
                                        2</a>
                                </div>
                                <div class="demo-item">
                                    <a href="home-electronic.html" class="demo-image">
                                        <img class="lazyload" data-src="{{ asset('client/images/demo/electronic.jpg') }}"
                                            src="{{ asset('client/images/demo/electronic.jpg') }}" alt="home-electronic">
                                    </a>
                                    </a>
                                    <a href="home-electronic.html" class="demo-name link">Electronic</a>
                                </div>
                                <div class="demo-item">
                                    <a href="home-furniture.html" class="demo-image">
                                        <img class="lazyload" data-src="{{ asset('client/images/demo/furniture.jpg') }}"
                                            src="{{ asset('client/images/demo/furniture.jpg') }}" alt="home-furniture">
                                    </a>
                                    <a href="home-furniture.html" class="demo-name link">Furniture</a>
                                </div>
                                <div class="demo-item">
                                    <a href="home-fashion-women.html" class="demo-image">
                                        <img class="lazyload" data-src="{{ asset('client/images/demo/women-fashion.jpg') }}"
                                            src="{{ asset('client/images/demo/women-fashion.jpg') }}" alt="home-women-fashion">
                                        <div class="demo-label">
                                            <span>New</span>
                                            <span class="demo-hot">Hot</span>
                                        </div>
                                    </a>
                                    <a href="home-fashion-women.html" class="demo-name link">Women
                                        Fashion</a>
                                </div>
                                <div class="demo-item">
                                    <a href="home-skincare.html" class="demo-image">
                                        <img class="lazyload" data-src="{{ asset('client/images/demo/comestic.jpg') }}"
                                            src="{{ asset('client/images/demo/comestic.jpg') }}" alt="home-comestic">
                                    </a>
                                    <a href="home-skincare.html" class="demo-name link">Skincare</a>
                                </div>
                                <div class="demo-item">
                                    <a href="home-bicycle.html" class="demo-image">
                                        <img class="lazyload" data-src="{{ asset('client/images/demo/bicycle.jpg') }}"
                                            src="{{ asset('client/images/demo/bicycle.jpg') }}" alt="home-bicycle">
                                    </a>
                                    <a href="home-bicycle.html" class="demo-name link">Bicycle</a>
                                </div>
                                <div class="demo-item">
                                    <a href="home-phonecase.html" class="demo-image">
                                        <img class="lazyload" data-src="{{ asset('client/images/demo/phonecase.jpg') }}"
                                            src="{{ asset('client/images/demo/phonecase.jpg') }}" alt="home-phonecase">
                                    </a>
                                    <a href="home-phonecase.html" class="demo-name link">Phone Case</a>
                                </div>
                                <div class="demo-item">
                                    <a href="home-pet-accessories.html" class="demo-image">
                                        <img class="lazyload" data-src="{{ asset('client/images/demo/pet-accessories.jpg') }}"
                                            src="{{ asset('client/images/demo/pet-accessories.jpg') }}" alt="home-pet">
                                    </a>
                                    <a href="home-pet-accessories.html" class="demo-name link">Pet
                                        Accessories</a>
                                </div>
                                <div class="demo-item">
                                    <a href="home-sportwear.html" class="demo-image">
                                        <img class="lazyload" data-src="{{ asset('client/images/demo/sportwear.jpg') }}"
                                            src="{{ asset('client/images/demo/sportwear.jpg') }}" alt="home-sportwear">
                                    </a>
                                    <a href="home-sportwear.html" class="demo-name link">Sportwear</a>
                                </div>
                            </div>
                            <div class="view-all-demo text-center">
                                <a href="#modalDemo" data-bs-toggle="modal"
                                    class="tf-btn btn-primary animate-btn">
                                    Explore all demos (22+)
                                    <i class="icon icon-arr-right"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="item-link">Shop<i class="icon icon-arr-down"></i></a>
                        <div class="sub-menu mega-menu mega-shop">
                            <div class="wrapper-sub-menu">
                                <div class="mega-menu-item">
                                    <div class="menu-heading">SHOP LAYOUT</div>
                                    <ul class="menu-list">
                                        <li><a href="shop-default.html" class="menu-link-text link">Default</a>
                                        </li>
                                        <li><a href="shop-left-sidebar.html" class="menu-link-text link">Filter
                                                Left Sidebar</a></li>
                                        <li><a href="shop-right-sidebar.html" class="menu-link-text link">Filter
                                                Right Sidebar</a></li>
                                        <li><a href="shop-horizontal-filter.html"
                                                class="menu-link-text link">Horizontal Filter</a></li>
                                        <li><a href="shop-default.html" class="menu-link-text link">Filter
                                                Drawer</a></li>
                                        <li><a href="shop-collection-list.html"
                                                class="menu-link-text link">Collection List</a></li>
                                        <li><a href="shop-sub-collection.html" class="menu-link-text link">Sub
                                                Collection 1</a></li>
                                        <li><a href="shop-sub-collection-02.html"
                                                class="menu-link-text link">Sub Collection 2</a></li>
                                        <li><a href="shop-grid-3-columns.html" class="menu-link-text link">Grid
                                                3 Columns </a></li>
                                        <li><a href="shop-default.html" class="menu-link-text link">Grid 4
                                                Columns</a></li>
                                        <li><a href="shop-fullwidth.html" class="menu-link-text link">Full
                                                Width</a></li>
                                    </ul>
                                </div>
                                <div class="mega-menu-item">
                                    <div class="menu-heading">SHOP LISTS</div>
                                    <ul class="menu-list">
                                        <li><a href="shop-default.html" class="menu-link-text link">Pagination
                                                Links</a></li>
                                        <li><a href="shop-load-more-button.html"
                                                class="menu-link-text link">Load More Button</a></li>
                                        <li><a href="shop-infinity-scroll.html"
                                                class="menu-link-text link">Infinity Scroll <span
                                                    class="demo-label">Hot</span></a></li>
                                        <li><a href="shop-filter-sidebar.html"
                                                class="menu-link-text link">Filter Sidebar</a></li>
                                        <li><a href="shop-filter-hidden.html" class="menu-link-text link">Filter
                                                Hidden</a></li>
                                    </ul>
                                </div>
                                <div class="mega-menu-item">
                                    <div class="menu-heading">PRODUCT STYLES</div>
                                    <ul class="menu-list">
                                        <li><a href="product-style-01.html" class="menu-link-text link">Product
                                                Style 1</a></li>
                                        <li><a href="product-style-02.html" class="menu-link-text link">Product
                                                Style 2</a></li>
                                        <li><a href="product-style-03.html" class="menu-link-text link">Product
                                                Style 3</a></li>
                                        <li><a href="home-fashion-02.html" class="menu-link-text link">Product
                                                Popup</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="wrapper-sub-collection">
                                <div dir="ltr" class="swiper tf-swiper hover-sw-nav wow fadeInUp" data-swiper='{
                                        "slidesPerView": 2,
                                        "spaceBetween": 24,
                                        "speed": 800,
                                        "observer": true,
                                        "observeParents": true,
                                        "slidesPerGroup": 2,
                                        "navigation": {
                                            "clickable": true,
                                            "nextEl": ".nav-next-cls-header",
                                            "prevEl": ".nav-prev-cls-header"
                                        },
                                        "pagination": { "el": ".sw-pagination-cls-header", "clickable": true }
                                    }'>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="wg-cls style-abs bg-surface asp-1 hover-img">
                                                <a href="shop-default.html" class="image img-style d-block">
                                                    <img src="{{ asset('client/images/cls-categories/electronic/smartphone.png') }}"
                                                        data-src="{{ asset('client/images/cls-categories/electronic/smartphone.png') }}"
                                                        alt="" class="lazyload">
                                                </a>
                                                <div class="cls-btn text-center">
                                                    <a href="shop-default.html"
                                                        class="tf-btn btn-cls btn-white hover-dark hover-icon-2">
                                                        Phones
                                                        <i class="icon icon-arrow-top-left"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- item 2 -->
                                        <div class="swiper-slide">
                                            <div class="wg-cls style-abs bg-surface asp-1 hover-img">
                                                <a href="shop-default.html" class="image img-style d-block">
                                                    <img src="{{ asset('client/images/cls-categories/electronic/earphone.png') }}"
                                                        data-src="{{ asset('client/images/cls-categories/electronic/earphone.png') }}"
                                                        alt="" class="lazyload">
                                                </a>
                                                <div class="cls-btn text-center">
                                                    <a href="shop-default.html"
                                                        class="tf-btn btn-cls btn-white hover-dark hover-icon-2">
                                                        Earphones
                                                        <i class="icon icon-arrow-top-left"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- item 3 -->
                                        <div class="swiper-slide">
                                            <div class="wg-cls style-abs bg-surface asp-1 hover-img">
                                                <a href="shop-default.html" class="image img-style d-block">
                                                    <img src="{{ asset('client/images/cls-categories/electronic/cable.png') }}"
                                                        data-src="{{ asset('client/images/cls-categories/electronic/cable.png') }}"
                                                        alt="" class="lazyload">
                                                </a>
                                                <div class="cls-btn text-center">
                                                    <a href="shop-default.html"
                                                        class="tf-btn btn-cls btn-white hover-dark hover-icon-2">
                                                        Cables
                                                        <i class="icon icon-arrow-top-left"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- item 4 -->
                                        <div class="swiper-slide">
                                            <div class="wg-cls style-abs bg-surface asp-1 hover-img">
                                                <a href="shop-default.html" class="image img-style d-block">
                                                    <img src="{{ asset('client/images/cls-categories/electronic/headphone.png') }}"
                                                        data-src="{{ asset('client/images/cls-categories/electronic/headphone.png') }}"
                                                        alt="" class="lazyload">
                                                </a>
                                                <div class="cls-btn text-center">
                                                    <a href="shop-default.html"
                                                        class="tf-btn btn-cls btn-white hover-dark hover-icon-2">
                                                        Headphone
                                                        <i class="icon icon-arrow-top-left"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex d-xl-none sw-dot-default sw-pagination-cls-header justify-content-center">
                                    </div>
                                    <div
                                        class="d-none d-xl-flex swiper-button-next nav-swiper nav-next-cls-header">
                                    </div>
                                    <div
                                        class="d-none d-xl-flex swiper-button-prev nav-swiper nav-prev-cls-header">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="item-link">Products<i class="icon icon-arr-down"></i></a>
                        <div class="sub-menu mega-menu mega-tab">
                            <div class="wrapper-sub-menu-tab flat-animate-tab">
                                <ul class="menu-tab" role="tablist">
                                    <li class="nav-tab-item" role="presentation">
                                        <a href="#productLayouts" class="tab-link active"
                                            data-bs-toggle="tab">PRODUCT LAYOUTS <i
                                                class="icon icon-arr-right"></i></a>
                                    </li>
                                    <li class="nav-tab-item" role="presentation">
                                        <a href="#productDetails" class="tab-link" data-bs-toggle="tab">PRODUCT
                                            DETAILS <i class="icon icon-arr-right"></i></a>
                                    </li>
                                    <li class="nav-tab-item" role="presentation">
                                        <a href="#productFeatures" class="tab-link" data-bs-toggle="tab">PRODUCT
                                            FEATURES <i class="icon icon-arr-right"></i></a>
                                    </li>
                                    <li class="nav-tab-item" role="presentation">
                                        <a href="#productDesc" class="tab-link" data-bs-toggle="tab">PRODUCT
                                            DESCRIPTION <i class="icon icon-arr-right"></i></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="productLayouts" role="tabpanel">
                                        <ul class="menu-list">
                                            <li><a href="product-detail.html"
                                                    class="menu-link-text link">Product Single</a></li>
                                            <li><a href="product-right-thumbnail.html"
                                                    class="menu-link-text link">Product Right Thumbnail</a>
                                            </li>
                                            <li><a href="product-detail.html"
                                                    class="menu-link-text link">Product Left Thumbnail</a>
                                            </li>
                                            <li><a href="product-bottom-thumbnail.html"
                                                    class="menu-link-text link">Product Bottom Thumbnail</a>
                                            </li>
                                        </ul>
                                        <ul class="menu-list">
                                            <li><a href="product-grid.html" class="menu-link-text link">Product
                                                    Grid</a></li>
                                            <li><a href="product-grid-02.html"
                                                    class="menu-link-text link">Product Grid 2</a></li>
                                            <li><a href="product-stacked.html"
                                                    class="menu-link-text link">Product Stacked</a></li>
                                            <li><a href="product-drawer-sidebar.html"
                                                    class="menu-link-text link">Product Drawer Sidebar</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane" id="productDetails" role="tabpanel">
                                        <ul class="menu-list">
                                            <li><a href="product-inner-zoom.html"
                                                    class="menu-link-text link">Product Inner Zoom</a></li>
                                            <li><a href="product-inner-circle-zoom.html"
                                                    class="menu-link-text link">Product Inner Circle
                                                    Zoom</a>
                                            </li>
                                            <li><a href="product-no-zoom.html"
                                                    class="menu-link-text link">Product No Zoom <span
                                                        class="demo-label">Hot</span></a></li>
                                            <li><a href="product-external-zoom.html"
                                                    class="menu-link-text link">Product External Zoom</a>
                                            </li>
                                            <li><a href="product-open-lightbox.html"
                                                    class="menu-link-text link">Product Open Lightbox <span
                                                        class="demo-label bg-primary">New</span></a></li>
                                            <li><a href="product-video.html" class="menu-link-text link">Product
                                                    Video</a></li>
                                            <li><a href="product-3d.html" class="menu-link-text link">Product
                                                    3D/AR</a></li>
                                            <li><a href="product-group.html" class="menu-link-text link">Product
                                                    Group</a></li>
                                            <li><a href="product-affiliate.html"
                                                    class="menu-link-text link">Product
                                                    Affiliate</a></li>
                                            <li><a href="product-out-of-stock.html"
                                                    class="menu-link-text link">Product
                                                    Out Of Stock</a></li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane" id="productFeatures" role="tabpanel">
                                        <ul class="menu-list">
                                            <li><a href="product-together.html" class="menu-link-text link">Buy
                                                    Together</a></li>

                                            <li><a href="product-countdown-timer.html"
                                                    class="menu-link-text link">Countdown Timer</a></li>

                                            <li><a href="product-volume-discount.html"
                                                    class="menu-link-text link">Volume Discount</a></li>
                                            <li><a href="product-volume-discount-thumbnail.html"
                                                    class="menu-link-text link">Volume Discount
                                                    Thumbnail</a>
                                            </li>
                                            <li><a href="product-swatch-dropdown.html"
                                                    class="menu-link-text link">Swatch Dropdown</a></li>
                                            <li><a href="product-swatch-dropdown-color.html"
                                                    class="menu-link-text link">Swatch Dropdown Color</a>
                                            </li>
                                            <li><a href="product-swatch-image.html"
                                                    class="menu-link-text link">Swatch Image</a></li>
                                            <li><a href="product-swatch-image-square.html"
                                                    class="menu-link-text link">Swatch Image rectangle</a>
                                            </li>
                                            <li><a href="product-pickup-available.html"
                                                    class="menu-link-text link">Pickup Available</a></li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane" id="productDesc" role="tabpanel">
                                        <ul class="menu-list">
                                            <li><a href="product-description-vertical.html"
                                                    class="menu-link-text link">Product Description
                                                    Vertical</a>
                                            </li>
                                            <li><a href="product-description-tab.html"
                                                    class="menu-link-text link">Product Description Tab</a>
                                            </li>
                                            <li><a href="product-description-accordions.html"
                                                    class="menu-link-text link">Product Description
                                                    Accordions</a></li>
                                            <li><a href="product-description-side-accordions.html"
                                                    class="menu-link-text link">Product Description Side
                                                    Accordions</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="wrapper-sub-product">
                                <div dir="ltr" class="swiper tf-swiper wrap-sw-over" data-swiper='{
                                        "slidesPerView": 2,
                                        "spaceBetween": 24,
                                        "speed": 800,
                                        "observer": true,
                                        "observeParents": true,
                                        "slidesPerGroup": 2,
                                        "navigation": {
                                            "clickable": true,
                                            "nextEl": ".nav-next-product-header",
                                            "prevEl": ".nav-prev-product-header"
                                        },
                                        "pagination": { "el": ".sw-pagination-product-header", "clickable": true }
                                    }'>
                                    <div class="swiper-wrapper">
                                        <!-- item 1 -->
                                        <div class="swiper-slide">
                                            <div class="card-product style-center">
                                                <div class="card-product-wrapper">
                                                    <a href="product-detail.html" class="product-img">
                                                        <img class="img-product lazyload"
                                                            data-src="{{ asset('client/images/products/electronic/airpod-pro-black.jpg') }}"
                                                            src="{{ asset('client/images/products/electronic/airpod-pro-black.jpg') }}"
                                                            alt="image-product">
                                                        <img class="img-hover lazyload"
                                                            data-src="{{ asset('client/images/products/electronic/airpod-pro-pink.jpg') }}"
                                                            src="{{ asset('client/images/products/electronic/airpod-pro-pink.jpg') }}"
                                                            alt="image-product">
                                                    </a>
                                                    <ul class="list-product-btn">
                                                        <li>
                                                            <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                                                class="bg-surface hover-tooltip tooltip-left box-icon">
                                                                <span class="icon icon-cart2"></span>
                                                                <span class="tooltip">Add to Cart</span>
                                                            </a>
                                                        </li>
                                                        <li class="wishlist">
                                                            <a href="javascript:void(0);"
                                                                class="bg-surface hover-tooltip tooltip-left box-icon">
                                                                <span class="icon icon-heart2"></span>
                                                                <span class="tooltip">Add to Wishlist</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#quickView" data-bs-toggle="modal"
                                                                class="bg-surface hover-tooltip tooltip-left box-icon quickview">
                                                                <span class="icon icon-view"></span>
                                                                <span class="tooltip">Quick View</span>
                                                            </a>
                                                        </li>
                                                        <li class="compare">
                                                            <a href="#compare" data-bs-toggle="modal"
                                                                class="bg-surface hover-tooltip tooltip-left box-icon">
                                                                <span class="icon icon-compare"></span>
                                                                <span class="tooltip">Add to Compare</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-product-info text-center">
                                                    <a href="product-detail.html"
                                                        class="name-product link fw-medium text-md">Apple
                                                        AirPods Pro 2 Wireless Earbuds</a>
                                                    <p class="price-wrap fw-medium">
                                                        <span class="price-new">$170.00</span>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- item 2 -->
                                        <div class="swiper-slide">
                                            <div class="card-product style-center">
                                                <div class="card-product-wrapper">
                                                    <a href="product-detail.html" class="product-img">
                                                        <img class="img-product lazyload"
                                                            data-src="{{ asset('client/images/products/electronic/ss-smart-watch.jpg') }}"
                                                            src="{{ asset('client/images/products/electronic/ss-smart-watch.jpg') }}"
                                                            alt="image-product">
                                                        <img class="img-hover lazyload"
                                                            data-src="{{ asset('client/images/products/electronic/ss-smart-watch-gray.jpg') }}"
                                                            src="{{ asset('client/images/products/electronic/ss-smart-watch-gray.jpg') }}"
                                                            alt="image-product">
                                                    </a>
                                                    <ul class="list-product-btn">
                                                        <li>
                                                            <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                                                class="bg-surface hover-tooltip tooltip-left box-icon">
                                                                <span class="icon icon-cart2"></span>
                                                                <span class="tooltip">Add to Cart</span>
                                                            </a>
                                                        </li>
                                                        <li class="wishlist">
                                                            <a href="javascript:void(0);"
                                                                class="bg-surface hover-tooltip tooltip-left box-icon">
                                                                <span class="icon icon-heart2"></span>
                                                                <span class="tooltip">Add to Wishlist</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#quickView" data-bs-toggle="modal"
                                                                class="bg-surface hover-tooltip tooltip-left box-icon quickview">
                                                                <span class="icon icon-view"></span>
                                                                <span class="tooltip">Quick View</span>
                                                            </a>
                                                        </li>
                                                        <li class="compare">
                                                            <a href="#compare" data-bs-toggle="modal"
                                                                class="bg-surface hover-tooltip tooltip-left box-icon">
                                                                <span class="icon icon-compare"></span>
                                                                <span class="tooltip">Add to Compare</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-product-info text-center">
                                                    <a href="product-detail.html"
                                                        class="name-product link fw-medium text-md">Samsung
                                                        Galaxy 5 LTE Smart Watch</a>
                                                    <p class="price-wrap fw-medium">
                                                        <span class="price-new">$159.00</span>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- item 3 -->
                                        <div class="swiper-slide">
                                            <div class="card-product style-center">
                                                <div class="card-product-wrapper">
                                                    <a href="product-detail.html" class="product-img">
                                                        <img class="img-product lazyload"
                                                            data-src="{{ asset('client/images/products/electronic/ss-s21.jpg') }}"
                                                            src="{{ asset('client/images/products/electronic/ss-s21.jpg') }}"
                                                            alt="image-product">
                                                        <img class="img-hover lazyload"
                                                            data-src="{{ asset('client/images/products/electronic/ss-s21-grey.jpg') }}"
                                                            src="{{ asset('client/images/products/electronic/ss-s21-grey.jpg') }}"
                                                            alt="image-product">
                                                    </a>
                                                    <ul class="list-product-btn">
                                                        <li>
                                                            <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                                                class="bg-surface hover-tooltip tooltip-left box-icon">
                                                                <span class="icon icon-cart2"></span>
                                                                <span class="tooltip">Add to Cart</span>
                                                            </a>
                                                        </li>
                                                        <li class="wishlist">
                                                            <a href="javascript:void(0);"
                                                                class="bg-surface hover-tooltip tooltip-left box-icon">
                                                                <span class="icon icon-heart2"></span>
                                                                <span class="tooltip">Add to Wishlist</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#quickView" data-bs-toggle="modal"
                                                                class="bg-surface hover-tooltip tooltip-left box-icon quickview">
                                                                <span class="icon icon-view"></span>
                                                                <span class="tooltip">Quick View</span>
                                                            </a>
                                                        </li>
                                                        <li class="compare">
                                                            <a href="#compare" data-bs-toggle="modal"
                                                                class="bg-surface hover-tooltip tooltip-left box-icon">
                                                                <span class="icon icon-compare"></span>
                                                                <span class="tooltip">Add to Compare</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-product-info text-center">
                                                    <a href="product-detail.html"
                                                        class="name-product link fw-medium text-md">Galaxy S21
                                                        5G 128GB G991U Unlocked Smartphone</a>
                                                    <p class="price-wrap fw-medium">
                                                        <span class="price-new">$399.00</span>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="sw-dot-default sw-pagination-product-header justify-content-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item position-relative">
                        <a href="#" class="item-link">Pages<i class="icon icon-arr-down"></i></a>
                        <div class="sub-menu sub-menu-style-2">
                            <ul class="menu-list">
                                <li><a href="about-us.html" class="menu-link-text link">About</a></li>
                                <li><a href="contact-us.html" class="menu-link-text link">Contact</a></li>
                                <li><a href="store-location.html" class="menu-link-text link">Store
                                        location</a></li>
                                <li><a href="account-page.html" class="menu-link-text link">My account</a>
                                </li>
                                <li><a href="faq.html" class="menu-link-text link">FAQ</a></li>
                                <li><a href="view-cart.html" class="menu-link-text link">View cart</a></li>
                                <li><a href="404.html" class="menu-link-text link">404</a></li>
                                <li><a href="coming-soon.html" class="menu-link-text link">Coming Soon!</a>
                                </li>
                            </ul>
                            <ul class="menu-list">
                                <li><a href="index.html" class="menu-link-text link">Newsletter Popup 1</a></li>
                                <li><a href="newsletter-popup-02.html" class="menu-link-text link">Newsletter
                                        Popup 2</a></li>
                                <li><a href="newsletter-popup-03.html" class="menu-link-text link">Newsletter
                                        Popup 3</a></li>
                                <li><a href="cart-empty.html" class="menu-link-text link">Cart drawer empty</a>
                                </li>
                                <li><a href="cart-drawer-v2.html" class="menu-link-text link">Cart drawer
                                        v2</a></li>
                                <li><a href="before-you-leave.html" class="menu-link-text link">Before you
                                        leave</a></li>
                                <li><a href="cookies.html" class="menu-link-text link">Cookies</a></li>
                                <li><a href="home-fashion-02.html" class="menu-link-text link">Sub navtab
                                        products</a></li>
                            </ul>
                            <div class="banner hover-img">
                                <a href="blog-single.html" class="img-style">
                                    <img src="{{ asset('client/images/blog/banner-header.jpg') }}" alt="banner">
                                </a>
                                <div class="content">
                                    <div class="title">
                                        Unveiling the latest gear
                                    </div>
                                    <a href="blog-single.html" class="box-icon animate-btn"><i
                                            class="icon icon-arrow-top-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item position-relative">
                        <a href="#" class="item-link">Blog<i class="icon icon-arr-down"></i></a>
                        <div class="sub-menu sub-menu-style-3">
                            <ul class="menu-list mt-0">
                                <li>
                                    <div class="menu-heading">Blogs</div>
                                </li>
                                <li><a href="blog-list-01.html" class="menu-link-text link">Blog List 1</a>
                                </li>
                                <li><a href="blog-list-02.html" class="menu-link-text link">Blog List 2</a>
                                </li>
                                <li><a href="blog-grid-01.html" class="menu-link-text link">Blog Grid 1</a>
                                </li>
                                <li><a href="blog-grid-02.html" class="menu-link-text link">Blog Grid 2</a>
                                </li>
                                <li><a href="blog-single.html" class="menu-link-text link">Single Blog </a>
                                </li>
                            </ul>
                            <div class="wrapper-sub-blog">
                                <div class="menu-heading">Recent Posts</div>
                                <ul class="list-recent-blog">
                                    <li class="item">
                                        <a href="blog-single.html" class="img-box">
                                            <img src="{{ asset('client/images/blog/recent-1.jpg') }}" alt="img-recent-blog">
                                        </a>
                                        <div class="content">
                                            <a href="blog-single.html" class="fw-medium text-sm link title">The
                                                Power of
                                                Monochrome: Styling One Color</a>
                                            <span class="text-xxs text-grey date-post">Sep 19 2025</span>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <a href="blog-single.html" class="img-box">
                                            <img src="{{ asset('client/images/blog/recent-2.jpg') }}" alt="img-recent-blog">
                                        </a>
                                        <div class="content">
                                            <a href="blog-single.html" class="fw-medium text-sm link title">10
                                                Must-Have
                                                Accessories for Every Season</a>
                                            <span class="text-xxs text-grey date-post">Sep 19 2025</span>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <a href="blog-single.html" class="img-box">
                                            <img src="{{ asset('client/images/blog/recent-3.jpg') }}" alt="img-recent-blog">
                                        </a>
                                        <div class="content">
                                            <a href="blog-single.html" class="fw-medium text-sm link title">How
                                                to Elevate Your
                                                Look with Layering</a>
                                            <span class="text-xxs text-grey date-post">Sep 19 2025</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </li>
                    <li class="menu-item"><a
                            href="https://themeforest.net/item/vince-multipurpose-ecommerce-html5-template/57202368?s_rank=5"
                            target="_blank" class="item-link">Buy Theme!</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>