@extends('admin.layouts.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Sửa bảng giá vận chuyển</h2>

    {{-- Hiển thị lỗi nếu có --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.shipping-rates.update', $shippingRate) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="shipping_id" class="form-label">Đơn vị vận chuyển</label>
            <select name="shipping_id" id="shipping_id" class="form-select" required>
                @foreach($shippings as $ship)
                    <option value="{{ $ship->id }}" {{ old('shipping_id', $shippingRate->shipping_id) == $ship->id ? 'selected' : '' }}>
                        {{ $ship->provider_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="min_km" class="form-label">Từ (km)</label>
            <input type="number" name="min_km" id="min_km"
                   class="form-control @error('min_km') is-invalid @enderror"
                   value="{{ old('min_km', $shippingRate->min_km) }}" required>
            @error('min_km')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="max_km" class="form-label">Đến (km)</label>
            <input type="number" name="max_km" id="max_km"
                   class="form-control @error('max_km') is-invalid @enderror"
                   value="{{ old('max_km', $shippingRate->max_km) }}" required>
            @error('max_km')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fee" class="form-label">Phí vận chuyển (VNĐ)</label>
            <input type="number" step="0.01" name="fee" id="fee"
                   class="form-control @error('fee') is-invalid @enderror"
                   value="{{ old('fee', $shippingRate->fee) }}" required>
            @error('fee')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.shipping-rates.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
