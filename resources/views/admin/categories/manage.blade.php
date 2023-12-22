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
        <h1 class="page-title">Manage Categories</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Manage Categories</li>
        </ol>
    </div>
<div class="page-content">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Manage Categories</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-8">
                @if(\App\Helper\CustomHelper::canView('List of Category', 'Super Admin|Cashier'))
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.categories.list') }}" class="btn btn-success float-right">List of Categories</a>
                  </div>
                </div>
                @endif
                @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group required row">
                  <input type="hidden" name="id" value="{{ $categories->id }}">
                    <label for="full_name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="name" placeholder="Name" required value="{{ $categories->name }}"
                      class="form-control @error('name') is-invalid @enderror">
               @error('name')
               <strong class="text-danger">{{ $errors->first('name') }}</strong>
               @enderror
                    </div>
                </div>
                <div class="form-group required row">
                  @if($categories->parent > 0)
                  <div class="col-sm-3">
                      <label><input class="col-form-label" type="checkbox" id="myCheck" onclick="myFunction()" name="checkbox" value="" checked="true"> Has Parent</label>
                  </div>
                  <div class="col-sm-9">
                      <select name="parent" id="text" class="form-control text-capitalize">
                        <option value="" disabled>Choose a Parent </option>
                          <option value="" selected class="text-capitalize">{{$categories->category_parent->name}}</option>
                          @foreach($cat as $show)
                          @if($show->id != $categories->category_parent->id)
                          <option value="{{$show->id}}" class="text-capitalize">{{ $show->name }}</option>
                          @endif
                          @endforeach
                      </select>
                     </div>
                  @else
                  <div class="col-sm-3">
                      <label><input class="col-form-label" type="checkbox" id="myCheck" onclick="myFunction()" name="checkbox" value=""> Has Parent</label>
                  </div>
                  <div class="col-sm-9">
                      <select name="parent" id="text" style="display:none" class="form-control text-capitalize">
                          <option value="" class="text-capitalize">Choose a parent</option>
                          @foreach($cat as $show)
                          <option value="{{$show->id}}" class="text-capitalize">{{ $show->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  @endif
              </div>
              
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-danger btn-block">Update</button>
                    </div>
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
  function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("text");
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
       text.style.display = "none";
    }
  }
  </script>
@endsection
