@extends('admin.layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Bảng giá vận chuyển</h2>
        <a href="{{ route('admin.shipping-rates.create') }}" class="btn btn-primary">+ Thêm mới</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Đơn vị vận chuyển</th>
                <th>Khoảng cách tối thiểu (km)</th>
                <th>Khoảng cách tối đa (km)</th>
                <th>Phí (VNĐ)</th>
                <th style="width: 20%;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rates as $rate)
                <tr>
                    <td>{{ $rate->shipping->provider_name }}</td>
                    <td>{{ $rate->min_km }}</td>
                    <td>{{ $rate->max_km }}</td>
                    <td>{{ number_format($rate->fee, 0, ',', '.') }}đ</td>
                    <td>
                        <a href="{{ route('admin.shipping-rates.edit', $rate) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form method="POST" action="{{ route('admin.shipping-rates.destroy', $rate) }}" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xoá?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Chưa có bảng giá nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
