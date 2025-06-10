@extends('admin.layouts.layout')

@section('content')


     <!-- Start Container Fluid -->
     <div class="container-xxl">

           <div class="row">
                 <div class="col-lg-12">
                       <div class="card">
                              <div class="card-header">
                                    <h4 class="card-title">Add Size</h4>
                              </div>
                              <div class="card-body">
                                    <div class="row">
                       
                                          <div class="col-lg-12">
                                                <form>
                                                       <div class="mb-3">
                                                             <label for="value-name" class="form-label text-dark">Size Name
                                                                   </label>
                                                             <input type="text" id="value-name" name="name" class="form-control"
                                                                   placeholder="Enter Name">
                                                       </div>
                                                </form>
                                          </div>
                                                                                
                                         
                                    </div>
                              </div>
                              <div class="card-footer border-top">
                                    <a href="#!" class="btn btn-primary">Save Change</a>
                              </div>
                       </div>
                 </div>
           </div>

     </div>
     <!-- End Container Fluid -->

    

@endsection