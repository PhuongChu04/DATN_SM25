@extends('admin.layouts.layout')

@section('content')
<div class="container-xxl">
    <div class="card overflow-hidden">
        <div class="card-header bg-light-subtle">
            <h4 class="mb-0">Đăng ký tài khoản Admin</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.auth.PostAdminRegister') }}">
                @csrf

                {{-- First Name --}}
                <div class="mb-3">
                    <label for="first_name" class="form-label">Họ</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                    @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Last Name --}}
                <div class="mb-3">
                    <label for="last_name" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                    @error('last_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Địa chỉ Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="mb-3">
                    <label for="role" class="form-label">Quyền</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">-- Chọn quyền --</option>
                        <option value="super-admin" {{ old('role') == 'super-admin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
