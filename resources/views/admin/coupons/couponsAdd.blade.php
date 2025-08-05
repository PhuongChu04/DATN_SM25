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
                  <h4 class="card-title">Trạng Thái Mã Giảm Giá</h4>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-lg-4">
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="status" value="0" id="status_active" checked>
                           <label class="form-check-label" for="status_active">Đang hoạt động</label>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="status" value="1" id="status_inactive">
                           <label class="form-check-label" for="status_inactive">Không hoạt động</label>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="status" value="2" id="status_future">
                           <label class="form-check-label" for="status_future">Kế hoạch tương lai</label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">Lịch Áp Dụng</h4>
               </div>
               <div class="card-body">
                  <div class="mb-3">
                     <label for="start-date" class="form-label text-dark">Ngày bắt đầu</label>
                     <input type="date" id="start-date" name="start_date" class="form-control" placeholder="dd-mm-yyyy">
                  </div>
                  <div class="mb-3">
                     <label for="end-date" class="form-label text-dark">Ngày kết thúc</label>
                     <input type="date" id="end-date" name="end_date" class="form-control" placeholder="dd-mm-yyyy">
                  </div>
                  <div class="mb-3">
                     <label for="usage_limit_per_user" class="form-label">Số lần sử dụng mỗi người</label>
                     <input type="number" name="usage_limit_per_user" id="usage_limit_per_user" class="form-control" min="1" placeholder="">
                  </div>
                  <div class="mb-3">
                     <label for="max_discount" class="form-label">Giảm tối đa</label>
                     <input type="number" name="max_discount" id="max_discount" class="form-control" placeholder="Áp dụng cho %">
                  </div>
                  <div class="mb-3">
                     <label for="min_order_amount" class="form-label">Giá trị đơn tối thiểu</label>
                     <input type="number" name="min_order_amount" id="min_order_amount" class="form-control" placeholder="Giá trị tối thiểu để áp mã">
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
                           <input type="text" id="coupons-name" name="coupons_name" class="form-control" placeholder="Nhập tên mã">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="mb-3">
                           <label for="coupons_quantity" class="form-label">Số lượng mã</label>
                           <input type="number" id="coupons_quantity" name="coupons_quantity" class="form-control" min="1" placeholder="Nhập số lượng">
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-6">
                        <div class="mb-3">
                           <label for="coupons_code" class="form-label">Mã giảm giá</label>
                           <input type="text" id="coupons_code" name="coupons_code" class="form-control" placeholder="Nhập mã">
                        </div>
                     </div>
                  </div>

                  <h4 class="card-title mb-3 mt-2">Loại Mã</h4>
                  <div class="row mb-3">
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

                  <div class="row">
                     <div class="col-lg-12">
                        <label for="discount-value" class="form-label">Giá trị giảm</label>
                        <input type="text" id="discount-value" name="discount_amount" class="form-control" placeholder="Nhập số tiền giảm">
                     </div>
                  </div>

                  <div class="row mt-3">
                     <div class="col-lg-12">
                        <label for="note" class="form-label">Mô tả</label>
                        <textarea id="note" name="description" class="form-control" placeholder="Mô tả thêm về mã này"></textarea>
                     </div>
                  </div>

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
                  <button type="submit" name="submit" class="btn btn-primary">Tạo Mã Giảm Giá</button>
               </div>
            </div>
         </div>
      </div>
   </form>
</div>
<!-- End Container Fluid -->

<!-- ========== Footer Start ========== -->
<footer class="footer">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12 text-center">
            <script>document.write(new Date().getFullYear())</script> &copy; Larkon. Thiết kế bởi
            <iconify-icon icon="iconamoon:heart-duotone" class="fs-18 align-middle text-danger"></iconify-icon>
            <a href="https://1.envato.market/techzaa" class="fw-bold footer-text" target="_blank">Techzaa</a>
         </div>
      </div>
   </div>
</footer>
<!-- ========== Footer End ========== -->

@endsection
