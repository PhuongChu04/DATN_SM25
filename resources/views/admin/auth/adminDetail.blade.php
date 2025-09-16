@extends('admin.layouts.layout')
@section('content')
<div class="container-xxl">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Chi tiết & Sửa Admin</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.auth.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Họ</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Phân quyền</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="roles[]"
                                       value="{{ $role->id }}"
                                       id="role{{ $role->id }}"
                                       @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                <label class="form-check-label" for="role{{ $role->id }}">
                                    {{ $role->name }} ({{ $role->slug }})
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="{{ route('admin.auth.listAdmin') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection
