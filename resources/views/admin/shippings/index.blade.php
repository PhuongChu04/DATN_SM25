@extends('admin.layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách đơn vị vận chuyển</h2>
        <a href="{{ route('admin.shippings.create') }}" class="btn btn-primary">+ Thêm mới</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col" style="width: 5%;">ID</th>
                <th scope="col">Tên đơn vị vận chuyển</th>
                <th scope="col" style="width: 20%;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shippings as $shipping)
            <tr>
                <td>{{ $shipping->id }}</td>
                <td>{{ $shipping->provider_name }}</td>
                <td>
                    <a href="{{ route('admin.shippings.edit', $shipping) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form method="POST" action="{{ route('admin.shippings.destroy', $shipping) }}" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xoá?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Chưa có đơn vị vận chuyển nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
