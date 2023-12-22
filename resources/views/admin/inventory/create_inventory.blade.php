@extends('layout.admin')

@section('stylesheet')
@endsection
@section('css')
<link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/cropper.css')}}" rel="stylesheet" type="text/css">
    <style>
        span.select2-container{
            width: 100% !important;
        }
    </style>
@endsection

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Create Inventory</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Create Inventory</li>
        </ol>
    </div>
    <div class="row">
            @if(session()->has('success'))
            <p class="alert alert-success" role="alert">{!! session()->get('success') !!}</p>
              @endif
              
      </div>
<div class="page-content">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Create new Inventory</div>
      </div>
      <div class="ibox-body">
          <div class="row">
            <div class="col-md-12">
                {{-- @if(session()->has('success'))
                {!! session()->get('success') !!}
              @endif --}}
              <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                <a href="{{ route('admin.inventory.list') }}" class="btn btn-success">List of Inventories</a>
              </div>
                  <form action="{{ route('admin.inventory.store') }}" method="post" enctype="multipart/form-data" >
                      @csrf
                <div class="form-row">
                    <div class="required col-md-4">
                        <label>Product Name</label>
                    <select name="product" required id="text" class="form-control text-capitalize">
                        <option value=""  class="text-capitalize">Choose Product Name</option>
                         @foreach($product as $show)
                          <option value="{{ $show->id }}" class="text-capitalize">{{ $show->name }}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="col-md-4">
                        <label>Product Category</label>
                    <select name="category" required id="text" class="form-control text-capitalize">
                        <option value=""  class="text-capitalize">Choose product Category</option>
                         @foreach($category as $show)
                          <option value="{{ $show->id }}" class="text-capitalize">{{ $show->name }}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="col-md-4">
                        <label>Brand Name</label>
                    <select name="brand" required id="text" class="form-control text-capitalize">
                        <option value=""  class="text-capitalize">Choose Brand</option>
                         @foreach($brand as $show)
                          <option value="{{ $show->id }}" class="text-capitalize">{{ $show->name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-row mt-5">
                    <div class="col-md-4">
                        <label>Quantity</label>
                    <select name="quantity" id="text" class="form-control text-capitalize">
                        <option value=""  class="text-capitalize">Choose Quantity</option>
                         @foreach($showData as $show)
                          <option value="{{ $show->id }}" class="text-capitalize">{{ $show->name }}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="col-md-4">
                        <label>Store Type</label>
                    <select name="store" required id="text" class="form-control text-capitalize">
                        <option value=""  class="text-capitalize">Choose Store</option>
                         @foreach($store as $show)
                          <option value="{{ $show->id }}" class="text-capitalize">{{ $show->store_name }}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="col-md-4">
                        <label>Status</label>
                            <select name="status" required class="form-control @error('status') is-invalid @enderror">
                              <option value="" selected>Choose a status</option>
                              @foreach(\App\Models\Inventory::$statusArrays as $status)
                                <option value="{{ $status }}"
                                        @if(old('status') == $status)  @endif>{{ ucfirst($status) }}</option>
                              @endforeach
                            </select>
                      </div>
                    </div>
                      
                      <div class="form-group row mt-5 ">
                          <label class="col-sm-4 col-form-label"></label>
                          <div class="col-sm-4">
                              <button type="submit" class="btn btn-primary btn-block">Submit</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection


@section('script')

<script>
    // function myFunction() {
    //   var checkBox = document.getElementById("myCheck");
    //   var text = document.getElementById("text");
    //   if (checkBox.checked == true){
    //     text.style.display = "block";
    //   } else {
    //      text.style.display = "none";
    //   }
    // }
        // $(function() {
        // var timeout = 3000; // in miliseconds (3*1000)
        // $('.alert').delay(timeout).fadeOut(300);
        // });
    </script>
@endsection
 @section('js')
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/cropper.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/image-cropper-modal.js')}}" type="text/javascript"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    
    <script src="{{asset('assets/js/products.js')}}" type="text/javascript"></script>
@endsection