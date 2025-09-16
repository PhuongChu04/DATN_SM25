@extends('client.layout.layout')
@section('content')

    <!-- Title Page -->
    <section class="tf-page-title">
        <div class="container">
            <div class="box-title text-center">
                <h4 class="title">Sản Phẩm Bán Chạy Nhất</h4>
                <div class="breadcrumb-list">
                    <a class="breadcrumb-item" href="{{ url('/') }}">Trang chủ</a>
                    <div class="breadcrumb-item dot"><span></span></div>
                    <div class="breadcrumb-item current">Bán chạy</div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Title Page -->

    <!-- Section Product -->
    <section class="flat-spacing-24">
        <div class="container">
            {{-- Sử dụng layout grid 4 cột --}}
            <div class="wrapper-shop tf-grid-layout tf-col-4" id="gridLayout">
                
                @forelse ($topProducts as $product)
                    {{-- Chỉ hiển thị sản phẩm nếu nó thực sự đã được bán --}}
                    @if ($product->order_details_sum_quantity > 0)
                        
                        {{-- BẮT ĐẦU CARD SẢN PHẨM THEO STYLE TRANG CHỦ --}}
                        <div class="card-product style-center">
                            <div class="card-product-wrapper">
                                <a href="{{ route('client.detailProduct', $product->id) }}" class="product-img">
                                    {{-- Thay 'image_primary' bằng tên cột ảnh của bạn nếu khác --}}
                                    <img class="img-product"
                                        src="{{ asset('storage/' . $product->image_primary) }}" alt="{{ $product->name }}">
                                    <img class="img-hover"
                                        src="{{ asset('storage/' . $product->image_primary) }}" alt="{{ $product->name }}">
                                </a>
                                <div class="on-sale-wrap flex-column type-2">
                                    {{-- Tag Bán chạy --}}
                                    <span class="on-sale-item trending">Bán chạy</span>
                                </div>
                                <ul class="list-product-btn">
                                    {{-- Các nút chức năng, bạn có thể thêm lại logic sau --}}
                                    <li class="wishlist">
                                        <a href="#" class="bg-surface hover-tooltip tooltip-left box-icon">
                                            <span class="icon icon-heart2"></span>
                                            <span class="tooltip">Add to Wishlist</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#quickView" data-bs-toggle="modal"
                                            class="bg-surface hover-tooltip tooltip-left box-icon quickview">
                                            <span class="icon icon-view"></span>
                                            <span class="tooltip">Quick View</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-product-info text-center">
                                <a href="{{ route('client.detailProduct', $product->id) }}"
                                    class="name-product link fw-medium text-md">{{ $product->name }}</a>
                                
                                {{-- Sửa lỗi: Dùng biến $product thay vì $item --}}
                                <p class="price-wrap fw-medium">
                                    <span class="price-new">{{ number_format($product->firstVariant->price ?? 0, 0, ',', '.') }} ₫</span>
                                    <span class="price-old old-line">{{ number_format(($product->firstVariant->price ?? 0) * 1.2, 0, ',', '.') }} ₫</span>
                                </p>
                                
                                {{-- Hiển thị màu sắc nếu có --}}
                                <ul class="list-color-product justify-content-center">
                                    @foreach ($product->colors as $value)
                                        <li class="list-color-item color-swatch hover-tooltip tooltip-bot active">
                                            <span class="tooltip">{{ $value->name }}</span>
                                            <span class="swatch-value" style="background-color: {{ $value->code }}"></span>
                                        </li>
                                    @endforeach
                                </ul>

                                {{-- Thêm dòng hiển thị số lượng đã bán --}}
                                <p style="font-size: 14px; color: #555; margin-top: 8px;">
                                    Đã bán: {{ $product->order_details_sum_quantity }}
                                </p>
                            </div>
                        </div>
                        {{-- KẾT THÚC CARD SẢN PHẨM --}}

                    @endif
                @empty
                    <div class="col-12 text-center">
                        <p>Chưa có sản phẩm bán chạy để hiển thị.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
    <!-- /Section Product -->
@endsection