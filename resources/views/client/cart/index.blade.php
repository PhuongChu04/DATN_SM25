



@extends('client.layout.layout')

@section('content')
    <div class="container py-5">
        <div class="row g-5">
            {{-- Phần giỏ hàng bên trái --}}
            <div class="col-lg-8">
                {{-- Tiêu đề các cột --}}
                <div class="row fw-bold border-bottom pb-2 mb-3 d-none d-md-flex">
                    <div class="col-md-5">Sản Phẩm</div>
                    <div class="col-md-2 text-center">Giá</div>
                    <div class="col-md-3 text-center">Số Lượng</div>
                    <div class="col-md-2 text-end">Tổng Tiền</div>
                </div>

                @if($cartItems->isNotEmpty())
                    <form action="{{ route('client.cart.update') }}" method="POST">
                        @csrf
                        @php $subtotal = 0; @endphp
                        @foreach($cartItems as $item)
                            @php
                                $totalItem = $item->variant->price * $item->quantity;
                                $subtotal += $totalItem;
                            @endphp
                            <div class="row align-items-center border-bottom py-3 g-3">
                                {{-- Cột sản phẩm --}}
                                <div class="col-12 col-md-5">
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('client.detailProduct', $item->variant->product->id) }}">
                                            <img src="{{ asset('storage/' . $item->variant->product->image_primary) }}"
                                                alt="{{ $item->variant->product->name }}"
                                                style="width: 90px; height: 110px; object-fit: cover;" class="rounded">
                                        </a>
                                        <div class="ms-3">
                                            <a href="{{ route('client.detailProduct', $item->variant->product->id) }}"
                                                class="text-dark text-decoration-none fw-bold">{{ $item->variant->product->name }}</a>
                                            <div class="mt-2">
                                                <span class="text-muted">Màu: {{ $item->variant->color->name ?? 'N/A' }}</span><br>
                                                <span class="text-muted">Size: {{ $item->variant->size->name ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Cột giá --}}
                                <div class="col-6 col-md-2 text-md-center">
                                    <span class="d-md-none">Giá: </span>
                                    <span class="fw-medium">{{ number_format($item->variant->price, 0, ',', '.') }} ₫</span>
                                </div>

                                {{-- Cột số lượng --}}
                                <div class="col-6 col-md-3">
                                    <div class="input-group justify-content-center"
                                        style="max-width: 130px; margin-left: auto; margin-right: auto;">
                                        <button class="btn btn-outline-secondary btn-decrease" type="button">-</button>
                                        <input type="number" min="1" class="form-control text-center quantity-product"
                                            name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}">
                                        <button class="btn btn-outline-secondary btn-increase" type="button">+</button>
                                    </div>
                                </div>

                                {{-- Cột tổng tiền và nút xóa --}}
                                <div class="col-12 col-md-2 text-end">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <span class="fw-medium me-3 item-total-price"
                                            data-price="{{ $item->variant->price }}">{{ number_format($totalItem, 0, ',', '.') }}
                                            ₫</span>
                                        <a href="{{ route('client.cart.remove', $item->id) }}" class="text-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')"
                                            title="Xóa sản phẩm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                                class="bi bi-x-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Nút Update Cart --}}
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-dark">Cập Nhật Giỏ Hàng</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-info">Giỏ hàng của bạn đang trống.</div>
                @endif
            </div>

            {{-- Sidebar Order Summary --}}
            <div class="col-lg-4">
                <div class="card border-0" style="background-color: #f8f9fa;">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4">Tóm Tắt Đơn Hàng</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                                Tạm Tính<span id="subtotal-value">{{ number_format($subtotal ?? 0, 0, ',', '.') }} ₫</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                                Giảm Giá<span id="discount-value">0 ₫</span>
                            </li>
                            <li class="list-group-item px-0 bg-transparent">
                                <p class="mb-2">Vận Chuyển</p>
                                <div class="form-check d-flex justify-content-between">
                                    <div><input class="form-check-input" type="radio" name="shipping" id="free" checked>
                                        <label class="form-check-label ms-2" for="free">Miễn Phí Vận Chuyển</label>
                                    </div>
                                    <span>0 ₫</span>
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div><input class="form-check-input" type="radio" name="shipping" id="local">
                                        <label class="form-check-label ms-2" for="local">Vận Chuyển Nội Địa</label>
                                    </div>
                                    <span>35,000 ₫</span>
                                </div>
                            </li>
                            <li class="mt4">
                                <!-- Nút mở modal -->
                                <button type="button" class="btn btn-voucher w-100 py-2 fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#voucherModal">
                                    🎟 Chọn mã giảm giá
                                </button>

                                <!-- Input hiển thị mã đã chọn -->
                                <input type="text" id="selectedVoucher" name="voucher_code" class="form-control mt-2"
                                    placeholder="Chưa chọn mã" readonly>

                                <!-- Modal -->
                                <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="voucherModalLabel">Chọn mã giảm giá</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Đóng"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table voucher-table align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>Tên</th>
                                                            <th>Mã</th>
                                                            <th>Giảm</th>
                                                            <th>Hạn dùng</th>
                                                            <th class="text-center">Chọn</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($vouchers as $voucher)
                                                            <tr>
                                                                <td class="fw-semibold text-dark">{{ $voucher->name }}</td>
                                                                <td><span class="voucher-code">{{ $voucher->code }}</span></td>
                                                                <td>
                                                                    @if($voucher->type == 0)
                                                                        <span class="badge rounded-pill bg-light text-dark border">Miễn phí ship</span>
                                                                    @elseif($voucher->type == 1)
                                                                        <span class="badge rounded-pill bg-light text-dark border">{{ $voucher->discount_amount }}%</span>
                                                                    @else
                                                                        <span class="badge rounded-pill bg-light text-dark border">{{ number_format($voucher->discount_amount) }} đ</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-muted">{{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}</td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn btn-voucher-select"
                                                                    data-code="{{ $voucher->code }}"
                                                                    data-type="{{ $voucher->type }}"
                                                                    data-amount="{{ $voucher->discount_amount }}"
                                                                    data-max="{{ $voucher->max_discount_value }}"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bi bi-ticket-perforated me-1"></i> Chọn
                                                                </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent border-top pt-3">
                                <strong class="h5">Tổng Cộng</strong>
                                <strong class="h5" id="total-value" data-subtotal="{{ $subtotal ?? 0 }}">
                                    {{ number_format($subtotal ?? 0, 0, ',', '.') }} ₫
                                </strong>
                            </li>
                            
                            <!-- Hidden input lưu giá trị giảm giá & tổng cuối -->
                            <input type="hidden" name="discount" id="discount-input" value="0">
                            <input type="hidden" name="final_price" id="final-price-input" value="{{ $subtotal ?? 0 }}">
                        </ul>

                        <a href="{{ route('checkout.form') }}" class="btn btn-dark btn-lg w-100 mt-4">Thanh toán</a>
                        <a href="{{ route('client.homeClient')}}" class="btn btn-outline-dark w-100">Hoặc tiếp tục mua
                            sắm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<style>
    /* Nút chọn voucher chính */
    .btn-voucher {
        background: linear-gradient(135deg, #6f42c1, #d63384);
        color: #fff;
        border: none;
        transition: 0.3s;
        border-radius: 12px;
    }
    .btn-voucher:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    /* Input hiển thị voucher đã chọn */
    #selectedVoucher {
        font-weight: 600;
        text-align: center;
        color: #495057;
        border-radius: 10px;
    }
    #selectedVoucher.voucher-applied {
        border: 2px solid #6f42c1;
        background: #f8f5ff;
        color: #6f42c1;
    }

    /* Bảng voucher */
    .voucher-table {
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .voucher-table thead {
        background: #f8f9fa;
    }
    .voucher-table th {
        font-weight: 600;
        text-align: center;
    }
    .voucher-table td {
        vertical-align: middle;
        text-align: center;
    }

    /* Badge mã */
    .voucher-code {
        display: inline-block;
        padding: 4px 10px;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: 6px;
        background: #e9ecef;
        color: #212529;
    }

    /* Nút trong bảng voucher */
    .btn-voucher-select {
        background: #20c997;
        color: #fff;
        border: none;
        padding: 6px 14px;
        font-size: 0.9rem;
        border-radius: 8px;
        transition: 0.2s;
    }
    .btn-voucher-select:hover {
        background: #17a085;
        transform: scale(1.05);
    }

    /* Discount hiển thị */
    #discount-value {
        font-weight: 600;
        color: #d63384;
    }

    /* Tổng cộng */
    #total-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: #212529;
    }
