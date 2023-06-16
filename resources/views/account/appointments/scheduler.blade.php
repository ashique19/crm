@extends('layouts.app')

@section('title')
<title>Appointment Scheduler</title>
@endsection

@section('styles')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker.css') }}">    
    <link href="{{ asset('assets/css/pages/scheduler.css') }}" rel="stylesheet" type="text/css" />   
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css" />   
    <link href="{{ asset('assets/plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <style type="text/css">
        .btn-outline-default {
            border: 1px solid #e9ecef !important;
            color: #3b3f5c !important;
            background-color: transparent;
            box-shadow: none;
            font-size: 14px;
            padding: 4px;
        }
        .appoint_month_option{
            background : #30505b !important;
            color:#fff !important;
        }

        .meeting-profile{
            top: 42px !important;
        }
        .fc-scroller{
            overflow: scroll !important;

        }
        .date-heading{
            text-align :  center;
        }
    </style>
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <form class="float-right app-search">
                @php 

                    $months = [];
                    $months[] = date('F Y');
                    for($i = 1; $i<=6; $i++ ){
                        $addToMonth = date('F Y', strtotime("+".$i." months", strtotime($months[0])));
                        $months[] = $addToMonth;
                    }
                
                @endphp
                <select type="select" placeholder="Search..." class="ml-2 form-control appoint_month">
                    @if(!empty($months))
                        @foreach($months as $key=> $value)
                            <option class="appoint_month_option">{{$value}}</option>
                        @endforeach
                       
                    @endif
                </select>
                <button type="submit"><i class="fa fa-calendar"></i></button>
            </form>
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Appointment Scheduler</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="scheduler">
    <div class="row" id="cancel-row">
        <div class="col-xl-4 col-lg-5 col-md-5 layout-spacing">
            <div class="card">
                <div class="card-body">
                    @if(Session::get('success_msg'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h6><i class="icon fa fa-check"></i> {{Session::get('success_msg')}}</h6>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h4 class="s-widget-title mb-4"><i class="flaticon-edit-2"></i> Make an Appoinment</h4>

                    <form action="{{ route('account.appointments.scheduler') }}" method="post" class="appointment-form">
                        @csrf()
                        <h4 class="mb-4 pt-3"><i class="flaticon-gear"></i> Basic Details</h4>
                        <div class="form-group">
                            <label for="select-date" class="mt-3 sr-only">Select Date</label>
                            <input id="select-date" name="date" type="text" class="form-control mb-4 time ui-timepicker-input" placeholder="Select Date" autocomplete="off" required >
                        </div>
                        <div class="form-group">
                            <label for="first_name" class="mt-3 sr-only">First Name</label>
                            <input id="first_name" type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="mt-3 sr-only">last Name</label>
                            <input id="last_name" type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="mt-3 sr-only">Email</label>
                            <input id="appointment_email" type="email" class="form-control" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="mt-3 sr-only">Phone</label>
                            <input id="appointment_phone" type="text" class="form-control phone" placeholder="Phone" name="phone" value="{{ old('phone') }}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="inlineFormCustomSelect" class="sr-only">Choose</label>
                            <select name="appointment_service" class="custom-select mr-sm-2" id="inlineFormCustomSelect" required>
                                <option value="">Choose...</option>
                                @foreach($appointment_services as $appointment_service)
                                    <option value="{{$appointment_service->id}}">{{$appointment_service->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-5">
                            <h4 class="mt-4 mb-4"><i class="flaticon-star"></i> Available Slots</h4>
                            <div class="a-slots" id="avail">
                                @if(count($appointment_avails)>0)
                                @foreach($appointment_avails as $key => $appointment_avail)
                                    <div class="slots-1">
                                        <div class="custom-control custom-radio pl-0">
                                            <input type="radio" value="{{$appointment_avail->id}}" name="appointment_availability" class="custom-control-input" id="customRadio{{$key}}" required>
                                            <label class="custom-control-label" for="customRadio{{$key}}">{{ Carbon\Carbon::parse($appointment_avail->availability)->format('m/d/Y h:i a') }}</label>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <p>No availability for {{Carbon\Carbon::now()->format('Y-m-d')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mt-5">
                            <h4 class="mt-4 mb-4"><i class="flaticon-star"></i> Notifications</h4>
                            <div class="a-slots">
                                <div class="slots-1">
                                    <div class="custom-control custom-checkbox pl-0">
                                        <input type="checkbox" name="sms_notification" class="custom-control-input" value="1" id="customCheckbox1" >
                                        <label class="custom-control-label" for="customCheckbox1">Sms Notification</label>
                                    </div>
                                </div>
                                <div class="slots-1">
                                    <div class="custom-control custom-checkbox pl-0">
                                        <input type="checkbox" class="custom-control-input" name="email_notification" value="1" id="customCheckbox2" >
                                        <label class="custom-control-label" for="customCheckbox2">Email Notification</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="mt-4 mb-4"><i class="flaticon-star"></i> Appointment-Type</h4>
                            <label for="inlineFormCustomSelect1" class="sr-only">Appointment-Type</label>
                            <select name="appointment_type" class="custom-select mr-sm-2" id="inlineFormCustomSelect1" required>
                                <option value="">Choose..</option>
                                <option value="1">In-person</option>
                                <option value="2">Webcam</option>
                                <option value="3">Phone</option>
                                <option value="4">Messaging</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-rounded mb-1 mt-4" id="appointment_form">Add</button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7 col-md-7 layout-spacing scheduled-appointments">
            <div class="card">
                <div class="card-body">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-5 mt-2" id="service_types">
                        <h5 class="date-heading" id="date-heading"></h3>
                        <div class="row">
                           
                            <?php
                                $classes = array('primary', 'danger', 'info', 'grey', 'dark', 'success')
                            ?>
                            @foreach($appointment_services as $key => $appointment_service)
                                @if($appointment_service->color)
                                <?php $b_color = $appointment_service->color; ?>
                                @else
                                <?php $b_color = 'primary'; ?>
                                @endif
                                <div class="scheduled-appointments-category col-xl-3 mb-xl-0 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                    <button class="btn btn-gradient-{{ $b_color  }} btn-block mb-4 time ui-timepicker-input select-date" service_id="{{$appointment_service->id}}" value=""  btn_class={{$classes[$key]}} >{{$appointment_service->name}}
                                        <i class="fa fa-calendar" style="margin-left: 5px;"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row load_scheduler">
                            <!-- Ajax Res --->
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add_apnmt_modal">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
              
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Add Appointment</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <form action="{{ route('account.appointments.scheduler') }}" method="post" class="">
                <!-- Modal body -->
                    <div class="modal-body">
                   
                        <div class="form-group">
                            @csrf()
                            <input type="hidden" name="appointment_service" id="service_id">
                            <input type="hidden" name="appointment_availability" id="avail_id">
                            <input type="hidden" name="sms_notification" value="0">
                            <input type="hidden" name="email_notification" value="0">
                           
                           
                            <label for="first_name">First name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required >
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required >
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" required >
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control phone" name="phone" id="phone" required >
                        </div>
                        <div class="form-group">
                            <label for="appointment_type">Appointment Type:</label>
                             <select name="appointment_type" class="form-control" id="appointment_type" required>
                                <option value="">Choose..</option>
                                <option value="1">In-person</option>
                                <option value="2">Webcam</option>
                                <option value="3">Phone</option>
                                <option value="4">Messaging</option>
                            </select>
                        </div>
                    </div>
                
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save_appmt" class="btn btn-primary" id="submit">
                        Submit
                        </button>
                        
                    </div>
                </form>
                
              </div>
            </div>
        </div>
         <div class="modal fade" id="add_apnmt_modal_without_service">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
              
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Add Appointment</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <form action="{{ route('account.appointments.scheduler') }}" method="post" class="">
                <!-- Modal body -->
                    <div class="modal-body">
                   
                        <div class="form-group">
                            @csrf()
                            
                            <input type="hidden" name="appointment_availability" id="avail_id_without_service">
                            <input type="hidden" name="sms_notification" value="0">
                            <input type="hidden" name="email_notification" value="0">
                           
                           
                            <label for="first_name">First name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required >
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required >
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="add_email" required >
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control phone" name="phone" id="add_phone" required >
                        </div>
                        
                        <div class="form-group">
                            <label for="inlineFormCustomSelect">Service:</label>
                            <select name="appointment_service" class="custom-select mr-sm-2" id="inlineFormCustomSelect" required>
                                <option value="">Choose...</option>
                                @foreach($appointment_services as $appointment_service)
                                    <option value="{{$appointment_service->id}}">{{$appointment_service->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="appointment_type">Appointment Type:</label>
                             <select name="appointment_type" class="form-control" id="appointment_type" required>
                                <option value="">Choose..</option>
                                <option value="1">In-person</option>
                                <option value="2">Webcam</option>
                                <option value="3">Phone</option>
                                <option value="4">Messaging</option>
                            </select>
                        </div>
                       
                        
                    </div>
                
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="save_appmt" class="btn btn-primary" id="submit_add_appointment">
                                Submit
                            </button>
                        
                    </div>
                </form>
                
              </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts')
    <script type="text/javascript">
        var ajax_url_sch = '{{ route('account.appointments.schedulers') }}';
        var ajax_url_avail = '{{ route('account.appointments.appointments_avail') }}';
        var ajax_url_all_sch = '{{ route('account.appointments.all_schedulers') }}';
    </script>
    <script src="{{ asset('assets/plugins/date_time_pickers/bootstrap_date_range_picker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/scheduler.js') }}"></script>
    <script>
        $("#appointment_form").on("click",function(){
            var email = $("#appointment_email").val();
            var phone = $("#appointment_phone").val();

            if(email==""){
                $("#appointment_phone").attr("required","required");
            }else{
                $("#appointment_phone").removeAttr("required"); 
            }
            if(phone==""){
                $("#appointment_email").attr("required","required");
            }else{
                $("#appointment_email").removeAttr("required"); 
            }
        });
        $("#submit").on("click",function(){
            var email = $("#email").val();
            var phone = $("#phone").val();

            if(email==""){
                $("#phone").attr("required","required");
            }else{
                $("#phone").removeAttr("required"); 
            }
            if(phone==""){
                $("#email").attr("required","required");
            }else{
                $("#email").removeAttr("required"); 
            }
        });
        $("#submit_add_appointment").on("click",function(){
            var email = $("#add_email").val();
            var phone = $("#add_phone").val();

            if(email==""){
                $("#add_phone").attr("required","required");
            }else{
                $("#add_phone").removeAttr("required"); 
            }
            if(phone==""){
                $("#add_email").attr("required","required");
            }else{
                $("#add_email").removeAttr("required"); 
            }
        });
    </script>
    <script src="{{ asset('assets/plugins/fullcalendar/js/fullcalendar.min.js') }}"></script>
    
    <script type="text/javascript">
    
    $(document).ready(function() {
        function ordinal_suffix_of(i) {
            var j = i % 10,
                k = i % 100;
            if (j == 1 && k != 11) {
                return i + "st";
            }
            if (j == 2 && k != 12) {
                return i + "nd";
            }
            if (j == 3 && k != 13) {
                return i + "rd";
            }
            return i + "th";
        }
        $("#service_types").hide();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            navLinks: true,
            editable: false,
            dayClick: function(date, allDay, jsEvent, view) {

                var newdate = moment(date).format('YYYY-MM-DD');
                var day =  moment(date).format('D');
                var suffix = ordinal_suffix_of(day);
                var selected_date = moment(date).format('MMMM')+" "+suffix+ ", " + moment(date).format('YYYY');
                
                $.ajax({
                    url: ajax_url_all_sch,
                    data: {'date': newdate},
                    type: 'GET',
                    success: function(res){
                        $('.load_scheduler').html(res);
                        $("#service_types").show();
                        $("#date-heading").html("DATE SELECTED : " + selected_date );
                    },
                    error: function(err){
                       
                    }
                });
             
            }   
        });
    });
    </script>
    
@endsection