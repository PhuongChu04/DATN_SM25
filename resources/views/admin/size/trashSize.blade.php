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
                                                            <th>ID</th>
                                                            <th>Tên Size</th>
                                                            
                                                            <th></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @foreach ($trashedSizes as $size)
                                                            
                                                      
                                                       <tr>
                                                            <td>
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input" name="selected[]" value="{{ $size->id }}">
                                                                      <label class="form-check-label" for="customCheck2"></label>
                                                                 </div>
                                                            </td>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      
                                                                 </div>

                                                            </td>
                                                            <td>{{$size->name}}</td>
                                                           
               
                                                          
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="{{route('admin.size.restoreSize', $size->id)}}" class="btn btn-sm btn-primary" onclick="return confirm('bạn có muốn khôi phục Size này không?')">
                                                                           Khôi Phục
                                                                      </a>
                                                                      <form action="{{ route('admin.size.forceDeleteSize', $size->id) }}" method="POST" style="display:inline;">
                                                                           @csrf
                                                                           @method('DELETE')
                                                                           <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('bạn có muốn xóa vĩnh viễn size này?')">Xóa</button>
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

        