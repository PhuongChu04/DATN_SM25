@extends('client.layout.layout')

@section('content')
    <!-- Title Page -->
    <section class="tf-page-title">
        <div class="container">
            <div class="box-title text-center">
                <h4 class="title">My Wishlist</h4>
                <div class="breadcrumb-list">
                    <a class="breadcrumb-item" href="index.html">Home</a>
                    <div class="breadcrumb-item dot"><span></span></div>
                    <div class="breadcrumb-item current">Wishlist</div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Title Page -->

    <!-- Wish list -->
    <section class="flat-spacing-13 pb-0">
        <div class="container">
            <div class="wrapper-wishlist tf-grid-layout tf-col-2 lg-col-3 xl-col-4">
                @foreach ($wishlistItems as $item)
                    <!-- Sản phẩm -->
                    <div class="card-product style-wishlist style-3 card-product-size">

                        <div class="card-product-wrapper">
                            <a href="#" class="remove-from-wishlist-btn" data-product-id="{{ $item->product->id }}"
                                title="Xóa sản phẩm">
                                <i class="icon icon-close remove"></i>
                            </a>
                            <a href="{{ route('client.detailProduct', $item->id_product) }}" class="product-img">
                                <img class="img-product lazyload"
                                    data-src="{{ asset('storage/' . $item->product->image_primary) }}"
                                    src="{{ asset('storage/' . $item->product->image_primary) }}" alt="image-product">
                                <img class="img-hover lazyload"
                                    data-src="{{ asset('storage/' . $item->product->image_primary) }}"
                                    src="{{ asset('storage/' . $item->product->image_primary) }}" alt="image-product">
                            </a>
                            <ul class="list-product-btn">
                                <li>
                                    <a href="#shoppingCart" data-bs-toggle="offcanvas" class="box-icon hover-tooltip">
                                        <span class="icon icon-cart2"></span>
                                        <span class="tooltip">Add to Cart</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('client.detailProduct', $item->id_product) }}"
                                        class="box-icon hover-tooltip quickview">
                                        <span class="icon icon-view"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#compare" data-bs-toggle="modal" aria-controls="compare"
                                        class="box-icon hover-tooltip compare">
                                        <span class="icon icon-compare"></span>
                                        <span class="tooltip">Add to Compare</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html"
                                class="name-product link fw-medium text-md">{{ $item->product->name }}</a>
                            <p class="price-wrap fw-medium">
                                <span class="price-new">{{ $item->product->firstVariant->price ?? 'N/A' }} ₫</span>
                                <span class="price-old">{{ $item->product->firstVariant->price ?? 'N/A' }} ₫</span>
                            </p>
                            <ul class="list-color-product">
                                @foreach ($item->product->colors as $value)
                                    <li class="list-color-item color-swatch hover-tooltip tooltip-bot active">
                                        <span class="tooltip">{{ $value->name }}</span>
                                        <span class="swatch-value" style="background-color: {{ $value->code }}"></span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- /Wish list-->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
            };

            document.body.addEventListener('click', function(event) {
                const removeButton = event.target.closest('.remove-from-wishlist-btn');

                if (!removeButton) {
                    return;
                }

                event.preventDefault();

                const productId = removeButton.dataset.productId;

                fetch(`/client/wishlist/toggle/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'removed') {
                            toastr.success('Đã xóa sản phẩm khỏi danh sách yêu thích.');

                            const productCard = document.getElementById(`wishlist-item-${productId}`);
                            if (productCard) {
                                // Thêm hiệu ứng mờ dần rồi xóa khỏi giao diện
                                productCard.style.transition = 'opacity 0.4s ease';
                                productCard.style.opacity = '0';
                                setTimeout(() => {
                                    productCard.remove();
                                }, 400);
                            }

                            const countBox = document.querySelector('.nav-wishlist .count-box');
                            if (countBox) {
                                countBox.textContent = data.count;
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi xóa sản phẩm:', error);
                        toastr.error('Có lỗi xảy ra, vui lòng thử lại.');
                    });
            });
        });
    </script>
@endsection
