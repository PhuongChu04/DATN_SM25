@extends('admin.layouts.layout')

@section('content')
    <div class="container">
        <h2>Chi tiết đơn hàng</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Đơn hàng</th>
                    <th>Variant</th>
                    <th>Thuộc tính</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->id }}</td>
                        <td>#{{ $detail->id_order }}</td>
                        <td>
                            {{ $detail->variant->product->name ?? 'Chưa có tên sản phẩm' }}
                        </td>
                        <td>
                            Size: {{ $detail->variant->size->name ?? 'N/A' }} <br>
                            Màu: {{ $detail->variant->color->name ?? 'N/A' }}
                        </td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->unit_price) }}</td>
                        <td>{{ number_format($detail->total) }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.order-details.destroy', $detail->id) }}">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Xoá chi tiết này?')">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
