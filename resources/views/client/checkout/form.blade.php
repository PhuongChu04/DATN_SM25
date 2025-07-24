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
                value="{{ old('name', ($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Số điện thoại *</label>
            <input type="text" name="phone" class="form-control" required
                value="{{ old('phone', $defaultAddress->phone_number ?? '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Email (tùy chọn)</label>
            <input type="email" name="email" class="form-control"
                value="{{ old('email', $user->email ?? '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Địa chỉ *</label>
            <input type="text" name="address" class="form-control" required
    value="{{ old('address', isset($defaultAddress) ? $defaultAddress->detailed_address . ', ' . $defaultAddress->ward . ', ' . $defaultAddress->district . ', ' . $defaultAddress->province : '') }}">

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
                                // Lấy tên, hình ảnh, giá và số lượng của sản phẩm
                                $name = is_array($item) ? $item['name'] : $item->variant->product->name;
                                $image = is_array($item) ? $item['image'] : $item->variant->product->image_primary;
                                $price = is_array($item) ? $item['price'] : $item->variant->price;
                                $quantity = is_array($item) ? $item['quantity'] : $item->quantity;
                                $lineTotal = $price * $quantity;
                                $total += $lineTotal;

                                // Lấy màu sắc và kích thước của sản phẩm
                                $color = is_array($item) ? $item['color'] : $item->variant->color->name;
                                $size = is_array($item) ? $item['size'] : $item->variant->size->name;
                            @endphp

                            <div class="d-flex mb-3">
                                <img src="{{ asset('storage/' . $image) }}"
                                    style="width: 60px; height: 60px; object-fit: cover;"
                                    class="rounded me-3 border">
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ $name }}</div>
                                    <div class="small text-muted">Color: {{ $color }}</div> <!-- Hiển thị màu -->
                                    <div class="small text-muted">Size: {{ $size }}</div> <!-- Hiển thị size -->
                                    <div class="small">x{{ $quantity }}</div>
                                </div>
                                <div class="fw-bold text-danger text-end">
                                    {{ number_format($lineTotal, 0) }} VNĐ
                                </div>
                            </div>
                        @endforeach


                            <hr>

                            <div class="d-flex justify-content-between fw-bold mb-2">
                                <span>Tổng tiền hàng</span>
                                <span>{{ number_format($total, 0) }}VNĐ</span>
                            </div>

                            <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                                <span>Thanh toán</span>
                                <span>{{ number_format($total, 0) }}VNĐ</span>
                            </div>

                            {{-- Hidden field để lưu tổng --}}
                            <input type="hidden" name="total_amount" value="{{ $total }}">

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
@endsection
