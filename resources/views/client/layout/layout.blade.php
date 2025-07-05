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
                                    <p>Return extended to 60 days</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Life-time Guarantes</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Limited-Time Offer</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <!-- 2 -->
                                <div class="marquee-child-item">
                                    <p>Return extended to 60 days</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Life-time Guarantes</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Limited-Time Offer</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <!-- 3 -->
                                <div class="marquee-child-item">
                                    <p>Return extended to 60 days</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Life-time Guarantes</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Limited-Time Offer</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <!-- 4 -->
                                <div class="marquee-child-item">
                                    <p>Return extended to 60 days</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Life-time Guarantes</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Limited-Time Offer</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <!-- 5 -->
                                <div class="marquee-child-item">
                                    <p>Return extended to 60 days</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Life-time Guarantes</p>
                                </div>
                                <div class="marquee-child-item"><span class="dot"></span></div>
                                <div class="marquee-child-item">
                                    <p>Limited-Time Offer</p>
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
                <h5 class="offcanvas-title">🛒 Giỏ hàng của bạn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Đóng"></button>
            </div>
            <div class="offcanvas-body">
                <ul id="cart-items" class="list-group list-group-flush mb-3"></ul>
                <div class="d-flex justify-content-between fw-bold mb-3">
                    <span>Tổng:</span>
                    <span id="cart-total">0₫</span>
                </div>

                <!-- Form gửi dữ liệu lên server -->
                <form method="POST" action="/checkout" onsubmit="return sendCartData()">
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

</body>



<!-- Mirrored from vineta-html.vercel.app/home-electronic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Apr 2025 19:33:06 GMT -->

</html>
<script>
  // Giỏ hàng từ localStorage
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  function renderCart() {
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const countBoxes = document.querySelectorAll('.nav-cart .count-box');

    cartItems.innerHTML = '';
    let total = 0;
    let totalQty = 0;

    if (cart.length === 0) {
      cartItems.innerHTML = `<li class="list-group-item text-center">Giỏ hàng trống</li>`;
      cartTotal.textContent = '0₫';
      countBoxes.forEach(el => el.textContent = '0');
      return;
    }

    cart.forEach(item => {
      const li = document.createElement('li');
      li.className = 'list-group-item d-flex gap-3 align-items-start';
      li.innerHTML = `
        <img src="${item.image}" width="60" height="60" class="rounded" style="object-fit:cover;">
        <div class="flex-grow-1">
          <strong>${item.name}</strong><br>
          <small>Size: ${item.size} | SL: ${item.qty}</small>
        </div>
        <div class="text-end">${(item.qty * item.price).toLocaleString('vi-VN')}₫</div>
      `;
      cartItems.appendChild(li);
      total += item.qty * item.price;
      totalQty += item.qty;
    });

    cartTotal.textContent = total.toLocaleString('vi-VN') + '₫';
    countBoxes.forEach(el => el.textContent = totalQty);
    localStorage.setItem('cart', JSON.stringify(cart));
  }

  // Bắt sự kiện thêm vào giỏ hàng
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add-to-cart').forEach(button => {
      button.addEventListener('click', () => {
        const id = button.dataset.id;
        const name = button.dataset.name;
        const price = parseInt(button.dataset.price);
        const image = button.dataset.image;
        const size = button.dataset.size;

        const existing = cart.find(item => item.id === id && item.size === size);
        if (existing) {
          existing.qty += 1;
        } else {
          cart.push({ id, name, price, image, size, qty: 1 });
        }

        renderCart();
      });
    });

    renderCart(); // render ngay khi DOM load
  });

  function sendCartData() {
    document.getElementById('cart-data-json').value = JSON.stringify(cart);
    return true;
  }
</script>


