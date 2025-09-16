@extends('admin.layouts.layout')
@section('content')
    <style>
        .btn-primary {
            display: inline-block;
            padding: 6px 12px;
            /* Giảm padding để nút nhỏ hơn */
            font-size: 13px;
            /* Giảm kích thước chữ */
            border-radius: 4px;
            /* Bo góc nhỏ hơn */
            background-color: #007bff;
            /* Màu xanh dương mặc định của btn-primary */
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            float: right;
            /* Căn phải */
            margin: 10px 0;
            /* Khoảng cách trên/dưới */
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Màu đậm hơn khi hover */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            /* Giảm bóng để phù hợp kích thước nhỏ */
        }
    </style>
    <div class="container-xxl">
        <div class="card overflow-hiddenCoupons">
            <div>
                <a href="{{ route('user.createUser') }}" class="btn btn-primary">Thêm mới người dùng</a>

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
                                <th>id</th>
                                <th>Email</th>
                                <th>first_name</th>
                                {{-- <th>permission</th> --}}
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->first_name }}
                                    </td>
                                    {{-- <td>{{ $value->permissions }}</td> --}}
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked1" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="#!" class="btn btn-light btn-sm"><iconify-icon
                                                    icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                            <a href="{{ route('user.userDetail', $value->id) }}"
                                                class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken"
                                                    class="align-middle fs-18"></iconify-icon></a>
                                            <a href="{{ route('user.deleteUser', $value->id) }}" onclick="return(confirm('Bạn có chắc chắn xóa người dùng này?'))" class="btn btn-soft-danger btn-sm"><iconify-icon
                                                    icon="solar:trash-bin-minimalistic-2-broken"
                                                    class="align-middle fs-18"></iconify-icon></a>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
            <div class="">
    {{ $users->links() }}
</div>

        </div> <!-- end card -->

    </div>
@endsection
