@extends('admin.layouts.layout')
@section('content')
    <div class="container-xxl">
        <div class="">
            <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data" id="bannerForm">
                @csrf

                {{-- Upload ảnh --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm ảnh Banner</h4>
                    </div>
                    <div class="card-body">
                        <div class="image-upload-wrapper" id="imageUploadWrapper">
                            {{-- Input file ẩn --}}
                            <input type="file" name="image" id="actualImageInput" class="hidden-input" accept="image/*" />

                            <div class="dz-message needsclick" onclick="document.getElementById('actualImageInput').click()">
                                <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                                <h3 class="mt-4">Kéo ảnh vào đây, hoặc <span class="text-primary">nhấp để duyệt</span></h3>
                                <span class="text-muted fs-13">
                                    1600 x 1200 (4:3) khuyến nghị. Chỉ cho phép file PNG, JPG và GIF.
                                </span>
                                <p id="selectedFileName" class="selected-file-name mt-2"></p>
                                <div id="imagePreview" class="image-preview mt-3"></div>
                            </div>

                            @if ($errors->has('image'))
                                <span style="color: red;">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Tiêu đề --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thông tin Banner</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="banner-title" class="form-label">Tiêu đề</label>
                            <input type="text" name="title" id="banner-title" class="form-control"
                                   placeholder="Nhập tiêu đề" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <span style="color: red;">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="p-3 bg-light mb-3 rounded">
                    <div class="row justify-content-end g-2">
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-outline-secondary w-100">Thêm</button>
                        </div>
                        <div class="col-lg-2">
                            <a href="{{ route('admin.banner.listBanner') }}" class="btn btn-primary w-100">Hủy</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- CSS ẩn input file --}}
    <style>
        .hidden-input {
            display: none;
        }
        .image-preview img {
            max-width: 200px;
            margin-top: 10px;
            border-radius: 8px;
        }
    </style>

    {{-- Script preview ảnh --}}
    <script>
        document.getElementById('actualImageInput').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const fileName = document.getElementById('selectedFileName');

            preview.innerHTML = '';
            fileName.textContent = '';

            if (file) {
                fileName.textContent = file.name;
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
