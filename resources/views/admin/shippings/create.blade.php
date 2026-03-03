@extends('admin.layouts.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Thêm đơn vị vận chuyển</h2>

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

    {{-- Form tạo đơn vị vận chuyển --}}
    <form method="POST" action="{{ route('admin.shippings.store') }}">
        @csrf

        <div class="mb-3">
            <label for="provider_name" class="form-label">Tên đơn vị vận chuyển</label>
            <input type="text" name="provider_name" id="provider_name"
                   class="form-control @error('provider_name') is-invalid @enderror"
                   value="{{ old('provider_name') }}" required>
            @error('provider_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Thêm trường giá vận chuyển --}}
        <div class="mb-3">
            <label for="price" class="form-label">Giá vận chuyển</label>
            <input type="number" step="0.01" name="price" id="price"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price') }}" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tạo mới</button>
        <a href="{{ route('admin.shippings.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
