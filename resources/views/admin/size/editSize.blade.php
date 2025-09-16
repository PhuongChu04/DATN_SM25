@extends('admin.layouts.layout')

@section('content')
<div class="container-xxl py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow border-0 rounded-4 modern-card animate-fade">
                <!-- Header -->
                <div class="card-header border-0 bg-white px-4 pt-4 pb-0">
                    <h4 class="fw-bold text-dark mb-1 d-flex align-items-center">
                        <i class="bi bi-pencil-square text-warning me-2"></i> Sửa Size
                    </h4>
                    <p class="text-muted mb-0">Chỉnh sửa thông tin size trong form bên dưới</p>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.size.updateSize', $size->id) }}" method="POST" class="p-4">
                    @csrf
                    <input type="hidden" name="id" value="{{ $size->id }}">

                    <!-- Tên Size -->
                    <div class="mb-4">
                        <label for="value-name" class="form-label fw-semibold">Tên Size</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 rounded-start-3">
                                <i class="bi bi-rulers text-muted"></i>
                            </span>
                            <input type="text" id="value-name" name="name" 
                                   class="form-control modern-input"
                                   placeholder="Ví dụ: M, L, XL..."
                                   value="{{ $size->name }}" required>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="my-4 text-muted opacity-25">

                    <!-- Footer -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" 
                                onclick="return confirm('Bạn có muốn lưu thay đổi không?')" 
                                class="btn modern-btn px-4 py-2 fw-semibold rounded-pill shadow-sm">
                            <i class="bi bi-save me-1"></i> Lưu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Animation */
.animate-fade {
    animation: fadeInUp 0.6s ease-in-out;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Card hover */
.modern-card {
    transition: all 0.3s ease;
}
.modern-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

/* Input đẹp */
.modern-input {
    border: 1px solid #e5e7eb;
    border-radius: 0.75rem;
    font-size: 1rem;
    transition: all 0.25s ease;
}
.modern-input:focus {
    border-color: #f59e0b;
    box-shadow: 0 4px 12px rgba(245,158,11,0.15);
    outline: none;
}

/* Button gradient vàng */
.modern-btn {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #fff;
    border: none;
    transition: all 0.3s ease;
}
.modern-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(245,158,11,0.35);
}
</style>
@endsection
