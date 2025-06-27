@extends('admin.layouts.layout')
@section('content')
    <!-- Start Container Fluid -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">All Product List</h4>

                        <a href="{{ route('product.createProduct') }}" class="btn btn-sm btn-primary">
                            Add Product
                        </a>

                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                This Month
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Download</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Export</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Import</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check ms-1">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1"></label>
                                            </div>
                                        </th>
                                        <th>ID</th>
                                        <th>Product Name & Size</th>
                                        <th>Description</th>

                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Category</th>

                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="form-check ms-1">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div
                                                        class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('storage/' . $product->image_primary) }}"
                                                            alt="" width="40">
                                                    </div>
                                                    <div>
                                                        <p class="text-dark fw-medium fs-15">{{ $product->name }}</p>
                                                        {{-- <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>
                                                            {{ $product->variants->pluck('size.name')->unique()->implode(', ') }}
                                                        </p> --}}
                                                        <p class="text-muted mb-0 mt-1 fs-13"><span>Color : </span>
                                                            @foreach ($product->variants->pluck('color')->unique() as $color)
                                                                <i class="bx bxs-circle fs-18"
                                                                    style="color: {{ $color->code }}"></i>
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->brand->name ?? '' }}</td>
                                            <td>
                                                {{ $product->variants->first()?->price ? number_format($product->variants->first()->price, 0, ',', '.') . ' VND' : '' }}
                                            </td>
                                            <td>{{ $product->variants->first()->quantity ?? '' }}</td>
                                            <td>{{ $product->category->name ?? '' }}</td>
                                            <td>{{ $product->status }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('product.detailProduct', $product->id) }}"
                                                        class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken"
                                                            class="align-middle fs-18"></iconify-icon> xem</a>
                                                    <a href="{{ route('product.editProduct', $product->id) }}"
                                                        class="btn btn-soft-primary btn-sm"><iconify-icon
                                                            icon="solar:pen-2-broken"
                                                            class="align-middle fs-18"></iconify-icon> sửa</a>
                                                    <form action="{{ route('product.destroyProduct', $product) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-soft-danger btn-sm"
                                                            onclick="return confirm('Bạn có muốn xóa không?')"><iconify-icon
                                                                icon="solar:trash-bin-minimalistic-2-broken"
                                                                class="align-middle fs-18"></iconify-icon> xóa</button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                    <div class="card-footer border-top">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- End Container Fluid -->
@endsection
