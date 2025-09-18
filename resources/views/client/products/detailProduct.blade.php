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
                                    <!-- Thumbnails -->
                                    <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom" data-preview="4"
                                        data-direction="vertical">
                                        <div class="swiper-wrapper stagger-wrap">
                                            <!-- Ảnh chính -->
                                            <div class="swiper-slide stagger-item">
                                                <div class="item">
                                                    <img class="lazyload"
                                                        data-src="{{ asset('storage/' . $product->image_primary) }}"
                                                        src="{{ asset('storage/' . $product->image_primary) }}"
                                                        alt="img-product">
                                                </div>
                                            </div>

                                            <!-- Album -->
                                            @foreach ($product->albums as $item)
                                                <div class="swiper-slide stagger-item">
                                                    <div class="item">
                                                        <img class="lazyload"
                                                            data-src="{{ asset('storage/' . $item->image_path) }}"
                                                            src="{{ asset('storage/' . $item->image_path) }}"
                                                            alt="img-product">
                                                    </div>
                                                </div>
                                            @endforeach

                                            <!-- Ảnh biến thể -->
                                            @foreach ($product->variants as $variant)
                                                @if($variant->image)
                                                    <div class="swiper-slide stagger-item">
                                                        <div class="item">
                                                            <img class="lazyload"
                                                                data-src="{{ asset('storage/' . $variant->image) }}"
                                                                src="{{ asset('storage/' . $variant->image) }}"
                                                                alt="variant-image">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Main gallery -->
                                    <div class="flat-wrap-media-product">
                                        <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                            <div class="swiper-wrapper">
                                                <!-- Ảnh chính -->
                                                <div class="swiper-slide">
                                                    <a href="{{ asset('storage/' . $product->image_primary) }}"
                                                        target="_blank" class="item" data-pswp-width="552px" data-pswp-height="827px">
                                                        <img class="tf-image-zoom lazyload"
                                                            data-zoom="{{ asset('storage/' . $product->image_primary) }}"
                                                            data-src="{{ asset('storage/' . $product->image_primary) }}"
                                                            src="{{ asset('storage/' . $product->image_primary) }}"
                                                            alt="img-product">
                                                    </a>
                                                </div>

                                                <!-- Album -->
                                                @foreach ($product->albums as $item)
                                                    <div class="swiper-slide">
                                                        <a href="{{ asset('storage/' . $item->image_path) }}" target="_blank"
                                                            class="item" data-pswp-width="552px" data-pswp-height="827px">
                                                            <img class="tf-image-zoom lazyload"
                                                                data-zoom="{{ asset('storage/' . $item->image_path) }}"
                                                                data-src="{{ asset('storage/' . $item->image_path) }}"
                                                                src="{{ asset('storage/' . $item->image_path) }}"
                                                                alt="img-product">
                                                        </a>
                                                    </div>
                                                @endforeach

                                                <!-- Ảnh biến thể -->
                                                @foreach ($product->variants as $variant)
                                                    @if($variant->image)
                                                        <div class="swiper-slide"
                                                            data-color-id="{{ $variant->id_color }}"
                                                            data-size-id="{{ $variant->id_size }}">
                                                            <a href="{{ asset('storage/' . $variant->image) }}" target="_blank"
                                                                class="item" data-pswp-width="552px" data-pswp-height="827px">
                                                                <img class="tf-image-zoom lazyload"
                                                                    data-zoom="{{ asset('storage/' . $variant->image) }}"
                                                                    data-src="{{ asset('storage/' . $variant->image) }}"
                                                                    src="{{ asset('storage/' . $variant->image) }}"
                                                                    alt="variant-image">
                                                            </a>
                                                        </div>
                                                    @endif
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
                                    <input type="hidden" name="id_color" id="input-color" value="">
                                    <input type="hidden" name="id_size" id="input-size" value="">
                                     <p id="stock-display" style="color: red; font-weight: bold;">Chọn màu và size để xem tồn kho</p>
                                    <div class="tf-product-variant">
                                        <div class="variant-picker-item variant-color">
                                            <div class="variant-picker-label">
                                                <div>Color: <span class="variant-picker-label-value value-currentColor"></span></div>
                                            </div>
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
                                                <input class="quantity-product"
                                                        type="number"
                                                        name="quantity"
                                                        id="quantity-product-{{ $product->id }}"
                                                        value="1" min="1" step="1">
                                                <button type="button" class="btn-quantity btn-increase">+</button>
                                            </div>

                                            <button type="submit" class="tf-btn animate-btn btn-add-to-cart">
                                                Thêm giỏ hàng
                                            </button>
                                        </div>



                                    </div>
                                </form>
                                <button type="button" class="tf-btn btn-primary w-100 animate-btn"
                                                        onclick="return buyNowStandalone({{ $product->id }})">
                                                Mua ngay
                                                </button>

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
function buyNowStandalone(productId){
  // tự đọc lựa chọn hiện tại từ DOM, không phụ thuộc biến toàn cục
  const colorEl = document.querySelector('.color-btn.active');
  const sizeEl  = document.querySelector('.size-btn.active');
  if(!colorEl || !sizeEl){
    alert('Vui lòng chọn màu và kích thước.');
    return false;
  }
  const selectedColorId = colorEl.dataset.colorId;
  const selectedSizeId  = sizeEl.dataset.sizeId;
  const qtyInput = document.getElementById('quantity-product-' + productId);
  const qtyValue = parseInt(qtyInput?.value, 10) || 1;

  // tạo form tạm và submit sang buyNow
  const f = document.createElement('form');
  f.method = 'POST';
  f.action = "{{ route('client.cart.buyNow') }}";

  const token = document.createElement('input');
  token.type='hidden'; token.name='_token'; token.value="{{ csrf_token() }}"; f.appendChild(token);

  const pid = document.createElement('input');
  pid.type='hidden'; pid.name='product_id'; pid.value=productId; f.appendChild(pid);

  const c = document.createElement('input');
  c.type='hidden'; c.name='id_color'; c.value=selectedColorId; f.appendChild(c);

  const s = document.createElement('input');
  s.type='hidden'; s.name='id_size'; s.value=selectedSizeId; f.appendChild(s);

  const q = document.createElement('input');
  q.type='hidden'; q.name='quantity'; q.value=qtyValue; f.appendChild(q);

  document.body.appendChild(f);
  f.submit();
  return false;
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const qtyInput = document.getElementById('quantity-product-{{ $product->id }}');
    const inputColor = document.getElementById('input-color');
    const inputSize = document.getElementById('input-size');
    const btnIncrease = document.querySelector('.btn-increase');
    const btnDecrease = document.querySelector('.btn-decrease');
    const colorButtons = document.querySelectorAll('.color-btn');
    const sizeButtons = document.querySelectorAll('.size-btn');
    const variantPickerLabel = document.querySelector('.value-currentSize');
    const variantColorLabel = document.querySelector('.value-currentColor');
    const formAddToCart = document.getElementById('form-add-to-cart');

    let currentStock = Infinity; // mặc định chưa chọn biến thể => không giới hạn


    // Giá trị mặc định
    let selectedColorId = document.querySelector('.color-btn.active')?.dataset.colorId || '';
    let selectedSizeId = document.querySelector('.size-btn.active')?.dataset.sizeId || '';

    // Chọn màu
colorButtons.forEach(button => {
    button.addEventListener('click', () => {
        colorButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        selectedColorId = button.dataset.colorId;

        // cập nhật hiển thị tên màu
        const variantColorLabel = document.querySelector('.value-currentColor');
        if (variantColorLabel) {
            variantColorLabel.textContent = button.dataset.color;
        }

        updateVariantInputs();

        if (selectedColorId && selectedSizeId) {
            updateStockDisplay({{ $product->id }}, selectedColorId, selectedSizeId);
        }
    });
});


// Chọn size
sizeButtons.forEach(button => {
    button.addEventListener('click', () => {
        sizeButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        selectedSizeId = button.dataset.sizeId;
        variantPickerLabel.textContent = button.dataset.size;
        updateVariantInputs();

        if (selectedColorId && selectedSizeId) {
            updateStockDisplay({{ $product->id }}, selectedColorId, selectedSizeId);
        }
    });
});


    // Nút tăng số lượng
   btnIncrease.addEventListener('click', () => {
    console.log("clicked +");
    setQty((parseInt(qtyInput.value, 10) || 1) + 1);
     let currentValue = parseInt(qtyInput.value, 10) || 1;
     if (currentValue < currentStock) {
        qtyInput.value = currentValue + 1;

    } else {
        alert("Bạn đã đạt số lượng tối đa trong kho!");
    }
});
btnDecrease.addEventListener('click', () => {
    console.log("clicked -");
    setQty((parseInt(qtyInput.value, 10) || 1) - 1);
});


    // Đồng bộ khi nhập tay số lượng
    qtyInput.addEventListener('input', () => {

    });

    // Cập nhật input hidden
    function updateVariantInputs() {
        inputColor.value = selectedColorId;
        inputSize.value = selectedSizeId;
    }

    // Kiểm tra trước khi submit form
    formAddToCart.addEventListener('submit', (e) => {
        if (!selectedColorId || !selectedSizeId) {
            e.preventDefault();
            alert('Vui lòng chọn màu và kích thước.');
        }
    });

    // Gọi lần đầu để set giá trị mặc định
    updateVariantInputs();


});
function updateStockDisplay(productId, colorId, sizeId) {
  const url = `{{ route('admin.product.stock') }}?product_id=${productId}&color_id=${colorId}&size_id=${sizeId}`;

  fetch(url, { method: 'GET' })
    .then(res => {
      if (!res.ok) throw new Error('HTTP ' + res.status);
      return res.json();
    })
    .then(data => {
      const stockEl = document.getElementById('stock-display');
      if (!stockEl) return;


      const qty = Number(data?.quantity ?? data?.stock ?? 0);

      if (data?.success) {
        stockEl.textContent = `Còn lại: ${qty} sản phẩm`;
        stockEl.style.color = qty > 0 ? 'green' : 'red';

        // Nếu bạn muốn giới hạn nút tăng theo tồn kho:
        currentStock = qty;

        // Nếu số đang nhập > tồn kho thì hạ xuống cho an toàn (không bắt buộc)
        const cur = parseInt(document.getElementById('quantity-product-{{ $product->id }}').value, 10) || 1;
        if (cur > qty) {
          document.getElementById('quantity-product-{{ $product->id }}').value = qty || 1;
        }
      } else {
        stockEl.textContent = 'Không có hàng';
        stockEl.style.color = 'red';
        currentStock = 0; // nếu dùng giới hạn
      }
    })
    .catch(err => {
      console.error('Lỗi fetch tồn kho:', err);
      const stockEl = document.getElementById('stock-display');
      if (stockEl) {
        stockEl.textContent = 'Lỗi khi lấy tồn kho';
        stockEl.style.color = 'red';
      }
    });

}

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Swiper chính của gallery
    const gallerySwiper = document.querySelector('#gallery-swiper-started').swiper;

    // Lấy nút chọn color và size
    const colorButtons = document.querySelectorAll('.color-btn');
    const sizeButtons = document.querySelectorAll('.size-btn');

    let selectedColorId = null;
    let selectedSizeId = null;

    // Khi chọn color
    colorButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            selectedColorId = btn.dataset.colorId;
            trySwitchVariantImage();
        });
    });

    // Khi chọn size
    sizeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            selectedSizeId = btn.dataset.sizeId;
            trySwitchVariantImage();
        });
    });

    function trySwitchVariantImage() {
        if (!selectedColorId || !selectedSizeId) return;

        const slides = document.querySelectorAll('#gallery-swiper-started .swiper-slide');
        let targetIndex = -1;

        slides.forEach((slide, idx) => {
            if (
                slide.dataset.colorId == selectedColorId &&
                slide.dataset.sizeId == selectedSizeId
            ) {
                targetIndex = idx;
            }
        });

        if (targetIndex >= 0 && gallerySwiper) {
            gallerySwiper.slideTo(targetIndex);
        }
    }
});
</script>

