@extends('admin.layouts.layout')
@section('content')

<!-- Start Container Fluid -->
<div class="container-xxl">
  <form action="{{route('admin.voucher.updateVoucher',$voucher->id)}}" method="post">
    @csrf
    <div class="row">

      <!-- Thông tin mã giảm giá -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Thông tin mã giảm giá</h4>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="coupons-name" class="form-label">Tên mã giảm giá</label>
              <input type="text" id="coupons-name" name="name" value="{{$voucher->name}}" class="form-control" placeholder="Nhập tên">
            </div>
            <div class="mb-3">
              <label for="coupons-code" class="form-label">Mã áp dụng</label>
              <input type="text" id="coupons-code" name="code" value="{{$voucher->code}}" class="form-control" placeholder="Nhập mã">
            </div>
            <div class="mb-3">
              <label for="coupons_quantity" class="form-label">Số lượng</label>
              <input type="number" id="coupons_quantity" name="quantity" value="{{$voucher->quantity}}" class="form-control" min="1" placeholder="Nhập số lượng">
            </div>
            <div class="mb-3">
              <label for="usage_limit_per_user" class="form-label">Số lần sử dụng mỗi người</label>
              <input type="number" name="usage_per_user" id="usage_limit_per_user" class="form-control" min="1" value="{{$voucher->usage_per_user}}">
            </div>
            <div class="mb-3">
              <label for="min_order_amount" class="form-label">Giá trị đơn tối thiểu</label>
              <input type="number" name="min_order_value" id="min_order_amount" class="form-control" value="{{$voucher->min_order_value}}" placeholder="Giá trị tối thiểu để áp mã">
            </div>
          </div>
        </div>
      </div>

      <!-- Cấu hình giảm giá và thời gian hiệu lực -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Cấu hình giảm giá</h4>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-lg-4">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="type" value="0" id="type_0" @if($voucher->type == 0)checked @endif>
                  <label class="form-check-label" for="type_0">Miễn phí vận chuyển</label>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="type" value="1" id="type_1" @if($voucher->type == 1)checked @endif>
                  <label class="form-check-label" for="type_1">Giảm theo %</label>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="type" value="2" id="type_2" @if($voucher->type == 2)checked @endif>
                  <label class="form-check-label" for="type_2">Giảm theo tiền</label>
                </div>
              </div>
            </div>

            {{-- 2 input sẽ ẩn/hiện theo loại mã --}}
            <div id="discount-wrapper">
              <div class="mb-3" id="discount-amount-wrapper">
                <label for="discount-value" class="form-label">Giá trị giảm</label>
                <input type="text" id="discount-value" name="discount_amount" class="form-control" value="{{$voucher->discount_amount}}" placeholder="Nhập số tiền hoặc %">
              </div>
              <div class="mb-3" id="max-discount-wrapper">
                <label for="max_discount" class="form-label">Giảm tối đa</label>
                <input type="text" id="max_discount" name="max_discount_value" class="form-control" value="{{$voucher->max_discount}}" placeholder="Giảm không quá bao nhiêu">
              </div>
            </div>

          </div>
        </div>

        <div class="card mt-3">
          <div class="card-header">
            <h4 class="card-title">Thời gian hiệu lực</h4>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="start-date" class="form-label text-dark">Ngày bắt đầu</label>
              <input type="date" id="start-date" name="start_date" value="{{ \Carbon\Carbon::parse($voucher->start_date)->format('Y-m-d') }}" class="form-control">
            </div>
            <div class="mb-3">
              <label for="end-date" class="form-label text-dark">Ngày kết thúc</label>
              <input type="date" id="end-date" name="end_date" value="{{ \Carbon\Carbon::parse($voucher->end_date)->format('Y-m-d') }}" class="form-control">
            </div>
          </div>
        </div>
      </div>

      <!-- Trạng thái và ghi chú -->
      <div class="col-lg-12 mt-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Trạng thái & Ghi chú</h4>
          </div>
          <div class="card-body">
            <div class="form-check mb-3">
              <input type="hidden" name="is_active" value="0">
              <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @if($voucher->is_active) checked @endif>
              <label class="form-check-label" for="is_active">Mã đang bật</label>
            </div>

            <div class="mb-3">
              <label for="note" class="form-label">Ghi chú</label>
              <textarea id="note" name="description" class="form-control" placeholder="Ghi chú thêm nếu có">{{$voucher->description}}</textarea>
            </div>
          </div>
          <div class="card-footer border-top text-end">
            <a href="{{ route('admin.voucher.listVoucher') }}" class="btn btn-outline-secondary">
              ⬅️ Quay lại
            </a>
            <button type="submit" name="submit" class="btn btn-primary" onclick="return confirm('Bạn có muốn cập nhật không?')">Lưu thay đổi</button>
          </div>
        </div>
      </div>

    </div>
  </form>
</div>
<!-- End Container Fluid -->

{{-- JS xử lý ẩn hiện input --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="type"]');
    const discountWrapper = document.getElementById('discount-wrapper');
    const discountAmountWrapper = document.getElementById('discount-amount-wrapper');
    const maxDiscountWrapper = document.getElementById('max-discount-wrapper');

    function updateDiscountInput() {
      const selectedType = document.querySelector('input[name="type"]:checked').value;

      if (selectedType === '0') {
        discountWrapper.style.display = 'none';
      } else if (selectedType === '1') {
        discountWrapper.style.display = 'block';
        discountAmountWrapper.style.display = 'block';
        maxDiscountWrapper.style.display = 'block';
      } else if (selectedType === '2') {
        discountWrapper.style.display = 'block';
        discountAmountWrapper.style.display = 'block';
        maxDiscountWrapper.style.display = 'none';
      }
    }

    radios.forEach(r => r.addEventListener('change', updateDiscountInput));
    updateDiscountInput();
  });
</script>

@endsection
