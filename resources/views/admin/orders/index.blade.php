@extends('admin.layouts.layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="container py-4">
        <h3 class="fs-4 fw-semibold mb-4">Order Overview</h3>

        {{-- Cards Overview --}}
        <div class="row g-4 mb-5">
            @php
                $statuses = [
                    ['count' => $orderCancel, 'label' => 'Order Cancel', 'icon' => 'cart-x', 'color' => 'danger'],
                    ['count' => $orderDelivering, 'label' => 'Order Delivering', 'icon' => 'truck', 'color' => 'info'],
                    ['count' => $pendingPayment, 'label' => 'Pending Payment', 'icon' => 'clock', 'color' => 'warning'],
                    ['count' => $orderDelivered, 'label' => 'Delivered', 'icon' => 'box-seam', 'color' => 'success'],
                ];
            @endphp
            @foreach ($statuses as $item)
                <div class="col-md-3">
                    <div
                        class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center justify-content-between">
                        <div>
                            <div class="fs-3 fw-bold">{{ $item['count'] }}</div>
                            <small class="text-muted">{{ $item['label'] }}</small>
                        </div>
                        <div class="bg-light p-3 rounded-circle">
                            <i class="bi bi-{{ $item['icon'] }} fs-4 text-{{ $item['color'] }}"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Orders Table --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="table-responsive p-3">
                <table class="table table-hover table-striped align-middle text-nowrap rounded">
                    <thead class="table-light text-uppercase text-center small">
                        <tr>
                            <th>Order ID</th>
                            <th>Created at</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="text-center">
                                <td>#{{ $order->order_code }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="text-danger fw-semibold">{{ $order->user->email }}</td>
                                <td class="fw-medium">{{ number_format($order->total_price, 0, ',', '.') }}₫</td>

                                <td>
                                    @php
                                        $badgeClass = match ($order->payment_status) {
                                            'paid' => 'bg-success',
                                            'refund' => 'bg-warning text-dark',
                                            'unpaid' => 'bg-secondary',
                                            default => 'bg-light text-dark',
                                        };
                                    @endphp
                                    <span class="badge rounded-pill px-3 py-2 {{ $badgeClass }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td>{{ ucfirst($order->order_status) }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="btn btn-sm btn-outline-primary me-1" title="Xem chi tiết">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <button onclick="showEditModal({{ $order->id }})"
                                        class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <button onclick="showDeleteModal({{ $order->id }})"
                                        class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal: View Order --}}
        <div class="modal fade" id="modalViewOrder" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="orderDetailContent">
                        <div class="text-center py-3">Loading...</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal: Edit Order --}}
        <div class="modal fade" id="modalEditOrder" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form id="formEditOrder" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update Order Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <select name="order_status" class="form-select" required>
                                <option value="draft">Draft</option>
                                <option value="completed">Completed</option>
                                <option value="delivering">Delivering</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal: Delete Order --}}
        <div class="modal fade" id="modalDeleteOrder" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form id="formDeleteOrder" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger">Delete Order</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this order?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function showEditModal(orderId) {
                document.getElementById('formEditOrder').action = '/admin/order/update-status/' + orderId;
                new bootstrap.Modal(document.getElementById('modalEditOrder')).show();
            }

            function showDeleteModal(orderId) {
                document.getElementById('formDeleteOrder').action = '/admin/orders/' + orderId;
                new bootstrap.Modal(document.getElementById('modalDeleteOrder')).show();
            }
        </script>
    @endpush
@endsection
