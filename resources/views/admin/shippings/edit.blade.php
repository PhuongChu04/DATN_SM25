@extends('admin.layouts.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Sửa đơn vị vận chuyển</h2>

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

    {{-- Form cập nhật --}}
    <form method="POST" action="{{ route('admin.shippings.update', $shipping) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="provider_name" class="form-label">Tên đơn vị vận chuyển</label>
            <input type="text" name="provider_name" id="provider_name"
                   class="form-control @error('provider_name') is-invalid @enderror"
                   value="{{ old('provider_name', $shipping->provider_name) }}" required>
            @error('provider_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.shippings.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
