@extends('admin.layouts.layout')
@section('content')

    <div class="container-xxl">
        <div class="card overflow-hiddenCoupons">

            {{-- <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="mb-0">Danh sách người dùng</h5>

            </div> --}}
            <div class="card-header d-flex justify-content-between align-items-center gap-1">
                <h4 class="card-title flex-grow-1">Danh sách người dùng</h4>

                <a href="{{ route('admin.auth.RegisterAdminForm') }}" class="btn btn-sm btn-primary">
                    Thêm mới
                </a>

            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                    </div>

                    <table class="table align-middle mb-0 table-hover table-centered">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Họ tên</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                    <td>
                                        @foreach ($value->roles as $role)
                                            <span class="badge bg-info">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                   <td>
    <form action="{{ route('admin.auth.toggleStatus', $value->id) }}" method="POST">
        @csrf
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="status" value="1" onchange="this.form.submit()"
                {{ $value->status ? 'checked' : '' }}>
        </div>
    </form>
</td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="#!" class="btn btn-light btn-sm" title="Xem">
                                                <iconify-icon icon="solar:eye-broken"
                                                    class="align-middle fs-18"></iconify-icon>
                                            </a>
                                            <a href="{{ route('admin.auth.detail', $value->id) }}"
                                                class="btn btn-soft-primary btn-sm" title="Sửa Admin">
                                                <iconify-icon icon="solar:pen-2-broken"
                                                    class="align-middle fs-18"></iconify-icon>
                                            </a>
                                            <form action="{{ route('admin.auth.DeleteAdminRegister', $value->id) }}"
                                                method="POST" style="display:inline-block;"
                                                onsubmit="return confirm('Bạn có chắc chắn xóa người dùng này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-soft-danger btn-sm" title="Xóa">
                                                    <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                                        class="align-middle fs-18"></iconify-icon>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Không có người dùng nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                {{ $users->links() }}
            </div>
        </div>
    </div>


    </div> <!-- end card -->

    </div>
@endsection
