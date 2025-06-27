

<style>
    .main-nav {
        width: 250px; /* Độ rộng cố định cho sidebar */
        background-color: var(--bs-secondary-bg); /* Màu nền từ app.min.css */
        height: 100vh; /* Chiều cao toàn màn hình */
        position: fixed; /* Cố định sidebar */
        top: 0;
        left: 0;
        padding: 15px 0;
        transition: all 0.3s ease; /* Hiệu ứng khi toggle */
    }
    
    .logo-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        position: relative;
        margin-bottom: 20px; /* Khoảng cách với phần menu */
    }
    
    .logo-dark,
    .logo-light {
        display: block;
        width: 100%;
        max-width: 100%;
        text-align: center;
    }
    
    .logo-sm,
    .logo-lg {
        width: 90%;
        height: auto;
        object-fit: cover;
        max-width: 90%;
        display: block;
        margin: 0 auto;
        border-radius: var(--bs-border-radius, 0.5rem);
    }
    
    .button-sm-hover {
        display: block;
        width: 100%;
        padding: 10px;
        text-align: center;
        background-color: var(--bs-light); /* Màu nền từ app.min.css */
        border: none;
        cursor: pointer;
        margin-bottom: 20px;
    }
    
    .button-sm-hover-icon {
        font-size: 1.5rem;
        color: var(--bs-dark); /* Màu icon từ app.min.css */
    }
    
    @media (min-width: 768px) {
        .logo-sm {
            display: none;
        }
        .logo-lg {
            display: block;
        }
    }
    
    @media (max-width: 767px) {
        .logo-lg {
            display: none;
        }
        .logo-sm {
            display: block;
        }
        .main-nav {
            width: 100%; /* Mở rộng toàn màn hình trên mobile */
            transform: translateX(-100%); /* Ẩn sidebar ban đầu */
        }
        .main-nav.active {
            transform: translateX(0); /* Hiển thị khi active */
        }
    }
    </style>
    
    
    <div class="main-nav">
    
        <!-- Sidebar Logo -->
       <div class="logo-box">
            <a href="{{ route('admin.homeAdmin') }}" class="logo-dark">
                <img src="{{ asset('admin/assets/images/cdp1.png') }}" class="logo-sm" alt="logo sm">
            </a>
            <a href="{{ route('admin.homeAdmin') }}" class="logo-dark">
                <img src="{{ asset('admin/assets/images/cdp1.png') }}" class="logo-lg" alt="logo dark">
            </a>
    
            <a href="{{ route('admin.homeAdmin') }}" class="logo-light">
                <img src="{{ asset('admin/assets/images/cdp.png') }}" class="logo-sm" alt="logo sm">
            </a>
            <a href="{{ route('admin.homeAdmin') }}" class="logo-light">
                <img src="{{ asset('admin/assets/images/cdp1.png') }}" class="logo-lg" alt="logo light">
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
                    <a class="nav-link" href="index.html">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Dashboard </span>
                    </a>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarProducts">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:t-shirt-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Products </span>
                    </a>
                    <div class="collapse" id="sidebarProducts">
                        <ul class="nav sub-navbar-nav">
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="product-list.html">List</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="product-grid.html">Grid</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="product-details.html">Details</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="product-edit.html">Edit</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="product-add.html">Create</a>
                            </li>
                        </ul>
                    </div>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link menu-arrow" href="#sidebarCategory" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCategory">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Category </span>
                    </a>
                    <div class="collapse" id="sidebarCategory">
                        <ul class="nav sub-navbar-nav">
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="category-list.html">List</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="category-edit.html">Edit</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="category-add.html">Create</a>
                            </li>
                        </ul>
                    </div>
                </li>
    
                <li class="nav-item">
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
                </li>
    
                <li class="nav-item">
                    <a class="nav-link menu-arrow" href="#sidebarOrders" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarOrders">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:bag-smile-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Orders </span>
                    </a>
                    <div class="collapse" id="sidebarOrders">
                        <ul class="nav sub-navbar-nav">
    
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="orders-list.html">List</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="order-detail.html">Details</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="order-cart.html">Cart</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="order-checkout.html">Check Out</a>
                            </li>
                        </ul>
                    </div>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link menu-arrow" href="#sidebarPurchases" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPurchases">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:card-send-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Purchases </span>
                    </a>
                    <div class="collapse" id="sidebarPurchases">
                        <ul class="nav sub-navbar-nav">
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="purchase-list.html">List</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="purchase-order.html">Order</a>
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
                        <span class="nav-icon">
                            <iconify-icon icon="solar:confetti-minimalistic-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Attributes </span>
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
                    <a class="nav-link" href="settings.html">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Settings </span>
                    </a>
                </li>
    
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
                                    <a class="sub-nav-link" href="role-list.html">List</a>
                                </li>
                                <li class="sub-nav-item">
                                    <a class="sub-nav-link" href="role-edit.html">Edit</a>
                                </li>
                                <li class="sub-nav-item">
                                    <a class="sub-nav-link" href="role-add.html">Create</a>
                                </li>
                            </ul>
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
    
                <li class="nav-item">
                    <a class="nav-link menu-arrow" href="#sidebarCustomers" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCustomers">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:users-group-two-rounded-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Customers </span>
                    </a>
                    <div class="collapse" id="sidebarCustomers">
                        <ul class="nav sub-navbar-nav">
    
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="customer-list.html">List</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="customer-detail.html">Details</a>
                            </li>
                        </ul>
                    </div>
                </li>
    
               
    
                <li class="menu-title mt-2">Other</li>
    
                <li class="nav-item">
                    <a class="nav-link menu-arrow" href="#sidebarCoupons" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCoupons">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:leaf-bold-duotone"></iconify-icon>
                        </span>
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
                    <a class="nav-link" href="pages-review.html">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:chat-square-like-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Reviews </span>
                    </a>
                </li>
    
          
    
                <li class="menu-title mt-2">Support</li>
    
                <li class="nav-item">
                    <a class="nav-link" href="help-center.html">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:help-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Help Center </span>
                    </a>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link" href="pages-faqs.html">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:question-circle-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> FAQs </span>
                    </a>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link" href="privacy-policy.html">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:document-text-bold-duotone"></iconify-icon>
                        </span>
                        <span class="nav-text"> Privacy Policy </span>
                    </a>
                </li>
    
              
    
    
            </ul>
        </div>
    </div>
    