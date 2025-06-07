@extends('admin.layouts.layout')
@section('content')
    <!-- Start Container Fluid -->

    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-light text-center rounded bg-light">
                            <img src="{{ Storage::url($category['image']) }}" alt="" class="avatar-xxl">
                        </div>
                        <div class="mt-3">
                            <h4>{{$category['name']}}</h4>
                            <div class="row">
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">Name:</p>
                                    <h5 class="mb-0">{{$category['name']}}</h5>
                                </div>
                                
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">ID :</p>
                                    <h5 class="mb-0">{{$category['id_parent']}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 ">
                <form action="{{ route('admin.listCategory.updateCategory', $category) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                            <h4 class="card-title">Update Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label for="category-title" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{$category['name']}}" id="category-title" class="form-control"
                                            placeholder="Enter Name">
                                    </div>

                                </div>
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label for="product-id" class="form-label">ID Parent</label>
                                        <input type="number" name="id_parent" value="{{$category['id_parent']}}" id="product-id" class="form-control"
                                            placeholder="******">
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-end g-2">
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-outline-secondary w-100">Update</button>
                            </div>

                            <div class="col-lg-2">
                                <a href="#!" class="btn btn-primary w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- End Container Fluid -->
@endsection
