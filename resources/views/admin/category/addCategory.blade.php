@extends('admin.layouts.layout')
@section('content')
    <!-- Start Container Fluid -->

    <div class="container-xxl">
        <div class="">
            <form action="{{ route('admin.listCategory.storeCategory') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Image</h4>
                    </div>
                    <div class="card-body">
                        <!-- File Upload -->
                        <div class="fallback">
                            <input type="file" name="image" />
                        </div>
                        <div class="dz-message needsclick">
                            <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                            <h3 class="mt-4">Drop your images here, or <span class="text-primary">click to
                                    browse</span></h3>
                            <span class="text-muted fs-13">
                                1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Category</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="mb-3">
                                    <label for="category-title" class="form-label">Name</label>
                                    <input type="text" name="name" id="category-title" class="form-control"
                                        placeholder="Enter Name">
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="mb-3">
                                    <label for="product-id" class="form-label">ID Parent</label>
                                    <input type="number" name="id_parent" id="product-id" class="form-control"
                                        placeholder="******">
                                </div>


                            </div>

                        </div>
                    </div>
                </div>

                <div class="p-3 bg-light mb-3 rounded">
                    <div class="row justify-content-end g-2">
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-outline-secondary w-100">Add</button>
                        </div>
                        <div class="col-lg-2">
                            <a href="{{route('admin.listCategory.list')}}" class="btn btn-primary w-100">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- End Container Fluid -->
@endsection
