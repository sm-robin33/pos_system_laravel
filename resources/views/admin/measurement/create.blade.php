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
        .float-right {
           float: right;
        }
    </style>
@endsection
@section('content')
    {{-- @include('partials._crop-image-modal') --}}

    <div class="page-heading">
        <h1 class="page-title">Create Measurement</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Create Measurement</li>
        </ol>
    </div>
<div class="page-content">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Create New Measurement</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-12">
                @if(\App\Helper\CustomHelper::canView('List of Customer', 'Super Admin|Cashier'))
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.measurement.list') }}" class="btn btn-success float-right">List of Measurement</a>
                  </div>
                </div>
                @endif
                @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
                  <form action="{{ route('admin.measurement.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                
                      <div class="form-row">
                        <div class="required col-md-5">
                          <label for="full_name" class="col-form-label">Measurement Name:</label>
                            <input type="text" name="name" placeholder="Measurement Name" required value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror">
                     @error('name')
                     <strong class="text-danger">{{ $errors->first('name') }}</strong>
                     @enderror
                          </div>
                          <div class="col-md-2"></div>
                          <div class="required col-md-5">
                          <label for="status" class="col-form-label">Status:</label>
                            <select name="status" required class="form-control @error('status') is-invalid @enderror">
                              <option value="">Choose a Status</option>
                              @foreach(\App\Models\Measurement::$statusArrays as $status)
                                <option value="{{ $status }}"
                                        @if(old('status') == $status) selected @endif>{{ ucfirst($status) }}</option>
                              @endforeach
                            </select>
                            @error('status')
                            <strong class="text-danger">{{ $errors->first('status') }}</strong>
                            @enderror
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

@endsection
 @section('js')
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/cropper.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/image-cropper-modal.js')}}" type="text/javascript"></script>
    
    <script src="{{asset('assets/js/products.js')}}" type="text/javascript"></script>
@endsection