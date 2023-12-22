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
        <h1 class="page-title">Customer List</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Customer List</li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">List of Customers</div>
            </div>
            <div class="ibox-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

                @if(\App\Helper\CustomHelper::canView('Create Customer', 'Super Admin'))
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href="{{ route('admin.customer.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>New Customer</a>
                  </div>
                </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="category-table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th width="10">#</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th width="200">Created at</th>
                      <th width="200">Updated at</th>
                      <th width="150">Created by</th>
                      <th width="150">Updated by</th>
                      <th width="50">Gender</th>
                      <th width="50">Status</th>
                      @if(\App\Helper\CustomHelper::canView('Manage Customer|Delete Customer', 'Super Admin'))
                        <th class="hidden-phone" width="260">Option</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $key => $val)
                  <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                    <td class="p-1">{{ ($key+1) }}</td>
                    <td class="p-1 text-capitalize">{{ $val->name }}</td>
                    <td class="p-1">{{ $val->phone }}</td>
                    <td class="p-1">{{ $val->email }}</td>
                    <td class="p-1">{{ $val->address }}</td>
                    <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>
                    <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->updated_at)) }}</td>
                    <td width="200" class="p-1">{{ $val->createdBy?->name }}</td>
                    <td width="200" class="p-1">{{ $val->updatedBy?->name }}</td>
                    @if(\App\Helper\CustomHelper::canView('Manage Customer', 'Super Admin|Cashier'))
                      
                      <td class="text-capitalize p-1">{{ $val->gender }}</td>
                      @endif
                    @if(\App\Helper\CustomHelper::canView('Manage Customer', 'Super Admin|Cashier'))
                      
                      <td class="text-capitalize p-1">{{ $val->status }}</td>
                      @endif
                    @if(\App\Helper\CustomHelper::canView('Manage Customer|Delete Customer', 'Super Admin|Cashier'))
                      <td class="text-center p-1" width="100">
                        @if(\App\Helper\CustomHelper::canView('Manage Customer', 'Super Admin|Cashier'))
                          <a href="{{ route('admin.customer.manage', $val->id) }}" class="btn btn-success"> <i
                              class="fa fa-edit"></i> </a>
                        @endif
                        @if(\App\Helper\CustomHelper::canView('Delete Customer', 'Super Admin|Cashier'))
                            <span class="btn btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                                data-id="{{ $val->id }}"><i
                              class="fa fa-trash-o"></i></span>
                        @endif
                      </td>
                      @endif
                  </tr>
                @endforeach
                    </tbody>
                </table>
                <div class="row">
                  <div class="col-sm-12">{{ $customers->links() }}</div>
                </div>
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
          <strong>Are you sure to delete this Customer?</strong>
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


      $(document).on('change', 'input[name="onoffswitch"]', function () {
        var status = 'inactive';
        var id = $(this).data('id')
        var isChecked = $(this).is(":checked");
        if (isChecked) {
          status = 'active';
        }
        $.ajax({
          url: "{{ route('admin.ajax.update.user.status') }}",
          method: "post",
          dataType: "html",
          data: {'id': id, 'status': status},
          success: function (data) {
            if (data === "success") {
            }
          }
        });
      })


      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_' + pid)
        $.ajax({
          url: "{{ route('admin.customer.destroy') }}",
          method: "delete",
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