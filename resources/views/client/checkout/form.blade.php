@extends('client.layout.layout')

@section('content')
<div class="container py-5">
    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row g-5">
            {{-- Cột trái: Thông tin nhận hàng --}}
            <div class="col-lg-8">
                <h2 class="mb-4">Thông tin nhận hàng</h2>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Họ và tên *</label>
                        <input type="text" name="name" class="form-control" required
                            value="{{ old('name', ($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Số điện thoại *</label>
                        <input type="text" name="phone" class="form-control" required
                            value="{{ old('phone', $defaultAddress->phone_number ?? '') }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email (tùy chọn)</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $user->email ?? '') }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Địa chỉ *</label>
                        <input type="text" name="address" class="form-control" required
                            value="{{ old('address', isset($defaultAddress) ? $defaultAddress->detailed_address . ', ' .
                            ($defaultAddress->ward ? $defaultAddress->ward . ', ' : '') .
                            ($defaultAddress->district ? $defaultAddress->district . ', ' : '') .
                            $defaultAddress->province : '') }}" readonly>
                    </div>
                </div>

                <button type="button" id="changeAddressButton" class="btn btn-outline-primary w-100 mt-3">
                    Thay đổi địa chỉ
                </button>

                {{-- Modal thay đổi địa chỉ --}}
                <div id="addressModal" class="modal" tabindex="-1" style="display:none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Chọn Địa Chỉ</h5>
                                <button type="button" class="btn-close" id="closeModalButton"></button>
                            </div>
                            <div class="modal-body">
                                <div class="list-group">
                                    @foreach ($addresses as $address)
                                        <button type="button" class="list-group-item list-group-item-action"
                                                data-address="{{ $address->recipient_name . ' - ' . $address->phone_number . ' - ' . $address->detailed_address . ' - ' . $address->ward . ' - ' . $address->district . ' - ' . $address->province }}">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <strong>{{ $address->recipient_name }}</strong>
                                                    <br>
                                                    {{ $address->phone_number }}
                                                    <br>
                                                    {{ $address->detailed_address }}, {{ $address->ward ? $address->ward . ', ' : '' }} {{ $address->district ? $address->district . ', ' : '' }} {{ $address->province }}
                                                </div>
                                                <div class="text-end">
                                                    @if($address->is_default)
                                                        <span class="badge bg-primary">Mặc định</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </button>
                                    @endforeach

                                    <button type="button" class="list-group-item list-group-item-action" onclick="window.location.href='{{ route('client.addresses.create') }}'">
                                        Thêm địa chỉ mới
                                    </button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="closeModalButtonFooter">Hủy</button>
                                <button type="button" class="btn btn-primary" id="selectAddressButton">Chọn</button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">
            </div>

            {{-- Cột phải: Tóm tắt đơn hàng --}}
            <div class="col-lg-4">
                <div class="card border">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4 text-center">TÓM TẮT ĐƠN HÀNG</h4>

                        @php $total = 0; @endphp
                        @foreach ($cartItems as $item)
                            @php
                                $name = is_array($item) ? $item['name'] : $item->variant->product->name;
                                $image = is_array($item) ? $item['image'] : $item->variant->product->image_primary;
                                $price = is_array($item) ? $item['price'] : $item->variant->price;
                                $quantity = is_array($item) ? $item['quantity'] : $item->quantity;
                                $lineTotal = $price * $quantity;
                                $total += $lineTotal;
                            @endphp

                            <div class="d-flex mb-3">
                                <img src="{{ asset('storage/' . $image) }}"
                                     style="width: 60px; height: 60px; object-fit: cover;"
                                     class="rounded me-3 border">
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ $name }}</div>
                                    <div class="small">x{{ $quantity }}</div>
                                </div>
                                <div class="fw-bold text-danger text-end">
                                    {{ number_format($lineTotal, 0) }} VNĐ
                                </div>
                            </div>
                        @endforeach

                        <hr>

                        {{-- Tổng tiền hàng --}}
                        <div class="d-flex justify-content-between fw-bold mb-2">
                            <span>Tổng tiền hàng</span>
                            <span>{{ number_format($total, 0) }} VNĐ</span>
                        </div>

                        {{-- Phí vận chuyển --}}
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển ({{ $shipping->provider_name ?? '---' }})</span>
                            <span>{{ number_format($shipping->price ?? 0, 0, ',', '.') }} ₫</span>
                        </div>

                        {{-- Tổng thanh toán --}}
                        <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                            <span>Thanh toán</span>
                            <span>{{ number_format($total + ($shipping->price ?? 0), 0, ',', '.') }} ₫</span>
                        </div>

                        {{-- Hidden field để gửi dữ liệu sang controller --}}
                        <input type="hidden" name="shipping_id" value="{{ $shipping->id ?? '' }}">
                        <input type="hidden" name="total_amount" value="{{ $total + ($shipping->price ?? 0) }}">

                        {{-- Nút thanh toán --}}
                        <button type="submit" name="payment_method" value="vnpay" class="btn btn-dark btn-lg w-100 mb-2">
                            Thanh Toán Bằng VNPay
                        </button>
                        <button type="submit" name="payment_method" value="cod" class="btn btn-outline-dark btn-lg w-100">
                            Thanh Toán Bằng Tiền Mặt
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Hiển thị modal thay đổi địa chỉ
document.getElementById('changeAddressButton').addEventListener('click', function() {
    document.getElementById('addressModal').style.display = 'block';
});

