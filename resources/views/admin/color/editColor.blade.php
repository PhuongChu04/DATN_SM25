@extends('admin.layouts.layout')

@section('content')
<div class="container-xxl py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="color-card p-4">
                <h3 class="mb-4 fw-bold text-center">🎨 Sửa Màu</h3>
                <form action="{{ route('admin.color.updateColor', $color->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $color->id }}">

                    <!-- Tên màu -->
                    <div class="mb-4">
                        <label for="value-name" class="form-label fw-semibold">Tên màu</label>
                        <input type="text" id="value-name" name="name" 
                               class="form-control-modern"
                               placeholder="Ví dụ: Đỏ tươi, Xanh lá mạ..."
                               value="{{ $color->name }}">
                    </div>

                    <!-- Mã màu -->
                    <div class="mb-4">
                        <label for="attribute-id" class="form-label fw-semibold">Mã màu (Hex)</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="text" id="attribute-id" name="code" 
                                   class="form-control-modern"
                                   placeholder="#FF0000"
                                   value="{{ $color->code }}"
                                   oninput="document.getElementById('color-preview-box').style.backgroundColor=this.value;
                                            document.getElementById('preview-color').value=this.value;">
                            <input type="color" id="preview-color" class="color-picker"
                                   value="{{ $color->code }}"
                                   onchange="document.getElementById('attribute-id').value=this.value;
                                             document.getElementById('color-preview-box').style.backgroundColor=this.value;">
                        </div>
                    </div>

                    <!-- Preview màu -->
                    <div class="mb-4 text-center">
                        <div id="color-preview-box" class="color-preview" style="background-color: {{ $color->code }}"></div>
                        <small class="text-muted d-block mt-2">Xem trước màu</small>
                    </div>

                    <!-- Nút lưu -->
                    <div class="d-grid">
                        <button type="submit" class="btn-modern" onclick="return confirm('Bạn có chắc muốn lưu thay đổi?')">
                            <i class="bi bi-save me-2"></i>Lưu Thay Đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
      .color-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: transform 0.2s ease;
}
.color-card:hover {
    transform: translateY(-5px);
}
.form-control-modern {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    background: #f9fafb;
    transition: all 0.2s ease;
}
.form-control-modern:focus {
    border-color: #6366f1;
    background: #fff;
    outline: none;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.2);
}
.color-picker {
    width: 60px;
    height: 45px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
}
.color-preview {
    width: 100%;
    height: 60px;
    border-radius: 12px;
    border: 2px dashed #e5e7eb;
    transition: background 0.3s ease;
}
.btn-modern {
    padding: 12px 20px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(90deg, #10b981, #059669);
    color: #fff;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
}
.btn-modern:hover {
    background: linear-gradient(90deg, #059669, #047857);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(16,185,129,0.3);
}

      </style>