@extends('admin.layouts.layout')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="container py-5">
    <div class="voucher-modern">
        <!-- Header -->
        <div class="voucher-header">
            <div class="d-flex align-items-center">
                <i class="bi bi-ticket-perforated-fill display-6 me-2"></i>
                <h4 class="mb-0">{{ $voucher->name }}</h4>
            </div>
            <span class="status-pill {{ $voucher->is_active ? 'on' : 'off' }}">
                {{ $voucher->is_active ? 'Đang bật' : 'Đã tắt' }}
            </span>
        </div>

        <!-- Body -->
        <div class="voucher-body">
            <!-- Left -->
            <div class="voucher-info">
                <p><strong><i class="bi bi-upc-scan me-1"></i>Mã:</strong> 
                    <span class="code-pill">{{ $voucher->code }}</span>
                </p>
                <p><strong><i class="bi bi-chat-left-text me-1"></i>Mô tả:</strong> 
                    {{ $voucher->description ?? 'Không có' }}
                </p>
                <p><strong><i class="bi bi-calendar-range me-1"></i>Thời gian:</strong>
                    {{ \Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y') }} → 
                    {{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}
                </p>
                <p><strong><i class="bi bi-info-circle me-1"></i>Trạng thái:</strong>
                    @php
                        $now = \Carbon\Carbon::now();
                        $start = \Carbon\Carbon::parse($voucher->start_date);
                        $end = \Carbon\Carbon::parse($voucher->end_date);
                    @endphp
                    @if ($now->lt($start))
                        <span class="badge bg-secondary">Chưa bắt đầu</span>
                    @elseif ($now->between($start, $end))
                        <span class="badge bg-success">Đang diễn ra</span>
                    @elseif ($now->gt($end))
                        <span class="badge bg-danger">Hết hạn</span>
                    @else
                        <span class="badge bg-dark">Không rõ</span>
                    @endif
                </p>
            </div>

            <!-- Right -->
            <div class="voucher-discount">
                <div class="discount-value">
                    @if($voucher->type == 0)
                        🚚 Free Ship
                    @elseif($voucher->type == 1)
                        {{ $voucher->discount_amount }}%
                    @elseif($voucher->type == 2)
                        {{ number_format($voucher->discount_amount, 0, ',', '.') }}đ
                    @endif
                </div>
                <ul class="discount-meta">
                    @if($voucher->type == 1)
                        <li>Giảm tối đa: <strong>{{ number_format($voucher->max_discount_value, 0, ',', '.') }}đ</strong></li>
                    @endif
                    <li>ĐH tối thiểu: <strong>{{ number_format($voucher->min_order_value, 0, ',', '.') }}đ</strong></li>
                    <li>Giới hạn / người: <strong>{{ $voucher->usage_limit_per_user }}</strong></li>
                    <li>Số lượng: <strong>{{ $voucher->quantity }}</strong></li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="voucher-footer">
            <a href="{{ route('admin.voucher.editVoucher', $voucher->id) }}" class="btn btn-warning">
                ✏️ Sửa
            </a>
            <a href="{{ route('admin.voucher.listVoucher') }}" class="btn btn-outline-secondary">
                ⬅️ Quay lại
            </a>
        </div>
    </div>
</div>
@endsection

<style>
    .voucher-modern {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        max-width: 900px;
        margin: auto;
    }
    .voucher-header {
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        color: #fff;
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .voucher-body {
        display: flex;
        justify-content: space-between;
        padding: 24px;
        gap: 30px;
    }
    .voucher-info p {
        margin: 8px 0;
        font-size: 0.95rem;
    }
    .code-pill {
        background: #0d6efd;
        color: #fff;
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 600;
    }
    .voucher-discount {
        background: #f8f9fa;
        border-left: 5px dashed #0d6efd;
        padding: 20px;
        border-radius: 12px;
        min-width: 260px;
        text-align: center;
    }
    .discount-value {
        font-size: 2.2rem;
        font-weight: 700;
        color: #0d6efd;
        margin-bottom: 12px;
    }
    .discount-meta {
        list-style: none;
        padding: 0;
        margin: 0;
        font-size: 0.9rem;
        text-align: left;
    }
    .discount-meta li {
        margin-bottom: 6px;
    }
    .voucher-footer {
        border-top: 1px solid #eee;
        padding: 16px 24px;
        text-align: right;
        background: #fafafa;
    }
    .status-pill {
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .status-pill.on { background: #28a745; }
    .status-pill.off { background: #6c757d; }
</style>
