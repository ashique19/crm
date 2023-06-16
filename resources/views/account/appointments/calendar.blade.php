@extends('layouts.app')
@section('title')
<title>Appointment Calendar</title>
@endsection

@section('styles')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('assets/plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <style type="text/css">
        .fc-day-grid-event .fc-content{
            white-space:  normal;
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
                    <li class="active"><a href="#">View Calendar</a> </li>
                </ul>
            </div>
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> View Calendar</h4>
        </div>
        @if(Session::get('response')['msg'])
            <div class="alert alert-{{Session::get('response')['class'] }} alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{Session::get('response')['msg']}}
            </div>
        @endif
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="row layout-spacing" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div id='calendar'></div>

                        <div style='clear:both'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="appointment_modal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabel">Appointment Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="appointment_detail"></div>
            </div>
        </div>
    </div>

    <!-- Modal For Adding Appointment-->
    <div class="modal fade" id="appointment_add_modal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabelAdd" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabelAdd">Appointment Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="appointment_add_detail">
                
                </div>
            </div>
        </div>
    </div>
    <!-- Modal For Adding Appointment End-->
</div>

@endsection

@section('scripts') 


    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
           var calendar = $("#calendar").fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                navLinks: true,
                editable: false,
                eventLimit: false,
                displayEventTime: false,
                events : [
                    @foreach($appointment_availability as $appointment)
                    {
                        @php
                            $time = Carbon\Carbon::parse($appointment->availability)->format('h:i a')
                        @endphp
                        @if($appointment->appointments && $appointment->appointments->active==1)
                            title : "{{ $appointment->appointments->appointment_services->name.' '.$time }}",
                            start : '{{ $appointment->availability }}',
                            id : '{{ $appointment->appointments->id }}',
                            type : 'edit',
                            className: '{{$appointment->appointments->appointment_services->color}}',
                            backgroundColor: "{{$appointment->appointments->appointment_services->color=='success'?'green':($appointment->appointments->appointment_services->color=='warning'?'#ff9a44':($appointment->appointments->appointment_services->color=='danger'?'#fe9a8b':''))}}",
                            borderColor: "{{$appointment->appointments->appointment_services->color=='success'?'green':($appointment->appointments->appointment_services->color=='warning'?'#ff9a44':($appointment->appointments->appointment_services->color=='danger'?'#fe9a8b':''))}}",
                        @else
                            title : '{{ $time }}',
                            id: '{{ $appointment->id }}',
                            type : 'add',
                            backgroundColor: '#ddd',
                            borderColor: '#ddd',
                            textColor: '#000 !important',
                            start : '{{ $appointment->availability }}',
                        @endif
                    },
                    @endforeach
                ],
                eventRender: function(event, element) {

                },
                eventClick: function(event, jsEvent, view){
                    if(event.id){
                        if(event.type == "add"){
                            $.ajax({
                                url: "{{ route('account.appointments.event.add') }}",
                                data: {'id':event.id},
                                type: 'GET',
                                success: function(response){
                                    $("#appointment_add_detail").html(response);
                                },
                                error: function(e){
                                }
                            });
                            $('#appointment_add_modal').modal();
                        }else{
                            $.ajax({
                                url: "{{ route('account.appointments.event') }}",
                                data: {'id':event.id},
                                type: 'GET',
                                success: function(response){
                                    $("#appointment_detail").html(response);
                                },
                                error: function(e){
                                }
                            });
                            $('#appointment_modal').modal();
                        }
                       
                    }
                }
            });
        });
    </script>

@endsection
