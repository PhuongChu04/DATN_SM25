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
                            <a href="account-addresses.html"
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
                        <h6 class="display-xs title-form">Account Details</h6>
                        <div class="form-name">
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="firstname" placeholder=" " type="text"
                                    name="firstname" value="{{ old('firstname', $user->first_name ?? '') }}">
                                <label class="tf-field-label" for="firstname">First name</label>
                            </div>
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="lastname" placeholder=" " type="text"
                                    name="lastname" value="{{ old('lastname', $user->last_name ?? '') }}">
                                <label class="tf-field-label" for="lastname">Last name</label>
                            </div>
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="email" placeholder=" " type="email"
                                    name="email" value="{{ old('email', $user->email ?? '') }}">
                                <label class="tf-field-label" for="email">Email</label>
                            </div>
                        </div>
                        <div class="form-pass">
                            <div class="text-lg title-pass">Password Change</div>
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="pass" placeholder=" " type="text"
                                    name="pass">
                                <label class="tf-field-label" for="pass">Current password</label>
                            </div>
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="newpass" placeholder=" " type="password"
                                    name="newpass">
                                <label class="tf-field-label" for="newpass">New password</label>
                            </div>
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="confirm-password" placeholder=" " type="password"
                                    name="confirm-password">
                                <label class="tf-field-label" for="confirm-password">Confirm password</label>
                            </div>
                        </div>
                        <button type="submit" class="tf-btn animate-btn">Save Changes</button>
                    </form>
                    @if ($errors->has('pass'))
                        <div class="alert alert-danger">
                            {{ $errors->first('pass') }}
                        </div>
                    @endif
                    {{-- <form action="">
                        <div class="form-pass">
                            <div class="text-lg title-pass">Password Change</div>
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="pass" placeholder=" " type="text"
                                    name="pass">
                                <label class="tf-field-label" for="pass">Current password</label>
                            </div>
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="newpass" placeholder=" " type="password"
                                    name="newpass">
                                <label class="tf-field-label" for="newpass">New password</label>
                            </div>
                            <div class="tf-field style-2 style-3">
                                <input class="tf-field-input tf-input" id="confirm-password" placeholder=" " type="password"
                                    name="confirm-password">
                                <label class="tf-field-label" for="confirm-password">Confirm password</label>
                            </div>
                        </div>
                        <button type="submit" class="tf-btn animate-btn">Save Changes</button>
                    </form> --}}
                </div>
            </div>
            <!-- /Account -->
        </div>
    </div>
@endsection
