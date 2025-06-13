@extends('admin.layouts.layout')
@section('content')



            <!-- Start Container Fluid -->

            <div class="container-xxl">
               <form action="{{route('admin.voucher.updateVoucher',$voucher->id)}}" method="post">
                  @csrf
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Coupon Status</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check">
                                             <input class="form-check-input" type="radio" name="status" value="0" id="status" @if($voucher->status == 0)checked @endif>
                                             <label class="form-check-label" for="status">
                                                  Active
                                             </label>
                                        </div>
                                        
                                   </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="1" id="status" @if($voucher->status == 1)checked @endif>
                                        <label class="form-check-label" for="status">
                                             In Active
                                        </label>
                                   </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="2" id="status" @if($voucher->status == 2)checked @endif>
                                        <label class="form-check-label" for="status">
                                            Future Plan
                                        </label>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Date Schedule</h4>
                        </div>
                        <div class="card-body">
                            
                                <div class="mb-3">
                                     <label for="start-date" class="form-label text-dark">Start Date</label>
                                     <input type="date" id="start-date" name="start_date" value="{{ \Carbon\Carbon::parse($voucher->start_date)->format('Y-m-d') }}" class="form-control " placeholder="dd-mm-yyyy">
                                </div>
                           
                                <div class="mb-3">
                                     <label for="end-date" class="form-label text-dark">End Date</label>
                                     <input type="date" id="end-date" name="end_date" value="{{ \Carbon\Carbon::parse($voucher->end_date)->format('Y-m-d') }}" class="form-control " placeholder="dd-mm-yyyy">
                                </div>
                           
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Coupon Information</h4>
                        </div>
                        <div class="card-body">
                         <div class="row">
                              <div class="col-lg-6">
                                   <div class="mb-3">
                                        <label for="coupons-code" class="form-label">Coupons Name</label>
                                        <input type="text" id="coupons-name" name="coupons_name" value="{{$voucher->name}}" class="form-control" placeholder="Name enter">
                                   </div>
                              </div>
                              <div class="col-lg-6">
                                   <div class="mb-3">
                                        <label for="coupons-code" class="form-label">Coupons Quantity</label>
                                        <input type="number" id="coupons_quantity" name="coupons_quantity" value="{{$voucher->quantity}}" class="form-control" min="1" placeholder="Quantity enter">
                                   </div>
                              </div>
                         </div>
                        
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="coupons-code" class="form-label">Coupons Code</label>
                                        <input type="text" id="coupons-code" name="coupons_code" value="{{$voucher->code}}"   class="form-control" placeholder="Code enter">
                                   </div>
                                </div>
                                <div class="col-lg-6">
                                    
                                        {{-- <label for="product-categories" class="form-label">Discount Products</label>
                                        <select class="form-control" name="product_categories" id="product-categories" data-choices data-choices-groups data-placeholder="Select Categories" name="choices-single-groups">
                                             <option value="">Choose a categories</option>
                                             <option value="Fashion">Fashion</option>
                                             <option value="Electronics">Electronics</option>
                                             <option value="Footwear">Footwear</option>
                                             <option value="Sportswear">Sportswear</option>
                                             <option value="Watches">Watches</option>
                                             <option value="Furniture">Furniture</option>
                                             <option value="Appliances">Appliances</option>
                                             <option value="Headphones">Headphones</option>
                                             <option value="Other Accessories">Other Accessories</option>
                                        </select> --}}
                                  
                                </div>
                               
                            </div>
                            <h4 class="card-title mb-3 mt-2">Coupons Types</h4>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check">
                                             <input class="form-check-input" type="radio" name="type" value="0" id="type" @if($voucher->type == 0)checked @endif>
                                             <label class="form-check-label" for="type">
                                                Free Shipping
                                             </label>
                                        </div>
                                        
                                   </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" value="1" id="type"@if($voucher->type == 1)checked @endif>
                                        <label class="form-check-label" for="type">
                                            Percentage
                                        </label>
                                   </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" value="2" id="type"@if($voucher->type == 2)checked @endif>
                                        <label class="form-check-label" for="type">
                                            Fixed Amount
                                        </label>
                                   </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <label for="discount-value" class="form-label">Discount Amount</label>
                                        <input type="text" id="discount-value" name="discount_amount" class="form-control" value="{{$voucher->discount_amount}}" placeholder="Discount Amount">
                                   </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
                                  <div class="">
                                      <label for="note" class="form-label">Note</label>
                                      <textarea type="note" id="note" name="note" class="form-control"  placeholder="description">{{$voucher->description}}</textarea>
                                 </div>
                              </div>
                          </div>
                        </div>
                        <div class="card-footer border-top">
                            <button type="submit" name="submit" class="btn btn-primary" onclick="return confirm('bạn có muốn update không?')">Update Coupon</button>
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
                            <script>document.write(new Date().getFullYear())</script> &copy; Larkon. Crafted by <iconify-icon icon="iconamoon:heart-duotone" class="fs-18 align-middle text-danger"></iconify-icon> <a
                                href="https://1.envato.market/techzaa" class="fw-bold footer-text" target="_blank">Techzaa</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- ========== Footer End ========== -->

   

 


@endsection