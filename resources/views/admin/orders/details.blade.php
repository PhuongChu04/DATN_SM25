@extends('admin.layouts.layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container py-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Đơn hàng <span class="text-primary">#{{ $order->order_code }}</span></h4>
            <div>
                <button onclick="showEditModal({{ $order->id }}, '{{ $order->order_status }}')"
                    class="btn btn-sm btn-outline-warning me-1" title="Chỉnh sửa">
                    <i class="bi bi-pencil-fill"></i>
                </button>


                <a href="{{ route('admin.orders.print', $order->id) }}" class="btn btn-outline-success me-2"
                    target="_blank">In
                    hóa đơn</a>
                <form action="{{ route('admin.orders.refund', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('POST')
                    <button class="btn btn-outline-danger" onclick="return confirm('Xác nhận hoàn tiền?')">Hoàn
                        tiền</button>
                </form>

            </div>
        </div>

        {{-- Trạng thái --}}
        <div class="mb-3">
            <span
                class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'refund' ? 'warning text-dark' : 'secondary') }}">
                {{ ucfirst($order->payment_status) }}
            </span>
            <span class="badge bg-info">{{ ucfirst($order->order_status) }}</span>
        </div>

        {{-- Progress bar 5 bước --}}
        @php
            // 1. Lấy danh sách 5 bước chính
            $steps = \App\Enums\OrderStatus::progressSteps(); // ['confirming','pending','processing','shipping','delivered']

            // 2. Nếu trạng thái là Canceled hoặc Returned, đặt index = -1 để không có bước nào được tô màu
            if (
                in_array($order->order_status, [
                    \App\Enums\OrderStatus::Canceled->value,
                    \App\Enums\OrderStatus::Returned->value,
                ])
            ) {
                $currentStep = -1;
            } else {
                // Ngược lại tìm index bình thường
                $currentStep = array_search($order->order_status, $steps);
            }
        @endphp

        <div class="progress mb-4" style="height:30px">
            @foreach ($steps as $i => $step)
                <div class="progress-bar {{ $i <= $currentStep ? 'bg-success' : 'bg-secondary' }}" style="width:20%">
                    {{ ucfirst($step) }}
                </div>
            @endforeach
        </div>


        <div class="row">
            {{-- Sản phẩm --}}
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold">Sản phẩm trong đơn</div>
                    <div class="card-body p-0">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Kích cỡ</th>
                                    <th>Màu</th>
                                    <th>SL</th>
                                    <th>Giá</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $item)
                                    <tr>
                                        <td>{{ $item->variant->product->name ?? '-' }}</td>
                                        <td>{{ $item->variant->size->name ?? '-' }}</td>
                                        <td>{{ $item->variant->color->name ?? '-' }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format(floor($item->unit_price), 0, ',', '.') }}₫</td>
                                        <td>{{ number_format(floor($item->total), 0, ',', '.') }}₫</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Tóm tắt và người dùng --}}
            <div class="col-md-4">
                <div class="card mb-3 shadow-sm">
                    <div class="card-header fw-bold">Thông tin khách hàng</div>
                    <div class="card-body">
                        <p><strong>Tên:</strong> {{ $order->user->first_name ?? '-' }}</p>
                        <p><strong>Email:</strong> {{ $order->user->email ?? '-' }}</p>
                    </div>
                </div>


                @php

                    // 1. Lấy subtotal từ chi tiết đơn
                    $subtotal = $order->orderDetails->sum(fn($d) => (int) $d->total);
                    // 2. Lấy các khoản khác (mặc định 0 nếu null)
                    $discount = (int) ($order->discount ?? 0);
                    $shippingFee = (int) ($order->shipping_fee ?? 0);
                    // Nếu chỉ có tax_rate mà không lưu tax_amount, dùng dòng dưới; còn nếu lưu tax_amount thì dùng trực tiếp
                    $tax =
                        $order->tax_amount !== null
                            ? (int) $order->tax_amount
                            : (int) round($subtotal * ($order->tax_rate / 100));
                    // 3. Tính grand total
                    $grandTotal = $subtotal - $discount + $shippingFee + $tax;
                @endphp

                <div class="card shadow-sm">
                    <div class="card-header fw-bold">Tóm tắt đơn</div>
                    <div class="card-body">
                        <p><strong>Tổng: {{ number_format($subtotal, 0, ',', '.') }}₫ </p>
                        <p><strong>Giảm giá:</strong> {{ number_format($discount, 0, ',', '.') }}₫</p>
                        <p><strong>Phí vận chuyển:</strong> {{ number_format($shippingFee, 0, ',', '.') }}₫</p>
                        <p><strong>Thuế ({{ $order->tax_rate ?? 0 }}%):</strong>
                            {{ number_format($tax, 0, ',', '.') }}₫</p>
                        <hr>
                        <p class="fs-5"><strong>Tổng cộng: {{ number_format($grandTotal, 0, ',', '.') }}₫
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Dòng thời gian đơn hàng thực tế --}}
        <div class="card shadow-sm">
            <div class="card-header fw-semibold">Dòng thời gian đơn hàng</div>
            <div class="card-body">
                <ul class="timeline">
                    <li><strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong>: Đơn hàng đã được tạo</li>
                    @if (in_array($order->order_status, ['pending', 'processing', 'shipping', 'delivered']))
                        <li><strong>{{ $order->created_at->addMinutes(5)->format('d/m/Y H:i') }}</strong>: Đơn hàng đã được
                            xác nhận</li>
                    @endif
                    @if (in_array($order->order_status, ['processing', 'shipping', 'delivered']))
                        <li><strong>{{ $order->created_at->addMinutes(15)->format('d/m/Y H:i') }}</strong>: Đang đóng gói
                            sản phẩm</li>
                    @endif
                    @if (in_array($order->order_status, ['shipping', 'delivered']))
                        <li><strong>{{ $order->created_at->addMinutes(30)->format('d/m/Y H:i') }}</strong>: Đang vận chuyển
                        </li>
                    @endif
                    @if ($order->order_status === 'delivered')
                        <li><strong>{{ $order->created_at->addHours(1)->format('d/m/Y H:i') }}</strong>: Giao hàng thành
                            công</li>
                    @endif
                    {{-- Đã hủy --}}
                    @if ($order->order_status === 'canceled')
                        <li>
                            <strong>{{ $order->updated_at->format('d/m/Y H:i') }}</strong>:
                            Đơn hàng đã bị hủy
                        </li>
                    @endif
                    {{-- Hoàn tiền --}}
                    @if ($order->payment_status === 'refund')
                        <li>
                            <strong>{{ $order->updated_at->format('d/m/Y H:i') }}</strong>:
                            Đã hoàn tiền đơn hàng
                        </li>
                    @endif
                    {{-- Đã trả hàng --}}
                    @if ($order->order_status === 'returned')
                        <li>
                            <strong>{{ $order->updated_at->format('d/m/Y H:i') }}</strong>:
                            Đơn hàng đã được trả hàng
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    {{-- Modal: Chỉnh sửa trạng thái đơn hàng --}}
    <div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="editOrderForm">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOrderModalLabel">Cập nhật trạng thái đơn hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="order_status" class="form-label">Trạng thái đơn hàng</label>
                            <select name="order_status" class="form-select" id="select-order-status">
                                @php
                                    $currentStatus = $order->order_status;
                                    $disabledBackStatuses = ['draft', 'pending', 'processing'];
                                    $lockedStatuses = ['shipping', 'delivered', 'returned', 'canceled'];
                                @endphp

                                @foreach (\App\Enums\OrderStatus::cases() as $case)
                                    @php
                                        $value = $case->value;
                                         if ($value === 'canceled') continue;

                                        // Nếu đã ở trạng thái cao (shipping+) thì ẩn các trạng thái quay lại
                                        $shouldHide =
                                            in_array($currentStatus, $lockedStatuses) &&
                                            in_array($value, $disabledBackStatuses);
                                    @endphp

                                    @if (!$shouldHide)
                                        <option value="{{ $value }}"
                                            {{ $currentStatus === $value ? 'selected' : '' }}>
                                            {{ ucfirst($value) }}
                                        </option>
                                    @endif
                                @endforeach

                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function showEditModal(orderId, currentStatus) {
            // 1) mở modal
            const modal = new bootstrap.Modal(document.getElementById('editOrderModal'));
            modal.show();

            // 2) gán action cho form
            document.getElementById('editOrderForm').action = `/admin/orders/${orderId}/update-status`;

            // 3) gán giá trị cho select
            const select = document.getElementById('select-order-status');
            if (select) {
                // ép về chữ thường để chắc khớp
                const status = currentStatus.toLowerCase();
                select.value = status;
            }
        }
    </script>
@endpush
