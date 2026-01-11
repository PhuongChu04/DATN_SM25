@extends('admin.layouts.layout')
@section('content')
    <!-- Start Container Fluid -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">Danh sách banner</h4>

                        <a href="{{ route('admin.banner.create') }}" class="btn btn-sm btn-primary">
                            Thêm mới banner
                        </a>

                        {{-- <a href="{{ route('admin.product.trash') }}" class="btn btn-soft-danger btn-sm">Đã Xóa</a> --}}


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
                                        <th>STT</th>
                                        <th>Title</th>
                                        <th>Image</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner)
                                        <tr>
                                            <td>
                                                <div class="form-check ms-1">
                                                    <input type="checkbox" class="form-check-input"
                                                        value="{{ $banner->id }}" name="ids[]">
                                                    <label class="form-check-label"> </label>
                                                </div>
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div>
                                                        {{ $banner->title ?? 'Chưa có tiêu đề' }}
                                                    </div>
                                                    
                                                    
                                                </div>  
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                   
                                                    <div
                                                        class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('storage/' . $banner->img) }}"
                                                            alt="{{ $banner->img }}" class="avatar-md">
                                                    </div>
                                                    
                                                </div>  
                                            </td>
                                            {{-- <td>{{ $banner->link ?? 'N/A' }}</td>
                                            <td>
                                                @if ($banner->status === 'active')
                                                    <span class="badge bg-success">Hiển thị</span>
                                                @else
                                                    <span class="badge bg-secondary">Ẩn</span>
                                                @endif
                                            </td>
                                            <td>{{ $banner->created_at->format('d/m/Y H:i') }}</td> --}}
                                            <td>
                                                <div class="d-flex gap-2">
                                                    {{-- <a href="{{ route('admin.banner.show', $banner->id) }}"
                                                        class="btn btn-light btn-sm"> --}}
                                                        <iconify-icon icon="solar:eye-broken"
                                                            class="align-middle fs-18"></iconify-icon>
                                                    </a>
                                                    <a href="{{ route('admin.banner.edit', $banner->id) }}"
                                                        class="btn btn-soft-primary btn-sm">
                                                        <iconify-icon icon="solar:pen-2-broken"
                                                            class="align-middle fs-18"></iconify-icon>
                                                    </a>
                                                    <form action="{{ route('admin.banner.destroy', $banner->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-soft-danger btn-sm">
                                                            <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                                                class="align-middle fs-18"></iconify-icon>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    {{ $banners->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
