@extends('client.layout.layout')

@section('content')

    <div class="flat-spacing-13">
        <div class="container-7">
            <div class="btn-sidebar-mb d-lg-none">
                <button data-bs-toggle="offcanvas" data-bs-target="#mbAccount">
                    <i class="icon icon-sidebar"></i>
                </button>
            </div>

            <div class="main-content-account">
                <div class="sidebar-account-wrap sidebar-content-wrap sticky-top d-lg-block d-none">
                    <ul class="my-account-nav">
                        <li><a href="{{ route('client.account') }}" class="text-sm link fw-medium my-account-nav-item">Dashboard</a></li>
                        <li><a href="{{ route('client.orders.index') }}" class="text-sm link fw-medium my-account-nav-item active">My Orders</a></li>
                        <li><a href="#" class="text-sm link fw-medium my-account-nav-item">My Wishlist</a></li>
                        <li><a href="{{ route('client.addresses.index') }}" class="text-sm link fw-medium my-account-nav-item">Addresses</a></li>
                        <li><a href="{{ route('client.accountDetail') }}" class="text-sm link fw-medium my-account-nav-item">Account Details</a></li>
                        <li><a href="{{ route('auth.logoutClient') }}" class="text-sm link fw-medium my-account-nav-item" onclick="return confirm('Bạn có muốn đăng xuất không?')">Log Out</a></li>
                    </ul>
                </div>

                <div class="my-acount-content account-dashboard">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>Danh Sách Đơn Hàng</h4>
                    </div>

                    <!-- Form tìm kiếm -->
                    <form method="GET" action="{{ route('client.orders.index') }}" class="search-form">
                        <!-- Tìm kiếm theo mã đơn hàng -->
                        <input type="text" name="order_code" class="form-control search-input" placeholder="Mã đơn hàng" value="{{ request('order_code') }}">

                        <!-- Tìm kiếm theo trạng thái đơn hàng -->
                        <select name="order_status" class="form-control search-select">
                            <option value="">Trạng thái</option>
                            <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>Đang chờ</option>
                            <option value="processing" {{ request('order_status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="completed" {{ request('order_status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="cancelled" {{ request('order_status') == 'cancelled' ? 'selected' : '' }}>Đã huỷ</option>
                            <option value="waiting_for_cancellation" {{ request('order_status') == 'waiting_for_cancellation' ? 'selected' : '' }}>Chờ xác nhận huỷ</option>
                        </select>

                        <!-- Tìm kiếm theo tên sản phẩm -->
                        <input type="text" name="product_name" class="form-control search-input" placeholder="Tên sản phẩm" value="{{ request('product_name') }}">

                        <!-- Tìm kiếm theo phương thức thanh toán -->
                        <select name="payment_method" class="form-control search-select">
                            <option value="">Phương thức thanh toán</option>
                            <option value="vnpay" {{ request('payment_method') == 'vnpay' ? 'selected' : '' }}>VNPay</option>
                            <option value="cod" {{ request('payment_method') == 'cod' ? 'selected' : '' }}>Thanh toán khi nhận hàng (COD)</option>
                        </select>

                        <button type="submit" class="btn btn-primary search-btn">Tìm kiếm</button>
                    </form>

                    @foreach ($orders as $order)
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <!-- Đoạn tiêu đề đơn hàng -->
                                <div class="mt-2">
                                    <strong>Trạng thái:</strong>
                                    <span class="
                                        @if ($order->order_status == 'pending') text-warning
                                        @elseif ($order->order_status == 'processing') text-primary
                                        @elseif ($order->order_status == 'cancelled') text-danger
                                        @elseif ($order->order_status == 'completed') text-success
                                        @else text-muted
                                        @endif
                                    ">
                                        @if ($order->order_status == 'pending')
                                            Đang chờ
                                        @elseif ($order->order_status == 'processing')
                                            Đang xử lý
                                        @elseif ($order->order_status == 'cancelled')
                                            Đã huỷ
                                        @elseif ($order->order_status == 'completed')
                                            Đã hoàn thành
                                        @elseif ($order->order_status == 'waiting_for_cancellation')
                                            Chờ xác nhận huỷ
                                        @else
                                            Chưa xác định
                                        @endif
                                    </span>
                                </div>

                                <!-- Hiển thị các sản phẩm trong đơn hàng -->
                                @foreach ($order->details as $detail)
                                    <div class="row mt-3">
                                        <div class="col-3">
                                            <img src="{{ asset('storage/'.$detail->product->image_primary) }}" alt="{{ $detail->product_name }}" class="img-fluid" style="max-width: 80px; height: auto;">
                                        </div>
                                        <div class="col-9">
                                            <p><strong>{{ $detail->product_name }}</strong></p>
                                            <p>Phương thức thanh toán:
                                                @if ($order->payment_method == 'vnpay')
                                                    VNPay
                                                @elseif ($order->payment_method == 'cod')
                                                    Thanh toán khi nhận hàng (COD)
                                                @else
                                                    Không xác định
                                                @endif
                                            </p>
                                            <p>Phân loại: {{ $detail->variant ? $detail->variant->size->name : 'Không có' }} / {{ $detail->variant ? $detail->variant->color->name : 'Không có' }}</p>
                                            <p>Số lượng: {{ $detail->quantity }}</p>
                                            <p>Đơn giá: {{ number_format($detail->unit_price, 0, ',', '.') }} VND</p>
                                            <p><strong>Tổng: {{ number_format($detail->total, 0, ',', '.') }} VND</strong></p>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="mt-3">
                                    <a href="{{ route('client.orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem chi tiết</a>
                                    @if(in_array($order->order_status, ['pending', 'processing']))
                                        <form action="{{ route('client.orders.cancel', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn huỷ đơn hàng này?')">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Huỷ đơn</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Phân trang -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links() }} <!-- Hiển thị liên kết phân trang -->
                    </div>

                    @if ($orders->isEmpty())
                        <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Thanh tìm kiếm */
        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px;
            width: 100%;
        }

        .search-input, .search-select, .search-btn {
            width: 100%;  /* Đảm bảo tất cả các phần tử có chiều rộng đầy đủ */
            padding: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;  /* Khoảng cách giữa các phần tử */
        }

        .search-btn {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .search-btn:hover {
            background-color: #0056b3;
        }

        .search-input, .search-select {
            flex: 1;  /* Đảm bảo các input và select chiếm cùng một không gian */
        }

        .search-btn {
            flex: none;
            width: auto;  /* Điều chỉnh lại kích cỡ của button */
        }
    </style>

@endsection
