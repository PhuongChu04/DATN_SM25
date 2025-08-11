@extends('admin.layouts.layout')
@section('content')
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-fluid">

            {{-- <div class="row"> --}}


                <div class="col-xl-12 ">
                    <form action="{{ route('admin.product.postCreate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thêm ảnh sản phẩm</h4>
                            </div>
                            <div class="card-body">
                                <!-- File Upload -->

                                <div class="fallback">
                                    <input type="file" name="image_primary" id="image_primary">
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
                                                placeholder="Vui lòng nhập tên sản phẩm" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- <div class="mb-3">
                                                <label for="name" class="form-label">Tên</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ old('name') }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}
                                        {{-- </form> --}}
                                    </div>
                                    <div class="col-lg-6">
                                        {{-- <div class="mb-3"> --}}
                                        <label for="id_category" class="form-label">Danh Mục</label>
                                        <select name="id_category" id="id_category" class="form-control">
                                            <option value="">-- Vui lòng chọn danh mục --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('id_category') == $category->id ? 'selected' : '' }}>
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
                                                        {{ old('id_brand') == $brand->id ? 'selected' : '' }}>
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
                                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- trạng thái --}}
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng Thái</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt
                                                Động</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                Không Hoạt Động</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                            
                                <h5 class="mt-4">Biến thể sản phẩm</h5>
                                <div id="variant-list">
                                    <div class="row variant-item mb-2">
                                        <div class="col-md-3">
                                            <label for="">Màu sắc</label>
                                            <select name="variants[0][id_color]" class="form-control">
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Kích cỡ</label>
                                            <select name="variants[0][id_size]" class="form-control">
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Giá</label>
                                            <input type="number" name="variants[0][price]" class="form-control" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Số lượng</label>
                                            <input type="number" name="variants[0][quantity]" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger remove-variant">Xóa</button>
                                        </div>
                                    </div>
                                </div>


                                {{--  --}}
                                <div class="p-4 bg-light mb-4 rounded">
                                    <div class="row justify-content-end g-3">
                                        <div class="col-lg-1">
                                            <button type="button" class="btn btn-success w-100" id="add-variant">+ Thêm
                                                biến thể</button>

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
                        </div>


                    </form>
                </div>
            {{-- </div> --}}
        </div>
    </div>
    @push('scripts')
        <script>
            let variantIndex = 1;

            document.getElementById('add-variant').addEventListener('click', function() {
                const html = `
        <div class="row variant-item mb-2">
            <div class="col-md-3">
                <label for="">Màu sắc</label>
                <select name="variants[${variantIndex}][id_color]" class="form-control">
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Kích cỡ</label>
                <select name="variants[${variantIndex}][id_size]" class="form-control">
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="">Giá</label>
                <input type="number" name="variants[${variantIndex}][price]" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label for="">Số lượng</label>
                <input type="number" name="variants[${variantIndex}][quantity]" class="form-control" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-variant">Xóa</button>
            </div>
        </div>`;
                document.getElementById('variant-list').insertAdjacentHTML('beforeend', html);
                variantIndex++;
            });

            // Xóa dòng biến thể
            document.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-variant')) {
                    e.target.closest('.variant-item').remove();
                }
            });
        </script>
    @endpush
@endsection
