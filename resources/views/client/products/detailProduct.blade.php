@extends('client.layout.layout')

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-wrap">
                <div class="breadcrumb-list">
                    <a class="breadcrumb-item" href="{{ route('client.homeClient') }}">Home</a>
                    <div class="breadcrumb-item dot"><span></span></div>
                    <div class="breadcrumb-item current">Chi tiết sản phẩm: {{ $product['name'] }}</div>
                </div>
                <div class="breadcrumb-prev-next">
                    <a href="#" class="breadcrumb-prev"><i class="icon icon-arr-left"></i></a>
                    <a href="shop-default.html" class="breadcrumb-back"><i class="icon icon-shop"></i></a>
                    <a href="#" class="breadcrumb-next"><i class="icon icon-arr-right2"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Product Main -->
    <section class="flat-single-product">
        <div class="tf-main-product section-image-zoom">
            <div class="container">
                <div class="row">
                    <!-- Product Images -->
                    <div class="col-md-6">
                        <div class="tf-product-media-wrap sticky-top">
                            <div class="product-thumbs-slider">
                                <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom" data-preview="4"
                                    data-direction="vertical">
                                    <div class="swiper-wrapper stagger-wrap">
                                        <!-- black -->
                                        <div class="swiper-slide stagger-item" data-color="black" data-size="small">
                                            <div class="item">
                                                <img class="lazyload"
                                                    data-src="{{ asset('storage/' . $product['image_primary']) }}"
                                                    src="{{ asset('storage/' . $product['image_primary']) }}"
                                                    alt="img-product">
                                            </div>
                                        </div>
                                        @foreach ($product->albums as $item)
                                            <div class="swiper-slide stagger-item" data-color="black" data-size="medium">
                                                <div class="item">
                                                    <img class="lazyload"
                                                        data-src="{{ asset('storage/' . $item['image_path']) }}"
                                                        src="{{ asset('storage/' . $item['image_path']) }}"
                                                        alt="img-product">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="flat-wrap-media-product">
                                    <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                        <div class="swiper-wrapper">
                                            <!-- black -->
                                            <div class="swiper-slide" data-color="black" data-size="small">
                                                <a href="{{ asset('storage/' . $product['image_primary']) }}"
                                                    target="_blank" class="item" data-pswp-width="552px"
                                                    data-pswp-height="827px">
                                                    <img class="tf-image-zoom lazyload"
                                                        data-zoom="{{ asset('storage/' . $product['image_primary']) }}"
                                                        data-src="{{ asset('storage/' . $product['image_primary']) }}"
                                                        src="{{ asset('storage/' . $product['image_primary']) }}"
                                                        alt="img-product">
                                                </a>
                                            </div>
                                            @foreach ($product->albums as $item)
                                                <div class="swiper-slide" data-color="black" data-size="medium">
                                                    <a href="{{ asset('storage/' . $item['image_path']) }}" target="_blank"
                                                        class="item" data-pswp-width="552px" data-pswp-height="827px">
                                                        <img class="tf-image-zoom lazyload"
                                                            data-zoom="{{ asset('storage/' . $item['image_path']) }}"
                                                            data-src="{{ asset('storage/' . $item['image_path']) }}"
                                                            src="{{ asset('storage/' . $item['image_path']) }}"
                                                            alt="img-product">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="swiper-button-next nav-swiper thumbs-next"></div>
                                    <div class="swiper-button-prev nav-swiper thumbs-prev"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Product Images -->
                    <!-- Product Info -->
                    <div class="col-md-6">
                        <div class="tf-zoom-main"></div>
                        <div class="tf-product-info-wrap other-image-zoom">
                            <div class="tf-product-info-list">
                                <div class="tf-product-heading">
                                    <h5 class="product-name fw-medium">{{ $product['name'] }}</h5>
                                    <div class="product-rate">
                                        <div class="list-star">
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                        </div>
                                        <span class="count-review">(5 reviews)</span>
                                    </div>
                                    <div class="product-price">
                                        <div class="display-sm price-new">{{ $product->firstVariant['price'] }}₫</div>
                                        <div class="display-sm price-old">{{ $product->firstVariant['price'] }}₫</div>
                                    </div>
                                </div>

                                <!-- FORM THÊM GIỎ HÀNG -->
                                <form id="form-add-to-cart" action="{{ route('client.cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" id="input-quantity" value="1">

                                    <div class="tf-product-variant">
                                        <div class="variant-picker-item variant-color">
                                            <div class="variant-picker-label">Colors:</div>
                                            <div class="variant-picker-values">
                                                @foreach ($product->colors as $item)
                                                    <div class="hover-tooltip tooltip-bot color-btn active"
                                                        data-color="{{ $item->name }}">
                                                        <span class="check-color"
                                                            style="background-color: {{ $item->code }}"></span>
                                                        <span class="tooltip">{{ $item->name }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="variant-picker-item variant-size">
                                            <div class="variant-picker-label">
                                                <div>Size:<span
                                                        class="variant-picker-label-value value-currentSize"></span></div>
                                            </div>
                                            <div class="variant-picker-values">
                                                @foreach ($product->sizes as $item)
                                                    <span class="size-btn active"
                                                        data-size="{{ $item->name }}">{{ $item->name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tf-product-total-quantity">
                                        <div class="group-btn">
                                            <div class="wg-quantity">
                                                <button type="button" class="btn-quantity btn-decrease">-</button>
                                                <input class="quantity-product" type="text" name="number"
                                                    value="1" id="quantity-product">
                                                <button type="button" class="btn-quantity btn-increase">+</button>
                                            </div>

                                            <button type="submit" class="tf-btn animate-btn btn-add-to-cart"
                                                data-bs-toggle="offcanvas" data-bs-target="#shoppingCart">
                                                Thêm giỏ hàng
                                            </button>
                                        </div>

                                        <a href="javascript:void(0);" class="tf-btn btn-primary w-100 animate-btn">Mua ngay</a>

                                    </div>
                                </form>

                                <div class="tf-product-extra-link">
                                    <a href="javascript:void(0);" class="product-extra-icon link btn-add-wishlist">
                                        <i class="icon add icon-heart"></i><span class="add">Thêm vào yêu thích</span>
                                        <i class="icon added icon-trash"></i><span class="added">Xoá khỏi yêu
                                            thích</span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="modal" class="product-extra-icon link">
                                        <i class="icon icon-compare2"></i>Compare
                                    </a>
                                    <a href="#askQuestion" data-bs-toggle="modal" class="product-extra-icon link">
                                        <i class="icon icon-ask"></i>Ask a question
                                    </a>
                                    <a href="#shareSocial" data-bs-toggle="modal" class="product-extra-icon link">
                                        <i class="icon icon-share"></i>Share
                                    </a>
                                </div>

                                <div class="tf-product-trust-seal text-center">
                                    <p class="text-md text-dark-2 text-seal fw-medium">Guarantee Safe Checkout:</p>
                                    <ul class="list-card">
                                        <li class="card-item"><img src="{{ asset('client/images/payment/Visa.png') }}"
                                                alt="card"></li>
                                        <li class="card-item"><img
                                                src="{{ asset('client/images/payment/DinersClub.png') }}" alt="card">
                                        </li>
                                        <li class="card-item"><img
                                                src="{{ asset('client/images/payment/Mastercard.png') }}" alt="card">
                                        </li>
                                        <li class="card-item"><img src="{{ asset('client/images/payment/Stripe.png') }}"
                                                alt="card"></li>
                                        <li class="card-item"><img src="{{ asset('client/images/payment/PayPal.png') }}"
                                                alt="card"></li>
                                        <li class="card-item"><img
                                                src="{{ asset('client/images/payment/GooglePay.png') }}" alt="card">
                                        </li>
                                        <li class="card-item"><img
                                                src="{{ asset('client/images/payment/ApplePay.png') }}" alt="card">
                                        </li>
                                    </ul>
                                </div>

                                <div class="tf-product-delivery-return">
                                    <div class="product-delivery">
                                        <div class="icon icon-car2"></div>
                                        <p class="text-md">Thời gian giao hàng: <span class="fw-medium">Ước tính 3 - 5
                                                ngày</span></p>
                                    </div>
                                    <div class="product-delivery">
                                        <div class="icon icon-shipping3"></div>
                                        <p class="text-md">Miễn phí vận chuyển <span class="fw-medium">cho tất cả đơn trên
                                                100.000₫</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /Product Info -->

                </div>
            </div>
        </div>

    </section>
    <!-- /Product Main -->
    <!-- Product Description -->
    <section class="flat-spacing pt-0">
        <div class="container">
            <div class="widget-accordion wd-product-descriptions">
                <div class="accordion-title collapsed" data-bs-target="#description" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="description" role="button">
                    <span>Mô tả</span>
                    <span class="icon icon-arrow-down"></span>
                </div>
                <div id="description" class="collapse">
                    <div class="accordion-body widget-desc">
                        <div class="item">
                            {{-- <p class="fw-medium title">Composition</p>
                            <ul>
                                <li>Viscose 55%, Linen 45%</li>
                                <li>We exclude the weight of minor components</li>
                            </ul> --}}
                        </div>
                        {{-- <p class="item">Additional material information</p> --}}
                        <div class="item">
                            {{-- <p class="title">The total weight of this product contains:</p>
                            <ul>
                                <li>55% LivaEco™ viscose</li>
                                <li>Viscose 55%</li>
                            </ul> --}}
                        </div>
                        <ul class="item">
                            <li>{{ $product['description'] }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-accordion wd-product-descriptions">
                <div class="accordion-title collapsed" data-bs-target="#returnPolicies" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="returnPolicies" role="button">
                    <span>Chính sách hoàn trả</span>
                    <span class="icon icon-arrow-down"></span>
                </div>
                <div id="returnPolicies" class="collapse">
                    <div class="accordion-body">
                        <ul class="list-policies">
                            <li>
                                <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222">
                                    <path fill="currentColor"
                                        d="M8.7 30.7h22.7c.3 0 .6-.2.7-.6l4-25.3c-.1-.4-.3-.7-.7-.8s-.7.2-.8.6L34 8.9l-3-1.1c-2.4-.9-5.1-.5-7.2 1-2.3 1.6-5.3 1.6-7.6 0-2.1-1.5-4.8-1.9-7.2-1L6 8.9l-.7-4.3c0-.4-.4-.7-.7-.6-.4.1-.6.4-.6.8l4 25.3c.1.3.3.6.7.6zm.8-21.6c2-.7 4.2-.4 6 .8 1.4 1 3 1.5 4.6 1.5s3.2-.5 4.6-1.5c1.7-1.2 4-1.6 6-.8l3.3 1.2-3 19.1H9.2l-3-19.1 3.3-1.2zM32 32H8c-.4 0-.7.3-.7.7s.3.7.7.7h24c.4 0 .7-.3.7-.7s-.3-.7-.7-.7zm0 2.7H8c-.4 0-.7.3-.7.7s.3.6.7.6h24c.4 0 .7-.3.7-.7s-.3-.6-.7-.6zm-17.9-8.9c-1 0-1.8-.3-2.4-.6l.1-2.1c.6.4 1.4.6 2 .6.8 0 1.2-.4 1.2-1.3s-.4-1.3-1.3-1.3h-1.3l.2-1.9h1.1c.6 0 1-.3 1-1.3 0-.8-.4-1.2-1.1-1.2s-1.2.2-1.9.4l-.2-1.9c.7-.4 1.5-.6 2.3-.6 2 0 3 1.3 3 2.9 0 1.2-.4 1.9-1.1 2.3 1 .4 1.3 1.4 1.3 2.5.3 1.8-.6 3.5-2.9 3.5zm4-5.5c0-3.9 1.2-5.5 3.2-5.5s3.2 1.6 3.2 5.5-1.2 5.5-3.2 5.5-3.2-1.6-3.2-5.5zm4.1 0c0-2-.1-3.5-.9-3.5s-1 1.5-1 3.5.1 3.5 1 3.5c.8 0 .9-1.5.9-3.5zm4.5-1.4c-.9 0-1.5-.8-1.5-2.1s.6-2.1 1.5-2.1 1.5.8 1.5 2.1-.5 2.1-1.5 2.1zm0-.8c.4 0 .7-.5.7-1.2s-.2-1.2-.7-1.2-.7.5-.7 1.2.3 1.2.7 1.2z">
                                    </path>
                                </svg>
                            </li>
                            <li>
                                <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222">
                                    <path fill="currentColor"
                                        d="M36.7 31.1l-2.8-1.3-4.7-9.1 7.5-3.5c.4-.2.6-.6.4-1s-.6-.5-1-.4l-7.5 3.5-7.8-15c-.3-.5-1.1-.5-1.4 0l-7.8 15L4 15.9c-.4-.2-.8 0-1 .4s0 .8.4 1l7.5 3.5-4.7 9.1-2.8 1.3c-.4.2-.6.6-.4 1 .1.3.4.4.7.4.1 0 .2 0 .3-.1l1-.4-1.5 2.8c-.1.2-.1.5 0 .8.1.2.4.3.7.3h31.7c.3 0 .5-.1.7-.4.1-.2.1-.5 0-.8L35.1 32l1 .4c.1 0 .2.1.3.1.3 0 .6-.2.7-.4.1-.3 0-.8-.4-1zm-5.1-2.3l-9.8-4.6 6-2.8 3.8 7.4zM20 6.4L27.1 20 20 23.3 12.9 20 20 6.4zm-7.8 15l6 2.8-9.8 4.6 3.8-7.4zm22.4 13.1H5.4L7.2 31 20 25l12.8 6 1.8 3.5z">
                                    </path>
                                </svg>
                            </li>
                            <li>
                                <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222">
                                    <path fill="currentColor"
                                        d="M5.9 5.9v28.2h28.2V5.9H5.9zM19.1 20l-8.3 8.3c-2-2.2-3.2-5.1-3.2-8.3s1.2-6.1 3.2-8.3l8.3 8.3zm-7.4-9.3c2.2-2 5.1-3.2 8.3-3.2s6.1 1.2 8.3 3.2L20 19.1l-8.3-8.4zM20 20.9l8.3 8.3c-2.2 2-5.1 3.2-8.3 3.2s-6.1-1.2-8.3-3.2l8.3-8.3zm.9-.9l8.3-8.3c2 2.2 3.2 5.1 3.2 8.3s-1.2 6.1-3.2 8.3L20.9 20zm8.4-10.2c-1.2-1.1-2.6-2-4.1-2.6h6.6l-2.5 2.6zm-18.6 0L8.2 7.2h6.6c-1.5.6-2.9 1.5-4.1 2.6zm-.9.9c-1.1 1.2-2 2.6-2.6 4.1V8.2l2.6 2.5zM7.2 25.2c.6 1.5 1.5 2.9 2.6 4.1l-2.6 2.6v-6.7zm3.5 5c1.2 1.1 2.6 2 4.1 2.6H8.2l2.5-2.6zm18.6 0l2.6 2.6h-6.6c1.4-.6 2.8-1.5 4-2.6zm.9-.9c1.1-1.2 2-2.6 2.6-4.1v6.6l-2.6-2.5zm2.6-14.5c-.6-1.5-1.5-2.9-2.6-4.1l2.6-2.6v6.7z">
                                    </path>
                                </svg>
                            </li>
                            <li>
                                <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222">
                                    <path fill="currentColor"
                                        d="M35.1 33.6L33.2 6.2c0-.4-.3-.7-.7-.7H13.9c-.4 0-.7.3-.7.7s.3.7.7.7h18l.7 10.5H20.8c-8.8.2-15.9 7.5-15.9 16.4 0 .4.3.7.7.7h28.9c.2 0 .4-.1.5-.2s.2-.3.2-.5v-.2h-.1zm-28.8-.5C6.7 25.3 13 19 20.8 18.9h11.9l1 14.2H6.3zm11.2-6.8c0 1.2-1 2.1-2.1 2.1s-2.1-1-2.1-2.1 1-2.1 2.1-2.1 2.1 1 2.1 2.1zm6.3 0c0 1.2-1 2.1-2.1 2.1-1.2 0-2.1-1-2.1-2.1s1-2.1 2.1-2.1 2.1 1 2.1 2.1z">
                                    </path>
                                </svg>
                            </li>
                            <li>
                                <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222">
                                    <path fill="currentColor"
                                        d="M20 33.8c7.6 0 13.8-6.2 13.8-13.8S27.6 6.2 20 6.2 6.2 12.4 6.2 20 12.4 33.8 20 33.8zm0-26.3c6.9 0 12.5 5.6 12.5 12.5S26.9 32.5 20 32.5 7.5 26.9 7.5 20 13.1 7.5 20 7.5zm-.4 15h.5c1.8 0 3-1.1 3-3.7 0-2.2-1.1-3.6-3.1-3.6h-2.6v10.6h2.2v-3.3zm0-5.2h.4c.6 0 .9.5.9 1.7 0 1.1-.3 1.7-.9 1.7h-.4v-3.4z">
                                    </path>
                                </svg>
                            </li>
                            <li>
                                <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222">
                                    <path fill="currentColor"
                                        d="M30.2 29.3c2.2-2.5 3.6-5.7 3.6-9.3s-1.4-6.8-3.6-9.3l3.6-3.6c.3-.3.3-.7 0-.9-.3-.3-.7-.3-.9 0l-3.6 3.6c-2.5-2.2-5.7-3.6-9.3-3.6s-6.8 1.4-9.3 3.6L7.1 6.2c-.3-.3-.7-.3-.9 0-.3.3-.3.7 0 .9l3.6 3.6c-2.2 2.5-3.6 5.7-3.6 9.3s1.4 6.8 3.6 9.3l-3.6 3.6c-.3.3-.3.7 0 .9.1.1.3.2.5.2s.3-.1.5-.2l3.6-3.6c2.5 2.2 5.7 3.6 9.3 3.6s6.8-1.4 9.3-3.6l3.6 3.6c.1.1.3.2.5.2s.3-.1.5-.2c.3-.3.3-.7 0-.9l-3.8-3.6z">
                                    </path>
                                </svg>
                            </li>
                            <li>
                                <svg viewBox="0 0 40 40" width="35px" height="35px" color="#222">
                                    <path fill="currentColor"
                                        d="M34.1 34.1H5.9V5.9h28.2v28.2zM7.2 32.8h25.6V7.2H7.2v25.6zm13.5-18.3a.68.68 0 0 0-.7-.7.68.68 0 0 0-.7.7v10.9a.68.68 0 0 0 .7.7.68.68 0 0 0 .7-.7V14.5z">
                                    </path>
                                </svg>
                            </li>
                        </ul>
                        <p class="text-center text-paragraph">LT01: 70% wool, 15% polyester, 10% polyamide, 5%
                            acrylic 900 Grms/mt</p>
                    </div>
                </div>
            </div>
            <div class="widget-accordion wd-product-descriptions">
                <div class="accordion-title collapsed" data-bs-target="#addInformation" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="addInformation" role="button">
                    <span>Thông tin thêm</span>
                    <span class="icon icon-arrow-down"></span>
                </div>
                <div id="addInformation" class="collapse">
                    <div class="accordion-body">
                        <table class="tb-info-product text-md">
                            <tbody>
                                <tr class="tb-attr-item">
                                    <th class="tb-attr-label">Material</th>
                                    <td class="tb-attr-value">
                                        <p>100% Cotton</p>
                                    </td>
                                </tr>
                                <tr class="tb-attr-item">
                                    <th class="tb-attr-label">Color</th>
                                    <td class="tb-attr-value">
                                        <div class="d-flex">
                                            @foreach ($product->colors as $item)
                                                <p> {{ $item->name }} |</p>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                <tr class="tb-attr-item">
                                    <th class="tb-attr-label">Brand</th>
                                    <td class="tb-attr-value">
                                        <p>Vineta</p>
                                    </td>
                                </tr>
                                <tr class="tb-attr-item">
                                    <th class="tb-attr-label">Size</th>
                                    <td class="tb-attr-value">
                                        <div class="d-flex">
                                            @foreach ($product->sizes as $item)
                                                <p> {{ $item->name }} |</p>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="widget-accordion wd-product-descriptions">
                <div class="accordion-title collapsed" data-bs-target="#reviews" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="reviews" role="button">
                    <span>Reviews</span>
                    <span class="icon icon-arrow-down"></span>
                </div>
                <div id="reviews" class="collapse">
                    <div class="accordion-body wd-form-review">
                        123
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Product Description -->

    <!-- Recently Viewed -->
    <section class="flat-spacing">
        <div class="container">
            <div class="flat-title wow fadeInUp">
                <h4 class="title">Sản phẩm tương tự</h4>
            </div>
            <div class="fl-control-sw2 wrap-pos-nav sw-over-product wow fadeInUp">
                <div dir="ltr" class="swiper tf-swiper wrap-sw-over"
                    data-swiper='{
                        "slidesPerView": 2,
                        "spaceBetween": 12,
                        "speed": 800,
                        "observer": true,
                        "observeParents": true,
                        "slidesPerGroup": 2,
                        "navigation": {
                            "clickable": true,
                            "nextEl": ".nav-next-viewed",
                            "prevEl": ".nav-prev-viewed"
                        },
                        "pagination": { "el": ".sw-pagination-viewed", "clickable": true },
                        "breakpoints": {
                        "768": { "slidesPerView": 3, "spaceBetween": 12, "slidesPerGroup": 3 },
                        "1200": { "slidesPerView": 4, "spaceBetween": 24, "slidesPerGroup": 4}
                        }
                    }'>
                    <div class="swiper-wrapper">
                        <!-- Sản phẩm tương tự -->
                        @foreach ($similarProducts as $item)
                            <div class="swiper-slide">
                                <div class="card-product style-2">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="img-product lazyload"
                                                data-src="{{ asset('storage/' . $item->image_primary) }}"
                                                src="{{ asset('storage/' . $item->image_primary) }}" alt="image-product">
                                            <img class="img-hover lazyload"
                                                data-src="{{ asset('storage/' . $item->image_primary) }}"
                                                src="{{ asset('storage/' . $item->image_primary) }}" alt="image-product">
                                        </a>
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
                                                <a href="javascript:void(0);" class="box-icon hover-tooltip">
                                                    <span class="icon icon-heart2"></span>
                                                    <span class="tooltip">Thêm vào yêu thích</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#quickView" data-bs-toggle="modal"
                                                    class="box-icon quickview hover-tooltip">
                                                    <span class="icon icon-view"></span>
                                                    <span class="tooltip">Xem</span>
                                                </a>
                                            </li>
                                            {{-- <li class="compare">
                                                <a href="#compare" data-bs-toggle="modal" aria-controls="compare"
                                                    class="box-icon hover-tooltip">
                                                    <span class="icon icon-compare"></span>
                                                    <span class="tooltip">Add to Compare</span>
                                                </a>
                                            </li> --}}
                                        </ul>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="product-detail.html"
                                            class="name-product link fw-medium text-md">{{ $item->name }}</a>
                                        <p class="price-wrap fw-medium">
                                            <span class="price-new">{{ $item->firstVariant->price ?? 'N/A' }}₫</span>
                                            <span class=" price-old">{{ $item->firstVariant->price ?? 'N/A' }}₫</span>
                                        </p>
                                        <ul class="list-color-product">
                                            @foreach ($item->colors as $value)
                                                <li class="list-color-item color-swatch hover-tooltip tooltip-bot active">
                                                    <span class="tooltip color-filter">{{ $value->name }}</span>
                                                    <span class="swatch-value"
                                                        style="background-color: {{ $value->code }}"></span>
                                                    {{-- <img class=" lazyload" data-src="images/products/fashion/product-30.jpg"
                                                    src="images/products/fashion/product-30.jpg" alt="image-product"> --}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex d-xl-none sw-dot-default sw-pagination-viewed justify-content-center"></div>
                </div>
                <div class="d-none d-xl-flex swiper-button-next nav-swiper nav-next-viewed"></div>
                <div class="d-none d-xl-flex swiper-button-prev nav-swiper nav-prev-viewed"></div>
            </div>
        </div>
    </section>
    <!-- /Recently Viewed -->
@endsection
<script>
    const qtyInput = document.getElementById('quantity-product');
    const inputQty = document.getElementById('input-quantity');
    const btnIncrease = document.querySelector('.btn-increase');
    const btnDecrease = document.querySelector('.btn-decrease');

    btnIncrease.addEventListener('click', () => {
        qtyInput.value = parseInt(qtyInput.value) + 1;
        inputQty.value = qtyInput.value;
    });

    btnDecrease.addEventListener('click', () => {
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
            inputQty.value = qtyInput.value;
        }
    });

    qtyInput.addEventListener('input', () => {
        inputQty.value = qtyInput.value;
    });
</script>
