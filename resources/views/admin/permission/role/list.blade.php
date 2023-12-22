@extends('layout.admin')

@section('stylesheet')
  <!-- DataTables -->
  <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

  <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css"/>

@endsection

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Role list</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Role list</li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">List of Roles</div>
            </div>
            <div class="ibox-body">
              @if(session()->has('status'))
              {!! session()->get('status') !!}
            @endif
                @if(\App\Helper\CustomHelper::canView('Create Role', 'Super Admin'))
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                      <a href="{{ route('admin.role.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>New Role</a>
                    </div>
                  </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="category-table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th width="50">#</th>
                      <th>Name</th>
                      <th width="200">Created at</th>
                      <th width="200">updated_at</th>
                      @if(\App\Helper\CustomHelper::canView('Manage Role|Delete Role', 'Super Admin'))
                        <th class="hidden-phone" width="40">Option</th>
                      @endif
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($roles as $key => $val)
                      <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                        <td class="p-1">{{ ($key+1) }}</td>
                        <td class="p-1 text-capitalize">{{ $val->name }}</td>
                        <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>
                        <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->updated_at)) }}</td>
                        @if(\App\Helper\CustomHelper::canView('Manage Role|Delete Role', 'Super Admin'))
                          <td class="center hidden-phone p-1" width="100">
                            @if(in_array($val->id, [1,2]))
                              @if(\App\Helper\CustomHelper::canView('Manage Role', 'Super Admin'))
                                <a href="#" style="cursor: not-allowed"
                                   class="btn btn-success"> <i class="fa fa-edit"></i> </a>
                              @endif
                              @if(\App\Helper\CustomHelper::canView('Delete Role', 'Super Admin'))
                                <span class="btn btn-danger" style="cursor: not-allowed"><i class="fa fa-trash-o"></i></span>
                              @endif
                            @else
                              @if(\App\Helper\CustomHelper::canView('Manage Role', 'Super Admin'))
                                <a href="{{ route('admin.role.manage', [$val->id]) }}"
                                   class="btn btn-success"> <i class="fa fa-edit"></i> </a>
                              @endif
                              @if(\App\Helper\CustomHelper::canView('Delete Role', 'Super Admin'))
                                <span class="btn btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                                      data-id="{{ $val->id }}"><i class="fa fa-trash-o"></i></span>
                              @endif
                            @endif
                          </td>
                        @endif
                      </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="userDeleteModal"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Delete role</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this role?</strong>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-success btn-sm yes-btn">Yes</button>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
  <!-- Required datatable js -->
  <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Buttons examples -->
  <script src="{{ asset('assets/admin/plugins/datatables/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/buttons.colVis.min.js') }}"></script>
  <!-- Responsive examples -->
  <script src="{{ asset('assets/admin/plugins/datatables/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>


  <script>
    $(document).ready(function () {
      // $('#datatable-buttons').DataTable();

      // var table = $('#datatable-buttons').DataTable({
      //   lengthChange: false,
      //   buttons: ['copy', 'excel', 'pdf', 'colvis']
      // });
      //
      // table.buttons().container()
      //   .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');


      {{--$(document).on('change', 'input[name="onoffswitch"]', function () {--}}
      {{--  var status = 'inactive';--}}
      {{--  var id = $(this).data('id')--}}
      {{--  var isChecked = $(this).is(":checked");--}}
      {{--  if (isChecked) {--}}
      {{--    status = 'active';--}}
      {{--  }--}}
      {{--  $.ajax({--}}
      {{--    url: "{{ route('admin.ajax.update.user.status') }}",--}}
      {{--    method: "post",--}}
      {{--    dataType: "html",--}}
      {{--    data: {'id': id, 'status': status},--}}
      {{--    success: function (data) {--}}
      {{--      if (data === "success") {--}}
      {{--      }--}}
      {{--    }--}}
      {{--  });--}}
      {{--})--}}


      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_' + pid)
        $.ajax({
          url: "{{ route('admin.role.destroy') }}",
          method: "DELETE",
          dataType: "html",
          data: {id: pid},
          success: function (data) {
            if (data === "success") {
              $('#userDeleteModal').modal('hide')
              $this.closest('tr').css('background-color', 'red').fadeOut();
            }
          }
        });
      })

      $(document).on('click', '.btn-delete', function () {
        var pid = $(this).data('id');
        $('.yes-btn').data('id', pid);
        $('#userDeleteModal').modal('show')
      });
    })
  </script>
@endsection