</style>


@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Khi chọn voucher
    document.querySelectorAll(".btn-voucher-select").forEach(btn => {
        btn.addEventListener("click", function () {
            let code = this.dataset.code;
            let type = parseInt(this.dataset.type);
            let amount = parseFloat(this.dataset.amount);
            let maxDiscount = parseFloat(this.dataset.max);

            // Hiện mã vào input
            let selectedVoucher = document.getElementById("selectedVoucher");
            selectedVoucher.value = code;
            selectedVoucher.classList.add("voucher-applied");

            // Lấy subtotal
            let subtotalEl = document.getElementById("subtotal-value");
            let totalEl = document.getElementById("total-value");
            let discountEl = document.getElementById("discount-value");

            let subtotal = parseInt(totalEl.dataset.subtotal);

            let discount = 0;
            if (type === 0) {
                // miễn phí ship => giảm 35k (hoặc đúng phí ship của mày)
                discount = 35000;
            } else if (type === 1) {
                // giảm %
                discount = subtotal * (amount / 100);
                if (maxDiscount > 0) discount = Math.min(discount, maxDiscount);
            } else {
                // giảm tiền cố định
                discount = amount;
            }

            let finalPrice = subtotal - discount;
            if (finalPrice < 0) finalPrice = 0;

            // Update hiển thị
            discountEl.textContent = new Intl.NumberFormat('vi-VN').format(discount) + " ₫";
            totalEl.textContent = new Intl.NumberFormat('vi-VN').format(finalPrice) + " ₫";

            // Update input hidden
            document.getElementById("discount-input").value = discount;
            document.getElementById("final-price-input").value = finalPrice;
        });
    });
});
</script>
@endpush




