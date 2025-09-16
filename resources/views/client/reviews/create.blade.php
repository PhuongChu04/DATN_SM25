@extends('client.layout.layout')

@section('content')

<div class="flat-spacing-13">
    <div class="container-7">
        <div class="my-acount-content account-dashboard">
            <h4>Đánh Giá Sản Phẩm</h4>

            <!-- Hiển thị sản phẩm đánh giá -->
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="product-info mb-3">
                        <div class="product-image">
                            <img src="{{ asset('storage/'.$product->image_primary) }}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 100px; height: auto;">
                        </div>
                        <div class="product-details">
                            <p><strong>{{ $product->name }}</strong></p>
                            <!-- Kiểm tra và hiển thị phân loại nếu có -->
                            <p>
                                <strong>Phân loại:</strong>
                                @if ($size && $color)
                                    {{ $size->name ?? 'Không có' }} / {{ $color->name ?? 'Không có' }}
                                @else
                                    Không có
                                @endif
                            </p>
                            <div class="mb-3">
                                <strong>Chất lượng sản phẩm:</strong>
                                <div class="rating">
                                    <span class="star" data-value="1">&#9733;</span>
                                    <span class="star" data-value="2">&#9733;</span>
                                    <span class="star" data-value="3">&#9733;</span>
                                    <span class="star" data-value="4">&#9733;</span>
                                    <span class="star" data-value="5">&#9733;</span>
                                </div>
                                <span class="rating-text">Tuyệt vời</span>
                            </div>
                        </div>
                    </div>

                    <!-- Mô tả đánh giá -->
                    <form action="{{ route('client.reviews.store', $order->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="form-group mb-3">
                            <label for="comment"><strong>Tính năng nổi bật:</strong></label>
                            <textarea name="comment" id="comment" rows="5" class="form-control" placeholder="Hãy chia sẻ những điều bạn thích về sản phẩm này với những người mua khác."></textarea>
                        </div>

                        <!-- Thêm input ẩn cho rating -->
                        <input type="hidden" name="rating" id="rating" value="">

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-danger btn-sm">Hoàn thành</button>
                            <a href="{{ route('client.orders.index') }}" class="btn btn-secondary btn-sm">Trở lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .product-info {
        display: flex;
        gap: 15px;
        padding: 16px;
        border: 1px solid #ddd;
        background-color: #f9f9f9;
        border-radius: 8px;
        align-items: center;
        margin-bottom: 15px;
    }

    .product-info .product-image {
        max-width: 100px;
    }

    .product-info .product-details {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .product-info .product-details p {
        margin: 5px 0;
    }

    .rating {
        display: flex;
        gap: 5px;
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .star {
        cursor: pointer;
        color: #ddd;
    }

    .star:hover,
    .star.selected {
        color: #f39c12;
    }

    .rating-text {
        font-size: 1rem;
        color: #555;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
    }
</style>

<script>
    // Xử lý sự kiện khi người dùng click vào sao
    document.querySelectorAll('.star').forEach(function(star) {
        star.addEventListener('click', function() {
            let rating = this.getAttribute('data-value');
            document.querySelectorAll('.star').forEach(function(star) {
                star.classList.remove('selected');
            });
            for (let i = 0; i < rating; i++) {
                document.querySelectorAll('.star')[i].classList.add('selected');
            }
            document.querySelector('.rating-text').textContent = getRatingText(rating);
            document.querySelector('#rating').value = rating; // Lưu giá trị vào input ẩn
        });
    });

    // Cập nhật text mô tả khi chọn sao
    function getRatingText(rating) {
        switch(rating) {
            case '1': return 'Tệ';
            case '2': return 'Khá tệ';
            case '3': return 'Bình thường';
            case '4': return 'Tốt';
            case '5': return 'Tuyệt vời';
            default: return '';
        }
    }
</script>

@endsection
