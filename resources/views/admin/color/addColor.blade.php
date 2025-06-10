@extends('admin.layouts.layout')

@section('content')


     <!-- Start Container Fluid -->
     <div class="container-xxl">

           <div class="row">
                 <div class="col-lg-12">
                       <div class="card">
                              <div class="card-header">
                                    <h4 class="card-title">Add Color</h4>
                              </div>
                              <div class="card-body">
                                    <div class="row">
                                          <form action="{{route('admin.color.storeColor')}}" method="post">
                                                @csrf
                                          <div class="col-lg-6">
                                                
                                                       <div class="mb-3">
                                                             <label for="value-name" class="form-label text-dark">Color Name
                                                                   </label>
                                                             <input type="text" id="value-name" name="name" class="form-control"
                                                                   placeholder="Enter Name">
                                                       </div>
                                               
                                          </div>
                                          <div class="col-lg-6">
                                                
                                                       <div class="">
                                                             <label for="attribute-id" class="form-label text-dark">Color Code</label>
                                                             <input type="text" id="attribute-id" name="code" class="form-control"
                                                                   placeholder="Enter ID">
                                                       </div>
                                                
                                          </div>
                                          
                                         
                                    </div>
                              </div>
                              <div class="card-footer border-top">
                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                              </div>
                              </form>
                       </div>
                 </div>
           </div>

     </div>
     <!-- End Container Fluid -->

    

@endsection