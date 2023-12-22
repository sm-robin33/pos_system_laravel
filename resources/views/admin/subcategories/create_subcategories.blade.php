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
        <h1 class="page-title">Create Sub-Categories</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Create Sub-Categories</li>
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
          <div class="ibox-title">Create new Sub-Category</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-12">
                {{-- @if(session()->has('success'))
                {!! session()->get('success') !!}
              @endif --}}
              <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                <a href="{{ route('admin.sub-categories.list') }}" class="btn btn-success">List of Sub-Categories</a>
              </div>
                  <form action="{{ route('admin.sub-categories.store') }}" method="post" enctype="multipart/form-data" >
                      @csrf
                <div class="form-row">
                    <div class="required col-md-5">
                        <label for="full_name" class="col-form-label">Sub-Categories Name:</label>
                        <div>
                          <input type="text" name="name" placeholder="Sub-Categories name" required value="{{ old('name') }}"
                          class="form-control @error('name') is-invalid @enderror">
                   @error('name')
                   <strong class="text-danger">{{ $errors->first('name') }}</strong>
                   @enderror
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                      {{-- <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                          Has Parent
                        </label>
                      </div> --}}
                      {{-- <div class="form-check">
                        <label><input class="form-check-input" type="checkbox" id="myCheck" onclick="myFunction()" name="ch_name[]" value="ch02"> Has Parent</label><br>
                        <input type="text" id="text" name="ch_for[]" style="display:none" value="" placeholder="Channel details"  class="form-control ch_for">
                    </div> --}}
                    <label>Categories</label>
                    <select name="parent" id="text" class="form-control text-capitalize">
                        <option value=""  class="text-capitalize">Choose a Category</option>
                         @foreach($showData as $show)
                          <option value="{{ $show->id }}" class="text-capitalize">{{ $show->name }}</option>
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
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    
    <script src="{{asset('assets/js/products.js')}}" type="text/javascript"></script>
@endsection