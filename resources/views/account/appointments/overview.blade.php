@extends('layouts.app')
@section('title')
<title>Appointment Overview</title>
@endsection

@section('styles')
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="crumbs float-right">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><a href="{{ route('account.dashboard') }}"><i class="fa fa-tachometer"></i></a></li>
                    <li class="active"><a href="#">View Appointments</a> </li>
                </ul>
            </div>
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> View Appointments</h4>
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
                    <div class="row">
                        <div class="col-12">
                            <p class="text-muted m-b-30 font-14 float-right"><a href="{{ route('account.appointments.scheduler') }}" class="btn btn-primary">Create New Appointment</a>
                            </p>
                        </div>
                    </div>

                    <table id="overview_datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Service Name</th>
                                <th>Availability Type</th>                  
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>

                        @if(!empty($appointments))
                            <tbody>
                            @foreach($appointments as $appointment)
                                <tr class="{{ $appointment->active==1?'':'background-danger' }}">
                                    <td>{{ !is_null($appointment->appointment_avail)?Carbon\Carbon::parse($appointment->appointment_avail->availability)->format('m/d/Y'):'' }}</td>
                                    <td>{{ !is_null($appointment->appointment_avail)?Carbon\Carbon::parse($appointment->appointment_avail->availability)->format('h:i a'):'' }}</td>
                                    <td>{{ $appointment->first_name }}</td>
                                    <td>{{ $appointment->last_name }}</td>
                                    <td>{{ !is_null($appointment->appointment_services)?$appointment->appointment_services->name:'' }}</td>
                                    <td>{{ $appointment_type[$appointment->appointment_type] }}</td>
                                    <td>{{ !is_null($appointment->appointment_services)?$appointment->appointment_services->duration:'' }} min</td>
                                    <td>{{ $appointment->active==1?'Confirmed':'Canceled' }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="model_edit btn btn-info mr-1" apmt_id="{{ $appointment->id }}">Edit</a>
                                        <a href="{{ route('account.appointments.change_status',$appointment->id) }}" class="btn {{ $appointment->active==1?'btn-warning':'btn-success' }} mr-1"> {{ $appointment->active==1?'Cancel':'Confirm' }}</a><a href="javascript:void(0);" class="appmnt_del btn btn-danger" apmt_id="{{ $appointment->id }}" >Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="modal fade" id="edit_model">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Appointment</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="{{ route('account.appointments.updateAppointment') }}" method="post" class="">
			@csrf()
            <!-- Modal body -->
            <div class="modal-body">
                    <div class="form-group">
                       
                        <input type="hidden" name="appmt_id" id="appmt_id">
                        <label for="first_name">First name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required >
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required >
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" id="email" required >
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone" id="phone" required >
                    </div>
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select name="type" id="type" class="form-control" required >
                            @foreach($appointment_type as $key=>$type)
                            <option value="{{ $key }}">
                                {{ $type }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service">Services:</label>
                        <select name="service" id="service" class="form-control" required >
                            @foreach($appointment_service as $app_service)
                            <option value="{{ $app_service->id }}">
                                {{ $app_service->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="availability">Availability:</label>
                        <select name="availability" id="availability" class="form-control" required>
                            @foreach($appointment_availability as $app_avail)
                            <option value="{{ $app_avail->id }}">
                                {{ $app_avail->availability }}
                            </option>
                            @endforeach
                        </select>
                    </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                    <button type="submit" name="save_appmt" class="btn btn-primary">
                        Update
                    </button>			
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
			</form>

          </div>
        </div>
    </div>

@endsection

@section('scripts')
<script type="text/javascript">
    var ajax_edit_url = "{{ route('account.appointments.getAppointmentById') }}";
    var ajax_delete_url = "{{ route('account.appointments.deleteAppointmentById') }}";
    var ajax_redirect_url = "{{ route('account.appointments.overview') }}";
</script>
<!-- Required datatable js -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/appointment_overview.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $( function() {
            $( "#datepicker" ).datepicker({
                orientation: "bottom right",
                autoclose: true,
                todayHighlight: true
            }).on('changeDate', function(e){
                var search_date = $(this).val();  // getting search input value
                table.column(0).search( search_date ).draw();
            });
        } );
  
        $("#overview_datatable").one("preInit.dt", function () {
            $button = $("<input type='text' id='datepicker' placeholder='Search Date' class='form-control form-control-sm' >");
            $("#overview_datatable_filter label").append($button);
            $button.button();

        });
        var table = $('#overview_datatable').DataTable();
       
        $(document).on('keyup change','#datepicker',function(){
            var search_date =$(this).val();
            if (Date.parse(search_date)) {
               //Valid date
               
            } else {
              //Not a valid date
                table.column(0).search('' ).draw();
            }
           
        });
    });
</script>
@endsection
