@extends('admin.layouts.layout')
@section('content')
    <!-- Start Container Fluid -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-1 anchor" id="striped">Danh sách danh mục <a class="anchor-link" href="#striped">#</a>
            </h5>
            <div class="table-responsive">
                <table class="table table-striped table-centered">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">ID_parent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->name }}</td>
                                <td>
                                    <img src="{{ $value->image }}" alt="" width="170">
                                </td>
                                <td>{{ $value->id_parent }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <!-- End Container Fluid -->
@endsection
