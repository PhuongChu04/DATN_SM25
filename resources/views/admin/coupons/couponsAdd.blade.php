@extends('admin.layouts.layout')
@section('content')

<!-- Start Container Fluid -->
<div class="container-xxl">
   <form action="{{route('admin.voucher.storeVoucher')}}" method="post">
      @csrf
      <div class="row">
         <div class="col-lg-5">
            

            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">Lịch Áp Dụng</h4>
               </div>
               <div class="card-body">
                  <div class="mb-3">
                     <label for="start-date" class="form-label text-dark">Ngày bắt đầu</label>
                     <input type="date" id="start-date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                  </div>
                  <div class="mb-3">
                     <label for="end-date" class="form-label text-dark">Ngày kết thúc</label>
                     <input type="date" id="end-date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                  </div>
                  <div class="mb-3">
                     <label for="usage_limit_per_user" class="form-label">Số lần sử dụng mỗi người</label>
                     <input type="number" name="usage_per_user" id="usage_limit_per_user" class="form-control" min="1" value="{{ old('usage_per_user', 1) }}">
                  </div>
                  
                  <div class="mb-3">
                     <label for="min_order_amount" class="form-label">Giá trị đơn tối thiểu</label>
                     <input type="number" name="min_order_value" id="min_order_amount" class="form-control" value="{{ old('min_order_value') }}" placeholder="Giá trị tối thiểu để áp mã">
                  </div>
               </div>
            </div>
         </div>

         <div class="col-lg-7">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">Thông Tin Mã Giảm Giá</h4>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="mb-3">
                           <label for="coupons-name" class="form-label">Tên mã</label>
                           <input type="text" id="coupons-name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nhập tên mã">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="mb-3">
                           <label for="coupons_quantity" class="form-label">Số lượng mã</label>
                           <input type="number" id="coupons_quantity" name="quantity" class="form-control" min="1" value="{{ old('quantity', 1) }}" placeholder="Nhập số lượng">
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-6">
                        <div class="mb-3">
                           <label for="coupons_code" class="form-label">Mã giảm giá</label>
                           <input type="text" id="coupons_code" name="code" class="form-control" value="{{ old('code') }}" placeholder="Nhập mã">
                        </div>
                     </div>
                  </div>

                  <h4 class="card-title mb-3 mt-2">Loại Mã</h4>
                  <div class="row mb-3" >
                     <div class="col-lg-4">
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="type" value="0" id="type_shipping" checked>
                           <label class="form-check-label" for="type_shipping">Miễn phí vận chuyển</label>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="type" value="1" id="type_percent">
                           <label class="form-check-label" for="type_percent">Phần trăm</label>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="type" value="2" id="type_fixed">
                           <label class="form-check-label" for="type_fixed">Số tiền cố định</label>
                        </div>
                     </div>
                  </div>

                  <div class="row" id="discount-value-group">
                     <div class="col-lg-12" id="discount-amount-wrapper">
                        <label for="discount-value" class="form-label">Giá trị giảm</label>
                        <input type="text" id="discount-value" name="discount_amount" class="form-control" value="{{ old('discount_amount') }}" placeholder="Nhập số tiền/ phần trăm giảm">
                     </div>
                     <div class="col-lg-12 mt-3" id="max-discount-wrapper">
                        <label for="max_discount_value" class="form-label">Giảm tối đa</label>
                        <input type="number" name="max_discount_value" id="max_discount_value" class="form-control" value="{{ old('max_discount_value') }}" placeholder="Áp dụng cho %">
                     </div>
                  </div>
                  
                  <div class="row mt-3">
                     <div class="col-lg-12">
                        <label for="note" class="form-label">Mô tả</label>
                        <textarea id="note" name="description" class="form-control" placeholder="Mô tả thêm về mã này">{{ old('description') }}</textarea>
                     </div>
                  </div>

                  <!-- NEW: Applied products & categories -->
                  <div class="row mt-3">
                     <div class="col-lg-6">
                        <label for="applied_products" class="form-label">Sản phẩm áp dụng</label>
                        <select name="applied_products[]" id="applied_products" class="form-control" multiple>
                           @if(isset($products) && count($products))
                              @foreach($products as $product)
                                 <option value="{{ $product->id }}"
                                    {{ in_array($product->id, old('applied_products', [])) ? 'selected' : '' }}>
                                    {{ $product->name }}
                                 </option>
                              @endforeach
                           @endif
                        </select>
                        <small class="text-muted">Giữ Ctrl/Cmd để chọn nhiều</small>
                     </div>

                     <div class="col-lg-6">
                        <label for="applied_categories" class="form-label">Danh mục áp dụng</label>
                        <select name="applied_categories[]" id="applied_categories" class="form-control" multiple>
                           @if(isset($categories) && count($categories))
                              @foreach($categories as $cat)
                                 <option value="{{ $cat->id }}"
                                    {{ in_array($cat->id, old('applied_categories', [])) ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                 </option>
                              @endforeach
                           @endif
                        </select>
                        <small class="text-muted">Giữ Ctrl/Cmd để chọn nhiều</small>
                     </div>
                  </div>
                  <!-- END NEW -->

                  <div class="mt-3">
                     <label class="form-label">Kích hoạt?</label><br>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_active" value="1" id="is_active_yes" checked>
                        <label class="form-check-label" for="is_active_yes">Có</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_active" value="0" id="is_active_no">
                        <label class="form-check-label" for="is_active_no">Không</label>
                     </div>
                  </div>
               </div>

               <div class="card-footer border-top">
                  <a href="{{ route('admin.voucher.listVoucher') }}" class="btn btn-outline-secondary">
                     ⬅️ Quay lại
                  </a>
                  <button type="submit" name="submit" class="btn btn-primary">Tạo Mã Giảm Giá</button>
               </div>
              
            </div>
         </div>
      </div>
   </form>
</div>
<!-- End Container Fluid -->

<script>
   document.addEventListener('DOMContentLoaded', function () {
       const radios = document.querySelectorAll('input[name="type"]');
       const discountGroup = document.getElementById('discount-value-group');
       const discountAmountWrapper = document.getElementById('discount-amount-wrapper');
       const maxDiscountWrapper = document.getElementById('max-discount-wrapper');
   
       function updateDiscountInputs() {
           const selected = document.querySelector('input[name="type"]:checked').value;
   
           if (selected === '0') { // miễn phí vận chuyển
               discountGroup.style.display = 'none';
           } else {
               discountGroup.style.display = 'flex';
               if (selected === '1') { // phần trăm
                   discountAmountWrapper.style.display = 'block';
                   maxDiscountWrapper.style.display = 'block';
               } else if (selected === '2') { // số tiền cố định
                   discountAmountWrapper.style.display = 'block';
                   maxDiscountWrapper.style.display = 'none';
               }
           }
       }
   
       radios.forEach(radio => {
           radio.addEventListener('change', updateDiscountInputs);
       });
   
       updateDiscountInputs(); // Gọi khi load trang
   });
</script>

@endsection
