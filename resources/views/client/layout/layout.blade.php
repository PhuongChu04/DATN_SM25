<!DOCTYPE html>

<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->


<!-- Mirrored from vineta-html.vercel.app/home-electronic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Apr 2025 19:31:38 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <title>Vineta - Multipurpose eCommerce</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description"
        content="Themesflat Vineta - A modern and versatile eCommerce template designed for various online stores, including fashion, furniture, electronics, and more. SEO-friendly, fast-loading, and highly customizable.">

    <!-- font -->
    <link rel="stylesheet" href="{{ asset('client/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('client/fonts/font-icons.css') }}">
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('client/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/drift-basic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/photoswipe.css') }}">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('client/images/logo/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('client/images/logo/favicon.png') }}">

</head>

<body>

    <!-- RTL -->
    <a href="javascript:void(0);" id="toggle-rtl" class="tf-btn animate-btn"><span>RTL</span></a>
    <!-- /RTL  -->

    <!-- Scroll Top -->
    @include('client.layout.srcoll')

    <!-- preload  tải trước-->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->

    <div id="wrapper">
        <!-- Top Bar-->
        <div class="tf-topbar bg-dark-5 topbar-bg">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-6 overflow-hidden">
                        <div class="topbar-center marquee-wrapper">
                            <div class="initial-child-container">
                                <div class="marquee-child-item">
                                    <p>Gia hạn đổi trả lên đến 60 ngày</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Bảo hành trọn đời</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Ưu đãi có thời hạn</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <!-- 2 -->
                                <div class="marquee-child-item">
                                    <p>Gia hạn đổi trả lên đến 60 ngày</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Bảo hành trọn đời</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Ưu đãi có thời hạn</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <!-- 3 -->
                                <div class="marquee-child-item">
                                    <p>Gia hạn đổi trả lên đến 60 ngày</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Bảo hành trọn đời</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Ưu đãi có thời hạn</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <!-- 4 -->
                                <div class="marquee-child-item">
                                    <p>Gia hạn đổi trả lên đến 60 ngày</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Bảo hành trọn đời</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Ưu đãi có thời hạn</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <!-- 5 -->
                                <div class="marquee-child-item">
                                    <p>Gia hạn đổi trả lên đến 60 ngày</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Bảo hành trọn đời</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Ưu đãi có thời hạn</p>
                                </div>

                                <div class="marquee-child-item"><span class="dot"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Top Bar -->
        <!-- Header -->
        @include('client.layout.header')
        <!-- /Header -->


        @yield('content')
        <div class="offcanvas offcanvas-end" tabindex="-1" id="shoppingCart" aria-labelledby="shoppingCartLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="shoppingCartLabel">🛒 Giỏ hàng của bạn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Đóng"></button>
            </div>
            <div class="offcanvas-body">
                <p id="cart-empty-message" class="text-center d-none">Giỏ hàng của bạn đang trống.</p>
                <ul id="cart-items" class="list-group list-group-flush mb-3">
                    <!-- Các sản phẩm trong giỏ hàng sẽ được thêm vào đây bằng JavaScript -->
                </ul>
                <div class="d-flex justify-content-between fw-bold mb-3">
                    <span>Tổng:</span>
                    <span id="cart-total">0₫</span>
                </div>

                <!-- Form gửi dữ liệu lên server -->
                <form id="checkout-form" method="POST" action="/checkout" onsubmit="return sendCartData()">
                    @csrf
                    <input type="hidden" name="cart_data" id="cart-data-json">
                    <button type="submit" class="btn btn-primary w-100">Thanh toán</button>
                </form>
            </div>
        </div>



        <!-- Footer -->
        @include('client.layout.footer')
        <!-- /Footer -->


    </div>



    <!-- Javascript -->
    <script src="{{ asset('client/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('client/js/jquery.min.js') }}"></script>
    <script src="{{ asset('client/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('client/js/carousel.js') }}"></script>
    <script src="{{ asset('client/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('client/js/lazysize.min.js') }}"></script>
    <script src="{{ asset('client/js/count-down.js') }}"></script>
    <script src="{{ asset('client/js/wow.min.js') }}"></script>
    <script src="{{ asset('client/js/multiple-modal.js') }}"></script>

    <script src="{{ asset('client/js/main.js') }}"></script>
    @stack('scripts')

    <script src="{{ asset('client/js/drift.min.js')}}"></script>
    <script src="{{ asset('client/js/photoswipe-lightbox.umd.min.js')}}"></script>
    <script src="{{ asset('client/js/photoswipe.umd.min.js')}}"></script>
    <script src="{{ asset('client/js/zoom.js')}}"></script>
