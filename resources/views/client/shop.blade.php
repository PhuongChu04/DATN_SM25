@extends('client.layout.layout')

@section('content')
    <section class="tf-page-title">
        <div class="container">
            <div class="box-title text-center">
                <h4 class="title">Shop</h4>
                <div class="breadcrumb-list">
                    <a class="breadcrumb-item" href="{{ route('client.home') }}">Home</a>
                    <div class="breadcrumb-item dot"><span></span></div>
                    <a class="breadcrumb-item" href="{{ route('client.listProducts') }}">Shop</a>
                </div>
            </div>
        </div>
    </section>
    <!-- /Title Page -->
    <!-- Section Product -->
    <section class="flat-spacing-24">
        <div class="container">
            <div class="tf-shop-control">
                <div class="tf-group-filter">
                    <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="filterShop" class="tf-btn-filter">
                        <span class="icon icon-filter"></span><span class="text">Filter</span></a>
                    <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                        <div class="btn-select">
                            <span class="text-sort-value">Best selling</span>
                            <span class="icon icon-arr-down"></span>
                        </div>
                        <div class="dropdown-menu">
                            <div class="select-item active" data-sort-value="best-selling">
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
                    <div id="product-count-grid" class="count-text"></div>
                    <div id="product-count-list" class="count-text"></div>
                    <div id="applied-filters"></div>
                    <button id="remove-all" class="remove-all-filters" style="display: none;"><i
                            class="icon icon-close"></i> Clear all filter</button>
                </div>
                <div class="tf-list-layout wrapper-shop" id="listLayout" style="display: none;">
                    <!-- Card Product 1 -->
                    <div class="card-product style-list" data-availability="In stock" data-brand="Vineta">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="img-product lazyload" data-src="images/products/fashion/product-16.jpg"
                                    src="images/products/fashion/product-16.jpg" alt="image-product">
                                <img class="img-hover lazyload" data-src="images/products/fashion/product-9.jpg"
                                    src="images/products/fashion/product-9.jpg" alt="image-product">
                            </a>
                            <div class="on-sale-wrap"><span class="on-sale-item">20% Off</span></div>
                        </div>
                        <div class="card-product-info">
                            <div class="info-list">
                                <a href="product-detail.html" class="name-product link fw-medium text-md">Graphic
                                    Printed Pure Cotton T-shirt</a>
                                <p class="price-wrap fw-medium text-md">
                                    <span class="price-new">$50.00</span>
                                    <span class="price-old">$70.00</span>
                                </p>
                                <p class="desc text-sm text-main text-line-clamp-2">
                                    Product Specifications Care for fiber: 30% more recycled polyester. We label
                                    garments
                                    manufactured using environmentally friendly technologies and raw materials with
                                    the
                                    Join
                                    Life label.
                                </p>
                                <ul class="list-color-product">
                                    <li class="list-color-item color-swatch hover-tooltip active">
                                        <span class="tooltip color-filter">Yellow</span>
                                        <span class="swatch-value bg-light-orange-2"></span>
                                        <img class="lazyload" data-src="images/products/fashion/product-16.jpg"
                                            src="images/products/fashion/product-16.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch hover-tooltip">
                                        <span class="tooltip color-filter">Black</span>
                                        <span class="swatch-value bg-dark"></span>
                                        <img class=" lazyload" data-src="images/products/fashion/product-9.jpg"
                                            src="images/products/fashion/product-9.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch hover-tooltip">
                                        <span class="tooltip color-filter">Grey</span>
                                        <span class="swatch-value bg-grey-4"></span>
                                        <img class=" lazyload" data-src="images/products/fashion/product-4.jpg"
                                            src="images/products/fashion/product-7.jpg" alt="image-product">
                                    </li>
                                </ul>
                                <ul class="size-box">
                                    <li class="size-item text-xs">S</li>
                                    <li class="size-item text-xs">M</li>
                                    <li class="size-item text-xs">L</li>
                                    <li class="size-item text-xs">XL</li>
                                </ul>
                            </div>
                            <div class="list-product-btn">
                                <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                    class="tf-btn btn-main-product add-to-cart animate-btn">Add
                                    To
                                    cart</a>
                                <a href="javascript:void(0);" class="box-icon wishlist hover-tooltip">
                                    <span class="icon icon-heart2"></span>
                                    <span class="tooltip">Add to Wishlist</span>
                                </a>
                                <a href="#quickView" data-bs-toggle="modal" class="box-icon hover-tooltip quickview">
                                    <span class="icon icon-view"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                                <a href="#compare" data-bs-toggle="modal" aria-controls="compare"
                                    class="box-icon compare hover-tooltip">
                                    <span class="icon icon-compare"></span>
                                    <span class="tooltip">Add to Compare</span>
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- Card Product 2 -->
                    <div class="card-product style-list" data-availability="In stock" data-brand="Vineta">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="img-product lazyload" data-src="images/products/fashion/product-17.jpg"
                                    src="images/products/fashion/product-17.jpg" alt="image-product">
                                <img class="img-hover lazyload" data-src="images/products/fashion/product-19.jpg"
                                    src="images/products/fashion/product-19.jpg" alt="image-product">
                            </a>
                        </div>
                        <div class="card-product-info">
                            <div class="info-list">
                                <a href="product-detail.html" class="name-product link fw-medium text-md">Graphic
                                    Printed Drop Shoulder Sleeves</a>
                                <p class="price-wrap fw-medium text-md">
                                    <span class="price-new">$80.00</span>
                                </p>
                                <p class="desc text-sm text-main text-line-clamp-2">
                                    Product Specifications Care for fiber: 30% more recycled polyester. We label
                                    garments
                                    manufactured using environmentally friendly technologies and raw materials with
                                    the
                                    Join
                                    Life label.
                                </p>
                                <ul class="list-color-product">
                                    <li class="list-color-item color-swatch hover-tooltip line active">
                                        <span class="tooltip color-filter">White</span>
                                        <span class="swatch-value bg-white"></span>
                                        <img class="lazyload" data-src="images/products/fashion/product-17.jpg"
                                            src="images/products/fashion/product-17.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch hover-tooltip">
                                        <span class="tooltip color-filter">Dark Green</span>
                                        <span class="swatch-value bg-dark-green"></span>
                                        <img class=" lazyload" data-src="images/products/fashion/product-21.jpg"
                                            src="images/products/fashion/product-21.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch hover-tooltip">
                                        <span class="tooltip color-filter">Grey</span>
                                        <span class="swatch-value bg-grey-4"></span>
                                        <img class="lazyload" data-src="images/products/fashion/product-19.jpg"
                                            src="images/products/fashion/product-19.jpg" alt="image-product">
                                    </li>
                                </ul>
                                <ul class="size-box">
                                    <li class="size-item text-xs">S</li>
                                    <li class="size-item text-xs">M</li>
                                    <li class="size-item text-xs">L</li>
                                    <li class="size-item text-xs">XL</li>
                                </ul>
                            </div>
                            <div class="list-product-btn">
                                <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                    class="tf-btn btn-main-product add-to-cart animate-btn">Add
                                    To
                                    cart</a>
                                <a href="javascript:void(0);" class="box-icon wishlist hover-tooltip">
                                    <span class="icon icon-heart2"></span>
                                    <span class="tooltip">Add to Wishlist</span>
                                </a>
                                <a href="#quickView" data-bs-toggle="modal" class="box-icon hover-tooltip quickview">
                                    <span class="icon icon-view"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                                <a href="#compare" data-bs-toggle="modal" aria-controls="compare"
                                    class="box-icon compare hover-tooltip">
                                    <span class="icon icon-compare"></span>
                                    <span class="tooltip">Add to Compare</span>
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- Card Product 3 -->
                    <div class="card-product style-list" data-availability="In stock" data-brand="Vineta">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="img-product lazyload" data-src="images/products/fashion/women-grey-2.jpg"
                                    src="images/products/fashion/women-grey-2.jpg" alt="image-product">
                                <img class="img-hover lazyload" data-src="images/products/fashion/women-grey-1.jpg"
                                    src="images/products/fashion/women-grey-1.jpg" alt="image-product">
                            </a>
                            <div class="on-sale-wrap"><span class="on-sale-item">10% Off</span></div>
                        </div>
                        <div class="card-product-info">
                            <div class="info-list">
                                <a href="product-detail.html" class="name-product link fw-medium text-md">Women
                                    Solid Scoop Neck Slim Fit T-shirt</a>
                                <p class="price-wrap fw-medium text-md">
                                    <span class="price-new">$80.00</span>
                                    <span class="price-old">$90.00</span>
                                </p>
                                <p class="desc text-sm text-main text-line-clamp-2">
                                    Product Specifications Care for fiber: 30% more recycled polyester. We label
                                    garments
                                    manufactured using environmentally friendly technologies and raw materials with
                                    the
                                    Join
                                    Life label.
                                </p>
                                <ul class="list-color-product">
                                    <li class="list-color-item color-swatch hover-tooltip active">
                                        <span class="tooltip color-filter">Grey</span>
                                        <span class="swatch-value bg-grey-4"></span>
                                        <img class="lazyload" data-src="images/products/fashion/women-grey-2.jpg"
                                            src="images/products/fashion/women-grey-2.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch hover-tooltip">
                                        <span class="tooltip color-filter">Yellow</span>
                                        <span class="swatch-value bg-yellow"></span>
                                        <img class="lazyload" data-src="images/products/fashion/women-yellow-2.jpg"
                                            src="images/products/fashion/women-yellow-2.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch hover-tooltip">
                                        <span class="tooltip color-filter">Light Grey</span>
                                        <span class="swatch-value bg-light-blue-2"></span>
                                        <img class="lazyload" data-src="images/products/fashion/women-light-blue-1.jpg"
                                            src="images/products/fashion/women-light-blue-1.jpg" alt="image-product">
                                    </li>
                                </ul>
                            </div>
                            <div class="list-product-btn">
                                <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                    class="tf-btn btn-main-product add-to-cart animate-btn">Add
                                    To
                                    cart</a>
                                <a href="javascript:void(0);" class="box-icon wishlist hover-tooltip">
                                    <span class="icon icon-heart2"></span>
                                    <span class="tooltip">Add to Wishlist</span>
                                </a>
                                <a href="#quickView" data-bs-toggle="modal" class="box-icon hover-tooltip quickview">
                                    <span class="icon icon-view"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                                <a href="#compare" data-bs-toggle="modal" aria-controls="compare"
                                    class="box-icon compare hover-tooltip">
                                    <span class="icon icon-compare"></span>
                                    <span class="tooltip">Add to Compare</span>
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- Card Product 4 -->
                    <div class="card-product style-list" data-availability="Out of stock" data-brand="Zotac">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="img-product lazyload" data-src="images/products/fashion/product-18.jpg"
                                    src="images/products/fashion/product-18.jpg" alt="image-product">
                                <img class="img-hover lazyload" data-src="images/products/fashion/product-12.jpg"
                                    src="images/products/fashion/product-12.jpg" alt="image-product">
                            </a>
                        </div>
                        <div class="card-product-info">
                            <div class="info-list">
                                <a href="product-detail.html" class="name-product link fw-medium text-md">Asymmetric
                                    Neck Tank Top</a>
                                <p class="price-wrap fw-medium text-md">
                                    <span class="price-new">$85.00</span>
                                </p>
                                <p class="desc text-sm text-main text-line-clamp-2">
                                    Product Specifications Care for fiber: 30% more recycled polyester. We label
                                    garments
                                    manufactured using environmentally friendly technologies and raw materials with
                                    the
                                    Join
                                    Life label.
                                </p>
                                <ul class="list-color-product">
                                    <li class="list-color-item color-swatch hover-tooltip active">
                                        <span class="tooltip color-filter">Light Orange</span>
                                        <span class="swatch-value bg-light-orange"></span>
                                        <img class="lazyload" data-src="images/products/fashion/product-18.jpg"
                                            src="images/products/fashion/product-18.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch hover-tooltip">
                                        <span class="tooltip color-filter">Black</span>
                                        <span class="swatch-value bg-dark"></span>
                                        <img class="lazyload" data-src="images/products/fashion/women-black-6.jpg"
                                            src="images/products/fashion/women-black-6.jpg" alt="image-product">
                                    </li>

                                </ul>
                                <ul class="size-box">
                                    <li class="size-item text-xs">S</li>
                                    <li class="size-item text-xs">M</li>
                                    <li class="size-item text-xs">L</li>
                                    <li class="size-item text-xs">XL</li>
                                </ul>
                            </div>
                            <div class="list-product-btn">
                                <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                    class="tf-btn btn-main-product animate-btn add-to-cart">Add
                                    To
                                    cart</a>
                                <a href="javascript:void(0);" class="box-icon wishlist hover-tooltip">
                                    <span class="icon icon-heart2"></span>
                                    <span class="tooltip">Add to Wishlist</span>
                                </a>
                                <a href="#quickView" data-bs-toggle="modal" class="box-icon hover-tooltip quickview">
                                    <span class="icon icon-view"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                                <a href="#compare" data-bs-toggle="modal" aria-controls="compare"
                                    class="box-icon compare hover-tooltip">
                                    <span class="icon icon-compare"></span>
                                    <span class="tooltip">Add to Compare</span>
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- Card Product 5 -->
                    <div class="card-product style-list" data-availability="Out of stock" data-brand="Zotac">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="img-product lazyload" data-src="images/products/fashion/product-15.jpg"
                                    src="images/products/fashion/product-15.jpg" alt="image-product">
                                <img class="img-hover lazyload" data-src="images/products/fashion/product-1.jpg"
                                    src="images/products/fashion/product-1.jpg" alt="image-product">
                            </a>
                        </div>
                        <div class="card-product-info">
                            <div class="info-list">
                                <a href="product-detail.html" class="name-product link fw-medium text-md">Short
                                    Sleeve Sweat</a>
                                <p class="price-wrap fw-medium text-md">
                                    <span class="price-new">$55.00</span>
                                </p>
                                <p class="desc text-sm text-main text-line-clamp-2">
                                    Product Specifications Care for fiber: 30% more recycled polyester. We label
                                    garments
                                    manufactured using environmentally friendly technologies and raw materials with
                                    the
                                    Join
                                    Life label.
                                </p>
                                <ul class="list-color-product">
                                    <li class="list-color-item color-swatch hover-tooltip active">
                                        <span class="tooltip color-filter">Light Pink</span>
                                        <span class="swatch-value bg-light-pink-4"></span>
                                        <img class="lazyload" data-src="images/products/fashion/product-15.jpg"
                                            src="images/products/fashion/product-15.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch hover-tooltip line">
                                        <span class="tooltip color-filter">White</span>
                                        <span class="swatch-value bg-white"></span>
                                        <img class="lazyload" data-src="images/products/fashion/product-1.jpg"
                                            src="images/products/fashion/product-1.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch hover-tooltip">
                                        <span class="tooltip color-filter">Light Grey</span>
                                        <span class="swatch-value bg-grey-4"></span>
                                        <img class="lazyload" data-src="images/products/fashion/product-19.jpg"
                                            src="images/products/fashion/product-19.jpg" alt="image-product">
                                    </li>
                                </ul>
                            </div>
                            <div class="list-product-btn">
                                <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                    class="tf-btn btn-main-product add-to-cart animate-btn">Add
                                    To
                                    cart</a>
                                <a href="javascript:void(0);" class="box-icon wishlist hover-tooltip">
                                    <span class="icon icon-heart2"></span>
                                    <span class="tooltip">Add to Wishlist</span>
                                </a>
                                <a href="#quickView" data-bs-toggle="modal" class="box-icon hover-tooltip quickview">
                                    <span class="icon icon-view"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                                <a href="#compare" data-bs-toggle="modal" aria-controls="compare"
                                    class="box-icon compare hover-tooltip">
                                    <span class="icon icon-compare"></span>
                                    <span class="tooltip">Add to Compare</span>
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- Pagination -->
                    <ul class="wg-pagination">
                        <li class="active">
                            <div class="pagination-item">1</div>
                        </li>
                        <li>
                            <a href="#" class="pagination-item">2</a>
                        </li>
                        <li>
                            <a href="#" class="pagination-item">3</a>
                        </li>
                        <li>
                            <a href="#" class="pagination-item"><i class="icon-arr-right2"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="wrapper-shop tf-grid-layout tf-col-4" id="gridLayout">
                    <!-- List Products -->
                    @foreach ($products as $item)
                        <div class="card-product grid card-product-size" data-availability="In stock"
                            data-brand="Vineta">
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
                                <ul class="size-box">
                                    @foreach ($item->sizes as $value)
                                        <li class="size-item text-xs text-white">{{ $value->name }}</li>
                                    @endforeach
                                </ul>

                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html"
                                    class="name-product link fw-medium text-md">{{ $item->name }}</a>
                                <p class="price-wrap fw-medium">
                                    <span class="price-new">{{ $item->firstVariant->price ?? 'N/A' }}₫</span>
                                </p>
                                <ul class="list-color-product">
                                    @foreach ($item->colors as $value)
                                        <li class="list-color-item color-swatch active hover-tooltip tooltip-bot line">
                                            <span class="tooltip color-filter">{{ $value->name }}</span>
                                            <span class="swatch-value"
                                                style="background-color: {{ $value->code }}"></span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="pagination-item">{{ $products->links() }}</div>
        </div>
    </section>
    <!-- search -->
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
                                        <input type="text" placeholder="Search" class="" name="search" tabindex="0"
                                            value="{{ request('search') }}" aria-required="true" required="">
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
                                <div dir="ltr" class="swiper tf-swiper wrap-sw-over" data-swiper='{
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
                                            <div class="card-product style-3 card-product-size">
                                                <div class="card-product-wrapper">
                                                    <a href="product-detail.html" class="product-img">
                                                        <img class="img-product lazyload"
                                                            data-src="{{asset('storage/'.$item->image_primary)}}"
                                                            src="{{asset('storage/'.$item->image_primary)}}"
                                                            alt="image-product">
                                                        <img class="img-hover lazyload"
                                                            data-src="{{asset('storage/'.$item->image_primary)}}"
                                                            src="{{asset('storage/'.$item->image_primary)}}"
                                                            alt="image-product">
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
                                                            <li class="size-item text-xs text-white">{{$value->name}}</li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                </div>
                                                <div class="card-product-info">
                                                    <a href="product-detail.html"
                                                        class="name-product link fw-medium text-md">{{$item->name}}</a>
                                                    <p class="price-wrap fw-medium">
                                                        <span class="price-new">{{ $item->firstVariant->price ?? 'N/A' }}</span>
                                                        {{-- <span class="price-old">$100.00</span> --}}
                                                    </p>
                                                    <ul class="list-color-product">
                                                        @foreach ($item->colors as $value)
                                                            <li
                                                            class="list-color-item color-swatch hover-tooltip tooltip-bot active">
                                                            <span class="tooltip color-filter">{{$value->name}}</span>
                                                            <span class="swatch-value" style="background-color: {{$value->code}}"></span>
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
    <!-- shoppingCart -->
    <div class="offcanvas offcanvas-end popup-style-1 popup-shopping-cart" id="shoppingCart">
        <div class="canvas-wrapper">
            <div class="popup-header">
                <span class="title">Shopping cart</span>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas"></span>
            </div>
            <div class="wrap">
                <div class="tf-mini-cart-threshold">
                    <div class="text">
                        Spend <span class="fw-medium">$100</span> more to get <span class="fw-medium">Free
                            Shipping</span>
                    </div>
                    <div class="tf-progress-bar tf-progress-ship">
                        <div class="value" style="width: 0%;" data-progress="75">
                            <i class="icon icon-car"></i>
                        </div>
                    </div>
                </div>
                <div class="tf-mini-cart-wrap">
                    <div class="tf-mini-cart-main">
                        <div class="tf-mini-cart-sroll">
                            <div class="tf-mini-cart-items">
                                <div class="tf-mini-cart-item file-delete">
                                    <div class="tf-mini-cart-image">
                                        <a href="product-detail.html">
                                            <img class="lazyload" data-src="images/products/fashion/women-1.jpg"
                                                src="images/products/fashion/women-1.jpg" alt="img-product">
                                        </a>
                                    </div>
                                    <div class="tf-mini-cart-info">
                                        <div class="d-flex justify-content-between">
                                            <a class="title link text-md fw-medium" href="product-detail.html">Short
                                                Sleeve Sweat</a>
                                            <i class="icon icon-close remove fs-12"></i>
                                        </div>
                                        <div class="info-variant">
                                            <select class="text-xs">
                                                <option value="White / L">White / L</option>
                                                <option value="White / M">White / M</option>
                                                <option value="Black / L">Black / L</option>
                                            </select>
                                            <i class="icon-pen edit"></i>
                                        </div>
                                        <p class="price-wrap text-sm fw-medium">
                                            <span class="new-price text-primary">$130.00</span>
                                            <span
                                                class="old-price text-decoration-line-through text-dark-1">$150.00</span>
                                        </p>
                                        <div class="wg-quantity small">
                                            <button class="btn-quantity minus-btn">-</button>
                                            <input class="quantity-product font-4" type="text" name="number" value="1">
                                            <button class="btn-quantity plus-btn">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-mini-cart-item file-delete">
                                    <div class="tf-mini-cart-image">
                                        <a href="product-detail.html">
                                            <img class="lazyload" data-src="images/products/fashion/women-2.jpg"
                                                src="images/products/fashion/women-2.jpg" alt="img-product">
                                        </a>
                                    </div>
                                    <div class="tf-mini-cart-info">
                                        <div class="d-flex justify-content-between">
                                            <a class="title link text-md fw-medium" href="product-detail.html">Loose
                                                Fit Tee</a>
                                            <i class="icon icon-close remove fs-12"></i>
                                        </div>
                                        <div class="info-variant">
                                            <select class="text-xs">
                                                <option value="White / L">White / L</option>
                                                <option value="White / M">White / M</option>
                                                <option value="Black / L">Black / L</option>
                                            </select>
                                            <i class="icon-pen edit"></i>
                                        </div>
                                        <p class="price-wrap text-sm fw-medium">
                                            <span class="new-price text-primary">$130.00</span>
                                            <span
                                                class="old-price text-decoration-line-through text-dark-1">$150.00</span>
                                        </p>
                                        <div class="wg-quantity small">
                                            <button class="btn-quantity minus-btn">-</button>
                                            <input class="quantity-product font-4" type="text" name="number" value="1">
                                            <button class="btn-quantity plus-btn">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tf-minicart-recommendations">
                                <div
                                    class="tf-minicart-recommendations-heading d-flex justify-content-between align-items-end">
                                    <div class="tf-minicart-recommendations-title text-md fw-medium">You may also
                                        like</div>
                                    <div class="d-flex gap-10">
                                        <div
                                            class="swiper-button-prev nav-swiper arrow-1 size-30 nav-prev-also-product">
                                        </div>
                                        <div
                                            class="swiper-button-next nav-swiper arrow-1 size-30 nav-next-also-product">
                                        </div>
                                    </div>
                                </div>
                                <div dir="ltr" class="swiper tf-swiper" data-swiper='{
                                            "slidesPerView": 1,
                                            "spaceBetween": 10,
                                            "speed": 800,
                                            "observer": true,
                                            "observeParents": true,
                                            "slidesPerGroup": 1,
                                            "navigation": {
                                                "clickable": true,
                                                "nextEl": ".nav-next-also-product",
                                                "prevEl": ".nav-prev-also-product"
                                            }
                                        }'>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="tf-mini-cart-item line radius-16">
                                                <div class="tf-mini-cart-image">
                                                    <a href="product-detail.html">
                                                        <img class="lazyload"
                                                            data-src="images/products/fashion/product-1.jpg"
                                                            src="images/products/fashion/product-1.jpg"
                                                            alt="img-product">
                                                    </a>
                                                </div>
                                                <div class="tf-mini-cart-info justify-content-center">
                                                    <a class="title link text-md fw-medium"
                                                        href="product-detail.html">Polo T-Shirt</a>
                                                    <p class="price-wrap text-sm fw-medium">
                                                        <span class="new-price text-primary">$130.00</span>
                                                        <span
                                                            class="old-price text-decoration-line-through text-dark-1">$150.00</span>
                                                    </p>
                                                    <a href="#"
                                                        class="tf-btn animate-btn d-inline-flex bg-dark-2 w-max-content">Add
                                                        to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="tf-mini-cart-item line radius-16">
                                                <div class="tf-mini-cart-image">
                                                    <a href="product-detail.html">
                                                        <img class="lazyload"
                                                            data-src="images/products/fashion/product-2.jpg"
                                                            src="images/products/fashion/product-2.jpg"
                                                            alt="img-product">
                                                    </a>
                                                </div>
                                                <div class="tf-mini-cart-info justify-content-center">
                                                    <a class="title link text-md fw-medium"
                                                        href="product-detail.html">Short Sleeve Sweat</a>
                                                    <p class="price-wrap text-sm fw-medium">
                                                        <span class="new-price text-primary">$100.00</span>
                                                        <span
                                                            class="old-price text-decoration-line-through text-dark-1">$115.00</span>
                                                    </p>
                                                    <a href="#"
                                                        class="tf-btn animate-btn d-inline-flex bg-dark-2 w-max-content">Add
                                                        to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="tf-mini-cart-item line radius-16">
                                                <div class="tf-mini-cart-image">
                                                    <a href="product-detail.html">
                                                        <img class="lazyload"
                                                            data-src="images/products/fashion/product-3.jpg"
                                                            src="images/products/fashion/product-3.jpg"
                                                            alt="img-product">
                                                    </a>
                                                </div>
                                                <div class="tf-mini-cart-info justify-content-center">
                                                    <a class="title link text-md fw-medium"
                                                        href="product-detail.html">Crop T-shirt</a>
                                                    <p class="price-wrap text-sm fw-medium">
                                                        <span class="new-price text-primary">$80.00</span>
                                                        <span
                                                            class="old-price text-decoration-line-through text-dark-1">$100.00</span>
                                                    </p>
                                                    <a href="#"
                                                        class="tf-btn animate-btn d-inline-flex bg-dark-2 w-max-content">Add
                                                        to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tf-mini-cart-bottom">
                        <div class="tf-mini-cart-tool">
                            <div class="tf-mini-cart-tool-btn btn-add-gift">
                                <i class="icon icon-gift2"></i>
                                <div class="text-xxs">Add gift wrap</div>
                            </div>
                            <div class="tf-mini-cart-tool-btn btn-add-note">
                                <i class="icon icon-note"></i>
                                <div class="text-xxs">Order note</div>
                            </div>
                            <div class="tf-mini-cart-tool-btn btn-coupon">
                                <i class="icon icon-coupon"></i>
                                <div class="text-xxs">Coupon</div>
                            </div>
                            <div class="tf-mini-cart-tool-btn btn-estimate-shipping">
                                <i class="icon icon-car"></i>
                                <div class="text-xxs">Shipping</div>
                            </div>
                        </div>
                        <div class="tf-mini-cart-bottom-wrap">
                            <div class="tf-cart-totals-discounts">
                                <div class="tf-cart-total text-xl fw-medium">Total:</div>
                                <div class="tf-totals-total-value text-xl fw-medium">$130.00 USD</div>
                            </div>
                            <div class="tf-cart-tax text-sm opacity-8">Taxes and shipping calculated at checkout
                            </div>
                            <div class="tf-cart-checkbox">
                                <div class="tf-checkbox-wrapp">
                                    <input class="" type="checkbox" id="CartDrawer-Form_agree" name="agree_checkbox">
                                    <div>
                                        <i class="icon-check"></i>
                                    </div>
                                </div>
                                <label for="CartDrawer-Form_agree" class="text-sm">
                                    I agree with the
                                    <a href="term-and-condition.html" title="Terms of Service" class="fw-medium">terms
                                        and conditions</a>
                                </label>
                            </div>
                            <div class="tf-mini-cart-view-checkout">
                                <a href="checkout.html"
                                    class="tf-btn animate-btn d-inline-flex bg-dark-2 w-100 justify-content-center"><span>Check
                                        out</span></a>
                                <a href="view-cart.html"
                                    class="tf-btn btn-out-line-dark2 w-100 justify-content-center">View cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="tf-mini-cart-tool-openable add-gift">
                        <div class="overplay tf-mini-cart-tool-close"></div>
                        <form action="#" class="tf-mini-cart-tool-content">
                            <div class="tf-mini-cart-tool-text text-sm fw-medium">Add gift wrap</div>
                            <div class="tf-mini-cart-tool-text1">The product will be wrapped carefully.
                                Fee is only <span class="text fw-medium text-dark">$10.00</span>. Do you want a
                                gift wrap?</div>
                            <div class="tf-cart-tool-btns">
                                <button class="subscribe-button tf-btn animate-btn d-inline-flex bg-dark-2 w-100"
                                    type="submit">Add a Gift Wrap</button>
                                <div class="tf-btn btn-out-line-dark2 w-100 tf-mini-cart-tool-close">Cancel</div>
                            </div>
                        </form>
                    </div>
                    <div class="tf-mini-cart-tool-openable add-note">
                        <div class="overplay tf-mini-cart-tool-close"></div>
                        <form action="#" class="tf-mini-cart-tool-content">
                            <label for="Cart-note" class="tf-mini-cart-tool-text text-sm fw-medium">Order
                                note</label>
                            <textarea name="note" id="Cart-note" placeholder="Instruction for seller..."></textarea>
                            <div class="tf-cart-tool-btns">
                                <button class="subscribe-button tf-btn animate-btn d-inline-flex bg-dark-2 w-100"
                                    type="submit">Save</button>
                                <div class="tf-btn btn-out-line-dark2 w-100 tf-mini-cart-tool-close">Close</div>
                            </div>
                        </form>
                    </div>
                    <div class="tf-mini-cart-tool-openable coupon">
                        <div class="overplay tf-mini-cart-tool-close"></div>
                        <form action="#" class="tf-mini-cart-tool-content">
                            <div class="tf-mini-cart-tool-text text-sm fw-medium">Add coupon</div>
                            <div class="tf-mini-cart-tool-text1">* Discount will be calculated and
                                applied at checkout</div>
                            <input type="text" name="text" placeholder="">
                            <div class="tf-cart-tool-btns">
                                <button class="subscribe-button tf-btn animate-btn d-inline-flex bg-dark-2 w-100"
                                    type="submit">Save</button>
                                <div class="tf-btn btn-out-line-dark2 w-100 tf-mini-cart-tool-close">Close</div>
                            </div>
                        </form>
                    </div>
                    <div class="tf-mini-cart-tool-openable estimate-shipping">
                        <div class="overplay tf-mini-cart-tool-close"></div>
                        <form id="shipping-form" class="tf-mini-cart-tool-content">
                            <div class="tf-mini-cart-tool-text text-sm fw-medium">Shipping estimates</div>
                            <div class="field">
                                <p class="text-sm">Country</p>
                                <div class="tf-select">
                                    <select class="w-100" id="shipping-country-form" name="address[country]"
                                        data-default="">
                                        <option value="Australia"
                                            data-provinces='[["Australian Capital Territory","Australian Capital Territory"],["New South Wales","New South Wales"],["Northern Territory","Northern Territory"],["Queensland","Queensland"],["South Australia","South Australia"],["Tasmania","Tasmania"],["Victoria","Victoria"],["Western Australia","Western Australia"]]'>
                                            Australia</option>
                                        <option value="Austria" data-provinces='[]'>Austria</option>
                                        <option value="Belgium" data-provinces='[]'>Belgium</option>
                                        <option value="Canada"
                                            data-provinces='[["Ontario","Ontario"],["Quebec","Quebec"]]'>Canada
                                        </option>
                                        <option value="Czech Republic" data-provinces='[]'>Czechia</option>
                                        <option value="Denmark" data-provinces='[]'>Denmark</option>
                                        <option value="Finland" data-provinces='[]'>Finland</option>
                                        <option value="France" data-provinces='[]'>France</option>
                                        <option value="Germany" data-provinces='[]'>Germany</option>
                                        <option selected value="United States"
                                            data-provinces='[["Alabama","Alabama"],["California","California"],["Florida","Florida"]]'>
                                            United States</option>
                                        <option value="United Kingdom"
                                            data-provinces='[["England","England"],["Scotland","Scotland"],["Wales","Wales"],["Northern Ireland","Northern Ireland"]]'>
                                            United Kingdom</option>
                                        <option value="India" data-provinces='[]'>India</option>
                                        <option value="Japan" data-provinces='[]'>Japan</option>
                                        <option value="Mexico" data-provinces='[]'>Mexico</option>
                                        <option value="South Korea" data-provinces='[]'>South Korea</option>
                                        <option value="Spain" data-provinces='[]'>Spain</option>
                                        <option value="Italy" data-provinces='[]'>Italy</option>
                                        <option value="Vietnam"
                                            data-provinces='[["Ha Noi","Ha Noi"],["Da Nang","Da Nang"],["Ho Chi Minh","Ho Chi Minh"]]'>
                                            Vietnam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field">
                                <p class="text-sm">State/Province</p>
                                <div class="tf-select">
                                    <select id="shipping-province-form" name="address[province]"
                                        data-default=""></select>
                                </div>
                            </div>
                            <div class="field">
                                <p class="text-sm">Zipcode</p>
                                <input type="text" data-opend-focus id="zipcode" name="address[zip]" value="">
                            </div>
                            <div id="zipcode-message" class="error" style="display: none;">
                                We found one shipping rate available for undefined.
                            </div>
                            <div id="zipcode-success" class="success" style="display: none;">
                                <p>We found one shipping rate available for your address:</p>
                                <p class="standard">Standard at <span>$0.00</span> USD</p>
                            </div>
                            <div class="tf-cart-tool-btns">
                                <button class="subscribe-button tf-btn animate-btn d-inline-flex bg-dark-2 w-100"
                                    type="submit">Estimate</button>
                                <div
                                    class="tf-mini-cart-tool-primary tf-btn btn-out-line-dark2 w-100 tf-mini-cart-tool-close">
                                    Close</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /shoppingCart -->

    <!-- modal quickView -->
    <div class="modal fade modalCentered modal-quick-view" id="quickView">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                <div class="tf-product-media-wrap">
                    <div dir="ltr" class="swiper tf-single-slide">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" data-color="orange">
                                <div class="item">
                                    <img class="lazyload" data-src="images/products/fashion/product-40.jpg"
                                        src="images/products/fashion/product-40.jpg" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide" data-color="green">
                                <div class="item">
                                    <img class="lazyload" data-src="images/products/fashion/product-41.jpg"
                                        src="images/products/fashion/product-41.jpg" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide" data-color="pink">
                                <div class="item">
                                    <img class="lazyload" data-src="images/products/fashion/product-42.jpg"
                                        src="images/products/fashion/product-42.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-prev nav-swiper arrow-1 nav-prev-cls single-slide-prev"></div>
                        <div class="swiper-button-next nav-swiper arrow-1 nav-next-cls single-slide-next"></div>
                    </div>
                </div>
                <div class="tf-product-info-wrap">
                    <div class="tf-product-info-inner">
                        <div class="tf-product-heading">
                            <h6 class="product-name"><a class="link" href="product-detail.html">Striped T-Shirt</a>
                            </h6>
                            <div class="product-price">
                                <h6 class="price-new price-on-sale">$100.00</h6>
                                <h6 class="price-old">$130.00</h6>
                                <span class="badge-sale">20% Off</span>
                            </div>
                            <p class="text">Pants in an airy weave made from a linen and viscose blend. Featuring a high
                                waist and a zip fly with button. Shaping at the front and back and wide legs.</p>
                        </div>
                        <div class="tf-product-variant">
                            <div class="variant-picker-item variant-color">
                                <div class="variant-picker-label">
                                    Color:<span class="variant-picker-label-value value-currentColor">Orange</span>
                                </div>
                                <div class="variant-picker-values">
                                    <div class="hover-tooltip color-btn active" data-color="orange">
                                        <span class="check-color bg-light-orange-2"></span>
                                        <span class="tooltip">Orange</span>
                                    </div>
                                    <div class="hover-tooltip color-btn" data-color="green">
                                        <span class="check-color bg-light-green"></span>
                                        <span class="tooltip">Green</span>
                                    </div>
                                    <div class="hover-tooltip color-btn" data-color="pink">
                                        <span class="check-color bg-pink"></span>
                                        <span class="tooltip">Pink</span>
                                    </div>
                                </div>
                            </div>
                            <div class="variant-picker-item variant-size">
                                <div class="variant-picker-label">
                                    <div>Size:<span class="variant-picker-label-value value-currentSize">Small</span>
                                    </div>
                                </div>
                                <div class="variant-picker-values">
                                    <span class="size-btn active" data-size="small">S</span>
                                    <span class="size-btn" data-size="medium">M</span>
                                    <span class="size-btn" data-size="large">L</span>
                                    <span class="size-btn" data-size="extra large">XL</span>
                                </div>
                            </div>
                        </div>
                        <div class="tf-product-total-quantity">
                            <div class="group-btn">
                                <div class="wg-quantity">
                                    <button class="btn-quantity minus-btn">-</button>
                                    <input class="quantity-product font-4" type="text" name="number" value="1">
                                    <button class="btn-quantity plus-btn">+</button>
                                </div>
                                <a href="#shoppingCart" data-bs-toggle="offcanvas" class="tf-btn hover-primary">Add to
                                    cart</a>
                            </div>
                            <a href="checkout.html" class="tf-btn w-100 animate-btn paypal btn-primary">Buy It Now</a>
                            <a href="checkout.html" class="more-choose-payment link">More payment options</a>
                        </div>
                        <a href="product-detail.html" class="view-details link">View full details <i
                                class="icon icon-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal quickView -->

    <!-- compare  -->
    <div class="modal modalCentered fade modal-compare" id="compare">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <span class="icon icon-close btn-hide-popup" data-bs-dismiss="modal"></span>
                <div class="modal-compare-wrap list-file-delete">
                    <h6 class="title text-center">Compare Products</h6>
                    <div class="tf-compare-inner">
                        <div class="tf-compare-list">
                            <div class="tf-compare-item file-delete">
                                <span class="icon-close remove"></span>
                                <a href="product-detail.html" class="image">
                                    <img class="lazyload" data-src="images/products/fashion/product-8.jpg"
                                        src="images/products/fashion/product-8.jpg" alt="">
                                </a>
                                <div class="content">
                                    <div class="text-title">
                                        <a class="link text-line-clamp-2" href="product-detail.html">Striped T-Shirt</a>
                                    </div>
                                    <p class="price-wrap">
                                        <span class="new-price text-primary">$130.00</span>
                                        <span class="old-price text-decoration-line-through text-dark-1">$150.00</span>
                                    </p>
                                </div>
                            </div>
                            <div class="tf-compare-item file-delete">
                                <span class="icon-close remove"></span>
                                <a href="product-detail.html" class="image">
                                    <img class="lazyload" data-src="images/products/fashion/product-6.jpg"
                                        src="images/products/fashion/product-6.jpg" alt="">
                                </a>
                                <div class="content">
                                    <div class="text-title">
                                        <a class="link text-line-clamp-2" href="product-detail.html">Loose Fit Tee</a>
                                    </div>
                                    <p class="price-wrap">
                                        <span class="new-price text-primary">$115.00</span>
                                        <span class="old-price text-decoration-line-through text-dark-1">$130.00</span>
                                    </p>
                                </div>
                            </div>
                            <div class="tf-compare-item file-delete">
                                <span class="icon-close remove"></span>
                                <a href="product-detail.html" class="image">
                                    <img class="lazyload" data-src="images/products/fashion/product-15.jpg"
                                        src="images/products/fashion/product-15.jpg" alt="">
                                </a>
                                <div class="content">
                                    <div class="text-title">
                                        <a class="link text-line-clamp-2" href="product-detail.html">Oversized Fit
                                            Tee</a>
                                    </div>
                                    <p class="price-wrap">
                                        <span class="new-price text-primary">$80.00</span>
                                        <span class="old-price text-decoration-line-through text-dark-1">$100.00</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tf-compare-buttons justify-content-center">
                        <a href="compare.html" class="tf-btn animate-btn justify-content-center">Compare</a>
                        <div class="tf-btn btn-out-line-dark justify-content-center clear-file-delete"><span>Clear
                                All</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /compare  -->
    <!-- Filter Shop -->
    <div class="offcanvas offcanvas-start canvas-sidebar canvas-filter" id="filterShop">
        <div class="canvas-wrapper">
            <div class="canvas-header">
                <span class="title">Filter</span>
                <button class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="canvas-body">
                <div class="widget-facet">
                    <div class="facet-title text-xl fw-medium" data-bs-target="#collections" role="button"
                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="collections">
                        <span>Collections</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="collections" class="collapse show">
                        <ul class="collapse-body list-categories current-scrollbar">
                            <li class="cate-item">
                                <a class="text-sm link" href="shop-default.html">
                                    <span>Men’s top</span>
                                    <span class="count">(20)</span>
                                </a>
                            </li>
                            <li class="cate-item">
                                <a class="text-sm link" href="shop-default.html">
                                    <span>Men</span>
                                    <span class="count">(20)</span>
                                </a>
                            </li>
                            <li class="cate-item">
                                <a class="text-sm link" href="shop-default.html">
                                    <span>Women</span>
                                    <span class="count">(20)</span>
                                </a>
                            </li>
                            <li class="cate-item">
                                <a class="text-sm link" href="shop-default.html">
                                    <span>Kid</span>
                                    <span class="count">(20)</span>
                                </a>
                            </li>
                            <li class="cate-item">
                                <a class="text-sm link" href="shop-default.html">
                                    <span>T-shirt</span>
                                    <span class="count">(20)</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="widget-facet">
                    <div class="facet-title text-xl fw-medium" data-bs-target="#availability" role="button"
                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="availability">
                        <span>Availability</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="availability" class="collapse show">
                        <ul class="collapse-body filter-group-check current-scrollbar">
                            <li class="list-item">
                                <input type="radio" name="availability" class="tf-check" id="inStock">
                                <label for="inStock" class="label"><span>In stock</span>&nbsp;<span
                                        class="count">(20)</span></label>
                            </li>
                            <li class="list-item">
                                <input type="radio" name="availability" class="tf-check" id="outStock">
                                <label for="outStock" class="label"><span>Out of stock</span>&nbsp;<span
                                        class="count">(3)</span></label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="widget-facet">
                    <div class="facet-title text-xl fw-medium" data-bs-target="#price" role="button"
                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="price">
                        <span>Price</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="price" class="collapse show">
                        <div class="collapse-body widget-price filter-price">
                            <span class="reset-price">Reset</span>
                            <div class="price-val-range" id="price-value-range" data-min="0" data-max="500"></div>
                            <div class="box-value-price">
                                <span class="text-sm">Price:</span>
                                <div class="price-box">
                                    <div class="price-val" id="price-min-value" data-currency="$"></div>
                                    <span>-</span>
                                    <div class="price-val" id="price-max-value" data-currency="$"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget-facet">
                    <div class="facet-title text-xl fw-medium" data-bs-target="#color" role="button"
                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="color">
                        <span>Color</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="color" class="collapse show">
                        <div class="collapse-body filter-color-box flat-check-list">
                            <div class="check-item color-item color-check"><span class="color bg-yellow"></span><span
                                    class="color-text">Yellow</span></div>
                            <div class="check-item color-item color-check"><span class="color bg-dark"></span><span
                                    class="color-text">Black</span></div>
                            <div class="check-item color-item color-check line"><span
                                    class="color bg-white"></span><span class="color-text">White</span></div>
                            <div class="check-item color-item color-check"><span class="color bg-purple-3"></span><span
                                    class="color-text">Purple</span></div>
                            <div class="check-item color-item color-check"><span
                                    class="color bg-light-orange"></span><span class="color-text">Light Orange</span>
                            </div>
                            <div class="check-item color-item color-check"><span
                                    class="color bg-light-pink-4"></span><span class="color-text">Light Pink</span>
                            </div>
                            <div class="check-item color-item color-check"><span class="color bg-pink"></span><span
                                    class="color-text">Pink</span></div>
                            <div class="check-item color-item color-check"><span
                                    class="color bg-dark-green"></span><span class="color-text">Dark Green</span></div>
                            <div class="check-item color-item color-check"><span class="color bg-grey-4"></span><span
                                    class="color-text">Grey</span></div>
                        </div>
                    </div>
                </div>
                <div class="widget-facet">
                    <div class="facet-title text-xl fw-medium" data-bs-target="#size" role="button"
                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="size">
                        <span>Size</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="size" class="collapse show">
                        <div class="collapse-body filter-size-box flat-check-list">
                            <div class="check-item size-item size-check"><span class="size">XS</span>&nbsp;<span
                                    class="count">(10)</span></div>
                            <div class="check-item size-item size-check"><span class="size">S</span>&nbsp;<span
                                    class="count">(8)</span></div>
                            <div class="check-item size-item size-check"><span class="size">L</span>&nbsp;<span
                                    class="count">(20)</span></div>
                            <div class="check-item size-item size-check"><span class="size">M</span>&nbsp;<span
                                    class="count">(10)</span></div>
                            <div class="check-item size-item size-check"><span class="size">XL</span>&nbsp;<span
                                    class="count">(20)</span></div>
                        </div>
                    </div>
                </div>
                <div class="widget-facet">
                    <div class="facet-title text-xl fw-medium" data-bs-target="#brand" role="button"
                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="brand">
                        <span>Brand</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="brand" class="collapse show">
                        <ul class="collapse-body filter-group-check current-scrollbar">
                            <li class="list-item">
                                <input type="radio" name="brand" class="tf-check" id="Vineta">
                                <label for="Vineta" class="label"><span>Vineta</span>&nbsp;<span
                                        class="count">(11)</span></label>
                            </li>
                            <li class="list-item">
                                <input type="radio" name="brand" class="tf-check" id="Zotac">
                                <label for="Zotac" class="label"><span>Zotac</span>&nbsp;<span
                                        class="count">(20)</span></label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="widget-facet">
                    <div class="facet-title text-xl fw-medium"><span>On sale</span></div>
                    <ul class="collapse-body list-recent">
                        <li>
                            <div class="recent-blog-item">
                                <a href="product-detail.html" class="img-product"><img
                                        src="images/products/recent/recent6.jpg" alt="img"></a>
                                <div class="content">
                                    <a href="product-detail.html" class="title text-md link fw-medium">Striped short
                                        sleeve shirt</a>
                                    <div class="price text-md fw-medium">
                                        <span class="new-price">$80.00</span>
                                        <span class="old-price">$100.00</span>
                                    </div>

                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="recent-blog-item">
                                <a href="product-detail.html" class="img-product"><img
                                        src="images/products/recent/recent7.jpg" alt="img"></a>
                                <div class="content">
                                    <a href="product-detail.html" class="title text-md link fw-medium">Short Sleeve
                                        Sweat</a>
                                    <div class="price text-md fw-medium">
                                        <span class="new-price">$65.00</span>
                                        <span class="old-price">$90.00</span>
                                    </div>


                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="widget-facet">
                    <div class="sb-banner hover-img">
                        <div class="image img-style">
                            <img src="images/blog/sb-banner.jpg" data-src="./images/blog/sb-banner.jpg" alt="banner"
                                class="lazyload">
                        </div>
                        <div class="banner-content">
                            <p class="title">
                                Elevate <br> Your Style
                            </p>
                            <a href="#" class="tf-btn btn-white hover-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Filter Shop -->
    
    
@endsection
