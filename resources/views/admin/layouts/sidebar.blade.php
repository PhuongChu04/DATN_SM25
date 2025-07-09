



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
            <img src="{{ asset('admin/assets/images/cdp2.png') }}" class="logo-sm" alt="logo sm" style="height: 150px;">
        </a>
        <a href="{{ route('admin.homeAdmin') }}" class="logo-light">
            <img src="{{ asset('admin/assets/images/cdp2.png') }}" class="logo-lg" alt="logo light"
                style="height: 150px;">
        </a>
    </div>


    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar>
        <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">General</li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.homeAdmin')}}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Dashboard </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarProducts">
                    {{-- <span class="nav-icon">
                        <iconify-icon icon="solar:t-shirt-bold-duotone"></iconify-icon>
                    </span> --}}
                    <span class="nav-text"> Sản Phẩm </span>
                </a>
                <div class="collapse" id="sidebarProducts">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.product.listProduct') }}">List</a>
                        </li>
                        {{--  --}}
                        {{--
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="product-details.html">Details</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="product-edit.html">Edit</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="product-add.html">Create</a>
                        </li> --}}
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarBrand" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarBrand">
                    {{-- <span class="nav-icon">
                        <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                    </span> --}}
                    <span class="nav-text"> Brand </span>
                </a>

                <div class="collapse" id="sidebarBrand">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.brands.index') }}">List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.brands.create') }}">Create</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarShipping" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarShipping">
                    {{-- <span class="nav-icon">
                        <iconify-icon icon="solar:truck-bold-duotone"></iconify-icon>
                    </span> --}}
                    <span class="nav-text"> Shipping </span>
                </a>

                <div class="collapse" id="sidebarShipping">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.shippings.index') }}">List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.shippings.create') }}">Create</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarShippingRate" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarShippingRate">
                    {{-- <span class="nav-icon">
                        <iconify-icon icon="solar:coin-bold-duotone"></iconify-icon>
                    </span> --}}
                    <span class="nav-text"> Shipping Rates </span>
                </a>

                <div class="collapse" id="sidebarShippingRate">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.shipping-rates.index') }}">List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.shipping-rates.create') }}">Create</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarCategory" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarCategory">

                    <span class="nav-text"> Category </span>
                </a>
                <div class="collapse" id="sidebarCategory">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('listCategory.list') }}">List</a>
                        </li>

                    </ul>
                </div>
            </li>
            {{-- Inventory --}}
            {{-- <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarInventory" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarInventory">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:box-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Inventory </span>
                </a>
                <div class="collapse" id="sidebarInventory">
                    <ul class="nav sub-navbar-nav">

                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="inventory-warehouse.html">Warehouse</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="inventory-received-orders.html">Received Orders</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarOrders" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarOrders">
                    {{-- <span class="nav-icon">
                        <iconify-icon icon="solar:bag-smile-bold-duotone"></iconify-icon>
                    </span> --}}
                    <span class="nav-text"> Orders </span>
                </a>
                <div class="collapse" id="sidebarOrders">
                    <ul class="nav sub-navbar-nav">

                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.orders.index') }}">List</a>
                        </li>
                        {{-- <li class="sub-nav-item">
                            <a class="sub-nav-link" href="">Details</a>
                        </li> --}}
                        {{-- <li class="sub-nav-item">
                            <a class="sub-nav-link" href="order-cart.html">Cart</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="order-checkout.html">Check Out</a>
                        </li> --}}
                    </ul>
                </div>
            </li>
{{-- Purchases --}}
            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarPurchases" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarPurchases">
                    {{-- <span class="nav-icon">
                        <iconify-icon icon="solar:card-send-bold-duotone"></iconify-icon>
                    </span> --}}
                    <span class="nav-text"> Purchases </span>
                </a>
                <div class="collapse" id="sidebarPurchases">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="purchase-list.html">List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="#">Order</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="purchase-returns.html">Return</a>
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
                                <a class="sub-nav-link" href="{{route('admin.color.listColor')   }}">Color</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{route('admin.size.listSize')}}">Size</a>
                            </li>
                            {{-- <li class="sub-nav-item">
                                <a class="sub-nav-link" href="attributes-add.html">Create</a>
                            </li> --}}
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-arrow" href="#sidebarCoupons" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCoupons">

                        <span class="nav-text"> Coupons </span>
                    </a>
                    <div class="collapse" id="sidebarCoupons">
                        <ul class="nav sub-navbar-nav">
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{route('admin.voucher.listVoucher')}}">Danh Sách Voucher</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{route('admin.voucher.addVoucher')}}">Thêm mã giảm giá</a>
                            </li>
                        </ul>
                    </div>
                </li>
                 <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarShippingRate" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarShippingRate">
                    {{-- <span class="nav-icon">
                        <iconify-icon icon="solar:coin-bold-duotone"></iconify-icon>
                    </span> --}}
                    <span class="nav-text"> Đánh giá </span>
                </a>

                <div class="collapse" id="sidebarShippingRate">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{route('admin.reviews.index') }}">List</a>
                        </li>

                    </ul>
                </div>
            </li>


{{-- Invoices- hóa đơn --}}
            {{-- <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarInvoice" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarInvoice">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:bill-list-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Invoices </span>
                </a>
                <div class="collapse" id="sidebarInvoice">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="invoice-list.html">List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="invoice-details.html">Details</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="invoice-add.html">Create</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link" href="settings.html">
                    {{-- <span class="nav-icon">
                        <iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
                    </span> --}}
                    <span class="nav-text"> Settings </span>
                </a>
            </li>
{{--  --}}
            <li class="menu-title mt-2">Users</li>

            <li class="nav-item">
                <a class="nav-link" href="pages-profile.html">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:chat-square-like-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Profile </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarRoles" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarRoles">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:user-speak-rounded-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Roles </span>
                </a>
                <div class="collapse" id="sidebarRoles">
                    <ul class="nav sub-navbar-nav">
                        <ul class="nav sub-navbar-nav">
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{ route('admin.auth.list') }}">User</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="role-edit.html">List</a>
                            </li>
                            {{-- <li class="sub-nav-item">
                                <a class="sub-nav-link" href="role-edit.html">Edit</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="role-add.html">Create</a>
                            </li> --}}
                        </ul>{{ route('admin.auth.list') }}
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="pages-permissions.html">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:checklist-minimalistic-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> Permissions </span>
                </a>
            </li>


        </ul>
    </div>
    </div>







