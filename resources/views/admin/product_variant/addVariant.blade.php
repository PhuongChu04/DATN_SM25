@extends('admin.layouts.layout')

@section('content')
<div class="container-xxl">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Thêm Biến Thể Sản Phẩm</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.product_variant.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="id_product" class="form-label">Sản Phẩm</label>
                    <select name="id_product" id="id_product" class="form-control">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('id_product') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Số Lượng</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', 0) }}">
                    @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="id_color" class="form-label">Màu</label>
                    <select name="id_color" id="id_color" class="form-control">
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                    @error('id_color') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="id_size" class="form-label">Kích Thước</label>
                    <select name="id_size" id="id_size" class="form-control">
                        @foreach($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                    @error('id_size') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Giá</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', 0) }}">
                    @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Trạng Thái</label>
                    <select name="status" id="status" class="form-control">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt Động</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không Hoạt Động</option>
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </div>
</div>
@endsection