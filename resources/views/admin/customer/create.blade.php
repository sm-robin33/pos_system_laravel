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
        <h1 class="page-title">Create Customer</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Create Customer</li>
        </ol>
    </div>
<div class="page-content">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Create New Customer</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-12">
                @if(\App\Helper\CustomHelper::canView('List of Customer', 'Super Admin|Cashier'))
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.customer.list') }}" class="btn btn-success float-right">List of Customer</a>
                  </div>
                </div>
                @endif
                @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
                  <form action="{{ route('admin.customer.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-row">
                       <div class="col-md-5">
                          <label for="full_name" class="col-form-label">Full name:</label>
                            <input type="text" name="name" placeholder="Full Name" required value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                        @enderror
                          </div>
                          <div class="col-md-2 mt-2"></div>
                      <div class="col-md-5 mt-2">
                        <label for="phone_no" class="col-form-label">Phone No:</label>
                        
                          <input type="number" name="phone" placeholder="Phone No" value="{{ old('phone') }}"
                          class="form-control @error('phone') is-invalid @enderror" required>
                          @error('phone')
                          <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                          @enderror
                        </div>
                    <div class="col-md-5 mt-2">
                          <label for="email" class="col-form-label">Email:</label>
                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" required>
                     @error('email')
                     <strong class="text-danger">{{ $errors->first('email') }}</strong>
                     @enderror
                          </div>
                          <div class="col-md-2 mt-2"></div>
                      <div class="required col-md-5 mt-2">
                        <label for="address" class="col-form-label">Address:</label>
                          <input type="text" name="address" placeholder="Address" value="{{ old('address') }}"
                          class="form-control @error('address') is-invalid @enderror" required>
                   @error('address')
                   <strong class="text-danger">{{ $errors->first('address') }}</strong>
                   @enderror
                        </div>

                        <div class="required col-md-5 mt-2">
                          <label for="password" class="col-form-label">Password:</label>
                            <input type="password" name="password" placeholder="Password" required
                            value="{{ old('password') }}"
                            class="form-control @error('password') is-invalid @enderror">
                     @error('password')
                     <strong class="text-danger">{{ $errors->first('password') }}</strong>
                     @enderror
                          </div>
              
                        <div class="col-md-2 mt-2"></div>
                      <div class="required col-md-5 mt-2">
                        <label for="gender" class="col-form-label">Gender:</label>
                          <select name="gender" required class="form-control @error('gender') is-invalid @enderror">
                            <option value="">Choose Your Gender</option>
                            @foreach(\App\Models\Customer::$genderArrays as $gender)
                              <option value="{{ $gender }}"
                                      @if(old('gender') == $gender) selected @endif>{{ ucfirst($gender) }}</option>
                            @endforeach
                          </select>
                          @error('gender')
                          <strong class="text-danger">{{ $errors->first('gender') }}</strong>
                          @enderror
                        </div>
      
                        <div class="col-md-5 mt-2">
                          <label for="status" class="col-form-label">Status:</label>
                            <select name="status" required class="form-control @error('status') is-invalid @enderror">
                              <option value="">Choose a Status</option>
                              @foreach(\App\Models\Customer::$statusArrays as $status)
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