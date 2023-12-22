@extends('layout.admin')

@section('stylesheet')
@endsection
<style>
  .abc{
    margin-top: 27px;
  }
</style>
@section('content')

    <div class="page-heading">
        <h1 class="page-title">Manage Sub-Categories</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Manage Sub-Categories</li>
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
          <div class="ibox-title">Manage new Sub-Category</div>
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
                      <input type="hidden" name="id" value="{{ $subcategories->id }}">
                        <label for="full_name" class="col-form-label">Sub-Categories Name:</label>
                        <div >
                          <input type="text" name="name" placeholder="Sub-Categories name" required value="{{ $subcategories->name }}"
                          class="form-control @error('name') is-invalid @enderror">
                   @error('name')
                   <strong class="text-danger">{{ $errors->first('name') }}</strong>
                   @enderror
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                    <label>Categories</label>
                    <select name="parent" id="text" class="form-control text-capitalize">
                      <option value="" disabled>Choose a Category</option>
                        <option value="" class="text-capitalize" selected>{{$subcategories->subcategory_parent?->name }}</option>
                        @foreach($subcat as $show)
                         @if($show->id != $subcategories->subcategory_parent->id)
                        <option value="{{$show->id}}" class="text-capitalize">{{ $show->name }}</option>
                         @endif
                        @endforeach
                    </select>
                  </div>
                </div>
                      
                      <div class="form-group row mt-5 ">
                          <label class="col-sm-4 col-form-label"></label>
                          <div class="col-sm-4">
                              <button type="submit" class="btn btn-danger btn-block">Update</button>
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
