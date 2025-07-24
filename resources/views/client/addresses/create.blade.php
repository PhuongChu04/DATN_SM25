@extends('client.layout.layout')

@section('content')
<div class="flat-spacing-13">
    <div class="container-7">
        <div class="main-content-account">
            <!-- Sidebar -->
            <div class="sidebar-account-wrap sidebar-content-wrap sticky-top d-lg-block d-none">
                <ul class="my-account-nav">
                    <li><a href="#" class="text-sm link fw-medium my-account-nav-item">Dashboard</a></li>
                    <li><a href="#" class="text-sm link fw-medium my-account-nav-item">My Orders</a></li>
                    <li><a href="#" class="text-sm link fw-medium my-account-nav-item">My Wishlist</a></li>
                    <li><a href="{{ route('client.addresses.index') }}" class="text-sm link fw-medium my-account-nav-item active">Addresses</a></li>
                    <li><a href="{{ route('client.accountDetail') }}" class="text-sm link fw-medium my-account-nav-item">Account Details</a></li>
                    <li><a href="{{ route('auth.logoutClient') }}" class="text-sm link fw-medium my-account-nav-item" onclick="return confirm('Bạn có muốn đăng xuất không?')">Log Out</a></li>
                </ul>
            </div>

            <!-- Content -->
            <div class="my-acount-content account-dashboard">
                <h4 class="fw-bold mb-4">Add New Address</h4>

                <form method="POST" action="{{ route('client.addresses.store') }}">
                    @csrf

                    <input type="text" name="recipient_name" class="form-control mb-2" placeholder="Recipient Name" required>
                    <input type="text" name="phone_number" class="form-control mb-2" placeholder="Phone Number" required>
                    <input type="text" name="province" class="form-control mb-2" placeholder="Province" required>
                    <input type="text" name="district" class="form-control mb-2" placeholder="District" required>
                    <input type="text" name="ward" class="form-control mb-2" placeholder="Ward" required>
                    <textarea name="detailed_address" class="form-control mb-2" placeholder="Street, house number..." required></textarea>

                    <select name="address_type" class="form-control mb-2">
                        <option value="Home">Home</option>
                        <option value="Office">Office</option>
                        <option value="Other">Other</option>
                    </select>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_default" value="1" id="defaultAddress">
                        <label class="form-check-label" for="defaultAddress">Set as default</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Address</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
