@extends('client.layout.layout')

@section('content')
    <!-- Slider -->
    <style>
        .category-image-container {
            width: 250px;

            height: 200px;
            /* Set the desired height */
            /* overflow: hidden; */
            /* Ẩn bất kỳ phần nào của hình ảnh vượt quá vùng chứa */
            margin-bottom: 20px;
        }

        .category-image-container img {
            width: 100%;
            /* Làm cho hình ảnh lấp đầy chiều rộng của vùng chứa */
            height: 100%;
            /* Làm cho hình ảnh lấp đầy chiều cao của vùng chứa */
            object-fit: cover;
            /* Thay đổi kích thước hình ảnh để bao phủ toàn bộ vùng chứa, cắt xén nếu cần thiết */
            object-position: center;
            /* Căn giữa hình ảnh trong vùng chứa */
        }
    </style>
    <div class="tf-slideshow slider-electronic slider-default">
        <div dir="ltr" class="swiper tf-sw-slideshow slider-effect-fade" data-preview="1" data-tablet="1" data-mobile="1"
            data-centered="false" data-space="0" data-space-mb="0" data-loop="true" data-auto-play="true">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="slider-wrap bg-type-4">
                        <div class="image">
                            <img src="images/slider/electronic/giày.jpng" data-src="images/slider/electronic/giày.jpg"
                                alt="slider" class="lazyload">
                        </div>
                        <div class="box-content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-12 col-sm-6">
                                        <div class="content-slider">
                                            <div class="box-title-slider">
                                                <p class="sub text-md fw-medium fade-item fade-item-1 text-dark-3">
                                                    Giày thể thao
                                                </p>
                                                <h2 class="heading fw-medium fade-item fade-item-2 text-dark-3">
                                                    Giảm tới <br> 15%
                                                </h2>
                                            </div>
                                            <div class="box-btn-slider fade-item fade-item-3">
                                                <a href="{{ route('client.listProducts') }}"
                                                    class="tf-btn btn-dark2 animate-btn">
                                                    Mua ngay
                                                    <i class="icon icon-arr-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide reverse-slide">
                    <div class="slider-wrap bg-type-5">
                        <div class="image">
                            <img src="images/slider/electronic/giày 1.jpg" data-src="images/slider/electronic/giày 1.jpg"
                                alt="slider" class="lazyload">
                        </div>
                        <div class="box-content">
                            <div class="container">
                                <div class="row">
                                    <div class=" offset-lg-8 col-lg-4 col-sm-6 offset-6 col-12">
                                        <div class="content-slider">
                                            <div class="box-title-slider">
                                                <p class="sub text-md fw-medium fade-item fade-item-1 text-dark-3">
                                                    Giày adidas
                                                </p>
                                                <h2 class="heading fw-medium fade-item fade-item-2 text-dark-3">
                                                    Thương hiệu <br> đẳng cấp
                                                </h2>

                                            </div>
                                            <div class="box-btn-slider fade-item fade-item-3">
                                                <a href="{{ route('client.listProducts') }}"
                                                    class="tf-btn btn-dark2 animate-btn">
                                                    Mua ngay
                                                    <i class="icon icon-arr-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slider-wrap bg-type-6 type-image-right">
                        <div class="image">
                            <img src="images/slider/electronic/giày 2.jpg" data-src="images/slider/electronic/giày 2.jpg"
                                alt="slider" class="lazyload">
                        </div>
                        <div class="box-content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-12 col-sm-6">
                                        <div class="content-slider">
                                            <div class="box-title-slider">
                                                <p class="sub text-md fw-medium fade-item fade-item-1 text-dark-3">
                                                    Giày Chất – Cuộc Sống Chất
                                                </p>
                                                <h2 class="heading fw-medium fade-item fade-item-2 text-dark-3">
                                                    Tiếp thêm năng lượng <br> Cho bước chạy của bạn
                                                </h2>

                                            </div>
                                            <div class="box-btn-slider fade-item fade-item-3">
                                                <a href="{{ route('client.listProducts') }}"
                                                    class="tf-btn btn-dark2 animate-btn">
                                                    Mua ngay
                                                    <i class="icon icon-arr-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrap-pagination">
                <div class="container">
                    <div class="sw-dots sw-pagination-slider justify-content-center"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Slider -->
    <!-- Marquee -->
    <div class="marquee-sale bg-light-green-2">
        <div class="marquee-wrapper">
            <div class="initial-child-container">
                <!-- 1 -->
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Giảm 50% cho một số sản phẩm</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Hàng Mới Về</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <!-- 2 -->
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Giảm 50% cho một số sản phẩm</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Hàng Mới Về</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <!-- 3 -->
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Giảm 50% cho một số sản phẩm</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Hàng Mới Về</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <!-- 4 -->
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Giảm 50% cho một số sản phẩm</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Hàng Mới Về</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <!-- 5 -->
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Giảm 50% cho một số sản phẩm</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Hàng Mới Về</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <!-- 6 -->
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Giảm 50% cho một số sản phẩm</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Hàng Mới Về</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <!-- 7 -->
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Giảm 50% cho một số sản phẩm</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>
                <div class="marquee-child-item">
                    <p class="display-xs fw-medium">Hàng Mới Về</p>
                </div>
                <div class="marquee-child-item"><i class="icon-flash-star"></i></div>

            </div>
        </div>
    </div>
    <!-- /Marquee -->
    <!-- Categories -->
    <section class="flat-spacing-3">
        <div class="container">
            <div class="flat-title text-start wow fadeInUp">
                <h4 class="title">Danh mục sản phẩm</h4>
            </div>
            <div class="wow fadeInUp">
                <div class="fl-control-sw pos3">
                    <div dir="ltr" class="swiper tf-swiper"
                        data-swiper='{
                        "slidesPerView": 2,
                        "spaceBetween": 12,
                        "speed": 800,
                        "observer": true,
                        "observeParents": true,
                        "slidesPerGroup": 2,
                        "navigation": {
                            "clickable": true,
                            "nextEl": ".nav-next-categories",
                            "prevEl": ".nav-prev-categories"
                        },
                        "pagination": { "el": ".sw-pagination-categories", "clickable": true },
                        "breakpoints": {
                        "575": { "slidesPerView": 3, "spaceBetween": 12 ,"slidesPerGroup": 3 },
                        "768": { "slidesPerView": 4, "spaceBetween": 12, "slidesPerGroup": 4 },
                        "992": { "slidesPerView": 5, "spaceBetween": 24, "slidesPerGroup": 4 },
                        "1200": { "slidesPerView": 6, "spaceBetween": 24, "slidesPerGroup": 4}
                        }
                    }'>
                        <div class="swiper-wrapper">
                            <!-- item 1 -->

                            @foreach ($categories as $category)
                                <div class="swiper-slide">
                                    <div class="wg-cls style-square hover-img">
                                        <a href="#category-{{ $category->id }}" class="image img-style d-block">
                                            <div class="category-image-container">
                                                <img src="{{ asset('storage/' . $category->image) }}"
                                                    alt="{{ $category->name }}">
                                            </div>


                                            <div class="cls-content text-center">
                                                <span class="link text-md fw-medium">{{ $category->name }}</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex d-xl-none sw-dot-default sw-pagination-categories justify-content-center">
                        </div>
                    </div>
                    <div class="swiper-button-next d-none d-xl-flex nav-swiper nav-next-categories"></div>
                    <div class="swiper-button-prev d-none d-xl-flex nav-swiper nav-prev-categories"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Categories -->
    <!-- Top Pick -->
    <section class="flat-spacing-8 bg-surface">
        <div class="container">
            <div class="flat-title style-between align-items-end wow fadeInUp">
                <div class="box-title">
                    <h4 class="title">Top sản phẩm mới nhất</h4>
                    <p class="desc text-main text-md">Khám phá những sản phẩm phổ biến nhất của chúng tôi mà khách hàng
                        không thể có đủ</p>
                </div>

                <a href="{{ route('client.listProducts') }}" class="btn-underline">View all</a>
            </div>
            <div class="fl-control-sw">
                <div dir="ltr" class="sw-height swiper tf-swiper"
                    data-swiper='{
                    "slidesPerView": 2,
                    "spaceBetween": 12,
                    "speed": 800,
                    "observer": true,
                    "observeParents": true,
                    "slidesPerGroup": 2,
                    "navigation": {
                        "clickable": true,
                        "nextEl": ".nav-next-top-pick",
                        "prevEl": ".nav-prev-top-pick"
                    },
                    "pagination": { "el": ".sw-pagination-top-pick", "clickable": true },
                    "breakpoints": {
                    "768": { "slidesPerView": 3, "spaceBetween": 12, "slidesPerGroup": 3 },
                    "1200": { "slidesPerView": 4, "spaceBetween": 24, "slidesPerGroup": 4}
                    }
                }'>
                    <div class="swiper-wrapper wow fadeInUp">
                        <!-- Sản phẩm bán chạy -->
                        {{-- @foreach ($products as $item)
                            <div class="swiper-slide">
                                <div class="card-product style-center">
                                    <div class="card-product-wrapper">

                                        <a href="{{ route('client.detailProduct', $item->id) }}" class="product-img">
                                            <img class="img-product lazyload"
                                                data-src="{{ asset('storage/' . $item->image_primary) }}"
                                                src="{{ asset('storage/' . $item->image_primary) }}" alt="image-product">
                                            <img class="img-hover lazyload"
                                                data-src="{{ asset('storage/' . $item->image_primary) }}"
                                                src="{{ asset('storage/' . $item->image_primary) }}" alt="image-product">
                                        </a>
                                        <div class="on-sale-wrap flex-column type-2">
                                            <span class="on-sale-item">20% Off</span>
                                            <span class="on-sale-item trending">Trending</span>
                                        </div>
                                        <ul class="list-product-btn">
                                            <li>

                                                <a href="javascript:void(0);"
                                                    onclick="document.getElementById('quick-add-{{ $item->id }}').submit();"
                                                    class="bg-surface hover-tooltip tooltip-left box-icon">
                                                    <span class="icon icon-cart2"></span>
                                                    <span class="tooltip">Quick Add</span>
                                                </a>


                                                <form id="quick-add-{{ $item->id }}"
                                                    action="{{ route('client.cart.add') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                </form>
                                            </li>
                                            <li class="wishlist">
                                                <a href="#" class="bg-surface hover-tooltip tooltip-left box-icon">
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
                                            class="name-product link fw-medium text-md">{{ $item->name }} </a>
                                        <p class="price-wrap fw-medium">
                                            <span class="price-new">{{ $item->firstVariant->price ?? 'N/A' }}₫</span>
                                            <span class="price-old old-line">190.00₫</span>
                                        </p>
                                        <ul class="list-color-product justify-content-center">
                                            @foreach ($item->colors as $value)
                                                <li class="list-color-item color-swatch hover-tooltip tooltip-bot active">
                                                    <span class="tooltip">{{ $value->name }}</span>
                                                    <span class="swatch-value"
                                                        style="background-color: {{ $value->code }}"></span>

                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}
                        @foreach ($products as $item)
                            <div class="swiper-slide">
                                <div class="card-product style-center">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('client.detailProduct', $item->id) }}" class="product-img">
                                            <img class="img-product lazyload"
                                                data-src="{{ asset('storage/' . $item->image_primary) }}"
                                                src="{{ asset('storage/' . $item->image_primary) }}" alt="image-product">
                                            <img class="img-hover lazyload"
                                                data-src="{{ asset('storage/' . $item->image_primary) }}"
                                                src="{{ asset('storage/' . $item->image_primary) }}" alt="image-product">
                                        </a>
                                        <div class="on-sale-wrap flex-column type-2">
                                            <span class="on-sale-item">20% Off</span>
                                            <span class="on-sale-item trending">Trending</span>
                                        </div>
                                        <ul class="list-product-btn">

                                            <li class="wishlist">
                                                <a href="#" class="bg-surface hover-tooltip tooltip-left box-icon">
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
                                        <a href="{{ route('client.detailProduct', $item->id) }}"
                                            class="name-product link fw-medium text-md">{{ $item->name }}</a>
                                        <p class="price-wrap fw-medium">
                                            <span
                                                class="price-new">{{ number_format($item->firstVariant->price ?? 0, 0, ',', '.') }}
                                                ₫</span>
                                            <span
                                                class="price-old old-line">{{ number_format(($item->firstVariant->price ?? 0) * 1.2, 0, ',', '.') }}
                                                ₫</span>
                                        </p>
                                        <ul class="list-color-product justify-content-center">
                                            @foreach ($item->colors as $value)
                                                <li class="list-color-item color-swatch hover-tooltip tooltip-bot active">
                                                    <span class="tooltip">{{ $value->name }}</span>
                                                    <span class="swatch-value"
                                                        style="background-color: {{ $value->code }}"></span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <script>
                            function validateForm(formId) {
                                var form = document.getElementById(formId);
                                var select = form.querySelector('select[name="id_variant"]');
                                if (!select.value) {
                                    alert('Vui lòng chọn biến thể sản phẩm!');
                                    return false;
                                }
                                return true;
                            }
                        </script>

                    </div>
                    <div class="d-flex d-xl-none sw-dot-default sw-pagination-top-pick justify-content-center">
                    </div>
                </div>
                <div class="swiper-button-next d-none d-xl-flex nav-swiper nav-next-top-pick"></div>
                <div class="swiper-button-prev d-none d-xl-flex nav-swiper nav-prev-top-pick"></div>
            </div>
        </div>
    </section>
    <!-- /Top Pick -->
    <!-- Banner Collection-->
    <div class="s-banner-colection banner-cls-electric flat-spacing-3">
        <div class="container">
            <div class="banner-content tf-grid-layout tf-col-2 hover-overlay-2">
                <div class="image">
                    <img src="images/banner/Giày 4.png" alt="images/banner/Giày 4.png" class="lazyload">
                </div>
                <div class="box-content">
                    <div class="box-title-banner wow fadeInUp">
                        <p class="title display-md fw-medium">
                            Thoải Mái Từng Bước Chân
                        </p>
                        <p class="sub text-md text-main">
                            Đổi giày mới đi chơi – chất mà không chát.
                        </p>
                    </div>
                    <div class="box-btn-banner wow fadeInUp">
                        <a href="{{ route('client.listProducts') }}" class="tf-btn btn-dark2 animate-btn">
                            Mua ngay
                            <i class="icon icon-arr-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade popup-search" id="search">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="header">
                    <button class="icon-close icon-close-popup" data-bs-dismiss="modal"></button>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="looking-for-wrap">
                                <div class="heading">Bạn đang tìm kiếm gì?</div>
                                <form class="form-search" action="{{ route('client.shop.search') }}" method="GET">
                                    <fieldset class="text">
                                        <input type="text" placeholder="Search" class="" name="search"
                                            tabindex="0" value="{{ request('search') }}" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <button type="submit">
                                        <i class="icon icon-search"></i>
                                    </button>
                                </form>
                                <div class="popular-searches justify-content-md-center">
                                    <div class="text fw-medium">Phổ Biến Nhất:</div>
                                    <ul>
                                        <li><a class="link" href="#">Sản Phẩm Mới</a></li>
                                        <li><a class="link" href="#">Giày Thể Thao</a></li>
                                        <li><a class="link" href="#">Giày Nam</a></li>
                                        <li><a class="link" href="#">Giảm Giá</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="featured-product">
                                <div class="text-xl-2 fw-medium featured-product-heading">Sản Phẩm Nổi Bật</div>
                                <div dir="ltr" class="swiper tf-swiper wrap-sw-over"
                                    data-swiper='{
                                        "slidesPerView": 2,
                                        "spaceBetween": 12,
                                        "speed": 800,
                                        "observer": true,
                                        "observeParents": true,
                                        "slidesPerGroup": 2,
                                        "pagination": { "el": ".sw-pagination-search", "clickable": true },
                                        "breakpoints": {
                                        "768": { "slidesPerView": 3, "spaceBetween": 12, "slidesPerGroup": 3 },
                                        "1200": { "slidesPerView": 4, "spaceBetween": 24, "slidesPerGroup": 4}
                                        }
                                    }'>
                                    <div class="swiper-wrapper">
                                        @foreach ($products as $item)
                                            <div class="swiper-slide">
                                                <div class="card-product style-3 card-product-size border rounded shadow-sm">
                                                    <div class="card-product-wrapper">
                                                        <a href="product-detail.html" class="product-img">
                                                            <img class="img-product lazyload"
                                                                data-src="{{ asset('storage/' . $item->image_primary) }}"
                                                                src="{{ asset('storage/' . $item->image_primary) }}"
                                                                alt="image-product">
                                                            <img class="img-hover lazyload"
                                                                data-src="{{ asset('storage/' . $item->image_primary) }}"
                                                                src="{{ asset('storage/' . $item->image_primary) }}"
                                                                alt="image-product">
                                                        </a>
                                                        <div class="on-sale-wrap flex-column type-2">
                                                            <span class="on-sale-item">20% Off</span>
                                                            <span class="on-sale-item trending">Trending</span>
                                                        </div>
                                                        <ul class="list-product-btn">
                                                            <li>
                                                                <a href="javascript:void(0);"
                                                                    class="box-icon hover-tooltip wishlist">
                                                                    <span class="icon icon-heart2"></span>
                                                                    <span class="tooltip">Add to Wishlist</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);"
                                                                    class="btn-quickview box-icon hover-tooltip quickview">
                                                                    <span class="icon icon-view"></span>
                                                                    <span class="tooltip">Quick View</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);"
                                                                    class="box-icon hover-tooltip compare btn-compare">
                                                                    <span class="icon icon-compare"></span>
                                                                    <span class="tooltip">Add to Compare</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div class="product-btn-main">
                                                            <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                                                class="btn-main-product">
                                                                <span class="icon icon-cart2"></span>
                                                                <span class="text-md fw-medium">
                                                                    Add to Cart
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <ul class="size-box">
                                                            @foreach ($item->sizes as $value)
                                                                <li class="size-item text-xs text-white">
                                                                    {{ $value->name }}</li>
                                                            @endforeach

                                                        </ul>
                                                    </div>

                                                    <div class="card-product-info text-center">
                                                        <a href="product-detail.html"
                                                            class="name-product link fw-medium text-md">{{ $item->name }}</a>
                                                        <p class="price-wrap fw-medium">
                                                            <span
                                                                class="price-new">{{ $item->firstVariant->price ?? 'N/A' }}</span>
                                                            {{-- <span class="price-old">$100.00</span> --}}
                                                        </p>
                                                        <ul class="list-color-product justify-content-center">
                                                            @foreach ($item->colors as $value)
                                                                <li
                                                                    class="list-color-item color-swatch hover-tooltip tooltip-bot active">
                                                                    <span
                                                                        class="tooltip color-filter">{{ $value->name }}</span>
                                                                    <span class="swatch-value"
                                                                        style="background-color: {{ $value->code }}"></span>
                                                                    {{-- <img class="lazyload"
                                                                data-src="images/products/fashion/product-27.jpg"
                                                                src="images/products/fashion/product-27.jpg"
                                                                alt="image-product"> --}}
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div
                                        class="d-flex d-xl-none sw-dot-default sw-pagination-search justify-content-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /search -->
    <div>

        <!-- Products by category -->
        @foreach ($categoriesWithProducts as $cate)
            <section class="bg-surface flat-spacing-8" id="category-{{ $cate->id }}">
                <div class="container">
                    <div class="flat-title mb_1 style-between wow fadeInUp">
                        <div class="box-title">
                            <h4 class="title">{{ $cate->name }}</h4>
                        </div>
                    </div>
                    <div class="fl-control-sw wow fadeInUp">
                        <div dir="ltr" class="swiper tf-swiper sw-height"
                            data-swiper='{
                    "slidesPerView": 2,
                    "spaceBetween": 12,
                    "speed": 800,
                    "observer": true,
                    "observeParents": true,
                    "slidesPerGroup": 2,
                    "navigation": {
                        "clickable": true,
                        "nextEl": ".nav-next-deal",
                        "prevEl": ".nav-prev-deal"
                    },
                    "pagination": { "el": ".sw-pagination-deal", "clickable": true },
                    "breakpoints": {
                    "768": { "slidesPerView": 3, "spaceBetween": 12, "slidesPerGroup": 3 },
                    "1200": { "slidesPerView": 4, "spaceBetween": 24, "slidesPerGroup": 4}
                    }
                }'>
                            <div class="swiper-wrapper">
                                <!-- PRODUCTS -->
                                @foreach ($cate->products as $item)
                                    <div class="swiper-slide">
                                        <div class="card-product style-center">
                                            <div class="card-product-wrapper">
                                                <a href="{{ route('client.detailProduct', $item->id) }}"
                                                    class="product-img">
                                                    <img class="img-product lazyload"
                                                        data-src="{{ asset('storage/' . $item->image_primary) }}"
                                                        src="{{ asset('storage/' . $item->image_primary) }}"
                                                        alt="image-product">
                                                    <img class="img-hover lazyload"
                                                        data-src="{{ asset('storage/' . $item->image_primary) }}"
                                                        src="{{ asset('storage/' . $item->image_primary) }}"
                                                        alt="image-product">
                                                </a>
                                                <div class="on-sale-wrap flex-column type-2">
                                                    <span class="on-sale-item">20% Off</span>
                                                    <span class="on-sale-item trending">Trending</span>
                                                </div>
                                                <ul class="list-product-btn">
                                                    <li>
                                                        <a href="#quickAdd" data-bs-toggle="modal"
                                                            class="bg-surface hover-tooltip tooltip-left box-icon">
                                                            <span class="icon icon-cart2"></span>
                                                            <span class="tooltip">Quick Add</span>
                                                        </a>
                                                    </li>
                                                    <li class="wishlist">
                                                        <a href="#"
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
                                                    class="name-product link fw-medium text-md">{{ $item->name }} </a>
                                                <p class="price-wrap fw-medium">
                                                    <span
                                                        class="price-new">{{ $item->firstVariant->price ?? 'N/A' }}₫</span>
                                                    <span class="price-old old-line">190.00₫</span>
                                                </p>
                                                <ul class="list-color-product justify-content-center">
                                                    @foreach ($item->colors as $value)
                                                        <li
                                                            class="list-color-item color-swatch hover-tooltip tooltip-bot active">
                                                            <span class="tooltip">{{ $value->name }}</span>
                                                            <span class="swatch-value"
                                                                style="background-color: {{ $value->code }}"></span>

                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex d-xl-none sw-dot-default sw-pagination-deal justify-content-center"></div>
                        </div>
                        <div class="swiper-button-next d-none d-xl-flex nav-swiper nav-next-deal"></div>
                        <div class="swiper-button-prev d-none d-xl-flex nav-swiper nav-prev-deal"></div>
                    </div>
                </div>
            </section>
        @endforeach


    </div>


    <!-- Brand -->
    <div class="flat-spacing-2">
        <div class="container">
            <div dir="ltr" class="swiper tf-swiper sw-brand"
                data-swiper='{
                "slidesPerView": 2,
                "spaceBetween": 0,
                "speed": 800,
                "observer": true,
                "observeParents": true,
                "slidesPerGroup": 2,
                "pagination": { "el": ".sw-pagination-brand", "clickable": true },
                "breakpoints": {
                "575": { "slidesPerView": 3},
                "991": { "slidesPerView": 4},
                "1200": { "slidesPerView": 6}
                }
            }'>
                <div class="swiper-wrapper">
                    <!-- item 1 -->
                    <div class="swiper-slide">
                        <div class="brand-item wow fadeInLeft">
                            <img src="images/brand/zara.png" alt="brand">
                        </div>
                    </div>
                    <!-- item 2 -->
                    <div class="swiper-slide">
                        <div class="brand-item wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="images/brand/bear.png" alt="brand">
                        </div>
                    </div>
                    <!-- item 3 -->
                    <div class="swiper-slide">
                        <div class="brand-item wow fadeInLeft" data-wow-delay="0.2s">
                            <img src="images/brand/nike.png" alt="brand">
                        </div>
                    </div>
                    <!-- item 4 -->
                    <div class="swiper-slide">
                        <div class="brand-item wow fadeInLeft" data-wow-delay="0.3s">
                            <img src="images/brand/asos.png" alt="brand">
                        </div>
                    </div>
                    <!-- item 5 -->
                    <div class="swiper-slide">
                        <div class="brand-item wow fadeInLeft" data-wow-delay="0.4s">
                            <img src="images/brand/burberry.png" alt="brand">
                        </div>
                    </div>
                    <!-- item 6 -->
                    <div class="swiper-slide">
                        <div class="brand-item wow fadeInLeft" data-wow-delay="0.5s">
                            <img src="images/brand/forever.png" alt="brand">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex d-xl-none sw-dot-default sw-pagination-brand justify-content-center"></div>
        </div>
    </div>
    <!-- /Brand -->
    <!-- Icon box -->
    <div class="flat-spacing-18">
        <div class="container">
            <div class="mw-1 m-auto flat-spacing-7">
                <div dir="ltr" class="swiper tf-swiper sw-auto tf-sw-iconbox-row"
                    data-swiper='{
                "slidesPerView": 1,
                "spaceBetween": 12,
                "speed": 800,
                "preventInteractionOnTransition": false,
                "touchStartPreventDefault": false,
                "slidesPerGroup": 1,
                "pagination": { "el": ".sw-pagination-iconbox", "clickable": true },
                "breakpoints": {
                    "575": { "slidesPerView": 2, "spaceBetween": 12},
                    "768": { "slidesPerView": 3, "spaceBetween": 24},
                    "1200": { "slidesPerView": "auto", "spaceBetween": 59}
                }
            }'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-3 wow fadeInLeft">
                                <div class="box-icon">
                                    <i class="icon icon-shipping"></i>
                                </div>
                                <div class="content">
                                    <div class="title text-uppercase">Free Shipping</div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-3 wow fadeInLeft">
                                <div class="box-icon">
                                    <i class="icon icon-gift"></i>
                                </div>
                                <div class="content">
                                    <div class="title text-uppercase">Tặng quà</div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-3 wow fadeInLeft">
                                <div class="box-icon">
                                    <i class="icon icon-return"></i>
                                </div>
                                <div class="content">
                                    <div class="title text-uppercase">Hoàn trả dễ dàng</div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-3 wow fadeInLeft">
                                <div class="box-icon">
                                    <i class="icon icon-support"></i>
                                </div>
                                <div class="content">
                                    <div class="title text-uppercase">Bảo hành 1 năm</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex d-xl-none sw-dot-default sw-pagination-iconbox justify-content-center"></div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Icon box -->
@endsection
