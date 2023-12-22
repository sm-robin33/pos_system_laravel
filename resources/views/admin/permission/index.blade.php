@extends('layout.admin')

@section('stylesheet')
@endsection

@section('content')
    {{-- @include('partials._crop-image-modal') --}}

    <div class="page-heading">
        <h1 class="page-title">Manage permissions</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Manage permissions</li>
        </ol>
    </div>
<div class="page-content">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Manage permissions</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-8">
                @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
                  <form action="{{ route('admin.permission.manage') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group required row">
                          <label for="role" class="col-sm-3 col-form-label">Role</label>
                          <div class="col-sm-9">
                      <select name="role" class="form-control">
                        <option value="">Choose a role</option>
                        @foreach($roles as $role)
                          <option value="{{ $role->id }}" class="text-capitalize">{{ $role->name }}</option>
                        @endforeach
                      </select>
                      </div>
                    </div>
                      <div class="col-13 mt-2">
                        <div id="permissions"></div>
                      </div>
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9">
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

{{-- @section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Manage permissions</h2>
            </header>
            <div class="panel-body">
              <div class="row mt-5">
                <div class="col-2">
                </div>
                <div class="col-10">

                  @if(session()->has('status'))
                    {!! session()->get('status') !!}
                  @endif
                </div>
              </div>
              <form action="{{ route('admin.permission.manage') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-6 offset-3">
                    <div class="form-group">
                      <label for="">Role</label>
                      <select name="role" class="form-control text-capitalize">
                        <option value="" class="text-capitalize">Choose a role</option>
                        @foreach($roles as $role)
                          <option value="{{ $role->id }}" class="text-capitalize">{{ $role->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-12 mt-2">
                    <div id="permissions"></div>
                  </div>
                  <div class="col-12 mt-4 text-right">
                    <button type="submit" class="btn btn-danger">Submit</button>
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
  <script>
    $(document).ready(function () {
      $('select[name="role"]').on('change', function () {
        // role id
        const roleId = $(this).val();
        let output = "";
        let permissions = JSON.parse('{!! $permissions !!}');
        if (roleId !== "") {
          // get all permission based on role id
          $.ajax({
            url: "{{ route('admin.ajax.get.permission.by.role') }}",
            method: "POST",
            dataType: "json",
            data: {role_id: roleId},
            success: function (currentPermissions) {
              if (currentPermissions.length > 0) {
                $.each(permissions, function (i, e) {
                  output += '<div class="row">'
                  output += '<div class="col-12">'
                  output += '<h6 class="text-capitalize"><label>' + i + '</label></h6>'
                  output += '</div>';
                  output += '<div class="col-12">'
                  output += '<div class="row">'
                  $.each(e, function (ii, ee) {
                    output += '<div class="d-inline mb-3 col-6 col-sm-4 col-md-3">';
                    if (hasPermission(currentPermissions, ee.id)) {
                      output += '<label class="text-capitalize noselect"><input type="checkbox" name="permission[]" value="' + ee.id + '" checked > ' + ee.name.replace(/_/g, " ") + '</label>';
                     
                    } else {
                      output += '<label class="text-capitalize noselect"><input type="checkbox" name="permission[]" value="' + ee.id + '" > ' + ee.name.replace(/_/g, " ") + '</label>';
                    }
                    output += '</div>';
                  })
                  output += '</div>';
                  output += '</div>';
                  output += '</div>';
                })
                $('#permissions').html(output);
              } else { // output all the permission without checked
                $.each(permissions, function (i, e) {
                  output += '<div class="row">'
                  output += '<div class="col-12">'
                  output += '<h6 class="text-capitalize"><label>' + i + '</label></h6>'
                  output += '</div>';
                  output += '<div class="col-12">'
                  output += '<div class="row">'
                  $.each(e, function (ii, ee) {
                    output += '<div class="d-inline mb-3 col-6 col-sm-4 col-md-3">';
                    output += '<label class="text-capitalize noselect"><input type="checkbox" name="permission[]" value="' + ee.id + '" > ' + ee.name.replace(/_/g, " ") + '</label>';
                    output += '</div>';
                  })
                  output += '</div>';
                  output += '</div>';
                  output += '</div>';
                })
                $('#permissions').html(output);
              }
            }
          })
        }
      })

      // checks if the user has permission
      function hasPermission(currentPermissions, permissionId) {
        let ret = false;
        $.each(currentPermissions, function (i, e) {
          if (Number(e.id) === Number(permissionId)) {
            ret = true
          }
        })
        return ret;
      }
    })
  </script>
@endsection