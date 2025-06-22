@extends('admin.layouts.layout')

@section('content')

               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="row">
                         <div class="col-xl-12">
                              <div class="card">
                                   <div class="card-header d-flex justify-content-between align-items-center gap-1">
                                        <h4 class="card-title flex-grow-1">Danh Sách Đã Xóa</h4>

                                        <a href="product-add.html" class="btn btn-sm btn-primary">
                                             Add Product
                                        </a>

                                        <div class="dropdown">
                                             <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-expanded="false">
                                                  This Month
                                             </a>
                                             <div class="dropdown-menu dropdown-menu-end">
                                                  <!-- item-->
                                                  <a href="#!" class="dropdown-item">Download</a>
                                                  <!-- item-->
                                                  <a href="#!" class="dropdown-item">Export</a>
                                                  <!-- item-->
                                                  <a href="#!" class="dropdown-item">Import</a>
                                             </div>
                                        </div>
                                   </div>
                                   <div>
                                        <div class="table-responsive">
                                             <table class="table align-middle mb-0 table-hover table-centered">
                                                  <thead class="bg-light-subtle">
                                                       <tr>
                                                            <th style="width: 20px;">
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input" id="checkAll">
                                                                      <label class="form-check-label" for="customCheck1"></label>
                                                                 </div>
                                                            </th>
                                                            <th>Tên Vouchers</th>
                                                            <th>Mã Vouchers</th>
                                                            <th>Ghi Chú</th>
                                                            <th>Phần Trăm giảm giá</th>
                                                            <th>loại</th>
                                                            <th>Ngày bắt đầu</th>
                                                            <th>ngày kết thúc</th>
                                                            <th>trạng thái</th>
                                                            <th></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       

                                                       @foreach ($trashedVouchers as $voucher)
                                                       <tr>
                                                            <td>
                                                                 {{ $loop->iteration }}
                                                            </td>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input" id="customCheck2">
                                                                      <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="assets/images/product/p-1.png" alt="" class="avatar-md">
                                                                      </div>
                                                                      <div>
                                                                           <a href="#!" class="text-dark fw-medium fs-15">{{$voucher->name}}</a>
                                                                           <p class="text-muted mb-0 mt-1 fs-13"><span>Fashion</p>
                                                                      </div>
                                                                 </div>

                                                            </td>
                                                            <td>{{$voucher->code}}</td>
                                                            <td>{{$voucher->description}}</td>
                                                            <td>{{$voucher->discount_amount}} %</td>
                                                            <td>
                                                                 @if($voucher->type == 0)
                                                                     <span class="badge bg-light text-dark fs-12">
                                                                         <i class="bx bx-send"></i> Miễn Phí Ship
                                                                     </span>
                                                                 @elseif($voucher->type == 1)
                                                                     <span class="badge bg-light text-dark fs-12">
                                                                         <i class="bx bx-percent"></i> Percentage
                                                                     </span>
                                                                 @elseif($voucher->type == 2)
                                                                     <span class="badge bg-light text-dark fs-12">
                                                                         <i class="bx bx-dollar-circle"></i> Fixed Amount
                                                                     </span>
                                                                 @else
                                                                     <span class="badge bg-light text-muted fs-12">
                                                                         <i class="bx bx-question-mark"></i> Unknown
                                                                     </span>
                                                                 @endif
                                                             </td>
                                                             
                                                            <td>{{$voucher->start_date}}</td>
                                                            <td>{{$voucher->end_date}}</td>
                                                            <td>
                                                                 @if($voucher->status == 0)
                                                                     <span class="badge text-success bg-success-subtle fs-12">
                                                                         <i class="bx bx-check-double"></i> Active
                                                                     </span>
                                                                 @elseif($voucher->status == 1)
                                                                     <span class="badge text-danger bg-danger-subtle fs-12">
                                                                         <i class="bx bx-x"></i> In Active
                                                                     </span>
                                                                 @elseif($voucher->status == 2)
                                                                     <span class="badge text-warning bg-warning-subtle fs-12">
                                                                         <i class="bx bx-time"></i> Future Plan
                                                                     </span>
                                                                 @else
                                                                     <span class="badge text-secondary bg-secondary-subtle fs-12">
                                                                         <i class="bx bx-question-mark"></i> Unknown
                                                                     </span>
                                                                 @endif
                                                             </td>
                                                             
                                                             <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="{{route('admin.voucher.restoreVoucher', $voucher->id)}}" class="btn btn-sm btn-primary" onclick="return confirm('bạn có muốn khôi phục màu này không?')">
                                                                           Khôi Phục
                                                                      </a>
                                                                      <form action="{{ route('admin.voucher.forceDeleteVoucher', $voucher->id) }}" method="POST" style="display:inline;">
                                                                           @csrf
                                                                           @method('DELETE')
                                                                           <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('bạn có muốn xóa vĩnh viễn màu này?')">Xóa</button>
                                                                      </form>
                                                                 </div>
                                                            </td>
                                                       </tr>
                                                       @endforeach

                                                  </tbody>
                                             </table>
                                        </div>
                                        <!-- end table-responsive -->
                                   </div>
                                   <div class="card-footer border-top">
                                        <nav aria-label="Page navigation example">
                                             <ul class="pagination justify-content-end mb-0">
                                                  <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                                  <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                                  <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                                  <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                                  <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                                             </ul>
                                        </nav>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
               <!-- End Container Fluid -->


               
@endsection

        