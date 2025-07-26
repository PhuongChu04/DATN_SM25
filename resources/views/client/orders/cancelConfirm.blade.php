@extends('client.layout.layout')

@section('content')
    <div class="flat-spacing-13">
        <div class="container-7">
            <div class="my-acount-content account-dashboard">
                <h4>Xác nhận huỷ đơn hàng</h4>

                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <p><strong>Mã đơn hàng:</strong> {{ $order->order_code }}</p>
                        <p><strong>Trạng thái:</strong> {{ ucfirst($order->order_status) }}</p>

                        <!-- Hiển thị chi tiết sản phẩm trong đơn hàng -->
                        @foreach ($order->details as $detail)
                            <div class="row mt-3">
                                <div class="col-3">
                                    <!-- Hiển thị ảnh sản phẩm -->
                                    <img src="{{ asset('storage/'.$detail->product->image_primary) }}" alt="{{ $detail->product_name }}" class="img-fluid" style="max-width: 80px; height: auto;">
                                </div>
                                <div class="col-9">
                                    <!-- Hiển thị tên sản phẩm -->
                                    <p><strong>{{ $detail->product_name }}</strong></p>
                                    <!-- Hiển thị phân loại, nếu có -->
                                    <p>Phân loại: {{ $detail->variant ? $detail->variant->size->name : 'Không có' }} / {{ $detail->variant ? $detail->variant->color->name : 'Không có' }}</p>
                                    <!-- Hiển thị số lượng -->
                                    <p>Số lượng: {{ $detail->quantity }}</p>
                                    <!-- Hiển thị đơn giá -->
                                    <p>Đơn giá: {{ number_format($detail->unit_price, 0, ',', '.') }} VND</p>
                                    <!-- Hiển thị tổng giá -->
                                    <p><strong>Tổng: {{ number_format($detail->total, 0, ',', '.') }} VND</strong></p>
                                </div>
                            </div>
                        @endforeach

                        <!-- Form xác nhận huỷ đơn -->
                        <form action="{{ route('client.orders.cancelFinalize', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            <p><strong>Lý do huỷ:</strong></p>
                            <div class="form-group">
                                <label for="reason">Chọn lý do huỷ:</label>
                                <select name="cancel_reason" id="reason" class="form-control">
                                    <option value="Cập nhật địa chỉ/số điện thoại nhận hàng">Cập nhật địa chỉ/số điện thoại nhận hàng</option>
                                    <option value="Thêm/Thay đổi mã giảm giá">Thêm/Thay đổi mã giảm giá</option>
                                    <option value="Thay đổi sản phẩm (kích thước, màu sắc, số lượng)">Thay đổi sản phẩm (kích thước, màu sắc, số lượng)</option>
                                    <option value="Thủ tục thanh toán rắc rối">Thủ tục thanh toán rắc rối</option>
                                    <option value="Tìm thấy chỗ mua khác tốt hơn">Tìm thấy chỗ mua khác tốt hơn</option>
                                    <option value="Không có nhu cầu mua nữa">Không có nhu cầu mua nữa</option>
                                    <option value="Lý do khác">Lý do khác</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-danger btn-sm">Xác nhận huỷ đơn</button>
                        </form>

                        <!-- Form Huỷ thao tác -->
                        <form action="{{ route('client.orders.cancelAction', $order->id) }}" method="POST" class="d-inline mt-3">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">Huỷ thao tác</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
