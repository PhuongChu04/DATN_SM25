@extends('admin.layouts.layout')

@section('content')
<div class="container-xxl">
    <form action="{{ route('admin.product_variant.bulkDelete') }}" method="POST">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('admin.product_variant.create') }}" class="btn btn-secondary mb-3">Thêm Biến Thể</a>
                            <h4 class="card-title">Danh Sách Biến Thể Sản Phẩm</h4>
                        </div>
                        <div class="dropdown">
                            <a href="{{ route('admin.product_variant.trash') }}" class="btn btn-soft-danger btn-sm">Đã Xóa</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-hover table-centered">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th>STT</th>
                                    <th>Sản Phẩm</th>
                                    <th>Số Lượng</th>
                                    <th>Màu</th>
                                    <th>Kích Thước</th>
                                    <th>Giá</th>
                                    <th>Trạng Thái</th>
                                    <th>Ngày Tạo</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($variants && $variants->count() > 0)
                                    @foreach($variants as $variant)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" name="ids[]" value="{{ $variant->id }}" class="form-check-input checkbox-item">
                                                    <label class="form-check-label"> </label>
                                                </div>
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $variant->product->name ?? 'N/A' }}</td>
                                            <td>{{ $variant->quantity }}</td>
                                            <td>{{ $variant->color->name ?? 'N/A' }}</td>
                                            <td>{{ $variant->size->name ?? 'N/A' }}</td>
                                            <td>{{ number_format($variant->price, 2) }} VND</td>
                                            <td>
                                                @if($variant->status === 'active')
                                                    <span class="badge bg-success">Hoạt Động</span>
                                                @else
                                                    <span class="badge bg-danger">Không Hoạt Động</span>
                                                @endif
                                            </td>
                                            <td>{{ $variant->created_at }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.product_variant.edit', $variant->id) }}" class="btn btn-soft-primary btn-sm">
                                                        <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                                    </a>
                                                    <a href="{{ route('admin.product_variant.destroy', $variant->id) }}" class="btn btn-soft-danger btn-sm" onclick="return confirm('Xóa?')">
                                                        <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="10">Không tìm thấy biến thể</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer border-top">
                        <button type="submit" class="btn btn-primary me-4" onclick="return confirm('Xóa các mục đã chọn?')">Xóa Đã Chọn</button>
                        {{-- {{ $variants->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </form>

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
</div>
@endsection