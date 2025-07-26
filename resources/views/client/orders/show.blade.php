@extends('client.layout.layout')

@section('content')

<div class="flat-spacing-13">
    <div class="container-7">
        <div class="main-content-account">
            <div class="my-acount-content account-dashboard">
                <div class="card mb-4 p-3">
                    <h5><strong>Đơn hàng:</strong> {{ $order->order_code }}</h5>
                    <p class="mb-1">Ngày tạo: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary">
                            {{ $order->payment_method === 'cod' ? 'Thanh toán khi nhận hàng' : ucfirst($order->payment_method) }}
                        </span>

                        @php
                            $statusLabels = [
                                'pending' => 'Chờ xử lý',
                                'processing' => 'Đang xử lý',
                                'shipping' => 'Đang giao hàng',
                                'delivered' => 'Đã giao',
                                'canceled' => 'Đã hủy',
                                'refund' => 'Đã hoàn tiền',
                            ];
                        @endphp

                        <span class="badge bg-warning">
                            {{ $statusLabels[$order->order_status] ?? ucfirst($order->order_status) }}
                        </span>
                    </div>
                </div>

                <div class="row g-4">
                    {{-- Danh sách sản phẩm --}}
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-header fw-bold">Sản phẩm</div>
                            <div class="card-body">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->details as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <img src="{{ asset('storage/' . $item->variant->product->image_primary) }}"
                                                         alt="{{ $item->variant->product->name }}" class="rounded" style="width:50px;height:50px;object-fit:cover">
                                                    <div>
                                                        <div class="fw-bold">{{ $item->variant->product->name }}</div>
                                                        <small class="text-muted">Size: {{ $item->variant->size->name }}</small>
                                                        <small class="text-muted">Color: {{ $item->variant->color->name }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->unit_price, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ number_format($item->total, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Tổng tiền --}}
                        <div class="card mt-3 shadow-sm">
                            <div class="card-body">
                                @php
                                    $subtotal = $order->details->sum(fn($d) => (int)$d->total);
                                    $discount = (int) ($order->discount ?? 0);
                                    $shippingFee = (int) ($order->shipping_fee ?? 0);
                                    $grandTotal = $subtotal - $discount + $shippingFee;
                                @endphp
                                <p><strong>Tổng tiền hàng:</strong> {{ number_format($subtotal, 0, ',', '.') }} VNĐ</p>
                                <p><strong>Phí vận chuyển:</strong> {{ number_format($shippingFee, 0, ',', '.') }} VNĐ</p>
                                <p><strong>Giảm giá:</strong> {{ number_format($discount, 0, ',', '.') }} VNĐ</p>
                                <h5 class="mt-3 text-primary fw-bold">Tổng thanh toán: {{ number_format($grandTotal, 0, ',', '.') }} VNĐ</h5>
                            </div>
                        </div>
                    </div>

                    {{-- Thông tin khách hàng --}}
                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-3">
                            <div class="card-header fw-bold">Thông tin khách hàng</div>
                            <div class="card-body">
                                <p><strong>Tên khách hàng:</strong> {{ $order->name }}</p>
                                <p><strong>Email:</strong> {{ $order->email }}</p>
                                <p><strong>SĐT:</strong> {{ $order->phone }}</p>
                                <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-3">
                            <div class="card-header fw-bold">Lý do huỷ đơn</div>
                            <div class="card-body">
                                <span class="badge bg-secondary">
                                    {{ $order->cancel_reason ?? 'Không có lý do huỷ đơn' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
