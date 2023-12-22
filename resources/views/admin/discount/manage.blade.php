@extends('layout.admin')

@section('stylesheet')
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .abc{
      margin-top: 27px;
    }
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
    {{-- @include('partials._crop-image-modal') --}}

    <div class="page-heading">
        <h1 class="page-title">Manage Discount Policy</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Manage Discount Policy</li>
        </ol>
    </div>
<div class="page-content">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Manage Discount Policy</div>
      </div>
      <div class="ibox-body">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                <a href="{{ route('admin.discount.list') }}" class="btn btn-success">List of Discount Policy</a>
              </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.discount.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-5">
                                <input type="hidden" name="id" value="{{ $discount->id }}">
                              <label class="control-label">Name<span class="text-danger">*</span></label>
                              <input type="text" name="name" placeholder="Name" required value="{{ $discount->policy_name }}"
                                     class="form-control @error('name') is-invalid @enderror">
                              @error('name')
                              <strong class="text-danger">{{ $errors->first('name') }}</strong>
                              @enderror
                            </div>
                            <div class="col-md-2"></div>
        
                          <div class="col-md-5">
                            <input type="hidden" name="id" value="{{ $discount->id }}">
                            <label class="control-label">Amount<span class="text-danger">*</span></label>
                            <input type="number" name="amount" placeholder="Ampunt" required value="{{ $discount->disc_amount }}"
                                   class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <strong class="text-danger">{{ $errors->first('name') }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row mt-5">
                        <div class="col-md-5">
                            <label for="date" class="col-3 col-form-label">Start Date:</label>
                            <div class="input-group mb-3" >
                            <div class="input-group date" id="datepicker">
                                <input type="text" name="sdate" class="form-control" id="date" value="{{$discount->start_date}}"/>
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
                                <input type="text" name="edate" class="form-control" id="date" value="{{$discount->end_date}}"/>
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
                            <button type="submit" class="btn btn-danger btn-block">Update</button>
                        </div>
                    </div>
                        

                      </form>
                </div>
            </div>
            </div>
        </div>
  </div>
</div>
@endsection

@section('script')
<script>
    $(function(){
  $('#datepicker').datepicker();
});
$(function(){
  $('#datepicker2').datepicker();
});
    </script>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection
