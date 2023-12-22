@extends('layout.admin')

@section('stylesheet')

@endsection
@section('css')
<link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/cropper.css')}}" rel="stylesheet" type="text/css">
    {{-- <link href="{{asset('assets/css/bootstrap1.min.css')}}" rel="stylesheet" type="text/css"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        span.select2-container{
            width: 100% !important;
        }
        .input-group-append {
         cursor: pointer;
        }
        .fnt{
            font-size: 25px;
            padding: 5px;
            /* margin-left: 5px; */
        }
    </style>
@endsection

@section('content')

    <div class="page-heading">
        <h1 class="page-title">Add Discount Policy</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Add Discount Policy</li>
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
          <div class="ibox-title">Create new Discount Policy</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-md-12">
                {{-- @if(session()->has('success'))
                {!! session()->get('success') !!}
              @endif --}}
              <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                <a href="{{ route('admin.discount.list') }}" class="btn btn-success">List of Discount Policy</a>
              </div>
                  <form action="{{ route('admin.discount.store') }}" method="post" enctype="multipart/form-data" >
                      @csrf
                <div class="form-row">
                    <div class="required col-md-5">
                        <label for="Enter Policy Name" class="col-form-label">Policy Name:</label>
                        <div >
                          <input type="text" name="name" placeholder="Full name" required value="{{ old('name') }}"
                          class="form-control @error('name') is-invalid @enderror">
                   @error('name')
                   <strong class="text-danger">{{ $errors->first('name') }}</strong>
                   @enderror
                        </div>
                    </div>
                    <div class="col-md-2"></div>

                    <div class="required col-md-5">
                        <label for="amount" class="col-form-label">Amount:</label>
                        <div >
                          <input type="number" name="amount" placeholder="Enter Amount" required value="{{ old('name') }}"
                          class="form-control @error('name') is-invalid @enderror">
                   @error('name')
                   <strong class="text-danger">{{ $errors->first('name') }}</strong>
                   @enderror
                        </div>
                    </div>
                </div>
                <div class="form-row mt-5">
                    <div class="col-md-5">
                        <label for="date" class="col-3 col-form-label">Start Date:</label>
                        <div class="input-group mb-3" >
                        <div class="input-group date" id="datepicker">
                            <input type="text" name="sdate" class="form-control" id="date"/>
                            <span class="input-group-append bg-info text-white">
                            <span class="input-group-text fnt">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <label for="date" class="col-3 col-form-label">End Date:</label>
                        <div class="input-group mb-3" >
                        <div class="input-group date" id="datepicker2">
                            <input type="text" name="edate" class="form-control" id="date"/>
                            <span class="input-group-append bg-info text-white">
                            <span class="input-group-text fnt">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                        </div>
                        </div>
                    </div>
                </div>
                      
                      <div class="form-group row mt-5 ">
                          <label class="col-sm-4 col-form-label"></label>
                          <div class="col-sm-4">
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


@section('script')

<script>
    $(function(){
  $('#datepicker').datepicker({format: 'dd/mm/yyyy' });
});
$(function(){
  $('#datepicker2').datepicker({ format: 'dd/mm/yyyy' });
});

        $(function() {
        var timeout = 3000; // in miliseconds (3*1000)
        $('.alert').delay(timeout).fadeOut(300);
        });
    </script>
@endsection
 @section('js')
    <script src="{{asset('assets/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/cropper.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/image-cropper-modal.js')}}" type="text/javascript"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="{{asset('assets/js/products.js')}}" type="text/javascript"></script>
@endsection