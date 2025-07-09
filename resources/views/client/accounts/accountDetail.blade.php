@extends('client.layout.layout')

@section('content')
    <div class="flat-spacing-13">
        <div class="container-7">
            <!-- sidebar-account -->
            <div class="btn-sidebar-mb d-lg-none">
                <button data-bs-toggle="offcanvas" data-bs-target="#mbAccount">
                    <i class="icon icon-sidebar"></i>
                </button>
            </div>
            <!-- /sidebar-account -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Section-acount -->
            <div class="main-content-account">
                <div class="sidebar-account-wrap sidebar-content-wrap sticky-top d-lg-block d-none">
                    <ul class="my-account-nav">
                        <li>
                            <a href="account-page.html"
                                class="text-sm link fw-medium my-account-nav-item active">Dashboard</a>
                        </li>
                        <li>
                            <a href="account-orders.html" class="text-sm link fw-medium my-account-nav-item">My
                                Orders</a>
                        </li>
                        <li>
                            <a href="wish-list.html" class="text-sm link fw-medium my-account-nav-item">My
                                Wishlist</a>
                        </li>
                        <li>
                            <a href="{{ route('client.addresses.index') }}"
                                class="text-sm link fw-medium my-account-nav-item">Addresses</a>
                        </li>
                        <li>
                            <a href="{{ route('client.accountDetail') }}"
                                class="text-sm link fw-medium my-account-nav-item">Account Details</a>
                        </li>
                        <li>
                            <a href="{{ route('auth.logoutClient') }}" class="text-sm link fw-medium my-account-nav-item"
                                onclick="return(confirm('Bạn có muốn đăng xuất không'))">Log
                                Out</a>
                        </li>
                    </ul>
                </div>
                <div class="my-acount-content account-dashboard">
                    <form action="{{ route('client.updateAccountDetail') }}" class="form-edit-account" method="POST">
                        @csrf
                        <h6 class="display-xs title-form">Thông tin tài khoản</h6>
                        <div class="form-name">
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="first_name" placeholder=" " type="text"
                                    name="first_name" value="{{ old('first_name', $user->first_name ?? '') }}">
                                <label class="tf-field-label" for="first_name">Họ</label>
                                @error('first_name')
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="last_name" placeholder=" " type="text"
                                    name="last_name" value="{{ old('last_name', $user->last_name ?? '') }}">
                                <label class="tf-field-label" for="last_name">Tên</label>
                                @error('last_name')
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="email" placeholder=" " type="email"
                                    name="email" value="{{ old('email', $user->email ?? '') }}">
                                <label class="tf-field-label" for="email">Email</label>
                                @error('email')
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-pass">
                            <div class="text-lg title-pass">Thay đổi mật khẩu</div>
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="password" placeholder=" " type="password"
                                    name="password">
                                <label class="tf-field-label" for="password">Mật khẩu hiện tại</label>
                                @error('password')
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="newPassword" placeholder=" " type="password"
                                    name="newPassword">
                                <label class="tf-field-label" for="newPassword">Mật khẩu mới</label>
                                @error('newPassword')
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="newPassword_confirmation" placeholder=" "
                                    type="password" name="newPassword_confirmation">
                                <label class="tf-field-label" for="newPassword_confirmation">Xác nhận mật khẩu</label>
                                @error('newPassword')
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="tf-btn animate-btn">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
            <!-- /Account -->
        </div>
    </div>
@endsection