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
    {{-- @include('partials._crop-image-modal') --}}

    <div class="page-heading">
        <h1 class="page-title">Update Store</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Update Store</li>
        </ol>
    </div>
<div class="page-content">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Update Store</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-12">
             
              <form action="{{ route('admin.store.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-sm-5">
                                <input type="hidden" name="id" value="{{ $store->id }}">
                                <label for="full_name" >Store Name:</label>
                                  <input type="text" name="name" placeholder="Store name" required value="{{ $store->store_name}}"
                                  class="form-control @error('name') is-invalid @enderror">
                           @error('name')
                           <strong class="text-danger">{{ $errors->first('name') }}</strong>
                           @enderror
                              
  
                        </div>
                        <div class="col-sm-2"></div>

                        <div class="col-sm-5">
                            <label for="status" class="col-form-label">Status:</label>
                            <select name="status" required class="form-control @error('status') is-invalid @enderror">
                              <option value="" disabled>Choose a Status</option>
                              <option value="{{$store->status}}" selected >{{ $store->status }}</option>
                              @foreach(\App\Models\Customer::$statusArrays as $status)
                              @if($status!=$store->status)
                                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                @endif
                              @endforeach
                            </select>
                            @error('status')
                            <strong class="text-danger">{{ $errors->first('status') }}</strong>
                            @enderror
                        </div>
                        </div>
                        
                    </div>
                    
                  </div>

                <div class="form-group row mt-5 ">
                    <label class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </div>
                    <div class="col-sm-4"></div>
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
        $(function() {
        var timeout = 3000; // in miliseconds (3*1000)
        $('.alert').delay(timeout).fadeOut(300);
        });
    </script>
@endsection
 @section('js')
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/cropper.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/image-cropper-modal.js')}}" type="text/javascript"></script>
    
    <script src="{{asset('assets/js/products.js')}}" type="text/javascript"></script>
@endsection