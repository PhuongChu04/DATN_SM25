@extends('client.layout.layout')

@section('content')
    <section class="tf-page-title">
        <div class="container">
            <div class="box-title text-center">
                <h4 class="title">
                    @if (!empty($categoryName  ?? null))
                        Shop • Danh mục <br> {{ $categoryName  }}
                    @else
                        Shop
                    @endif
                </h4>
                <div class="breadcrumb-list">
                    <a class="breadcrumb-item" href="{{ route('client.homeClient') }}">Home</a>
                    <div class="breadcrumb-item dot"><span></span></div>
                    {{-- Về trang danh mục/list và giữ query nếu có --}}
                    <a class="breadcrumb-item" href="{{ route('client.listCategoryClient', request()->query()) }}">Shop</a>
                </div>
            </div>
        </div>
    </section>

    <section class="flat-spacing-24">
        <div class="container">
            <div class="tf-shop-control">
                <div class="tf-group-filter">
                    <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="filterShop" class="tf-btn-filter">
                        <span class="icon icon-filter"></span><span class="text">Filter</span>
                    </a>

                    {{-- Dropdown sort (hiển thị thôi; phần xử lý sort bạn có thể map theo nhu cầu sau) --}}
                    <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                        <div class="btn-select">
                            <span class="text-sort-value">Newest</span>
                            <span class="icon icon-arr-down"></span>
                        </div>
                        <div class="dropdown-menu">
                            <div class="select-item active" data-sort-value="newest">
                                <span class="text-value-item">Newest</span>
                            </div>
                            <div class="select-item" data-sort-value="best-selling">
                                <span class="text-value-item">Best selling</span>
                            </div>
                            <div class="select-item" data-sort-value="a-z">
                                <span class="text-value-item">Alphabetically, A-Z</span>
                            </div>
                            <div class="select-item" data-sort-value="z-a">
                                <span class="text-value-item">Alphabetically, Z-A</span>
                            </div>
                            <div class="select-item" data-sort-value="price-low-high">
                                <span class="text-value-item">Price, low to high</span>
                            </div>
                            <div class="select-item" data-sort-value="price-high-low">
                                <span class="text-value-item">Price, high to low</span>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="tf-control-layout">
                    <li class="tf-view-layout-switch sw-layout-list list-layout" data-value-layout="list">
                        <div class="item icon-list">
                            <span></span>
                            <span></span>
                        </div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-2" data-value-layout="tf-col-2">
                        <div class="item icon-grid-2">
                            <span></span>
                            <span></span>
                        </div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-3" data-value-layout="tf-col-3">
                        <div class="item icon-grid-3">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-4 active" data-value-layout="tf-col-4">
                        <div class="item icon-grid-4">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="wrapper-control-shop">
                <div class="meta-filter-shop">
                    {{-- Hiển thị tổng số sản phẩm tìm thấy --}}
                    <div id="product-count-grid" class="count-text">
                        {{ $products->total() }} sản phẩm
                        @if (!empty($categoryName  ?? null))
                            • theo danh mục #{{ $categoryName  }}
                        @endif
                    </div>
                    <div id="product-count-list" class="count-text" style="display:none;"></div>
                    <div id="applied-filters">
                        @if (!empty($categoryName  ?? null))
                            <span class="badge bg-primary-subtle text-primary me-2">
                                Category: #{{ $categoryName  }}
                            </span>
                        @endif
                    </div>
                    @if (!empty($categoryName  ?? null))
                        <a href="{{ route('client.listCategoryClient') }}" id="remove-all" class="remove-all-filters">
                            <i class="icon icon-close"></i> Clear category
                        </a>
                    @endif
                </div>

                {{-- Ẩn layout dạng list tĩnh demo --}}
                <div class="tf-list-layout wrapper-shop" id="listLayout" style="display:none;"></div>

                {{-- GRID: sản phẩm theo cate (nếu có) và sắp xếp mới nhất (controller đảm nhiệm) --}}
                <div class="wrapper-shop tf-grid-layout tf-col-4" id="gridLayout">
                    @forelse ($products as $item)
                        <div class="card-product grid card-product-size" data-availability="In stock" data-brand="Vineta">
                            <div class="card-product-wrapper">
                                <a href="{{ route('client.detailProduct', $item->id) }}" class="product-img">
                                    <img class="img-product lazyload"
                                        data-src="{{ asset('storage/' . $item->image_primary) }}"
                                        src="{{ asset('storage/' . $item->image_primary) }}" alt="{{ $item->name }}">
                                    <img class="img-hover lazyload"
                                        data-src="{{ asset('storage/' . $item->image_primary) }}"
                                        src="{{ asset('storage/' . $item->image_primary) }}" alt="{{ $item->name }}">
                                </a>

                                <ul class="list-product-btn">
                                    <li>
                                        <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                            class="box-icon hover-tooltip tooltip-left">
                                            <span class="icon icon-cart2"></span>
                                            <span class="tooltip">Add to Cart</span>
                                        </a>
                                    </li>
                                    <li class="wishlist">
                                        <a href="javascript:void(0);" class="box-icon hover-tooltip tooltip-left">
                                            <span class="icon icon-heart2"></span>
                                            <span class="tooltip">Add to Wishlist</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#quickView" data-bs-toggle="modal"
                                            class="box-icon quickview hover-tooltip tooltip-left">
                                            <span class="icon icon-view"></span>
                                            <span class="tooltip">Quick View</span>
                                        </a>
                                    </li>
                                    <li class="compare">
                                        <a href="#compare" data-bs-toggle="modal" aria-controls="compare"
                                            class="box-icon hover-tooltip tooltip-left">
                                            <span class="icon icon-compare"></span>
                                            <span class="tooltip">Add to Compare</span>
                                        </a>
                                    </li>
                                </ul>

                                {{-- Sizes --}}
                                @if ($item->sizes && $item->sizes->count())
                                    <ul class="size-box">
                                        @foreach ($item->sizes as $value)
                                            <li class="size-item text-xs text-white">{{ $value->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div class="card-product-info">
                                <a href="{{ route('client.detailProduct', $item->id) }}"
                                    class="name-product link fw-medium text-md">
                                    {{ $item->name }}
                                </a>
                                <p class="price-wrap fw-medium">
                                    <span class="price-new">
                                        {{ isset($item->firstVariant->price) ? number_format($item->firstVariant->price) : 'N/A' }}₫
                                    </span>
                                </p>

                                {{-- Colors --}}
                                @if ($item->colors && $item->colors->count())
                                    <ul class="list-color-product">
                                        @foreach ($item->colors as $value)
                                            <li class="list-color-item color-swatch active hover-tooltip tooltip-bot line">
                                                <span class="tooltip color-filter">{{ $value->name }}</span>
                                                <span class="swatch-value"
                                                    style="background-color: {{ $value->code }}"></span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="w-100">
                            <div class="alert alert-info mb-0">Chưa có sản phẩm nào.</div>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Phân trang: giữ nguyên query ?c=... và các query khác --}}
            <div class="pagination-item">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>

        {{-- SEARCH MODAL (giữ nguyên cấu trúc, chỉ chỉnh link/ảnh/format giá cho thống nhất) --}}
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
                                            <input type="text" placeholder="Search" name="search"
                                                value="{{ request('search') }}" required="">
                                        </fieldset>
                                        <button type="submit">
                                            <i class="icon icon-search"></i>
                                        </button>
                                    </form>
                                    <div class="popular-searches justify-content-md-center">
                                        <div class="text fw-medium">Popular searches:</div>
                                        <ul>
                                            <li><a class="link" href="#">Featured</a></li>
                                            <li><a class="link" href="#">Trendy</a></li>
                                            <li><a class="link" href="#">New</a></li>
                                            <li><a class="link" href="#">Sale</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="featured-product">
                                    <div class="text-xl-2 fw-medium featured-product-heading">Featured product</div>

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
                                                "1200": { "slidesPerView": 4, "spaceBetween": 24, "slidesPerGroup": 4 }
                                            }
                                         }'>
                                        <div class="swiper-wrapper">
                                            @foreach ($products as $item)
                                                <div class="swiper-slide">
                                                    <div class="card-product style-3 card-product-size">
                                                        <div class="card-product-wrapper">
                                                            <a href="{{ route('client.detailProduct', $item->id) }}"
                                                                class="product-img">
                                                                <img class="img-product lazyload"
                                                                    data-src="{{ asset('storage/' . $item->image_primary) }}"
                                                                    src="{{ asset('storage/' . $item->image_primary) }}"
                                                                    alt="{{ $item->name }}">
                                                                <img class="img-hover lazyload"
                                                                    data-src="{{ asset('storage/' . $item->image_primary) }}"
                                                                    src="{{ asset('storage/' . $item->image_primary) }}"
                                                                    alt="{{ $item->name }}">
                                                            </a>
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
                                                            @if ($item->sizes && $item->sizes->count())
                                                                <ul class="size-box">
                                                                    @foreach ($item->sizes as $value)
                                                                        <li class="size-item text-xs text-white">
                                                                            {{ $value->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </div>
                                                        <div class="card-product-info">
                                                            <a href="{{ route('client.detailProduct', $item->id) }}"
                                                                class="name-product link fw-medium text-md">
                                                                {{ $item->name }}
                                                            </a>
                                                            <p class="price-wrap fw-medium">
                                                                <span class="price-new">
                                                                    {{ isset($item->firstVariant->price) ? number_format($item->firstVariant->price) : 'N/A' }}₫
                                                                </span>
                                                            </p>
                                                            @if ($item->colors && $item->colors->count())
                                                                <ul class="list-color-product">
                                                                    @foreach ($item->colors as $value)
                                                                        <li
                                                                            class="list-color-item color-swatch hover-tooltip tooltip-bot active">
                                                                            <span
                                                                                class="tooltip color-filter">{{ $value->name }}</span>
                                                                            <span class="swatch-value"
                                                                                style="background-color: {{ $value->code }}"></span>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
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

                        </div> {{-- row --}}
                    </div> {{-- container --}}
                </div> {{-- modal-content --}}
            </div> {{-- modal-dialog --}}
        </div> {{-- modal --}}
    </section>
@endsection
