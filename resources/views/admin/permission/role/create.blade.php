@extends('layout.admin')

@section('stylesheet')
@endsection

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Create Role</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Create Role</li>
        </ol>
    </div>
<div class="page-content">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Create New Role</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-12">
                @if(\App\Helper\CustomHelper::canView('List of Role', 'Super Admin'))
                <div class="row">
                   <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.user.list') }}" class="btn btn-success float-right">List of Roles</a>
                  </div>
                </div>
                @endif
                @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
                  <form action="{{ route('admin.role.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-sm-3"></div>
                        <label for="name" class="col-sm-3">Role Name:</label>
                      </div>
                      <div class="form-group required row mt-1">
                        <div class="col-sm-3"></div>
                          <div class="col-sm-6">
                            <input type="text" name="name" placeholder="Role Name" required autocomplete="off" value="{{ old('name') }}"
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
@endsection