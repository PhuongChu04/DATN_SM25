@extends('admin.layouts.layout')

@section('content')


     <!-- Start Container Fluid -->
     <div class="container-xxl">

           <div class="row">
                 <div class="col-lg-12">
                       <div class="card">
                              <div class="card-header">
                                    <h4 class="card-title">Edit Color</h4>
                              </div>
                              <div class="card-body">
                                    <div class="row">
                                             <form action="{{route('admin.size.updateSize', $size->id)}}" method="post">
                                                @csrf
                                          <div class="col-lg-6">
                                             <input type="hidden" name="id" value="{{$size->id}}">
                                                
                                                       <div class="mb-3">
                                                             <label for="value-name" class="form-label text-dark">size Name
                                                                   </label>
                                                             <input type="text" id="value-name" name="name" class="form-control"
                                                                   placeholder="Enter Name" value="{{$size->name}}">
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