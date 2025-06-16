@extends('admin.layouts.layout')
@section('content')
    <!-- Start Container Fluid -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">

                        <a href="{{ route('admin.listProduct') }}" class="btn btn-sm btn-primary">
                            All Product List
                        </a>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle">

                                </thead>

                                <body>
                                    <div class="container w-60">
                                        @if ($errors->any())
                                            <div class="alert alert-danger mt-5">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mt-3">
                                                <label for="" class="form-label">Name</label>
                                                <input type="text" name="name" id="" class="form-control"
                                                    value="{{ $product->name }}" disabled>
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Description</label>
                                                <input type="text" name="description" id=""class="form-control"
                                                    value="{{ $product->description }}" disabled>
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Brand_id</label>
                                                <select name="brand_id" class="form-control" disabled>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            {{ $product->id_brand == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Id_Category</label>
                                                <select name="id_category" class="form-control" disabled>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" 
                                                            {{ $product->id_category == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="mt-3">
                                                <label for="" class="form-label">Image_Primary</label>
                                                {{-- <input type="file" name="image_primary"
                                                    id=""class="form-control" disabled> --}}
                                                <img src="{{ asset('storage/' . $product->image_primary) }}" alt=""
                                                    width="60">
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Status</label>
                                                <input type="text" name="status" id="" class="form-control"
                                                    value="{{ $product->status }}" disabled>
                                            </div>

                                            <div class="mt-3">

                                            </div>

                                        </form>
                                    </div>
                                </body>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- End Container Fluid -->
@endsection
