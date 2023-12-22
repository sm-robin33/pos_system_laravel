<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title>Admin | Dashboard</title>

  <meta content="Admin Panel" name="description"/>
  <meta content="Arena;"
        name="author"/>
  <meta content="Arena" name="company"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

  <meta name="csrf-token" content="{{ csrf_token() }}">


  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset("favicon.ico") }}" type="icon">
  {{--  <link rel="shortcut icon" href="{{ asset("fav.jpg") }}" type="image/png">--}}
  <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/css/icons.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>

  <style>
      body {
          font-size: 14px;
      }

      label {
          font-size: 12px;
      }

      .form-control {
          font-size: 14px;
      }


    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }

  </style>
  @yield('stylesheet')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/custom.css') }}">


</head>
<body class="fixed-left">
<!-- Loader -->
<div id="preloader">
  <div id="status">
    <div class="spinner"></div>
  </div>
</div>

<div id="wrapper">
  <!-- ========== Left Sidebar Start ========== -->
  <div class="left side-menu">

    <!-- LOGO -->
    <div class="topbar-left">
      <div class="text-center" style="padding-right: 35px">
        <a href="{{ route('home') }}" class="logo">
          <img style="background: whitesmoke;display: unset;height: 60px"
               src="{{ auth()->user()->profile_photo_path ? asset('uploads/'. auth()->user()->profile_photo_path) : auth()->user()->profile_photo_url }}"
               height="100"
               alt="logo"></a>
      </div>
    </div>
    <div class="sidebar-inner slimscrollleft">
      <div id="sidebar-menu">
        <ul>
          <li>
            <a href="{{ route('admin.dashboard') }}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard</span>
            </a>
          </li>

          @if(\App\Helper\CustomHelper::canView('Create User|Manage User|Delete User|View User|List Of User', 'Super Admin'))
            <li class="has_sub">
              <a class="waves-effect"><i class="mdi mdi-account-multiple"></i><span> User <span
                    class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
              <ul class="list-unstyled">
                @if(\App\Helper\CustomHelper::canView('Create User', 'Super Admin'))
                  <li><a href="{{ route('admin.user.create') }}">Create new</a></li>
                @endif
                @if(\App\Helper\CustomHelper::canView('Manage User|Delete User|View User|List Of User', 'Super Admin'))
                  <li><a href="{{ route('admin.user.list') }}">List of Users</a></li>
                @endif
              </ul>
            </li>
          @endif

          @if(\App\Helper\CustomHelper::canView('Create Role|Manage Role|Delete Role|View Role|List Of Role', 'Super Admin'))
            <li class="has_sub">
              <a class="waves-effect"><i>
                  <iconify-icon icon="eos-icons:cluster-role-binding"></iconify-icon>
                </i><span> Role <span
                    class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
              <ul class="list-unstyled">
                @if(\App\Helper\CustomHelper::canView('Create Role', 'Super Admin'))
                  <li><a href="{{ route('admin.role.create') }}"> Create new</a></li>
                @endif
                @if(\App\Helper\CustomHelper::canView('Manage Role|Delete Role|View Role|List Of Role', 'Super Admin'))
                  <li><a href="{{ route('admin.role.list') }}">List of roles</a></li>
                @endif
              </ul>
            </li>
          @endif

          @if(\App\Helper\CustomHelper::canView('Manage Permission', 'Super Admin'))
            <li><a href="{{ route('admin.permission.manage') }}" class="waves-effect">
                <i>
                  <iconify-icon icon="icon-park-solid:permissions"></iconify-icon>
                </i>
                <span>  Permissions</span>
              </a></li>
          @endif

        </ul>
      </div>
      <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
  </div>
 
  <!-- Left Sidebar End -->

  <!-- Start right Content here -->
  <div class="content-page">

    <!-- Start content -->
    <div class="content">

      <!-- Top Bar Start -->
      <div class="topbar">

        <nav class="navbar-custom">
          <!-- Search input -->
          <div class="search-wrap" id="search-wrap">
            <div class="search-bar">
              <input class="search-input" type="search" placeholder="Search"/>
              <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                <i class="mdi mdi-close-circle"></i>
              </a>
            </div>
          </div>

          <ul class="list-inline float-right mb-0">
            <!-- Fullscreen -->
            <li class="list-inline-item dropdown notification-list hidden-xs-down">
              <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                <i class="mdi mdi-fullscreen noti-icon"></i>
              </a>
            </li>
            <li class="list-inline-item dropdown notification-list">
              <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#"
                 role="button"
                 aria-haspopup="false" aria-expanded="false">
                <img
                  src="{{ auth()->user()->profile_photo_path ? asset('uploads/'. auth()->user()->profile_photo_path) : auth()->user()->profile_photo_url }}"
                  alt="user"
                  class="rounded-circle">
              </a>
              <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <a class="dropdown-item" href="{{ route("admin.profile.show") }}"><i
                    class="dripicons-user text-muted"></i>
                  Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="dripicons-exit text-muted"></i>
                  Logout</a>
              </div>
            </li>
          </ul>
          <!-- Page title -->
          <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
              <button type="button" class="button-menu-mobile open-left waves-effect">
                <i class="ion-navicon"></i>
              </button>
            </li>
            {{--            <li class="hide-phone list-inline-item app-search">--}}
            {{--              <h3 class="page-title">Dashboard</h3>--}}
            {{--            </li>--}}
            {{--            <li class="hide-phone list-inline-item dropdown notification-list">--}}
            {{--              <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#"--}}
            {{--                 role="button"--}}
            {{--                 aria-haspopup="false" aria-expanded="false">--}}
            {{--                Trainee--}}
            {{--              </a>--}}
            {{--              <div class="dropdown-menu dropdown-menu-right profile-dropdown ">--}}
            {{--                <a class="dropdown-item" href="{{ route("admin.profile.show") }}">Profile</a>--}}
            {{--                <div class="dropdown-divider"></div>--}}
            {{--                <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>--}}
            {{--              </div>--}}
            {{--            </li>--}}
          </ul>
          <div class="clearfix"></div>
        </nav>
      </div>
      <!-- Top Bar End -->

      <div class="page-content-wrapper">
        @yield('content')
      </div> <!-- Page content Wrapper -->
    </div>
    <footer class="footer">
      © 2023 {{ env('APP_NAME') }}
            <span class="text-muted hidden-xs-down pull-right">Developed & Maintained by  <a href="https://www.arena.com.bd/"
                                                                                             target="_blank">Arena Phone BD</a></span>
    </footer>
  </div>
</div>
<script src="{{asset('assets/admin/newicon/code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/admin/js/waves.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>


<!-- App js -->
<script src="{{ asset('assets/admin/js/app.js') }}"></script>


<script>
  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.year-picker').datepicker({
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years",
      autoclose: true //to close picker once year is selected
    });
  })
</script>
@yield('script')
</body>
</html>
