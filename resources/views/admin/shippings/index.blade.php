@extends('admin.layouts.layout')
@section('content')
<!-- Start Container Fluid -->
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">Danh Sách Đơn Vị Vận Chuyển</h4>

                    <a href="{{ route('admin.shippings.create') }}" class="btn btn-sm btn-primary">
                        Thêm mới đơn vị
                    </a>

                    <a href="" class="btn btn-soft-danger btn-sm">Đã Xóa</a>

                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Tháng này
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="#!" class="dropdown-item">Download</a>
                            <a href="#!" class="dropdown-item">Export</a>
                            <a href="#!" class="dropdown-item">Import</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-hover table-centered">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check ms-1">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1"></label>
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Tên đơn vị vận chuyển</th>
                                    <th>Giá vận chuyển</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($shippings as $shipping)
                                <tr>
                                    <td>
                                        <div class="form-check ms-1">
                                            <input type="checkbox" class="form-check-input" value="{{ $shipping->id }}" name="ids[]">
                                            <label class="form-check-label"></label>
                                        </div>
                                    </td>
                                    <td>{{ $shipping->id }}</td>
                                    <td>{{ $shipping->provider_name }}</td>
                                    <td>{{ number_format($shipping->price, 0, ',', '.') }} đ</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                            <a href="{{ route('admin.shippings.edit', $shipping) }}" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                            <form action="{{ route('admin.shippings.destroy', $shipping) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Chưa có đơn vị vận chuyển nào.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
