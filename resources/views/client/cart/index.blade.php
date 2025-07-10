@extends('client.layout.layout')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        {{-- Phần giỏ hàng bên trái (GIỮ NGUYÊN) --}}
        <div class="col-lg-8">
            {{-- Thanh tiến trình Freeship --}}
            <div class="mb-4 p-3 bg-light rounded">
                <p class="mb-2">Buy <strong class="text-success">$70.00</strong> more to get <strong class="text-dark">Freeship</strong></p>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            {{-- Tiêu đề các cột --}}
            <div class="row fw-bold border-bottom pb-2 mb-3 d-none d-md-flex">
                <div class="col-md-5">Products</div>
                <div class="col-md-2 text-center">Price</div>
                <div class="col-md-3 text-center">Quantity</div>
                <div class="col-md-2 text-end">Total Price</div>
            </div>

            @if(!empty($cart) && count($cart) > 0)
                <form action="{{ route('client.cart.update') }}" method="POST">
                    @csrf
                    @php $subtotal = 0; @endphp
                    @foreach($cart as $id => $details)
                        @php
                            $totalItem = $details['price'] * $details['quantity'];
                            $subtotal += $totalItem;
                        @endphp
                        <div class="row align-items-center border-bottom py-3 g-3">
                            {{-- Cột sản phẩm --}}
                            <div class="col-12 col-md-5">
                                <div class="d-flex align-items-center">
                                    <a href="#"><img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" style="width: 90px; height: 110px; object-fit: cover;" class="rounded"></a>
                                    <div class="ms-3">
                                        <a href="#" class="text-dark text-decoration-none fw-bold">{{ $details['name'] }}</a>
                                        <div class="d-flex gap-2 mt-2">
                                            {{-- COLOR --}}
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle color-btn" type="button" data-bs-toggle="dropdown">
                                                    {{ $details['color'] ?? 'Choose Color' }}
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @foreach(['Blue', 'Black', 'Red'] as $color)
                                                        <li>
                                                            <a class="dropdown-item color-option" href="#" data-value="{{ $color }}">{{ $color }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="colors[{{ $id }}]" value="{{ $details['color'] ?? '' }}" class="color-input">
                                            </div>

                                            {{-- SIZE --}}
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle size-btn" type="button" data-bs-toggle="dropdown">
                                                    {{ $details['size'] ?? 'Choose Size' }}
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @foreach(['S', 'M', 'L', 'XL'] as $size)
                                                        <li>
                                                            <a class="dropdown-item size-option" href="#" data-value="{{ $size }}">{{ $size }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="sizes[{{ $id }}]" value="{{ $details['size'] ?? '' }}" class="size-input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Cột giá --}}
                            <div class="col-6 col-md-2 text-md-center">
                                <span class="d-md-none">Price: </span>
                                <span class="fw-medium">${{ number_format($details['price'], 2) }}</span>
                            </div>

                            {{-- Cột số lượng --}}
                            <div class="col-6 col-md-3">
                                <div class="input-group justify-content-center" style="max-width: 130px; margin-left: auto; margin-right: auto;">
                                    <button class="btn btn-outline-secondary btn-decrease" type="button">-</button>
                                    <input type="number" min="1" class="form-control text-center quantity-product" name="quantities[{{ $id }}]" value="{{ $details['quantity'] }}">
                                    <button class="btn btn-outline-secondary btn-increase" type="button">+</button>
                                </div>
                            </div>

                            {{-- Cột tổng tiền và nút xóa --}}
                            <div class="col-12 col-md-2 text-end">
                                <div class="d-flex justify-content-end align-items-center">
                                    <span class="fw-medium me-3 item-total-price" data-price="{{ $details['price'] }}">${{ number_format($totalItem, 2) }}</span>
                                    <a href="{{ route('client.cart.remove', $id) }}" class="text-danger" onclick="return confirm('Are you sure?')" title="Remove item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        


                    @endforeach
                    @if (session('selected_address'))
                            <div class="alert alert-info">
                                <h5>Địa chỉ giao hàng:</h5>
                                <p><strong>{{ session('selected_address.full_name') }}</strong></p>
                                <p>{{ session('selected_address.phone') }}</p>
                                <p>{{ session('selected_address.address') }}</p>
                            </div>
                        @endif

                    {{-- Nút Update Cart --}}
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-dark">Update Cart</button>
                    </div>
                    </form>
                        @else
                            <div class="alert alert-info">Your cart is empty.</div>
                        @endif
                    </div>


        {{-- Sidebar Order Summary bên phải (GIỮ NGUYÊN) --}}
        <div class="col-lg-4">
            <div class="card border-0" style="background-color: #f8f9fa;">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4">Order Summary</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                            Subtotal<span id="subtotal-value">-${{ number_format($subtotal ?? 0, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">Discounts<span>-$0.00</span></li>
                        <li class="list-group-item px-0 bg-transparent">
                            <p class="mb-2">Shipping</p>
                            <div class="form-check d-flex justify-content-between"><div><input class="form-check-input" type="radio" name="shipping" id="free" checked><label class="form-check-label ms-2" for="free">Free Shipping</label></div><span>$0.00</span></div>
                            <div class="form-check d-flex justify-content-between"><div><input class="form-check-input" type="radio" name="shipping" id="local"><label class="form-check-label ms-2" for="local">Local</label></div><span>$35.00</span></div>
                            <div class="form-check d-flex justify-content-between"><div><input class="form-check-input" type="radio" name="shipping" id="flatrate"><label class="form-check-label ms-2" for="flatrate">Flat Rate</label></div><span>$35.00</span></div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent border-top pt-3"><strong class="h5">Total</strong><strong class="h5">${{ number_format($subtotal ?? 0, 2) }}</strong></li>
                    </ul>
                    <div class="form-check my-4"><input class="form-check-input" type="checkbox" value="" id="terms"><label class="form-check-label" for="terms">I agree with the <a href="#">Terms And Conditions</a></label></div>
                    <a href="#" class="btn btn-dark btn-lg w-100 mb-2">Process To Checkout</a>
                    <a href="/" class="btn btn-outline-dark w-100">Or continue shopping</a>
                </div>
            </div>
        </div>
    </div>

    {{-- === PHẦN MỚI ĐƯỢC THÊM VÀO === --}}
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <div class="row mt-5 pt-5 border-top">
        <div class="col-12 text-center mb-5">
            <h2 class="fw-bold display-5">You May Also Like</h2>
        </div>

        @foreach($relatedProducts as $product)
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card border-0 product-card-hover">
                <div class="card-product-wrapper position-relative">
                    <a href="#">
                        <img src="{{ asset('storage/' . $product->image_primary) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                    </a>

                    {{-- Nhãn giảm giá --}}
                    @if(isset($product->sale_percent) && $product->sale_percent > 0)
                        <span class="badge bg-danger position-absolute top-0 start-0 m-3 fs-6">-{{$product->sale_percent}}%</span>
                    @endif

                    {{-- Các nút chức năng ẩn/hiện --}}
                    <div class="product-actions">
                        <a href="#" class="btn btn-light btn-icon rounded-circle" title="Add to Wishlist"><i class="bi bi-heart"></i></a>
                        <a href="#" class="btn btn-light btn-icon rounded-circle" title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                        <a href="#" class="btn btn-light btn-icon rounded-circle" title="Quick View"><i class="bi bi-eye"></i></a>
                    </div>

                    {{-- Nút Quick Add ẩn/hiện --}}
                    <div class="quick-add-overlay">
                        <form action="{{ route('client.cart.add') }}" method="POST">
                           @csrf
                           <input type="hidden" name="product_id" value="{{ $product->id }}">
                           <input type="hidden" name="quantity" value="1">
                           <button type="submit" class="btn btn-light w-100 rounded-pill">Quick Add</button>
                       </form>
                    </div>
                </div>

                <div class="card-body text-start px-0 pt-3">
                    <h5 class="card-title fs-6 mb-1"><a href="#" class="text-dark text-decoration-none">{{ $product->name }}</a></h5>
                    <p class="card-text fw-bold text-dark mb-2">
                        @if(isset($product->firstVariant->sale_price))
                            <span class="text-muted text-decoration-line-through me-2">${{ number_format($product->firstVariant->price, 2) }}</span>
                            <span>${{ number_format($product->firstVariant->sale_price, 2) }}</span>
                        @else
                            <span>${{ number_format($product->firstVariant->price ?? 0, 2) }}</span>
                        @endif
                    </p>
                    {{-- Chấm màu --}}
                    @if(isset($product->colors) && $product->colors->count() > 0)
                        <div class="d-flex gap-2">
                            @foreach($product->colors as $color)
                                <span class="color-swatch-related" style="background-color: {{ $color->code }};"></span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    {{-- === KẾT THÚC PHẦN MỚI === --}}

</div>
{{-- CSS tùy chỉnh cho hiệu ứng hover và các thành phần khác --}}
<style>
    .product-card-hover .product-actions,
    .product-card-hover .quick-add-overlay {
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
        transform: translateY(10px);
    }
    .product-card-hover:hover .product-actions,
    .product-card-hover:hover .quick-add-overlay {
        opacity: 1;
        transform: translateY(0);
    }
    .product-actions {
        position: absolute;
        top: 1rem;
        right: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .btn-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .quick-add-overlay {
        position: absolute;
        bottom: 1rem;
        left: 1rem;
        right: 1rem;
    }
    .color-swatch-related {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 1px solid #dee2e6;
        cursor: pointer;
    }
    /* Xoá mũi tên nhỏ trong input type=number */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

</style>
@endsection

@push('scripts')
{{-- Script cho nút +/- (GIỮ NGUYÊN) --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.input-group').forEach(function (group) {
        const btnMinus = group.querySelector('.btn-decrease');
        const btnPlus = group.querySelector('.btn-increase');
        const input = group.querySelector('.quantity-product');
        const itemTotalEl = group.closest('.row').querySelector('.item-total-price');

        const updateTotal = () => {
            const quantity = parseInt(input.value) || 1;
            const price = parseFloat(itemTotalEl.dataset.price);
            const total = quantity * price;
            itemTotalEl.textContent = '$' + total.toFixed(2);
            updateSubtotal();
        };

        btnMinus?.addEventListener('click', function () {
            let value = parseInt(input.value) || 1;
            if (value > 1) {
                input.value = value - 1;
                updateTotal();
            }
        });

        btnPlus?.addEventListener('click', function () {
            let value = parseInt(input.value) || 1;
            input.value = value + 1;
            updateTotal();
        });
    });

    function updateSubtotal() {
        let subtotal = 0;
        document.querySelectorAll('.item-total-price').forEach(function (el) {
            const total = parseFloat(el.textContent.replace('$', '')) || 0;
            subtotal += total;
        });
        const subtotalEl = document.getElementById('subtotal-value');
        if (subtotalEl) {
            subtotalEl.textContent = '-$' + subtotal.toFixed(2);
        }

        // Nếu em muốn cập nhật luôn tổng ở dưới cùng:
        const grandTotalEl = document.querySelector('li.border-top strong:last-child');
        if (grandTotalEl) {
            grandTotalEl.textContent = '$' + subtotal.toFixed(2);
        }
    }
    });
    // Chọn màu
    document.querySelectorAll('.color-option').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            const value = this.dataset.value;
            const dropdown = this.closest('.dropdown');
            const btn = dropdown.querySelector('.color-btn');
            const input = dropdown.querySelector('.color-input');
            btn.textContent = value;
            input.value = value;
        });
    });

    // Chọn size
    document.querySelectorAll('.size-option').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            const value = this.dataset.value;
            const dropdown = this.closest('.dropdown');
            const btn = dropdown.querySelector('.size-btn');
            const input = dropdown.querySelector('.size-input');
            btn.textContent = value;
            input.value = value;
        });
    });
</script>
@endpush
