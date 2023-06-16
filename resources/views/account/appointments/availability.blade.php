@extends('layouts.app')

@section('title')
<title>Appointment Availability</title>
@endsection


@section('styles')
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/date_time_pickers/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/timepicker/jquery.timepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css" />

    <style type="text/css">
        .hidden {
            display:none;
        }
        
        input[type="checkbox"] {
            height: inherit;
        }
        .input-group-addon {
            height: 51px;
            min-width: 51px;
            font-size: 1.5rem;
        }
        .add-listing-section {
            z-index: 0;
        }
        .timerange-container {
            border-bottom: 1px solid #eeeeee;
            margin-bottom: 10px;
        }
    </style>    
    
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="crumbs float-right">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><a href="{{ route('account.dashboard') }}"><i class="fa fa-tachometer"></i></a></li>
                    <li class="active"><a href="javascript:void(0);">Manage Availability</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Manage Availability</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                 @if(Session::get('response')['msg'])
                    <div class="alert alert-{{Session::get('response')['class'] }} alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{Session::get('response')['msg']}}
                    </div>
                @endif
                <form action="{{ route('account.appointments.availability_store') }}" name="availability_form" id="availability_form" enctype="multipart/form-data" method="POST">
                    @csrf()
                    <div class="style-2 padding-top-30">
                        <!-- Tabs Content -->
                        <div class="tabs-container">
                            <div class="tab-content" style="display: inline-block">
                                <!--Date range-->
                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <div class="toggle-wrap">
                                            <span class="trigger active"><a href="javascript:void(0);">Date Range<i class="sl sl-icon-plus"></i></a></span>
                                            <div class="toggle-container" style="display: block;">
                                                <div class="row with-forms">
                                                    <div class="col-md-12 text-center">
                                                        <p>Click on the input field to select date rate</p>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>From</h5>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
                                                                <input 
                                                                    type="text" 
                                                                    class="form-control date" 
                                                                    name="fromdate" 
                                                                    id="fromdate" 
                                                                    value="{{ date('m/d/Y') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>To</h5>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
                                                                <input 
                                                                    type="text" 
                                                                    class="form-control date" 
                                                                    name="todate" 
                                                                    id="todate"
                                                                    value="{{ date('m/d/Y') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Eo Date Range-->
                                <!--Eo Date range-->
                                
                                <!--Opening hours-->
                                <!--Opening hours-->
                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <div class="toggle-wrap">
                                            <span class="trigger active"><a href="javascript:void(0);">Opening Hours<i class="sl sl-icon-plus"></i></a></span>
                                            <div class="toggle-container" style="display: block;">
                                                <div class="row with-forms">
                                                    <div class="col-md-12 text-center">
                                                        <p>Set Opening Hours in the Selected Date Range</p>
                                                    </div>
                                                    
                                                    <!--Monday-->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="custom-control custom-checkbox ">
                                                                    <h5>
                                                                        <input type="checkbox" value="1" class="custom-control-input" data-target="#monday-time-range" name="monday" data-toggle='collapse' id="monday">
                                                                        <label class="custom-control-label" for="monday">Monday</label>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default collapse timerange-container" id="monday-time-range">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="monFrom">From:</label>
                                                                                <input type="text" name="monday_from" id="monFrom" class="form-control timepicker">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="monTo">To:</label>
                                                                                <input type="text" name="monday_to" id="monTo" class="form-control timepicker">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Eo Monday-->
                                                    
                                                    <!--Tuesday-->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="custom-control custom-checkbox ">
                                                                    <h5>
                                                                        <input type="checkbox" value="1" class="custom-control-input" data-target="#tuesday-time-range" name="tuesday" data-toggle='collapse' id="tuesday">
                                                                        <label class="custom-control-label" for="tuesday">Tuesday</label>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default collapse timerange-container" id="tuesday-time-range">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="tueFrom">From:</label>
                                                                                <input type="text" name="tuesday_from" id="tueFrom" class="form-control timepicker">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="tueTo">To:</label>
                                                                                <input type="text" name="tuesday_to" id="tueTo" class="form-control timepicker">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Eo Tuesday-->
                                                    
                                                    <!--Wednesday-->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="custom-control custom-checkbox ">
                                                                    <h5>
                                                                        <input type="checkbox" value="1" class="custom-control-input" data-target="#wednesday-time-range" name="wednesday" data-toggle='collapse' id="wednesday">
                                                                        <label class="custom-control-label" for="wednesday">Wednesday</label>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default collapse timerange-container" id="wednesday-time-range">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="wedFrom">From:</label>
                                                                                <input type="text" name="wednesday_from" id="wedFrom" class="form-control timepicker">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="wedTo">To:</label>
                                                                                <input type="text" name="wednesday_to" id="wedTo" class="form-control timepicker">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Eo Wednesday-->
                                                    
                                                    <!--Thursday-->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="custom-control custom-checkbox ">
                                                                    <h5>
                                                                        <input type="checkbox" value="1" class="custom-control-input" data-target="#thursday-time-range" name="thursday" data-toggle='collapse' id="thursday">
                                                                        <label class="custom-control-label" for="thursday">Thursday</label>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default collapse timerange-container" id="thursday-time-range">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="thurFrom">From:</label>
                                                                                <input type="text" name="thursday_from" id="thurFrom" class="form-control timepicker">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="thurTo">To:</label>
                                                                                <input type="text" name="thursday_to" id="thurTo" class="form-control timepicker">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Eo Thursday-->
                                                    
                                                    <!--Friday-->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="custom-control custom-checkbox ">
                                                                    <h5>
                                                                        <input type="checkbox" value="1" class="custom-control-input" data-target="#friday-time-range" name="friday" data-toggle='collapse' id="friday">
                                                                        <label class="custom-control-label" for="friday">Friday</label>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default collapse timerange-container" id="friday-time-range">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="friFrom">From:</label>
                                                                                <input type="text" name="friday_from" id="friFrom" class="form-control timepicker">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="friTo">To:</label>
                                                                                <input type="text" name="friday_to" id="friTo" class="form-control timepicker">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Eo Friday-->
                                                    
                                                    <!--Saturday-->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="custom-control custom-checkbox ">
                                                                    <h5>
                                                                        <input type="checkbox" value="1" class="custom-control-input" data-target="#saturday-time-range" name="saturday" data-toggle='collapse' id="saturday">
                                                                        <label class="custom-control-label" for="saturday">Saturday</label>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default collapse timerange-container" id="saturday-time-range">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="satFrom">From:</label>
                                                                                <input type="text" name="saturday_from" id="satFrom" class="form-control timepicker">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="satTo">To:</label>
                                                                                <input type="text" name="saturday_to" id="satTo" class="form-control timepicker">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Eo Saturday-->
                                                    
                                                    <!--Sunday-->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-6">
                                                                <div class="custom-control custom-checkbox ">
                                                                    <h5>
                                                                        <input type="checkbox" value="1" class="custom-control-input" data-target="#sunday-time-range" name="sunday" data-toggle='collapse' id="sunday">
                                                                        <label class="custom-control-label" for="sunday">Sunday</label>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default collapse timerange-container" id="sunday-time-range">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="sunFrom">From:</label>
                                                                                <input type="text" name="sunday_from" id="sunFrom" class="form-control timepicker">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="sunTo">To:</label>
                                                                                <input type="text" name="sunday_to" id="sunTo" class="form-control timepicker">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Eo Sunday-->
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Eo Opening hours-->
                                <!--Eo Opening hours-->
                                
                                <!--Appointment length-->
                                <!--Appointment Length-->
                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <div class="toggle-wrap">
                                            <span class="trigger active"><a href="#">Appointment Length<i class="sl sl-icon-plus"></i></a></span>
                                            <div class="toggle-container" style="display: block;">
                                                <div class="row with-forms">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <select class="custom-select mr-sm-2" name="length" id="length">
                                                                    <option value="45">45</option>
                                                                </select>
                                                                <span class="input-group-addon">
                                                                    Minutes
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Eo Appointment Length-->
                                <!--Eo Appointment length-->
                                
                                <!--Break Time-->
                                <!--Break time between appointment-->
                                <div class="row with-forms">
                                    <div class="col-md-12">
                                        <div class="toggle-wrap">
                                            <span class="trigger active"><a href="#">Break Time<i class="sl sl-icon-plus"></i></a></span>
                                            <div class="toggle-container" style="display: block;">
                                                <div class="row with-forms">
                                                    <div class="col-md-12">
                                                        <p>Time Between Appointments</p>
                                                    </div>
                                                    
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <select class="custom-select mr-sm-2" name="break" id="break">
                                                                    <option value="0">0</option>
                                                                    <option value="15">15</option>
                                                                    <option value="30">30</option>
                                                                </select>
                                                                <span class="input-group-addon">
                                                                    Minutes
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Eo Break time between appointment-->
                                <!--Eo Break Time-->
                                
                            </div>
                            
                            <div class="row margin-20">
                                <div class="col-md-12">
                                    <button class="btn btn-md btn-success waves-effect float-right" type="submit"name="action">
                                        Add Availability
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->                
                
@endsection

@section('scripts') 
<script type="text/javascript" src="{{ asset('assets/plugins/date_time_pickers/bootstrap_date_range_picker/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/date_time_pickers/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/timepicker/jquery.timepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/timepicker/custom-timepicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.date').datepicker();
    })
</script>
@endsection           
