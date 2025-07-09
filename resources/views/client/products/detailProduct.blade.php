@extends('client.layout.layout')

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-wrap">
                <div class="breadcrumb-list">
                    <a class="breadcrumb-item" href="{{ route('client.home') }}">Home</a>
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
                                        <div class="display-sm price-new">
                                            {{ $product->firstVariant['price'] }}₫</div>
                                        <div class="display-sm price-old">{{ $product->firstVariant['price'] }}₫</div>
                                        {{-- <span class="badge-sale">20% Off</span> --}}
                                    </div>
                                    {{-- <div class="product-stock">
                                        <svg class="icon" width="18" height="18" viewBox="0 0 18 18"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.2759 10.9242C15.2556 10.6149 14.9236 10.4281 14.6488 10.5714C14.4098 10.6961 13.6603 11.0196 13.0698 11.0196C12.6156 11.0196 12.3132 10.8694 12.3132 10.1362C12.3132 8.12636 15.0124 6.52078 12.6056 3.51218C12.3295 3.16719 11.773 3.41746 11.8469 3.85238C11.8484 3.86145 11.9887 4.77182 11.5632 5.27582C11.3635 5.51218 11.061 5.62711 10.6384 5.62711C9.17454 5.62711 9.27646 1.94027 11.1223 0.795793C11.5328 0.541367 11.2702 -0.0948905 10.8012 0.0119845C10.683 0.0387033 7.88684 0.701328 6.39105 3.62798C5.28035 5.80099 5.88191 7.29977 6.32116 8.39418C6.71371 9.3722 6.89283 9.81857 6.01364 10.4273C5.68251 10.6566 5.42618 10.6328 5.42618 10.6328C4.60384 10.6328 3.82489 9.42402 3.59437 8.95879C3.40712 8.57837 2.83721 8.67311 2.78314 9.09372C2.75993 9.27457 2.24057 13.5513 4.51026 16.1312C5.76076 17.5525 7.50054 18.0581 9.40742 17.9948C11.1702 17.9357 12.5768 17.3395 13.5883 16.2228C15.4639 14.152 15.2844 11.0549 15.2759 10.9242Z"
                                                fill="#F2721C" />
                                            <path
                                                d="M4.44845 10.1357C4.04521 9.74669 3.72761 9.22817 3.59412 8.95877C3.40688 8.57834 2.83696 8.67309 2.78289 9.0937C2.75969 9.27454 2.24032 13.5513 4.51001 16.1312C5.2812 17.0077 6.27795 17.5784 7.48458 17.8379C4.95987 16.3506 4.24181 13.0162 4.44845 10.1357Z"
                                                fill="#EA5513" />
                                            <path
                                                d="M3.73448 4.51577C3.70506 4.49735 3.66772 4.49735 3.6383 4.51577C2.64745 5.13712 2.64446 6.58633 3.6383 7.20955C3.66723 7.22769 3.70471 7.22825 3.73448 7.20955C4.72533 6.58816 4.72821 5.13898 3.73448 4.51577Z"
                                                fill="#F2721C" />
                                            <path
                                                d="M4.12025 4.85809C4.01204 4.72502 3.88239 4.60855 3.73448 4.51577C3.70506 4.49735 3.66772 4.49735 3.6383 4.51577C2.64745 5.13712 2.64446 6.58633 3.6383 7.20955C3.66723 7.22769 3.70471 7.22825 3.73448 7.20955C3.88242 7.11677 4.01208 7.00026 4.12029 6.8672C3.64157 6.28237 3.64072 5.44386 4.12025 4.85809Z"
                                                fill="#EA5513" />
                                            <path
                                                d="M10.8011 0.0119845C10.6829 0.0387033 7.88676 0.701328 6.39096 3.62798C4.90723 6.53083 6.48163 8.24741 6.63386 9.34639L6.63403 9.34629C6.69 9.74974 6.54569 10.0588 6.01356 10.4272C5.69392 10.6486 5.40494 10.6816 5.10034 10.5723V10.5727C5.10034 10.5727 6.17507 11.6058 7.26087 10.8972C8.33686 10.1951 8.02601 9.11809 7.85986 8.63131L7.86025 8.63103C7.46365 7.57951 7.11673 6.19027 8.09319 4.27988C8.67292 3.14557 9.44797 2.35153 10.1868 1.80263C10.426 1.38835 10.7395 1.0331 11.1223 0.795758C11.5326 0.541367 11.2701 -0.0948905 10.8011 0.0119845Z"
                                                fill="#EA5513" />
                                        </svg>
                                        <span class="text-dark">30 sold in last 24 hours</span>
                                    </div> --}}
                                    {{-- <div class="product-progress-sale">
                                        <div class="title-hurry-up"><span class="text-primary fw-medium">HURRY
                                                UP!</span> Only <span class="count">4</span> items left!</div>
                                        <div class="progress-sold">
                                            <div class="value" style="width: 0%;" data-progress="70"></div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="tf-product-variant">
                                    <div class="variant-picker-item variant-color">
                                        <div class="variant-picker-label">
                                            Colors:
                                        </div>
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
                                            <div>Size:<span class="variant-picker-label-value value-currentSize"></span>
                                            </div>
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
                                            <button class="btn-quantity btn-decrease">-</button>
                                            <input class="quantity-product" type="text" name="number"
                                                value="1">
                                            <button class="btn-quantity btn-increase">+</button>
                                        </div>
                                        <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                            class="tf-btn animate-btn btn-add-to-cart">Thêm giỏ hàng</a>
                                    </div>
                                    <a href="checkout.html" class="tf-btn btn-primary w-100 animate-btn">Mua ngay</a>
                                </div>
                                <div class="tf-product-extra-link">
                                    <a href="javascript:void(0);" class="product-extra-icon link btn-add-wishlist">
                                        <i class="icon add icon-heart"></i><span class="add">Thêm vào yêu thích</span>
                                        <i class="icon added icon-trash"></i><span class="added">Remove from
                                            wishlist</span>
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
                                        <li class="card-item">
                                            <img src="{{ asset('client/images/payment/Visa.png') }}" alt="card">
                                        </li>
                                        <li class="card-item">
                                            <img src="{{ asset('client/images/payment/DinersClub.png') }}"
                                                alt="card">
                                        </li>
                                        <li class="card-item">
                                            <img src="{{ asset('client/images/payment/Mastercard.png') }}"
                                                alt="card">
                                        </li>
                                        <li class="card-item">
                                            <img src="{{ asset('client/images/payment/Stripe.png') }}" alt="card">
                                        </li>
                                        <li class="card-item">
                                            <img src="{{ asset('client/images/payment/PayPal.png') }}" alt="card">
                                        </li>
                                        <li class="card-item">
                                            <img src="{{ asset('client/images/payment/GooglePay.png') }}" alt="card">
                                        </li>
                                        <li class="card-item">
                                            <img src="{{ asset('client/images/payment/ApplePay.png') }}" alt="card">
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
        {{-- <div class="tf-sticky-btn-atc">
            <div class="container">
                <div class="tf-height-observer w-100 d-flex align-items-center">
                    <div class="tf-sticky-atc-product d-flex align-items-center">
                        <div class="tf-sticky-atc-img">
                            <img class="lazyload" data-src="images/products/fashion/thumbs/thumb-black2.jpg"
                                alt="" src="images/products/fashion/thumbs/thumb-black2.jpg">
                        </div>
                        <div class="tf-sticky-atc-title fw-5 d-xl-block d-none">Long Sleeve T-Shirt</div>
                    </div>
                    <div class="tf-sticky-atc-infos">
                        <form class="">
                            <div class="tf-sticky-atc-variant-price text-center tf-select">
                                <select>
                                    <option selected="selected">Black / Small - $60.00</option>
                                    <option>Black / M - $60.00</option>
                                    <option>Black / L - $60.00</option>
                                    <option>Blue / S - $60.00</option>
                                    <option>Blue / M - $60.00</option>
                                    <option>Blue / L - $60.00</option>
                                    <option>Blue / XL - $60.00</option>
                                    <option>White / S - $60.00</option>
                                    <option>White / M - $60.00</option>
                                    <option>White / L - $60.00</option>
                                </select>
                            </div>
                            <div class="tf-sticky-atc-btns">
                                <div class="tf-product-info-quantity">
                                    <div class="wg-quantity">
                                        <button class="btn-quantity minus-btn">-</button>
                                        <input class="quantity-product font-4" type="text" name="number"
                                            value="1">
                                        <button class="btn-quantity plus-btn">+</button>
                                    </div>
                                </div>
                                <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                    class="tf-btn animate-btn d-inline-flex justify-content-center">Add to cart</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
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
            {{-- <div class="widget-accordion wd-product-descriptions">
                <div class="accordion-title collapsed" data-bs-target="#material" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="material" role="button">
                    <span>Materials</span>
                    <span class="icon icon-arrow-down"></span>
                </div>
                <div id="material" class="collapse">
                    <div class="accordion-body widget-material">
                        <div class="item">
                            <p class="fw-medium title">Materials Care</p>
                            <ul>
                                <li>Content: 100% LENZING™ ECOVERO™ Viscose</li>
                                <li>Care: Hand wash</li>
                                <li>Imported</li>
                                <li>Machine wash max. 30ºC. Short spin.</li>
                                <li>Iron maximum 110ºC.</li>
                                <li>Do not bleach/bleach.</li>
                                <li>Do not dry clean.</li>
                                <li>Tumble dry, medium hear.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
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
                                                <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                                    class="box-icon hover-tooltip">
                                                    <span class="icon icon-cart2"></span>
                                                    <span class="tooltip">Thêm vào giỏ hàng</span>
                                                </a>
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
                                                    <span class="tooltip color-filter">{{$value->name}}</span>
                                                    <span class="swatch-value" style="background-color: {{$value->code}}"></span>
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
