@extends('layout.admin')

@section('stylesheet')
  <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

  @section('content')
    <div class="page-heading">
        <h1 class="page-title">Brand List</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Brand List</li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">List of Brands</div>
            </div>
            <div class="ibox-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif

                @if(\App\Helper\CustomHelper::canView('Create Brand', 'Super Admin|Cashier'))
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                    <a href=" {{ route('admin.brand.create') }} " class="btn btn-success"><i class="fa fa-plus"></i>New Brand</a>
                  </div>
                </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="category-table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th width="10">#</th>
                      <th>Name</th>
                      <th width="200">Created At</th>
                      <th width="200">Updated At</th>
                      <th width="200">Created By</th>
                      <th width="200">Updated By</th>
                      <th class="hidden-phone" width="40">Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($showData as $key => $val)
                     <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                        <td class="p-1">{{ ($key+1) }}</td>
                        <td class="p-1 text-capitalize">{{ $val->name }}</td>
                        <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>
                        <td width="200" class="p-1">{{ date('F d, Y h:i A', strtotime($val->updated_at)) }}</td>
                        <td width="200" class="p-1">{{ $val->created_by }}</td>
                        <td width="200" class="p-1">{{ $val->updated_by }}</td>
    
                          <td class="text-center p-1" width="100">
                              <a href="{{ route('admin.brand.manage', $val->id) }}" class="btn btn-success"> <i
                                  class="fa fa-edit"></i> </a>
                                <span class="btn btn-danger btn-delete delete_{{ $val->id }}" style="cursor: pointer"
                                    data-id="{{ $val->id }}"><i
                                  class="fa fa-trash-o"></i></span>
                          </td>
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
          <h4>Delete Brand</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this brand?</strong>
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


      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_' + pid)
        $.ajax({
          url: "{{ route('admin.brand.destroy') }}",
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
    $(function() {
        var timeout = 3000; // in miliseconds (3*1000)
        $('.alert').delay(timeout).fadeOut(300);
        });
  </script>
@endsection
