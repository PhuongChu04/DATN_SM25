@extends('admin.layouts.layout')
@section('content')

    <body>
        @if ($errors->any())
            <div class="alert alert-danger mt-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-xxl">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="assets/images/product/p-1.png" alt="" class="img-fluid rounded bg-light">
                            <div class="mt-3">
                                <h4>Men Black Slim Fit T-shirt <span class="fs-14 text-muted ms-1">(Fashion)</span></h4>
                                <h5 class="text-dark fw-medium mt-3">Price :</h5>
                                <h4 class="fw-semibold text-dark mt-2 d-flex align-items-center gap-2">
                                    <span class="text-muted text-decoration-line-through">$100</span>
                                    $80 <small class="text-muted"> (30% Off)</small>
                                </h4>
                                <div class="mt-3">
                                    <h5 class="text-dark fw-medium">Size :</h5>
                                    <div class="d-flex flex-wrap gap-2" role="group"
                                        aria-label="Basic checkbox toggle button group">
                                        <input type="checkbox" class="btn-check" id="size-s">
                                        <label
                                            class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                            for="size-s">S</label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h5 class="text-dark fw-medium">Colors :</h5>
                                    <div class="d-flex flex-wrap gap-2" role="group"
                                        aria-label="Basic checkbox toggle button group">
                                        <input type="checkbox" class="btn-check" id="color-dark">
                                        <label
                                            class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                            for="color-dark"> <i class="bx bxs-circle fs-18 text-dark"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 ">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Product Photo</h4>
                        </div>
                        <form action="{{ route('product.createProduct') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="fallback">
                                    <input type="file" name="image_primary" id="">
                                </div>
                                <div class="dz-message needsclick">
                                    <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                                    <h3 class="mt-4">Drop your images here, or <span class="text-primary">click to
                                            browse</span></h3>
                                    <span class="text-muted fs-13">
                                        1600 x 1200 (4:3) recommended. PNG, JPG and GIF files
                                        are allowed
                                    </span>
                                </div>
                            </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="product-name" class="form-label">Product
                                            Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Items Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="" class="form-label">Product
                                        Categories</label>
                                    <select class="form-control" name="id_category">
                                        <option value="">Choose a categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('id_category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label">Brand</label>
                                    <select class="form-control" name="id_brand">
                                        <option value="">Choose a brands</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ old('id_brand') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Price</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><i class='bx bx-dollar'></i></span>
                                        <input type="number" name="variants[0][price]" class="form-control"
                                            placeholder="000">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4">
                                    <div class="mt-3">
                                        <h5 class="text-dark fw-medium">Size :</h5>
                                        <div class="d-flex flex-wrap gap-2" role="group"
                                            aria-label="Basic checkbox toggle button group">
                                            {{-- @foreach ($sizes as $size)
                                                <input type="checkbox" name="sizes[]" class="btn-check"
                                                    id="size-{{ $size->id }}" value="{{ $size->id }}">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="size-{{ $size->id }}">{{ $size->name }}</label>
                                            @endforeach --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="mt-3">
                                        <h5 class="text-dark fw-medium">Colors :</h5>
                                        <div class="d-flex flex-wrap gap-2" role="group"
                                            aria-label="Basic checkbox toggle button group">
                                            @foreach ($colors as $color)
                                                <input type="checkbox" name="colors[]" class="btn-check"
                                                    id="color-{{ $color->id }}" value="{{ $color->id }}">
                                                <label
                                                    class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                                    for="color-{{ $color->id }}"><i class="bx bxs-circle fs-18"
                                                        style="color: {{ $color->code }}"></i></label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control bg-light-subtle" name="description" rows="7"
                                            placeholder="Short description about the product"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label for="product-stock" class="form-label">Stock</label>
                                        <input type="number" class="form-control" placeholder="Quantity"
                                            name="variants[0][quantity]">
                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label for="product-stock" class="form-label">Status</label>
                                        <input type="tex" name="status" class="form-control" placeholder="Status">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-end g-2">

                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-outline-secondary w-100">Create
                                    Product</button>
                            </div>
                            <div class="col-lg-2">
                                <a href="{{ route('product.listProduct') }}" class="btn btn-primary w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
@endsection
