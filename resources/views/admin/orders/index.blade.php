@extends('admin.layouts.layout')

@section('content')
<div class="container">
    <h2>Quản lý đơn hàng</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã ĐH</th>
                <th>Người dùng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->id_user }}</td>
                <td>{{ number_format($order->total) }} đ</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                    <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST" enctype="multipart/form-data" class="d-flex">
                        @csrf
                        <select name="status" class="form-select me-2">
                            <option {{ $order->status == 'pending' ? 'selected' : '' }}>pending</option>
                            <option {{ $order->status == 'processing' ? 'selected' : '' }}>processing</option>
                            <option {{ $order->status == 'shipped' ? 'selected' : '' }}>shipped</option>
                            <option {{ $order->status == 'delivered' ? 'selected' : '' }}>delivered</option>
                            <option {{ $order->status == 'cancelled' ? 'selected' : '' }}>cancelled</option>
                        </select>
                        <button class="btn btn-primary btn-sm">Cập nhật</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
