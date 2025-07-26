@extends('client.layout.layout')

@section('content')
<style>
    /* Style cho widget-accordion */
.widget-accordion {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    margin-top: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Style cho tiêu đề của mỗi accordion */
.accordion-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background-color: #f5f5f5;
    cursor: pointer;
    font-weight: bold;
    border-radius: 8px 8px 0 0;
}

.accordion-title:hover {
    background-color: #e0e0e0;
}

/* Style cho nội dung của accordion */
.accordion-body {
    padding: 20px;
    background-color: #fff;
    border-radius: 0 0 8px 8px;
    color: #555;
}

/* Style cho review-item */
.review-item {
    padding: 15px;
    border-bottom: 1px solid #e0e0e0;
    margin-bottom: 15px;
}

/* Style cho user-info */
.user-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.user-info .user-name {
    font-size: 16px;
    font-weight: bold;
}

.user-info .rating {
    font-size: 14px;
    color: #f39c12;
}

/* Style cho comment */
.comment {
    font-size: 14px;
    margin-bottom: 10px;
    line-height: 1.6;
}

/* Style cho admin-reply */
.admin-reply {
    padding: 10px 15px;
    background-color: #f1f1f1;
    border-left: 4px solid #2980b9;
    font-size: 14px;
}

.admin-reply strong {
    font-weight: bold;
    color: #2980b9;
}

/* Style cho các icon */
.icon {
    font-size: 16px;
    margin-left: 10px;
    transition: transform 0.3s;
}

.icon:hover {
    transform: rotate(180deg);
}

.icon-arrow-down {
    font-size: 18px;
    color: #999;
}

/* CSS cho responsive */
@media screen and (max-width: 768px) {
    .accordion-body {
        padding: 15px;
    }

    .review-item {
        padding: 10px;
    }
}

