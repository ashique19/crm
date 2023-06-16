@extends('layouts.app')

@section('title')
<title>Reviews</title>
@endsection

@section('styles')
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap-rating/bootstrap-rating.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="crumbs float-right">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><a href="{{ route('account.dashboard') }}"><i class="fa fa-tachometer"></i></a></li>
                    <li class="active"><a href="javascript:void(0);">Reviews</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Reviews</h4>
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
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Review From</th>	
                            <th>Service</th>	
                            <th>Appointment Time</th>		
                            <th>Options</th>							
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointment_reviews as $appointment_reviews)
                            <tr>
                                <td width="15%">
                                    <input type="hidden" class="rating-tooltip-manual" data-filled="fa fa-star fa-2x" data-empty="fa fa-star-o fa-2x" data-fractions="3" value="{{$appointment_reviews->rating}}" data-readonly />
                                </td>
                                <td>
                                    {{ substr($appointment_reviews->review,0,100) }}
                                </td>
                                <td>
                                    {{ $appointment_reviews->appointment->first_name.' '.$appointment_reviews->appointment->last_name }}
                                </td>		
                                <td>
                                     {{ $appointment_reviews->appointment->appointment_services->name }}
                                </td>						
                                <td>
                                    {{ Carbon\Carbon::parse($appointment_reviews->appointment->appointment_avail->availability)->format('m/d/Y h:s a') }}
                                </td>	
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#reviewModal{{$appointment_reviews->id}}">Read Full Review</button>
                                    <div class="modal fade" id="reviewModal{{$appointment_reviews->id}}">
                                        <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Review</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>
                                                    {{ $appointment_reviews->review }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </td>								
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection

@section('scripts')

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
<!-- Responsive examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-rating/bootstrap-rating.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.rating-tooltip-manual').rating();
    });
</script>
@endsection