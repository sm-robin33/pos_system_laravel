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
    <h1 class="page-title">Create Product</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Create Product</li>
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
      <div class="ibox-title">Create New Product</div>
  </div>
  <div class="ibox-body">
      <div class="row">
        <div class="col-md-12">
            {{-- @if(session()->has('success'))
            {!! session()->get('success') !!}
          @endif --}}
          <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
            <a href="{{ route('admin.product.list') }}" class="btn btn-success">List of Products</a>
          </div>
               <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data" >
                  @csrf
            <div class="form-row">
                <input type="hidden" name="id" value="{{ $products->id }}">
                <div class="col-md-4">
                    <label for="full_name" class="col-form-label">Product Name:</label>
                      <input type="text" name="name" placeholder="Product Name" required value="{{$products->name }}"
                      class="form-control @error('name') is-invalid @enderror">
                  @error('name')
                  <strong class="text-danger">{{ $errors->first('name') }}</strong>
                  @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label">Brand Name:</label>
                    <select name="brand_id" id="text" class="form-control text-capitalize">
                        <option value=""  class="text-capitalize">Choose a Brand</option>
                         @foreach($brands as $brand_data)
                          <option value="{{ $brand_data->id }}" class="text-capitalize">{{ $brand_data->name }}</option>
                        @endforeach
                    </select>
                    </div>

                    
                    <div class="col-md-4">
                        <label for="barcode" class="col-form-label">Barcode:</label>
                        <input type="text" name="barcode" placeholder="Barcode" required value="{{ old('barcode') }}"
                        class="form-control @error('barcode') is-invalid @enderror">
                        @error('barcode')
                        <strong class="text-danger">{{ $errors->first('barcode') }}</strong>
                       @enderror
                    </div>
            </div>
            <div class="form-row mt-5">
                 <div class="col-md-4">
                    <label class="col-form-label">Category:</label>
                <select name="category_id" id="text" class="form-control text-capitalize">
                    <option value=""  class="text-capitalize">Choose a Category</option>
                     @foreach($category as $categoryData)
                      <option value="{{ $categoryData->id }}" class="text-capitalize">{{ $categoryData->name }}</option>
                    @endforeach
                </select>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">Sub-Category:</label>
                <select name="subcategory_id" id="text" class="form-control text-capitalize">
                    <option value=""  class="text-capitalize">Choose a Sub-Category</option>
                     @foreach($sub_category as $sub_categoryData)
                      <option value="{{ $sub_categoryData->id }}" class="text-capitalize">{{ $sub_categoryData->name }}</option>
                    @endforeach
                </select>
                </div>

                <div class="col-md-4">
                    <label for="Photo" class="col-form-label">Photo:</label>
                    <input type="file" name="product_image" placeholder="Upload Image" required value="{{ old('product_image') }}"
                    class="form-control @error('product_image') is-invalid @enderror">
                    @error('product_image')
                    <strong class="text-danger">{{ $errors->first('product_image') }}</strong>
                   @enderror
                </div>
            </div>
            <div class="form-row mt-5">
                 <div class="col-md-4">
                    <label class="col-form-label">Purchase Measurement:</label>
                <select name="measure_purchase_id" id="text" class="form-control text-capitalize">
                    <option value=""  class="text-capitalize">Choose a Measurement</option>
                     @foreach($measurement_purchase as $measure_purchase)
                      <option value="{{ $measure_purchase->id }}" class="text-capitalize">{{ $measure_purchase->name }}</option>
                    @endforeach
                </select>
                </div>
                    <div class="col-md-4">
                       <label class="col-form-label">Sale Measurement:</label>
                   <select name="measure_sale_id" id="text" class="form-control text-capitalize">
                       <option value=""  class="text-capitalize">Choose a Measurement</option>
                        @foreach($measurement_sale as $measure_sale)
                         <option value="{{ $measure_sale->id }}" class="text-capitalize">{{ $measure_sale->name }}</option>
                       @endforeach
                   </select>
                   </div>
                   <div class="col-md-4">
                    <label class="col-form-label" >Discount:</label>
                <select name="discount_id" id="text" class="form-control text-capitalize">
                    <option value=""  class="text-capitalize">Choose a Discount Policy</option>
                     @foreach($discount_amount as $discountPolicy)
                      <option value="{{ $discountPolicy->id }}" class="text-capitalize">{{ $discountPolicy->disc_amount }}</option>
                    @endforeach
                </select>
                </div>
            </div>
                <div class="form-row mt-5">
                    <div class="col-md-4">
                    <label for="Price" class="col-form-label">Price:</label>
                      <input type="number" name="price" placeholder="Price" required value="{{ old('price') }}"
                      class="form-control @error('name') is-invalid @enderror">
                  @error('price')
                  <strong class="text-danger">{{ $errors->first('price') }}</strong>
                  @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label" >Status:</label>
                    <select name="status" id="text" class="form-control text-capitalize">
                        <option value=""  class="text-capitalize">Choose a Status</option>
                        @foreach(\App\Models\Product::$statusArrays as $status)
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