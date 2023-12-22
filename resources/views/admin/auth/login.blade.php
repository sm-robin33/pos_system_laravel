<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title> Admin Login</title>

   {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/logo/favicon.png') }}"> --}}


  <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/css/icons.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" type="text/css">
<style>
  .btn-color{
  background-color: #0e1c36;
  color: #fff;
  
}

.profile-image-pic{
  height: 200px;
  width: 200px;
  object-fit: cover;
}



.cardbody-color{
  background-color: #ebf2fa;
}

a{
  text-decoration: none;
}
</style>

</head>
<body class="fixed-left">

  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Arena POS System</h2>
        {{-- <div class="text-center mb-5 text-dark">Made with bootstrap</div> --}}
        <div class="card my-5">
          @if(session()->has('status'))
          {!! session()->get('status') !!}
        @endif
          <form class="card-body cardbody-color p-lg-5" action="{{ route('login')}}" method="post">
          @csrf
            <div class="text-center">
              <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                width="200px" alt="profile">
            </div>

            <div class="mb-3">
              <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            <span class="spin"></span>
            @error('email')
            <strong class="text-danger">{{ $errors->first('email') }}</strong>
            @enderror
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control" id="password" placeholder="Password" autocomplete="off"
              class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required>
              <span class="spin"></span>
              @error('password')
              <strong class="text-danger">{{ $errors->first('password') }}</strong>
              @enderror 
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button></div>
            <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
              Registered? <a href="#" class="text-dark fw-bold"> Create an
                Account</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

<!-- Loader -->
 {{-- <div id="preloader">
  <div id="status">
    <div class="spinner"></div>
  </div>
</div> --}}
<!-- Begin page -->
 {{-- <div class="accountbg"></div>
<div class="wrapper-page">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12 text-center"><a href="{{ route('home') }}" class="logo logo-admin"> --}}
            {{-- <img src="{{ asset('assets/text-logo.png') }}" height="80" alt="logo"> --}}
          {{-- </a></div>
      </div>
      <div class="pl-3 pr-3 pb-3">
        <div class="row">
          <div class="col-12 text-center">
            <h3 class="m-2">Login</h3>
          </div>
        </div>
        @if(session()->has('status'))
          {!! session()->get('status') !!}
        @endif
        <form class="form-horizontal" action="{{ route('login')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter Your email"
                   class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            <span class="spin"></span>
            @error('email')
            <strong class="text-danger">{{ $errors->first('email') }}</strong>
            @enderror
          </div> --}}
          {{--          <div class="form-group">--}}
          {{--            <label for="user_id">User ID</label>--}}
          {{--            <input type="text" name="user_id" id="user_id" placeholder="Enter Your user_id"--}}
          {{--                   class="form-control @error('user_id') is-invalid @enderror" value="{{ old('user_id') }}" required>--}}
          {{--            <span class="spin"></span>--}}
          {{--            @error('user_id')--}}
          {{--            <strong class="text-danger">{{ $errors->first('user_id') }}</strong>--}}
          {{--            @enderror--}}
          {{--          </div>--}}

          {{-- <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Your Password" autocomplete="off"
                   class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required>
            <span class="spin"></span>
            @error('password')
            <strong class="text-danger">{{ $errors->first('password') }}</strong>
            @enderror
          </div>

          <div class="form-group row m-t-20">
            <div class="col-sm-12 text-right">
              <button class="btn btn-success w-md waves-effect waves-light" type="submit">Log In</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>

</div> --}}

{{-- <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/admin/js/waves.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.scrollTo.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}


<!-- App js -->
{{-- <script src="{{ asset('assets/admin/js/app.js') }}"></script> --}}

{{--@include('sweetalert::alert')--}}

</body>
</html>
