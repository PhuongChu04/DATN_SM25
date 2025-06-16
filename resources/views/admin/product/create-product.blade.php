@extends('admin.layouts.layout')
@section('content')

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
                                        <form action="{{ route('product.createProduct') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mt-3">
                                                <label for="" class="form-label">Name</label>
                                                <input type="text" name="name" id="" class="form-control">
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Description</label>
                                                <input type="text" name="description" id=""
                                                    class="form-control">
                                            </div>
                                            <div class="mt-3">

                                                <select name="id_brand" class="form-control">
                                                    <option value="">Brand_Id</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            {{ old('id_brand') == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- <div class="mt-3">
                                                <label for="" class="form-label">Color</label>
                                                <input type="text" name="color" id="" class="form-control">
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Size</label>
                                                <input type="text" name="size" id="" class="form-control">
                                            </div> --}}
                                            <div class="mt-3">

                                                <select name="id_category" class="form-control">
                                                    <option value="">Id_Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('id_category') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- <div class="mt-3">
                                                <label for="" class="form-label">Quantity</label>
                                                <input type="text" name="quantity" id="" class="form-control">
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Price</label>
                                                <input type="text" name="price" id="" class="form-control">
                                            </div> --}}

                                            <div class="mt-3">
                                                <label for="" class="form-label">Image_Primary</label>
                                                <input type="file" name="image_primary" id=""
                                                    class="form-control">
                                            </div>
                                            <div class="mt-3">
                                                <label for="" class="form-label">Status</label>
                                                <input type="text" name="status" id="" class="form-control">
                                            </div>

                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-success">Them Moi</button>
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
