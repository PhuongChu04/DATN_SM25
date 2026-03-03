<div class="main-nav">

    <div class="logo-box d-flex justify-content-center align-items-center py-3" style="height: 100px;">
        <a href="{{ route('admin.homeAdmin') }}" class="logo-dark">
            <img src="{{ asset('admin/assets/images/cdp2.png') }}" class="logo-sm" alt="logo sm" style="height: 150px;">
        </a>
        <a href="{{ route('admin.homeAdmin') }}" class="logo-dark">
            <img src="{{ asset('admin/assets/images/cdp2.png') }}" class="logo-lg" alt="logo dark"
                style="height: 150px;">
        </a>

        <a href="{{ route('admin.homeAdmin') }}" class="logo-light">
            <img src="{{ asset('admin/assets/images/cdp2.png') }}" class="logo-sm" alt="logo sm"
                style="height: 150px;">
        </a>
        <a href="{{ route('admin.homeAdmin') }}" class="logo-light">
            <img src="{{ asset('admin/assets/images/cdp2.png') }}" class="logo-lg" alt="logo light"
                style="height: 150px;">
        </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Hiển thị Thanh điều hướng">
        <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar>
        <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">Tổng quan</li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.homeAdmin') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Bảng điều khiển </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarProducts">
                    <span class="nav-text"> Sản phẩm </span>
                </a>
                <div class="collapse" id="sidebarProducts">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.product.listProduct') }}">Danh sách</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarBrand" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarBrand">
                    <span class="nav-text"> Thương hiệu </span>
                </a>

                <div class="collapse" id="sidebarBrand">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.brands.index') }}">Danh sách</a>
                        </li>
                        {{-- <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.brands.create') }}">Tạo mới</a>
                        </li> --}}
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarShipping" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarShipping">
                    <span class="nav-text"> Vận chuyển </span>
                </a>

                <div class="collapse" id="sidebarShipping">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.shippings.index') }}">Danh sách</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.shippings.create') }}">Tạo mới</a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarShippingRate" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarShippingRate">
                    <span class="nav-text"> Phí vận chuyển </span>
                </a>

                <div class="collapse" id="sidebarShippingRate">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.shipping-rates.index') }}">Danh sách</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.shipping-rates.create') }}">Tạo mới</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarCategory" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarCategory">

                    <span class="nav-text"> Danh mục </span>
                </a>
                <div class="collapse" id="sidebarCategory">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('listCategory.list') }}">Danh sách</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarOrders" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarOrders">
                    <span class="nav-text"> Đơn hàng </span>
                </a>
                <div class="collapse" id="sidebarOrders">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.orders.index') }}">Danh sách</a>
                        </li>
                    </ul>
                </div>

            </li>


            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarAttributes" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarAttributes">

                    <span class="nav-text"> Thuộc tính </span>
                </a>
                <div class="collapse" id="sidebarAttributes">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.color.listColor') }}">Màu sắc</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.size.listSize') }}">Kích thước</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarCoupons" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarCoupons">

                    <span class="nav-text"> Mã giảm giá </span>
                </a>
                <div class="collapse" id="sidebarCoupons">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.voucher.listVoucher') }}">Danh sách
                                Voucher</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.voucher.addVoucher') }}">Thêm mã giảm
                                giá</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarShippingRate" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarShippingRate">
                    <span class="nav-text"> Đánh giá </span>
                </a>

                <div class="collapse" id="sidebarShippingRate">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.reviews.index') }}">Danh sách</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarContacts" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarContacts">
                    <span class="nav-text"> Liên hệ </span>
                </a>
                <div class="collapse" id="sidebarContacts">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.contacts.index') }}">Danh sách liên hệ</a>
                        </li>
                    </ul>
                </div>
            </li>


            {{-- <li class="nav-item">
                <a class="nav-link" href="settings.html">
                    <span class="nav-text"> Cài đặt </span>
                </a>
            </li> --}}

            <li class="menu-title mt-2">Người dùng</li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarRoles" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarRoles">
                    <span class="nav-text"> Khách hàng </span>
                </a>
                <div class="collapse" id="sidebarRoles">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.auth.list') }}">Tài khoản</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarAdmin" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarAdmin">
                    <span class="nav-text"> Admin </span>
                </a>
                <div class="collapse" id="sidebarAdmin">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.auth.listAdmin') }}">Danh sách</a>
                        </li>
                    </ul>
                </div>
            </li>







        </ul>
    </div>
</div>
