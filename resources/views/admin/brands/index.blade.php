@extends('admin.layouts.layout')

@section('content')
<div class="container">
    <h2>Danh sách thương hiệu</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px;">Tên thương hiệu</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Ngày cập nhật</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $brand->name }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $brand->updated_at->format('d/m/Y H:i') }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: white; background-color: red; border: none; padding: 6px 12px; border-radius: 4px;">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
