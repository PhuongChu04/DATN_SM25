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
                        <li><a href="account-page.html" class="text-sm link fw-medium my-account-nav-item">Dashboard</a></li>
                        <li><a href="account-orders.html" class="text-sm link fw-medium my-account-nav-item">My Orders</a></li>
                        <li><a href="wish-list.html" class="text-sm link fw-medium my-account-nav-item">My Wishlist</a></li>
                        <li><a href="{{ route('client.addresses.index') }}" class="text-sm link fw-medium my-account-nav-item active">Addresses</a></li>
                        <li><a href="{{ route('client.accountDetail') }}" class="text-sm link fw-medium my-account-nav-item">Account Details</a></li>
                        <li><a href="{{ route('auth.logoutClient') }}" class="text-sm link fw-medium my-account-nav-item" onclick="return confirm('Bạn có muốn đăng xuất không?')">Log Out</a></li>
                    </ul>
                </div>

                <div class="my-acount-content account-dashboard">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>Địa chỉ</h4>
                        <a href="{{ route('client.addresses.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Thêm mới
                        </a>
                    </div>

                    @foreach ($addresses as $address)
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <!-- Hiển thị họ tên và số điện thoại trên hai dòng và làm chúng nhỏ lại -->
                                <p class="card-text">
                                    <strong>Họ tên:</strong>
                                    {{ $address->recipient_name }}
                                </p>
                                <p class="card-text">
                                    <strong>Số điện thoại:</strong>
                                    {{ $address->phone_number }}
                                </p>


                                <!-- Hiển thị địa chỉ trên dòng riêng -->
                                <p class="card-text">
                                    <strong>Địa chỉ:</strong>
                                    {{ $address->detailed_address }}, {{ $address->ward }}, {{ $address->province }}
                                </p>

                                <!-- Hiển thị loại địa chỉ (Home/Office) -->
                                <span class="badge bg-primary">{{ $address->address_type }}</span>
                                @if ($address->is_default)
                                    <span class="badge bg-danger">Mặc định</span>
                                @else
                                    <form action="{{ route('client.addresses.set-default', $address->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Chọn làm mặc định</button>
                                    </form>
                                @endif

                                <div class="mt-3">
                                    <!-- Chỉnh sửa và xóa địa chỉ -->
                                    <a href="{{ route('client.addresses.edit', $address->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('client.addresses.destroy', $address->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this address?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                                    </form>

                                    <!-- ✅ Thêm nút chọn địa chỉ ngay tại đây -->
                                    <form action="{{ route('client.address.select') }}" method="POST" class="d-inline ms-2">
                                        @csrf
                                        <input type="hidden" name="address_id" value="{{ $address->id }}">
                                        <button type="submit" class="btn btn-sm btn-primary">Chọn địa chỉ này</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Pagination --}}


                    @if ($addresses->isEmpty())
                        <div class="alert alert-info">You don't have any saved addresses yet.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
