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
        <h1 class="page-title">Manage User</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Manage User</li>
        </ol>
    </div>
<div class="page-content">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Edit User</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-12">
                @if(\App\Helper\CustomHelper::canView('List of User', 'Super Admin'))
                <div class="row">
                   <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.user.list') }}" class="btn btn-success float-right">List of user</a>
                  </div>
                </div>
              @endif
                @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
                  <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                
                      <div class="form-row">
                        <div class="required col-md-5">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                          <label for="full_name" class="col-sm-3 col-form-label">Full name</label>
                          <div class="col-sm-14">
                            <input type="text" name="name" placeholder="Full name" value="{{ $user->name }}"
                            class="form-control @error('name') is-invalid @enderror">
                     @error('name')
                     <strong class="text-danger">{{ $errors->first('name') }}</strong>
                     @enderror
                          </div>
                      </div>
                      <div class="col-md-2"></div>
                      <div class="required col-md-5">
                          <label for="email" class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-14">
                            <input type="email" name="email" placeholder="Email" value="{{ $user->email }}"
                            class="form-control @error('email') is-invalid @enderror" >
                     @error('email')
                     <strong class="text-danger">{{ $errors->first('email') }}</strong>
                     @enderror
                          </div>
                      </div>
                      <div class="required col-md-5">
                          <label for="phone_no" class="col-sm-3 col-form-label">Phone No</label>
                          <div class="col-sm-14">
                            <input type="number" name="phone" placeholder="Phone No" value="{{ $user->phone }}"
                            class="form-control @error('phone') is-invalid @enderror" required>
                     @error('phone')
                     <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                     @enderror
                          </div>
                      </div>
                      <div class="col-md-2"></div>
                      <div class="required col-md-5">
                          <label for="password" class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-14">
                            <input type="password" name="password" placeholder="Password"
                            
                            class="form-control @error('password') is-invalid @enderror">
                     @error('password')
                     <strong class="text-danger">{{ $errors->first('password') }}</strong>
                     @enderror
                          </div>
                      </div>
                      <div class="required col-md-5">
                          <label for="role" class="col-sm-3 col-form-label">Role</label>
                          <div class="col-sm-14">
                            <select name="role" required class="form-control @error('role') is-invalid @enderror">
                              <option value="">Choose a role</option>
                              <?php
                              $roleNo = count($user->roles);
                              $role_id = 0;
                              if ($roleNo > 0) {
                                $role_id = $user->roles[0]->id;
                              }
                              $role_id = old('role', $role_id);
                              ?>
                              @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                        @if($role_id == $role->id) selected @endif>{{ ucfirst($role->name) }}</option>
                              @endforeach
                            </select>
                            @error('role')
                            <strong class="text-danger">{{ $errors->first('role') }}</strong>
                            @enderror    
        
                          </div>
                      </div>
                      <div class="col-md-2"></div>
                      <div class="required col-md-5">
                          <label for="status" class="col-sm-3 col-form-label">Status</label>
                          <div class="col-sm-14">
                            <select name="status" required class="form-control @error('status') is-invalid @enderror">
                              <option value="">Choose a status</option>
                              @foreach(\App\Models\User::$statusArrays as $status)
                                <option value="{{ $status }}"
                                        @if(old('status', $user->status) == $status) selected @endif>{{ ucfirst($status) }}</option>
                              @endforeach
                            </select>
                            @error('status')
                            <strong class="text-danger">{{ $errors->first('status') }}</strong>
                            @enderror
                          </div>
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

{{-- @section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Update user</h2>
            </header>
            <div class="panel-body">
              @if(\App\Helper\CustomHelper::canView('List of User', 'Super Admin'))
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.user.list') }}" class="brn btn-success btn-sm">List of user</a>
                  </div>
                </div>
              @endif
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

              <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <input type="hidden" name="id" value="{{ $user->id }}">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Name<span class="text-danger">*</span></label>
                      <input type="text" name="name" placeholder="Name" required value="{{ $user->name }}"
                             class="form-control @error('name') is-invalid @enderror">
                      @error('name')
                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Email<span class="text-danger">*</span></label>
                      <input type="email" name="email" placeholder="Email" required value="{{ $user->email }}"
                             class="form-control @error('email') is-invalid @enderror">
                      @error('email')
                      <strong class="text-danger">{{ $errors->first('email') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Phone<span class="text-danger">*</span></label>
                      <input type="number" name="phone" placeholder="Phone" required value="{{ $user->phone }}"
                             class="form-control @error('phone') is-invalid @enderror">
                      @error('phone')
                      <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Password</label>
                      <input type="password" name="password" placeholder="Password"
                             class="form-control @error('password') is-invalid @enderror">
                      @error('password')
                      <strong class="text-danger">{{ $errors->first('password') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Role<span class="text-danger">*</span></label>
                      <select name="role" required class="form-control @error('role') is-invalid @enderror">
                        <option value="">Choose a role</option>
                        <?php
                        $roleNo = count($user->roles);
                        $role_id = 0;
                        if ($roleNo > 0) {
                          $role_id = $user->roles[0]->id;
                        }
                        $role_id = old('role', $role_id);
                        ?>
                        @foreach($roles as $role)
                          <option value="{{ $role->id }}"
                                  @if($role_id == $role->id) selected @endif>{{ ucfirst($role->name) }}</option>
                        @endforeach
                      </select>
                      @error('role')
                      <strong class="text-danger">{{ $errors->first('role') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Status<span class="text-danger">*</span></label>
                      <select name="status" required class="form-control @error('status') is-invalid @enderror">
                        <option value="">Choose a status</option>
                        @foreach(\App\Models\User::$statusArrays as $status)
                          <option value="{{ $status }}"
                                  @if(old('status', $user->status) == $status) selected @endif>{{ ucfirst($status) }}</option>
                        @endforeach
                      </select>
                      @error('status')
                      <strong class="text-danger">{{ $errors->first('status') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-danger btn-sm" type="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
@endsection --}}
@section('script')
@endsection
