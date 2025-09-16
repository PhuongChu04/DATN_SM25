@extends('admin.layouts.layout')

@section('content')
<div class="container-xxl py-5">
    <form action="{{ route('admin.size.bulkDeleteSize') }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="card shadow-lg border-0 rounded-3">
            <div class="d-flex card-header justify-content-between align-items-center bg-gradient-primary text-white rounded-top-3 p-3">
                <h4 class="mb-0 fw-bold">📏 Danh Sách Size</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.size.addSize') }}" class="btn btn-light btn-sm fw-semibold">
                        <i class="bi bi-plus-circle me-1"></i> Thêm Size
                    </a>
                    <a href="{{ route('admin.size.trashSize') }}" class="btn btn-danger btn-sm fw-semibold">
                        <i class="bi bi-trash me-1"></i> Đã xóa
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                </div>
                            </th>
                            <th>STT</th>
                            <th>Tên Size</th>
                            <th>Ngày Cập Nhật</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sizes as $size)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" name="ids[]" value="{{ $size->id }}" class="form-check-input checkbox-item">
                                </div>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $size->name }}</td>
                            <td>
                                @if($size->updated_at)
                                    {{ $size->updated_at->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">Chưa cập nhật</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.size.editSize', $size->id) }}" 
                                       class="btn btn-outline-primary btn-sm">
                                       <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="{{ route('admin.size.deleteSize', $size->id) }}" 
                                       class="btn btn-outline-danger btn-sm"
                                       onclick="return confirm('Bạn có chắc muốn xóa size này không?')">
                                       <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-danger fw-semibold"
                        onclick="return confirm('Bạn có muốn xóa các mục đã chọn?')">
                    <i class="bi bi-trash me-1"></i> Xóa các mục đã chọn
                </button>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkAll = document.getElementById('checkAll');
    const checkboxes = document.querySelectorAll('.checkbox-item');

    checkAll.addEventListener('change', function () {
        checkboxes.forEach(cb => cb.checked = checkAll.checked);
    });

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            checkAll.checked = [...checkboxes].every(input => input.checked);
        });
    });
});
</script>
@endsection

<style>
.table thead th {
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    color: #6b7280;
}
.table tbody td {
    vertical-align: middle;
}
.btn-outline-primary, .btn-outline-danger {
    border-radius: 8px;
}
</style>
