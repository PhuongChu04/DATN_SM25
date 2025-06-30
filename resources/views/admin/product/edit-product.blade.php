@extends('admin.layouts.layout')
@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-fluid">

            <div class="row">


                <div class="col-xl-12 ">
                    <form action="{{ route('admin.product.postEdit', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thêm ảnh sản phẩm</h4>
                            </div>
                            <div class="card-body">
                                <!-- File Upload -->

                                <div class="fallback">
                                    <input type="file" name="image_primary" id="image_primary">
                                    <img src="{{ asset('storage/' . $product->image_primary) }}" alt="{{ $product->name }}"
                                        width="100" class="mt-2">

                                </div>

                                <div class="dz-message needsclick">
                                    <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                                    <h3 class="mt-4">Thả hình ảnh của bạn ở đây, hoặc <span class="text-primary">nhấp để
                                            duyệt</span></h3>
                                    <span class="text-muted fs-13">
                                        1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                                    </span>
                                    @error('image_primary')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thông tin sản phẩm</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        {{-- <form> --}}
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên sản phẩm</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name', $product->name) }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        {{-- <div class="mb-3"> --}}
                                        <label for="id_category" class="form-label">Danh Mục</label>
                                        <select name="id_category" id="id_category" class="form-control">
                                            <option value="">-- Vui lòng chọn danh mục --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('id_category', $product->id_category) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_category')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- </div> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="id_brand" class="form-label">Thương Hiệu</label>
                                            <select name="id_brand" id="id_brand" class="form-control">
                                                <option value="">-- Vui lòng chọn thương hiệu --</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ old('id_brand', $product->id_brand) == $brand->id ? 'selected' : '' }}>
                                                        {{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_brand')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô Tả</label>
                                        <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- trạng thái --}}
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng Thái</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="active"
                                                {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Hoạt
                                                Động</option>
                                            <option value="inactive"
                                                {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Không
                                                Hoạt Động</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                               



                            </div>

                            {{-- / --}}


                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Biến thể sản phẩm</h4>
                                </div>
                                <div class="card-body">
                                    @forelse ($product->variants as $index => $variant)
                                        <div class="row border p-3 mb-3 rounded bg-light">
                                            <input type="hidden" name="variants[{{ $index }}][id]"
                                                value="{{ $variant->id }}">
                                            <div class="col-md-3">
                                                <label class="form-label">Màu sắc</label>
                                                <select name="variants[{{ $index }}][id_color]"
                                                    class="form-control">
                                                    @foreach ($colors as $color)
                                                        <option value="{{ $color->id }}"
                                                            {{ $variant->id_color == $color->id ? 'selected' : '' }}>
                                                            {{ $color->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Kích cỡ</label>
                                                <select name="variants[{{ $index }}][id_size]" class="form-control">
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->id }}"
                                                            {{ $variant->id_size == $size->id ? 'selected' : '' }}>
                                                            {{ $size->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Giá</label>
                                                <input type="number" class="form-control"
                                                    name="variants[{{ $index }}][price]"
                                                    value="{{ old('variants.' . $index . '.price', $variant->price) }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Số lượng</label>
                                                <input type="number" class="form-control"
                                                    name="variants[{{ $index }}][quantity]"
                                                    value="{{ old('variants.' . $index . '.quantity', $variant->quantity) }}">
                                            </div>
                                            <div>
                                                <a href="">xóa</a>
                                            </div>
                                        </div>
                                        
                                    @empty
                                        <div class="alert alert-warning">Sản phẩm này chưa có biến thể.</div>
                                    @endforelse
                                    <div id="variant-new-list" class="mt-3"></div>
                                </div>
                                
                            </div>
                            <div class="p-3 bg-light mb-3 rounded">
                                <div class="row justify-content-end g-3">
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success w-100" id="add-variant-btn">+ Thêm biến thể</button>




                                    </div>
                                    <div class="col-lg-1">
                                        <button type="submit" class="btn btn-primary w-100">Lưu</button>
                                    </div>
                                    <div class="col-lg-1">
                                        <a href="{{ route('admin.product.listProduct') }}"
                                            class="btn btn-primary w-100">Cancel</a>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
  @push('scripts')
<script>
    let variantIndex = {{ count($product->variants) ?? 0 }};

    document.getElementById('add-variant-btn').addEventListener('click', function () {
        const html = `
        <div class="row variant-item mb-3 border p-2 bg-light rounded">
            <div class="col-md-3">
                <label>Màu sắc</label>
                <select name="variants_new[${variantIndex}][id_color]" class="form-control">
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Kích cỡ</label>
                <select name="variants_new[${variantIndex}][id_size]" class="form-control">
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label>Giá</label>
                <input type="number" name="variants_new[${variantIndex}][price]" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label>Số lượng</label>
                <input type="number" name="variants_new[${variantIndex}][quantity]" class="form-control" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-variant">Xóa</button>
            </div>
        </div>`;
        document.getElementById('variant-new-list').insertAdjacentHTML('beforeend', html);
        variantIndex++;
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-variant')) {
            e.target.closest('.variant-item').remove();
        }
    });
</script>
@endpush



@endsection
