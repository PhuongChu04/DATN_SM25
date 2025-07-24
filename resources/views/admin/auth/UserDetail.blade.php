@extends('admin.layouts.layout')

@section('content')
<div class="container-xxl">
    

    <div class="card overflow-hidden">
        <div class="card-header bg-light-subtle">
            <h4 class="mb-0">Sửa thông tin tài khoản</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('user.updateAccountDetail', $user->id) }}">
                @csrf
                {{-- @method('PATCH') --}}

                <!-- Họ -->
                <div class="mb-3">
                    <label for="first_name" class="form-label">Họ</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                    @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Tên -->
                <div class="mb-3">
                    <label for="last_name" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                    @error('last_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Địa chỉ Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Mật khẩu mới -->
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword">
                    <small class="text-muted">Để trống nếu không muốn đổi mật khẩu.</small>
                    @error('newPassword')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Xác nhận mật khẩu mới -->
                <div class="mb-3">
                    <label for="newPassword_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" class="form-control" id="newPassword_confirmation" name="newPassword_confirmation">
                    @error('newPassword_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection