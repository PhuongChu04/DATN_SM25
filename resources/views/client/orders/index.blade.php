@extends('client.layout.layout')

@section('content')
<div class="flat-spacing-13">
  <div class="container-7">
    <div class="btn-sidebar-mb d-lg-none">
      <button data-bs-toggle="offcanvas" data-bs-target="#mbAccount">
        <i class="icon icon-sidebar"></i>
      </button>
    </div>

    <div class="main-content-account">
      {{-- GIỮ NGUYÊN SIDEBAR --}}
      <div class="sidebar-account-wrap sidebar-content-wrap sticky-top d-lg-block d-none">
        <ul class="my-account-nav">
          <li><a href="{{ route('client.account') }}" class="text-sm link fw-medium my-account-nav-item">Dashboard</a></li>
          <li><a href="{{ route('client.orders.index') }}" class="text-sm link fw-medium my-account-nav-item active">My Orders</a></li>
          <li><a href="#" class="text-sm link fw-medium my-account-nav-item">My Wishlist</a></li>
          <li><a href="{{ route('client.addresses.index') }}" class="text-sm link fw-medium my-account-nav-item">Addresses</a></li>
          <li><a href="{{ route('client.accountDetail') }}" class="text-sm link fw-medium my-account-nav-item">Account Details</a></li>
          <li><a href="{{ route('auth.logoutClient') }}" class="text-sm link fw-medium my-account-nav-item" onclick="return confirm('Bạn có muốn đăng xuất không?')">Log Out</a></li>
        </ul>
      </div>

      {{-- NỘI DUNG CHÍNH --}}
      <div class="my-acount-content account-dashboard w-100">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="mb-0">Danh Sách Đơn Hàng</h4>
        </div>

        {{-- Form tìm kiếm --}}
        <form method="GET" action="{{ route('client.orders.index') }}" class="orders-search">
          <input type="text" name="order_code" class="form-control" placeholder="Mã đơn hàng" value="{{ request('order_code') }}">
          <select name="order_status" class="form-control">
            <option value="">Trạng thái</option>
            <option value="pending" {{ request('order_status')=='pending'?'selected':'' }}>Đang chờ</option>
            <option value="processing" {{ request('order_status')=='processing'?'selected':'' }}>Đang xử lý</option>
            <option value="shipped" {{ request('order_status')=='shipped'?'selected':'' }}>Đang giao hàng</option>
            <option value="delivered" {{ request('order_status')=='delivered'?'selected':'' }}>Đã hoàn thành</option>
            <option value="cancelled" {{ request('order_status')=='cancelled'?'selected':'' }}>Đã huỷ</option>
            <option value="waiting_for_cancellation" {{ request('order_status')=='waiting_for_cancellation'?'selected':'' }}>Chờ xác nhận huỷ</option>
          </select>
          <input type="text" name="product_name" class="form-control" placeholder="Tên sản phẩm" value="{{ request('product_name') }}">
          <select name="payment_method" class="form-control">
            <option value="">Phương thức thanh toán</option>
            <option value="vnpay" {{ request('payment_method')=='vnpay'?'selected':'' }}>VNPay</option>
            <option value="cod" {{ request('payment_method')=='cod'?'selected':'' }}>Thanh toán khi nhận hàng (COD)</option>
          </select>
          <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>

        @if($orders->isEmpty())
          <div class="orders-empty text-center">
            <div class="mb-3"><i class="bi bi-bag-x fs-1 text-muted"></i></div>
            <h6 class="text-muted">Bạn chưa có đơn hàng nào</h6>
            <p class="text-muted">Hãy mua sắm để có đơn hàng đầu tiên!</p>
            <a href="{{ route('client.homeClient') }}" class="btn btn-outline-dark">Mua sắm ngay</a>
          </div>
        @else
          @foreach($orders as $order)
            <div class="order-card card mb-3 shadow-sm">
              <div class="card-body">

                {{-- Header: Trạng thái + Thanh toán + Mã đơn --}}
                <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between mb-2">
                  <div class="d-flex flex-wrap gap-3">
                    <div>
                      <strong>Trạng thái:</strong>
                      <span class="badge
                        @if ($order->order_status=='pending') bg-warning
                        @elseif ($order->order_status=='processing') bg-info
                        @elseif ($order->order_status=='shipped') bg-primary
                        @elseif ($order->order_status=='delivered') bg-success
                        @elseif ($order->order_status=='cancelled') bg-danger
                        @elseif ($order->order_status=='waiting_for_cancellation') bg-secondary
                        @else bg-light text-dark @endif">
                        @switch($order->order_status)
                          @case('pending') Đang chờ @break
                          @case('processing') Đang xử lý @break
                          @case('shipped') Đang giao hàng @break
                          @case('delivered') Đã hoàn thành @break
                          @case('cancelled') Đã huỷ @break
                          @case('waiting_for_cancellation') Chờ xác nhận huỷ @break
                          @default Chưa xác định
                        @endswitch
                      </span>
                    </div>

                    <div>
                      <strong>Thanh toán:</strong>
                      <span class="badge
                        @if ($order->payment_status=='paid') bg-success
                        @elseif ($order->payment_status=='failed') bg-primary
                        @elseif ($order->payment_status=='unpaid') bg-danger
                        @else bg-light text-dark @endif">
                        @switch($order->payment_status)
                          @case('paid') Đã thanh toán @break
                          @case('failed') Thanh toán thất bại @break
                          @case('unpaid') Chưa thanh toán @break
                          @default Không xác định
                        @endswitch
                      </span>
                    </div>
                  </div>

                  <div>
                    <strong>Mã đơn:</strong>
                    <span class="badge bg-light text-dark ms-1">#{{ $order->order_code }}</span>
                  </div>
                </div>

                <hr class="my-2">

                {{-- Danh sách sản phẩm trong đơn (GIỮ LOGIC: $order->details) --}}
                @foreach ($order->details as $detail)
                  <div class="d-flex align-items-center py-3 border-bottom order-item-row">
                    <img
                      src="{{ asset('storage/'.$detail->product->image_primary) }}"
                      alt="{{ $detail->product_name }}"
                      class="rounded border me-3"
                      style="width:80px;height:80px;object-fit:cover"
                    >
                    <div class="flex-grow-1">
                      <div class="fw-semibold">{{ $detail->product_name }}</div>
                      <div class="text-muted small">
                        Phương thức:
                        @if ($order->payment_method=='vnpay') VNPay
                        @elseif ($order->payment_method=='cod') Thanh toán khi nhận hàng (COD)
                        @else Không xác định @endif
                      </div>
                      <div class="text-muted small">
                        Phân loại:
                        {{ $detail->variant?($detail->variant->size->name ?? '—'):'Không có' }}
                        /
                        {{ $detail->variant?($detail->variant->color->name ?? '—'):'Không có' }}
                      </div>
                      <div class="text-muted small">Số lượng: x{{ $detail->quantity }}</div>
                    </div>
                    <div class="text-end">
                      <div class="text-muted small">Đơn giá</div>
                      <div class="fw-semibold">{{ number_format($detail->unit_price,0,',','.') }} VND</div>
                      <div class="text-muted small mt-1">Tổng</div>
                      <div class="fw-bold text-danger">{{ number_format($detail->total,0,',','.') }} VND</div>
                    </div>
                  </div>

                  {{-- Nút đánh giá (khi đã giao) – GIỮ LOGIC Sentinel + Review --}}
                  @if ($order->order_status == 'delivered')
                    @php
                      $review = \App\Models\Review::where('user_id', optional(Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser())->id)
                        ->where('product_id', $detail->product->id)
                        ->where('order_id', $order->id)
                        ->first();
                    @endphp
                    <div class="pt-2">
                      @if ($review)
                        <a href="{{ route('client.reviews.create', ['orderId'=>$order->id,'productId'=>$detail->product->id]) }}"
                           class="btn btn-warning btn-sm">Sửa đánh giá</a>
                      @else
                        <a href="{{ url('reviews/create/'.$order->id.'/'.$detail->product->id) }}"
                           class="btn btn-warning btn-sm">Đánh giá</a>
                      @endif
                    </div>
                  @endif
                @endforeach

                {{-- Footer: hành động --}}
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <div class="fw-bold">
                    Thành tiền: <span class="text-danger">{{ number_format($order->total_price,0,',','.') }} VND</span>
                  </div>
                  <div class="d-flex gap-2">
                    <a href="{{ route('client.orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem chi tiết</a>

                    @if(in_array($order->order_status, ['pending','processing']))
                        <form action="{{ route('client.orders.cancel', $order->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn có chắc chắn muốn huỷ đơn hàng này?')">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Huỷ đơn</button>
                        </form>
                    @endif

                    {{-- Nút thanh toán lại --}}
                    @if ($order->payment_status == 'failed')
                        <a href="{{ route('order.continuePayment', $order->id) }}" class="btn btn-warning btn-sm">
                            Thanh toán lại
                        </a>
                        @endif
                    </div>

                </div>

              </div>
            </div>
          @endforeach

          {{-- Phân trang --}}
          <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

{{-- STYLE NHẸ CHO GIAO DIỆN --}}
<style>
  .orders-search{
    display:grid;grid-template-columns:repeat(4,1fr) 120px;gap:10px;margin-bottom:24px
  }
  .orders-search .form-control{border-radius:8px}
  .orders-search .btn{border-radius:8px}
  @media(max-width:991px){
    .orders-search{grid-template-columns:1fr}
  }

  .orders-empty .btn{border-radius:8px}
  .order-card{border:none;border-radius:14px}
  .order-item-row:last-of-type{border-bottom:0}
  .order-card {
    border: none;
    border-radius: 14px;
    background: #fff;
    padding: 15px;
    margin-bottom: 30px; /* Tăng khoảng cách giữa các đơn hàng */
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.order-card:last-child {
    margin-bottom: 50px; /* Cho đơn cuối thêm khoảng cách với footer */
}

</style>
@endsection
