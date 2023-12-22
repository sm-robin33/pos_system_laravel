@extends('layout.admin')

@section('stylesheet')
@endsection
<style>
  .abc{
    margin-top: 27px;
  }
</style>

@section('content')
    {{-- @include('partials._crop-image-modal') --}}

    <div class="page-heading">
        <h1 class="page-title">Manage Customer</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Manage Brand</li>
        </ol>
    </div>
<div class="page-content">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Manage Brand</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-12">
                @if(\App\Helper\CustomHelper::canView('List of Brand', 'Super Admin|Cashier'))
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.brand.list') }}" class="btn btn-success float-right">List of Brand</a>
                  </div>
                </div>
                @endif
                @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-sm-3"></div>
                  <label for="full_name" class="col-sm-3">Brand Name:</label>
                </div>
                <div class="form-group required row sm-1">
                  <input type="hidden" name="id" value="{{ $brand->id }}">
                  <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                      <input type="text" name="name" placeholder="Brand Name" required value="{{ $brand->name }}"
                      class="form-control @error('name') is-invalid @enderror">
               @error('name')
               <strong class="text-danger">{{ $errors->first('name') }}</strong>
               @enderror
                    </div>
                </div>
                <div class="form-group row mt-5 ">
                  <label class="col-sm-4 col-form-label"></label>
                  <div class="col-sm-4">
                      <button type="submit" class="btn btn-danger btn-block">Update</button>
                  </div>
                  <div class="col-sm-4"></div>
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
