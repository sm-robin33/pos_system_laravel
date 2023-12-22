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
        <h1 class="page-title">Create Brand</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Create Brand</li>
        </ol>
    </div>
<div class="page-content">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Create new brand</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-12">
                @if(\App\Helper\CustomHelper::canView('List of Brand', 'Super Admin|Cashier'))
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.brand.list') }}" class="btn btn-success float-right">List of Brands</a>
                  </div>
                </div>
                @endif
                 {{-- @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif --}}
              <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>
                    <label for="full_name" class="col-sm-3">Brand Name:</label>
                  </div>
                <div class="form-group required row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                      <input type="text" name="name" placeholder="Full name" required value="{{ old('name') }}"
                      class="form-control @error('name') is-invalid @enderror">
               @error('name')
               <strong class="text-danger">{{ $errors->first('name') }}</strong>
               @enderror
                    </div>
                </div>
                <div class="form-group row mt-5 ">
                    <label class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
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