@extends('admin.layouts.layout')
@section('content')
    <!-- Start Container Fluid -->

    <div class="container-xxl">

        <div class="row">
            <div class="">
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
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- End Container Fluid -->
@endsection