// Khi chọn một địa chỉ
document.querySelectorAll('.list-group-item').forEach(item => {
    item.addEventListener('click', function() {
        // Gỡ bỏ màu xanh cho tất cả các địa chỉ
        document.querySelectorAll('.list-group-item').forEach(button => button.classList.remove('active'));
        // Thêm màu xanh cho địa chỉ đã chọn
        this.classList.add('active');
    });
});

// Khi nhấn nút chọn
document.getElementById('selectAddressButton').addEventListener('click', function() {
    const selectedAddress = document.querySelector('.list-group-item.active').getAttribute('data-address');
    const addressDetails = selectedAddress.split(' - ');  // Tách các phần của địa chỉ

    // Kiểm tra và loại bỏ dấu phẩy thừa
    let address = addressDetails[2]; // Start with detailed address
    if (addressDetails[3]) {
        address += ', ' + addressDetails[3]; // Add ward if present
    }
    if (addressDetails[4]) {
        address += ', ' + addressDetails[4]; // Add district if present
    }
    if (addressDetails[5]) {
        address += ', ' + addressDetails[5]; // Add province if present
    }

    // Gán dữ liệu vào form
    document.querySelector('input[name="name"]').value = addressDetails[0]; // Họ tên
    document.querySelector('input[name="phone"]').value = addressDetails[1]; // Số điện thoại
    document.querySelector('input[name="address"]').value = address; // Địa chỉ đầy đủ

    // Đóng modal
    document.getElementById('addressModal').style.display = 'none';
});

// Đóng modal khi nhấn nút "Hủy" hoặc "X"
document.querySelector('#closeModalButton').addEventListener('click', function() {
    document.getElementById('addressModal').style.display = 'none';
});

document.querySelector('#closeModalButtonFooter').addEventListener('click', function() {
    document.getElementById('addressModal').style.display = 'none';
});
</script>

{{-- CSS để tạo kiểu cho modal --}}
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1050;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-dialog {
        margin: 100px auto;
        width: 400px;
    }

    .list-group-item.active {
        background-color: #007bff;
        color: white;
    }

    .list-group-item {
        padding: 10px 20px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        border-radius: 10px;
        background-color: #fff;
        transition: all 0.3s ease-in-out;
    }

    .list-group-item:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    .list-group-item-action {
        padding: 15px;
    }

    .modal-header {
        background-color: #f8f9fa;
    }

    .modal-footer {
        text-align: center;
    }

    .modal-body {
        max-height: 350px;
        overflow-y: auto;
    }

    .badge.bg-primary {
        font-size: 0.8rem;
        background-color: #0d6efd;
        color: white;
        border-radius: 5px;
        padding: 5px 10px;
    }
</style>

@endsection
