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
                <h4 class="fw-bold mb-4">Edit Address</h4>

                <form method="POST" action="{{ route('client.addresses.update', $address->id) }}">
                    @csrf
                    @method('PUT')

                    <input type="text" name="recipient_name" class="form-control mb-2" value="{{ old('recipient_name', $address->recipient_name) }}" required>
                    <input type="text" name="phone_number" class="form-control mb-2" value="{{ old('phone_number', $address->phone_number) }}" required>
                    <input type="text" name="province" class="form-control mb-2" value="{{ old('province', $address->province) }}" required>
                    <input type="text" name="district" class="form-control mb-2" value="{{ old('district', $address->district) }}" required>
                    <input type="text" name="ward" class="form-control mb-2" value="{{ old('ward', $address->ward) }}" required>
                    <textarea name="detailed_address" class="form-control mb-2" required>{{ old('detailed_address', $address->detailed_address) }}</textarea>

                    <select name="address_type" class="form-control mb-2">
                        <option value="Home" {{ $address->address_type == 'Home' ? 'selected' : '' }}>Home</option>
                        <option value="Office" {{ $address->address_type == 'Office' ? 'selected' : '' }}>Office</option>
                        <option value="Other" {{ $address->address_type == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_default" value="1" {{ $address->is_default ? 'checked' : '' }} id="defaultEdit">
                        <label class="form-check-label" for="defaultEdit">Set as default</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Address</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
