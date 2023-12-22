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
        <h1 class="page-title">Update Supplier</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Update Supplier</li>
        </ol>
    </div>
<div class="page-content">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Update Supplier</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-12">
                @if(\App\Helper\CustomHelper::canView('List of Supplier', 'Super Admin|Cashier'))
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.supplier.list') }}" class="btn btn-success float-right">List of Supplier</a>
                  </div>
                </div>
                @endif
                @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
                  <form action="{{ route('admin.supplier.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-row">
                       <div class="col-md-5">
                        <input type="hidden" name="id" value="{{ $supplier->id }}">
                          <label for="full_name" class="col-form-label">Full name:</label>
                            <input type="text" name="name" placeholder="Full Name" required value="{{ $supplier->supplier_name }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                        @enderror
                          </div>
                          <div class="col-md-2 mt-2"></div>
                      <div class="col-md-5 mt-2">
                        <label for="phone_no" class="col-form-label">Phone No:</label>
                        
                          <input type="number" name="phone" placeholder="Phone No" value="{{ $supplier->phone }}"
                          class="form-control @error('phone') is-invalid @enderror" required>
                          @error('phone')
                          <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                          @enderror
                        </div>
                    <div class="col-md-5 mt-2 required">
                          <label for="email" class="col-form-label">Email:</label>
                            <input type="email" name="email" placeholder="Email" value="{{ $supplier->email }}"
                            class="form-control @error('email') is-invalid @enderror" required>
                     @error('email')
                     <strong class="text-danger">{{ $errors->first('email') }}</strong>
                     @enderror
                          </div>
                          <div class="col-md-2 mt-2"></div>
                      <div class="required col-md-5 mt-2">
                        <label for="address" class="col-form-label">Address:</label>
                          <input type="text" name="address" placeholder="Address" value="{{ $supplier->address }}"
                          class="form-control @error('address') is-invalid @enderror" required>
                   @error('address')
                   <strong class="text-danger">{{ $errors->first('address') }}</strong>
                   @enderror
                        </div>

                        <div class="required col-md-5 mt-2">
                            <label>Brand:</label>
                            <select name="brand_id" id="text" class="form-control text-capitalize">
                                <option value="" disabled class="text-capitalize">Choose Brand Name</option>
                                <option value="{{$supplier->brand_id}}" selected class="text-capitalize">{{$supplier->brand_parent?->name }}</option>
                                 @foreach($brand as $show)
                                @if($show->id != $supplier->brand_parent->id)
                                <option value="{{$show->id}}" class="text-capitalize">{{ $show->name }}</option>
                                @endif
                                @endforeach
                            </select>
                          </div>
              
                        <div class="col-md-2 mt-2"></div>
                        <div class="col-md-5 mt-2">
                            <label for="status" class="col-form-label">Status:</label>
                              <select name="status" required class="form-control @error('status') is-invalid @enderror">
                                <option value="" disabled>Choose a Status</option>
                                <option value="{{$supplier->status}}" selected >{{ $supplier->status }}</option>
                                @foreach(\App\Models\Customer::$statusArrays as $status)
                                @if($status!=$supplier->status)
                                  <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                  @endif
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
                          <button type="submit" class="btn btn-primary btn-block">Update</button>
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