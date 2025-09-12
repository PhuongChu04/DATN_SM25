@extends('admin.layouts.layout')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <div class="container mt-4">
        <h2 class="mb-4">🎫 <strong>Chi tiết Mã Giảm Giá</strong></h2>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <i class="bi bi-ticket-perforated-fill me-2"></i> {{ $voucher->name }}
                </div>
                <span class="badge rounded-pill bg-{{ $voucher->is_active ? 'success' : 'secondary' }}">
                    {{ $voucher->is_active ? 'Đang bật' : 'Đã tắt' }}
                </span>
            </div>

            <div class="card-body">
                {{-- Mã và mô tả --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <i class="bi bi-upc-scan me-1 text-primary"></i> <strong>Mã:</strong> {{ $voucher->code }}
                    </div>
                    <div class="col-md-6">
                        <i class="bi bi-chat-left-text me-1 text-info"></i> <strong>Mô tả:</strong>
                        {{ $voucher->description ?? 'Không có' }}
                    </div>
                </div>

                <hr>

                {{-- Thông tin giảm giá --}}
                <h5 class="text-uppercase text-muted mb-3"><i class="bi bi-cash-coin me-1"></i>Thông Tin Giảm Giá</h5>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <strong>Loại:</strong>
                        <span class="badge bg-light text-dark">
                            @switch($voucher->type)
                                @case(0)
                                Miễn phí ship
                                @break

                                @case(1)
                                    Phần trăm
                                @break

                                @case(2)
                                Số tiền cố định
                                    
                                @break

                                @default
                                    Không rõ
                            @endswitch
                        </span>
                    </div>
                    <div class="col-md-4">
                        <strong>Giảm:</strong> <span
                            class="text-success">{{ number_format($voucher->discount_amount, 0, ',', '.') }} 
                            @switch($voucher->type)
                            @case(0)
                            
                            @break

                            @case(1)
                                %
                            @break

                            @case(2)
                            VND
                                
                            @break

                            @default
                                Không rõ
                        @endswitch
                        </span>
                    </div>
                    <div class="col-md-4">
                        <strong>Giảm tối đa:</strong> <span
                            class="text-danger">{{ number_format($voucher->max_discount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <strong>Đơn hàng tối thiểu:</strong> {{ number_format($voucher->min_order_amount, 0, ',', '.') }} VND
                    </div>
                    <div class="col-md-4">
                        <strong>Giới hạn / người:</strong> {{ $voucher->usage_limit_per_user }}
                    </div>
                    <div class="col-md-4">
                        <strong>Số lượng:</strong> {{ $voucher->quantity }}
                    </div>
                </div>

                <hr>

                {{-- Thời gian và trạng thái --}}
                <h5 class="text-uppercase text-muted mb-3"><i class="bi bi-calendar-check me-1"></i>Thời Gian & Trạng Thái
                </h5>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <strong>Áp dụng:</strong> 🗓️ {{ \Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y') }} →
                        {{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}
                    </div>
                    @php
                        $now = \Carbon\Carbon::now();
                        $start = \Carbon\Carbon::parse($voucher->start_date);
                        $end = \Carbon\Carbon::parse($voucher->end_date);
                    @endphp

                    <div class="col-md-6">
                        <strong>Trạng thái:</strong>
                        @if ($now->lt($start))
                            <span class="badge bg-secondary">Chưa bắt đầu</span>
                        @elseif ($now->between($start, $end))
                            <span class="badge bg-success">Đang diễn ra</span>
                        @elseif ($now->gt($end))
                            <span class="badge bg-danger">Hết hạn</span>
                        @else
                            <span class="badge bg-dark">Không rõ</span>
                        @endif
                    </div>



                    {{-- Action --}}
                    <div class="mt-4 d-flex justify-content-end">
                        <a href="{{ route('admin.voucher.editVoucher', $voucher->id) }}" class="btn btn-warning me-2">
                            ✏️ Sửa
                        </a>
                        <a href="{{ route('admin.voucher.listVoucher') }}" class="btn btn-outline-secondary">
                            ⬅️ Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