</style>
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

                                    </div>
                                    <div class="product-price">
                                            <p class="display-sm price-new">
                                                <!-- Hiển thị dải giá thay thế cho giá cũ và mới -->
                                                <span class="price-new" style="color: #ff4d4d;">
                                                    {{ $priceRange }}
                                                </span>
                                            </p>
                                    </div>
                                </div>

                                <!-- FORM THÊM GIỎ HÀNG -->
                                <!-- Thêm thông báo lỗi/thành công -->
                                <!-- Thêm thông báo lỗi/thành công -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form id="form-add-to-cart" action="{{ route('client.cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" id="input-quantity" value="1">
                                    <input type="hidden" name="id_color" id="input-color" value="">
                                    <input type="hidden" name="id_size" id="input-size" value="">

                                    <div class="tf-product-variant">
                                        <div class="variant-picker-item variant-color">
                                            <div class="variant-picker-label">Colors:</div>
                                            <div class="variant-picker-values">
                                                @foreach ($product->colors as $item)
                                                    <div class="hover-tooltip tooltip-bot color-btn {{ $loop->first ? 'active' : '' }}"
                                                        data-color="{{ $item->name }}"
                                                        data-color-id="{{ $item->id }}">
                                                        <span class="check-color"
                                                            style="background-color: {{ $item->code }}"></span>
                                                        <span class="tooltip">{{ $item->name }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="variant-picker-item variant-size">
                                            <div class="variant-picker-label">
                                                <div>Size: <span
                                                        class="variant-picker-label-value value-currentSize"></span></div>
                                            </div>
                                            <div class="variant-picker-values">
                                                @foreach ($product->sizes as $item)
                                                    <span class="size-btn {{ $loop->first ? 'active' : '' }}"
                                                        data-size="{{ $item->name }}"
                                                        data-size-id="{{ $item->id }}">{{ $item->name }}</span>
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

                                            <button type="submit" class="tf-btn animate-btn btn-add-to-cart">
                                                Thêm giỏ hàng
                                            </button>
                                        </div>

                                        <a href="javascript:void(0);" class="tf-btn btn-primary w-100 animate-btn">Mua
                                            ngay</a>
                                    </div>
                                </form>

                                <div class="tf-product-extra-link">
                                    <a href="javascript:void(0);" class="product-extra-icon link btn-add-wishlist">
                                        <i class="icon add icon-heart"></i><span class="add">Thêm vào yêu thích</span>
                                        <i class="icon added icon-trash"></i><span class="added">Xoá khỏi yêu
                                            thích</span>
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
                                        <p class="text-md"> Vận chuyển toàn quốc <span class="fw-medium">trên khắp đất nước</span></p>
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
        <!-- Mô tả -->
        <div class="widget-accordion wd-product-descriptions">
            <div class="accordion-title" data-bs-target="#description" data-bs-toggle="collapse"
                aria-expanded="true" aria-controls="description" role="button">
                <span>Mô tả</span>
                <span class="icon icon-arrow-down"></span>
            </div>
            <div id="description" class="collapse show">
                <div class="accordion-body widget-desc">
                    <div class="item">
                        <ul class="item">
                            <li>{{ $product['description'] }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



        <!-- Thông tin thêm -->
        <div class="widget-accordion wd-product-descriptions">
            <div class="accordion-title" data-bs-target="#addInformation" data-bs-toggle="collapse"
                aria-expanded="true" aria-controls="addInformation" role="button">
                <span>Thông tin thêm</span>
                <span class="icon icon-arrow-down"></span>
            </div>
            <div id="addInformation" class="collapse show">
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

        <!-- Reviews -->
<div class="widget-accordion wd-product-descriptions">
    <div class="accordion-title" data-bs-target="#reviews" data-bs-toggle="collapse"
        aria-expanded="true" aria-controls="reviews" role="button">
        <span>Reviews</span>
        <span class="icon icon-arrow-down"></span>
    </div>
    <div id="reviews" class="collapse show">
        <div class="accordion-body wd-form-review">
            @if($reviews->isEmpty())
                <p>Chưa có đánh giá cho sản phẩm này.</p>
            @else
                @foreach ($reviews as $review)
    <div class="review-item">
        <!-- Thêm phần tiêu đề trước tên người dùng và sao đánh giá -->
        <div class="user-info">
            <span class="user-name">Người dùng:{{ $review->user_name }}</span>
            <span class="rating">
                {{ str_repeat('★', $review->rating) }}
                {{ str_repeat('☆', 5 - $review->rating) }}
            </span>
        </div>

        <!-- Thêm tiêu đề cho phần bình luận -->
        <div class="comment-section">
            <span class="label">Bình luận:</span>
            <p class="comment">{{ $review->comment }}</p>
        </div>

        <!-- Phản hồi từ quản trị viên nếu có -->
        @if ($review->admin_reply)
            <div class="admin-reply">
                <strong>Phản hồi từ quản trị viên:</strong>
                <p>{{ $review->admin_reply }}</p>
            </div>
        @endif
    </div>
@endforeach

            @endif
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
document.addEventListener('DOMContentLoaded', function () {
    const qtyInput = document.getElementById('quantity-product');
    const inputQty = document.getElementById('input-quantity');
    const inputColor = document.getElementById('input-color');
    const inputSize = document.getElementById('input-size');
    const btnIncrease = document.querySelector('.btn-increase');
    const btnDecrease = document.querySelector('.btn-decrease');
    const colorButtons = document.querySelectorAll('.color-btn');
    const sizeButtons = document.querySelectorAll('.size-btn');
    const variantPickerLabel = document.querySelector('.value-currentSize');

    // Lấy giá trị mặc định
    // let selectedColorId = document.querySelector('.color-btn.active')?.dataset.colorId || '';
    // let selectedSizeId = document.querySelector('.size-btn.active')?.dataset.sizeId || '';



    // Xử lý chọn màu
    colorButtons.forEach(button => {
        button.addEventListener('click', () => {
            colorButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            selectedColorId = button.dataset.colorId;
            updateVariantInputs();
        });
    });

    // Xử lý chọn kích thước
    sizeButtons.forEach(button => {
        button.addEventListener('click', () => {
            sizeButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            selectedSizeId = button.dataset.sizeId;
            variantPickerLabel.textContent = button.dataset.size;
            updateVariantInputs();
        });
    });

    // Xử lý số lượng
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
    // Cập nhật input-color và input-size
    function updateVariantInputs() {
    if (!selectedColorId || !selectedSizeId) {
        alert('Vui lòng chọn màu và kích thước.');
        return; // dừng hàm lại nếu chưa đủ điều kiện
    }

    inputColor.value = selectedColorId;
    inputSize.value = selectedSizeId;
}
    qtyInput.addEventListener('input', () => {
        inputQty.value = qtyInput.value;
    });

    // Gọi lần đầu để thiết lập giá trị mặc định
    updateVariantInputs();
});
</script>