</body>



<!-- Mirrored from vineta-html.vercel.app/home-electronic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Apr 2025 19:33:06 GMT -->

</html>
<script>
    // Giỏ hàng từ localStorage
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy các phần tử DOM cần thiết
        const cartItemsContainer = document.getElementById('cart-items');
        const cartTotalElement = document.getElementById('cart-total');

        // === DÒNG ĐÃ THAY ĐỔI ===
        const cartCountElement = document.querySelector('.count-box'); // Tìm theo class thay vì id
        // ========================

        const cartDataInput = document.getElementById('cart-data-json');
        const checkoutForm = document.getElementById('checkout-form');
        const cartEmptyMessage = document.getElementById('cart-empty-message');

        // Khởi tạo giỏ hàng từ localStorage hoặc tạo mới nếu chưa có
        let cart = JSON.parse(localStorage.getItem('shoppingCart')) || [];

        // Cập nhật giao diện giỏ hàng khi trang được tải
        updateCartDisplay();

        // Lắng nghe sự kiện click trên toàn bộ document
        document.addEventListener('click', function(event) {
            // 1. Xử lý khi nhấn nút "Thêm vào giỏ"
            if (event.target.classList.contains('add-to-cart-btn')) {
                const productCard = event.target.closest('.product-card');
                const productId = productCard.dataset.productId;
                const productName = productCard.dataset.productName;
                const productPrice = parseFloat(productCard.dataset.productPrice);
                const productImage = productCard.dataset.productImage;

                addToCart(productId, productName, productPrice, productImage);
            }

            // 2. Xử lý khi nhấn nút "Xóa" sản phẩm trong giỏ hàng
            if (event.target.classList.contains('remove-from-cart-btn')) {
                const productId = event.target.dataset.productId;
                removeFromCart(productId);
            }
        });


        /**
         * Thêm một sản phẩm vào giỏ hàng
         */
        function addToCart(productId, productName, productPrice, productImage) {
            const existingItem = cart.find(item => item.id === productId);

            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    quantity: 1,
                });
            }
            updateCartDisplay();
        }

        /**
         * Xóa một sản phẩm khỏi giỏ hàng
         */
        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCartDisplay();
        }


        /**
         * Cập nhật toàn bộ giao diện giỏ hàng
         */
        function updateCartDisplay() {
            cartItemsContainer.innerHTML = '';
            let total = 0;
            let totalItems = 0;

            if (cart.length === 0) {
                cartEmptyMessage.classList.remove('d-none');
                checkoutForm.querySelector('button[type="submit"]').disabled = true;
            } else {
                cartEmptyMessage.classList.add('d-none');
                checkoutForm.querySelector('button[type="submit"]').disabled = false;

                cart.forEach(item => {
                    const li = document.createElement('li');
                    li.className = 'list-group-item d-flex justify-content-between align-items-center';
                    li.innerHTML = `
                    <div class="d-flex align-items-center">
                        <img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                        <div>
                            <div class="fw-bold">${item.name}</div>
                            <small class="text-muted">${item.quantity} x ${formatCurrency(item.price)}</small>
                        </div>
                    </div>
                    <div>
                        <span class="fw-bold me-3">${formatCurrency(item.quantity * item.price)}</span>
                        <button class="btn btn-sm btn-outline-danger remove-from-cart-btn" data-product-id="${item.id}">×</button>
                    </div>
                `;
                    cartItemsContainer.appendChild(li);

                    total += item.quantity * item.price;
                    totalItems += item.quantity;
                });
            }

            // Cập nhật tổng tiền và số lượng trên badge
            cartTotalElement.textContent = formatCurrency(total);
            if (cartCountElement) { // Kiểm tra xem phần tử có tồn tại không trước khi cập nhật
                cartCountElement.textContent = totalItems;
            }

            localStorage.setItem('shoppingCart', JSON.stringify(cart));
        }

        /**
         * Định dạng số thành tiền tệ (VD: 100000 -> 100.000₫)
         */
        function formatCurrency(number) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(number);
        }

        /**
         * Hàm này được gọi bởi thuộc tính onsubmit của form
         */
        window.sendCartData = function() {
            if (cart.length === 0) {
                alert('Giỏ hàng của bạn đang trống!');
                return false;
            }
            cartDataInput.value = JSON.stringify(cart);
            return true;
        }
    });
    // Lấy các phần tử DOM cần thiết
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');
    const cartCountElement = document.querySelector('.count-box');
    const cartDataInput = document.getElementById('cart-data-json');
    const checkoutForm = document.getElementById('checkout-form');
    const cartEmptyMessage = document.getElementById('cart-empty-message');

    // Khởi tạo giỏ hàng từ localStorage hoặc tạo mới nếu chưa có
    let cart = JSON.parse(localStorage.getItem('shoppingCart')) || [];

    // Cập nhật giao diện giỏ hàng khi trang được tải
    updateCartDisplay();

    // Lắng nghe sự kiện click trên toàn bộ document
    document.addEventListener('click', function(event) {
        // 1. Xử lý khi nhấn nút "Thêm vào giỏ"
        if (event.target.classList.contains('add-to-cart-btn')) {
            const productCard = event.target.closest('.product-card'); // Tìm thẻ cha chứa thông tin sản phẩm
            const productId = productCard.dataset.productId;
            const productName = productCard.dataset.productName;
            const productPrice = parseFloat(productCard.dataset.productPrice);
            const productImage = productCard.dataset.productImage;

            addToCart(productId, productName, productPrice, productImage);
        }

        // 2. Xử lý khi nhấn nút "Xóa" sản phẩm trong giỏ hàng
        if (event.target.classList.contains('remove-from-cart-btn')) {
            const productId = event.target.dataset.productId;
            removeFromCart(productId);
        }
    });


    /**
     * Thêm một sản phẩm vào giỏ hàng
     */
    function addToCart(productId, productName, productPrice, productImage) {
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        const existingItem = cart.find(item => item.id === productId);

        if (existingItem) {
            // Nếu đã có, chỉ tăng số lượng
            existingItem.quantity++;
        } else {
            // Nếu chưa có, thêm sản phẩm mới vào giỏ
            cart.push({
                id: productId,
                name: productName,
                price: productPrice,
                image: productImage,
                quantity: 1,
            });
        }
        // Cập nhật lại giao diện và lưu vào localStorage
        updateCartDisplay();
    }

    /**
     * Xóa một sản phẩm khỏi giỏ hàng
     */
    function removeFromCart(productId) {
        cart = cart.filter(item => item.id !== productId);
        // Cập nhật lại giao diện và lưu vào localStorage
        updateCartDisplay();
    }


    /**
     * Cập nhật toàn bộ giao diện giỏ hàng
     */
    function updateCartDisplay() {
        // Xóa nội dung hiện tại của giỏ hàng
        cartItemsContainer.innerHTML = '';

        let total = 0;
        let totalItems = 0;

        if (cart.length === 0) {
            cartEmptyMessage.classList.remove('d-none'); // Hiện thông báo rỗng
            checkoutForm.querySelector('button[type="submit"]').disabled = true; // Vô hiệu hóa nút thanh toán
        } else {
            cartEmptyMessage.classList.add('d-none'); // Ẩn thông báo rỗng
            checkoutForm.querySelector('button[type="submit"]').disabled = false; // Kích hoạt nút thanh toán

            cart.forEach(item => {
                // Tạo một list item cho mỗi sản phẩm
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.innerHTML = `
                    <div class="d-flex align-items-center">
                        <img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                        <div>
                            <div class="fw-bold">${item.name}</div>
                            <small class="text-muted">${item.quantity} x ${formatCurrency(item.price)}</small>
                        </div>
                    </div>
                    <div>
                        <span class="fw-bold me-3">${formatCurrency(item.quantity * item.price)}</span>
                        <button class="btn btn-sm btn-outline-danger remove-from-cart-btn" data-product-id="${item.id}">×</button>
                    </div>
                `;
                cartItemsContainer.appendChild(li);

                // Tính tổng tiền và tổng số lượng
                total += item.quantity * item.price;
                totalItems += item.quantity;
            });
        }

        // Cập nhật tổng tiền và số lượng trên badge
        cartTotalElement.textContent = formatCurrency(total);
        cartCountElement.textContent = totalItems;

        // Lưu giỏ hàng vào localStorage
        localStorage.setItem('shoppingCart', JSON.stringify(cart));
    }

    /**
     * Định dạng số thành tiền tệ (VD: 100000 -> 100.000₫)
     */
    function formatCurrency(number) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(number);
    }


    /**
     * Hàm này được gọi bởi thuộc tính onsubmit của form
     * Nó sẽ chuyển đổi giỏ hàng thành chuỗi JSON và đặt vào input ẩn
     */
    window.sendCartData = function() {
    if (cart.length === 0) {
        alert('Giỏ hàng của bạn đang trống!');
        return false; // Ngăn không cho form được gửi đi
    }
    cartDataInput.value = JSON.stringify(cart);
    return true; // Cho phép form được gửi đi
    }

</script>
