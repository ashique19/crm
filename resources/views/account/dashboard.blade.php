@extends('layouts.app')
@section('title')
<title>Dashboard</title>
@endsection

@section('styles')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('assets/plugins/morris/css/morris.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker.css') }}">    
    <link href="{{ asset('assets/css/pages/scheduler.css') }}" rel="stylesheet" type="text/css" />   
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css" />   
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<style>
  .cust_sel_cl{background-color: #306079 !important;}
  .cust_sel_cl{background-color: #306079 !important;}
  .gif_img{    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    text-align: center;
    background-color: #275165d1;
    z-index: 9;
    padding-top: 35%;}

   .gif_img img {
    width: 18%;
  }
/****Graph**/
.gif_img_graph{    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    text-align: center;
    background-color: #275165d1;
    z-index: 9;
    padding-top: 16%;}

    .gif_img_graph img {
    width: 8%;
}
#preloader_cust{position: relative;}
</style>
@endsection


@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <form class="float-right app-search">
                <select type="select" placeholder="Search..." class="ml-2 form-control cust_sel_cl" id="all_record">
                    @foreach($lists as $key=>$data)
                    <option value="{{$lists1[$key]}}">{{$data}}</option>
                    @endforeach
                </select>
                <button type="button"><i class="fa fa-calendar"></i></button>
            </form>
            <h5 class="float-right mr-5"> Quick Stats</h5>
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Dashboard</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('topcontent')
<div class="row">
    <div class="col-12 mb-4">

        <div class="row">
        <div class="col-xl-8">
         <div class="preloader_cust">
            <div class="gif_img_graph">
                <img src="{{ asset('assets/images/preloader.gif') }}">
            </div>
            <div class="card-transparent m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <h4 class="mt-0 header-title text-muted">Analytics</h4>
                        </div>

                        <div class="col-xl-6">
                          <div class="float-right badge badge-pill badge-info ml-2">Leads</div>
                          <div class="float-right badge badge-pill badge-warning ml-2">Appointments</div>
                          <div class="float-right badge badge-pill ml-2 badge-danger">Visitors</div>
                        </div>
                    </div>

                    <div id="morris-area-example1" class="dash-chart"></div>

                    <div class="row">
                      <div class="col-xl-10">
                        <form class="float-left app-search">
                            <select type="select" class="ml-2 form-control cust_sel_cl" id="graph">
                              <option value="">Select</option>
                              <option value="visitors">Visitors</option>
                              <option value="appointments">Appointments</option>
                              <option value="leads">Leads</option>
                            </select>
                            <button type="button"><i class="fa fa-cog"></i></button>
                        </form>
                        <form class="float-left app-search">
                             <input id="start_date" name="date" type="text" class="form-control mb-4 time ui-timepicker-input" placeholder="Select Date" autocomplete="off" required >
                            <button type="button"><i class="fa fa-calendar"></i></button>
                            
                        </form>
                        <form class="float-left app-search">
                            <input id="end_date" name="date" type="text" class="form-control mb-4 time ui-timepicker-input" placeholder="Select Date" autocomplete="off" required >
                            <button type="button"><i class="fa fa-calendar"></i></button>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="col-xl-4">
            <div id="preloader_cust">
            <div class="gif_img">
                <img src="{{ asset('assets/images/preloader.gif') }}">
            </div>
          <div class="row">
            <div class="col-md-6 col-xl-6">
                <div class="card-transparent text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-info" id="total_appointment">{{ $countValues['appointmentsbooked']->total }}</h3>
                        Appointments
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-6">
                <div class="card-transparent text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-info" id="newclients" >{{ $countValues['newclients']->total }}</h3>
                        New Clients
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-xl-6">
                <div class="card-transparent text-center m-b-30">
                      <div class="mb-2 card-body text-muted">
                      @if($countValues['revenue']->total=='')
                        <h3 class="text-info" id="revenue" >{{ 0 }}</h3>
                      @else
                       <h3 class="text-info" id="revenue" >${{ $countValues['revenue']->total }}</h3>
                      @endif   
                        Revenue
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-6">
                <div class="card-transparent text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-info" id="leadsReceived">{{ $countValues['leadsReceived']->total }}</h3>
                        Leads Received
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-xl-6">
                <div class="card-transparent text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-info" id="total_visits">{{ $countValues['total_visits']->total }}</h3>
                        Total Website Visits
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-6">
                <div class="card-transparent text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-info" id="uniqueVisitors">{{ $countValues['uniqueVisitors']->total }}</h3>
                        Unique Visitors
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
</div>
</div>
@endsection

@section('content')
            
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 m-b-30 header-title">Upcoming Appointments</h4>
                               @if($up_cmg_appmt == '')
                               <p>{{'No upcoming appointments '}}</p>
                               @else
                                <div class="table-responsive">
                                    <table class="table m-t-20 mb-0 table-vertical">

                                        <tbody>
                                            @foreach($up_cmg_appmt as $row)
                                        <tr>
                                            <td>
                        <p class="m-0 text-muted font-14">{{ $row->appointment_services->name }}</p>
                                                ({{$row->first_name}} {{$row->last_name}})
                                            </td>
                                            <td><center><p class="m-0 text-muted font-14">{{$row->active =='1'? 'Confirmed' : 'Canceled'}}</p> <i class="fa {{$row->active =='1'? 'fa-check-circle text-success' : 'fa-times-circle text-danger'}}"></i></center></td>
                                            <td>
                                                <p class="m-0 text-muted font-14">Date</p>
                                              {{ Carbon\Carbon::parse($row->appointment_avail->availability)->format('m/d/y')}}                       
                                            </td>
                                            <td>
                                                <p class="m-0 text-muted font-14">Time</p>
                                              {{ Carbon\Carbon::parse($row->appointment_avail->availability)->format('h:i a') }}                        
                                            </td>
                                                <td>    
                                                <p class="m-0 text-muted font-14">Appointment</p>                         
                                            @if($row->appointment_type == '1')         
                                                {{ 'In-Person' }}     
                                            @elseif($row->appointment_type == '2')  
                                                {{ 'Webcam' }} 
                                            @elseif($row->appointment_type == '3')  
                                                {{ 'Phone' }}
                                            @else  
                        {{ 'Messaging' }}    
                                            @endif
                                                </td>                                              
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm waves-effect edit_btn" appointment_id="{{$row->id}}" data-toggle="modal" data-target="#edit_appointment">
                                                  Edit
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                  @endif
                            </div>
                        </div>
                    </div>
                  
                    @if($appointments == '')
                     <div class="col-xl-4">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 m-b-15 header-title">Recent Activity Feed</h4>

                                <ol class="activity-feed mb-0">
                                    <li class="feed-item">
                                        <span class="date">  {{ 'No appointment' }}</span>
                                        <span class="activity-text">{{ 'No appointment' }}</span>
                                    </li>
                                    <li class="feed-item pb-2">
                                        <span class="date"> {{ 'No lead' }}</span>
                                        <span class="activity-text">{{ 'No lead' }}</span>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                    @else
                    <div class="col-xl-4">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 m-b-15 header-title">Recent Activity Feed</h4>

                                  <ol class="activity-feed mb-0">
                                    <li class="feed-item edit_btn" data-toggle="modal" data-target="#edit_appointment" appointment_id="{{$appointments->id}}">
                                        <span class="date">  {{ Carbon\Carbon::parse($appointments->created_at)->format('F d')}}</span>
                                        <span class="activity-text">{{$appointments->first_name}} {{$appointments->last_name}} booked a new appointment</span>
                                    </li>
                                    <li class="feed-item pb-2 model_edit" data-toggle="modal" data-target="#leadEditModal"  lead_id="{{$lead->id}}">
                                        <span class="date"> {{ Carbon\Carbon::parse($lead->created_at)->format('F d')}}</span>
                                        <span class="activity-text">New Lead: {{$lead->first_name}} {{$lead->last_name}}</span>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                @endif

<!-- Modal -->
<div class="modal fade" id="edit_appointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <form action="{{ route('account.dashboard.appointment_update') }}" method="POST">
    @csrf
  <div class="form-row">
    <input type="hidden" name="appmt_id" id="appmt_id">
    <div class="form-group col-md-6">
      <label for="inputEmail4">First name</label>
      <input type="text" class="form-control" id="first_name" name="first_name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Last name</label>
      <input type="text" class="form-control" id="last_name" name="last_name">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputStatus">Status</label>
     <select class="form-control" name="active" id="active">
        <option value="0"> Canceled</option>
        <option value="1">Confirmed</option>       
     </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputType">Type</label>
      <select class="form-control" id="appointment_type" name="appointment_type">
        <option value="1">In-Person</option>
        <option value="2">Webcam</option>
        <option value="3">Phone</option>
        <option value="4">Messaging</option>
      </select>
    </div>
  </div>
  <div class="form-group">
      <label for="availability">Availability:</label>
      <select name="availability" id="availability" class="form-control" required>
          @foreach($appointment_availability as $app_avail)
          <option value="{{ $app_avail->id }}">
        {{ Carbon\Carbon::parse($app_avail->availability)->format('m/d/Y h:i a') }}
          </option>
          @endforeach
      </select>
  </div> 
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value=" Save changes">
      </div>
  </form>
    </div>
  </div>
</div>

@include('account/website/leads/editlead')
@endsection

@section('scripts')
<!--Morris Chart-->
<script type="text/javascript">
    var areadata = '{!! $areaData !!}';
    var ajax_edit_url = "{{ route('account.website.getLeadById') }}";
</script>
<!-- Required datatable js -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/morris/js/morris.min.js') }}"></script>
<script src="{{ asset('assets/plugins/raphael/raphael.js') }}"></script>
<script src="{{ asset('assets/plugins/date_time_pickers/bootstrap_date_range_picker/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<!-- Required datatable js -->
<script src="{{ asset('assets/js/pages/lead.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $(".gif_img").hide();
      $(".gif_img_graph").hide(); 
      $('.phone').inputmask("(999) 999-9999");
      $('#start_date').daterangepicker({ 
        "singleDatePicker": true,
        "startDate": moment().subtract(30, 'day'),
        "maxDate": new Date()
      },function(start, end, label) {
        $(".gif_img_graph").show();
        var date = new Date(start.toLocaleString());
        var start_date = moment(date).format('YYYY-MM-DD');
        var metric_type = $('#graph').find(":selected").val();
        var end_date1 = $("#end_date").val();
        var end_date1 = new Date(end_date1.toLocaleString());
        var end_date = moment(end_date1).format('YYYY-MM-DD');
        draw_chart(metric_type,start_date,end_date);
      });
      $('#end_date').daterangepicker({ 
        "singleDatePicker": true,
         "maxDate": new Date()
      },function(start, end, label) {
        $(".gif_img_graph").show();
        var date = new Date(start.toLocaleString());
        var end_date = moment(date).format('YYYY-MM-DD');
        var metric_type = $('#graph').find(":selected").val();
        var start_date1 = $("#start_date").val();
        var start_date1 = new Date(start_date1.toLocaleString());
        var start_date = moment(start_date1).format('YYYY-MM-DD');
        draw_chart(metric_type,start_date,end_date);
      });
    $('.edit_btn').click(function() {
        var appointment_id = $(this).attr("appointment_id");
        $.ajax({
            url: "{{ route('account.appointment_data') }}",
            type:"POST",
            data:{ "_token": "{{ csrf_token() }}","id": appointment_id},
            success:function(data){
                var data = data.data;
                
                $("#appmt_id").val(data.id);
                $("#first_name").val(data.first_name);
                $("#last_name").val(data.last_name);
                $("#availability").val(data.appointment_availability_id);
                $("#active").val(data.active);
                $("#appointment_type").val(data.appointment_type);                
            }
        });
    });

  
     $("#all_record").change(function () {
        $(".gif_img").show();
       var date = $(this).val();
        $.ajax({
            url: "{{ route('account.all_record') }}",
            type:"POST",
            data:{ "_token": "{{ csrf_token() }}","selected_date": date},
            success:function(data){
               $(".gif_img").hide();
               $('#total_appointment').text(data.appointmentsbooked.total);             
               $('#leadsReceived').text(data.leadsReceived.total);
               $('#newclients').text(data.newclients.total); 
               $('#total_visits').text(data.total_visits.total);
               if(data.revenue.total != null){
                 $('#revenue').text(data.revenue.total);
               }else{
                 $('#revenue').text(0);
               }
               $('#uniqueVisitors').text(data.uniqueVisitors.total)

            }
        });

    });
     $('#graph').on('change', function() {
      $(".gif_img_graph").show();
      var metric_type = $(this).val();
      var start_date1 = $("#start_date").val();
      var start_date1 = new Date(start_date1.toLocaleString());
      var start_date = moment(start_date1).format('YYYY-MM-DD');
      var end_date1 = $("#end_date").val();
      var end_date1 = new Date(end_date1.toLocaleString());
      var end_date = moment(end_date1).format('YYYY-MM-DD');
        draw_chart(metric_type,start_date,end_date);
    });

    var $areaData = JSON.parse(areadata);
    var chart = createAreaChart('morris-area-example1', 0, 0, $areaData, 'y', ['a', 'b', 'c'], ['Visitors', 'Appointments', 'Leads'], ['#ccc', '#f15a69', '#4bbbce']);

    });
     function createAreaChart (element, pointSize, lineWidth, data, xkey, ykeys, labels, lineColors) {
          Morris.Area({
              element: element,
              pointSize: 0,
              lineWidth: 0,
              data: data,
              xkey: xkey,
              ykeys: ykeys,
              labels: labels,
              resize: true,
              gridLineColor: '#eee',
              hideHover: 'auto',
              lineColors: lineColors,
              fillOpacity: .6,
              behaveLikeLine: true
          });
      }
    function draw_chart(metric_type,start_date,end_date){
       $.ajax({
            url: "{{ route('account.graph_data') }}",
            type:"POST",
            data:{ "_token": "{{ csrf_token() }}","metric_type": metric_type,"start_date": start_date,"end_date": end_date},
            success:function(data){
              $(".gif_img_graph").hide(); 
              $("#morris-area-example1").empty();
            if(data.title == ''){
              var chart = createAreaChart('morris-area-example1', 0, 0, JSON.parse(areadata), 'y', ['a','b','c'], ['Visitors', 'Appointments', 'Leads'], ['#ccc', '#f15a69', '#4bbbce']);

            }else{
                 var chart = createAreaChart('morris-area-example1', 0, 0, data.data, 'y', ['a'], [data.title], ['#ccc']);
            }

            }
        });
    }
</script>
@endsection
