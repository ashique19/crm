@extends('layouts.app')

@section('title')
<title>Services</title>
@endsection

@section('styles')
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="crumbs float-right">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><a href="{{ route('account.dashboard') }}"><i class="fa fa-tachometer"></i></a></li>
                    <li class="active"><a href="javascript:void(0);">Manage Services</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Manage Services</h4>
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
                        @if(Session::get('success_msg'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{Session::get('success_msg')}}
                            </div>
                        @endif
                        <p class="text-muted m-b-30 font-14 float-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#serviceAddModal" data-whatever="@mdo">Create New Service</button>
                            <div class="modal fade" id="serviceAddModal" tabindex="-1" role="dialog" aria-labelledby="serviceAddModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="serviceAddModalLabel"> 
                                        Add Service
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{ route('account.services.store')}}" method="post">
                                        @csrf()
                                      <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                              <div class="form-group">
                                                <label for="name1" class="col-form-label">Name:</label>
                                                <input type="text" name="name" class="form-control" id="name1" required>
                                              </div>
                                            </div>
                                            <div class="col-sm-6">
                                              <div class="form-group">
                                                <label for="description1" class="col-form-label">Description:</label>
                                                <input type="text" name="description" class="form-control" id="description1" required>
                                              </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-sm-6">
                                              <div class="form-group">
                                                <label for="duration1" class="col-form-label">Duration (minutes):</label>
                                                <input type="number" name="duration" class="form-control" id="duration1" min="0" required>
                                              </div>
                                            </div>
                                            <div class="col-sm-6">
                                              <div class="form-group">
                                                <label for="amount1" class="col-form-label">Price:</label>
                                                <input type="text" name="amount" class="form-control amount" id="amount1" required>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            <div class="form-group">
                                              <label for="appointment_types1" class="col-form-label">Appointment Type:</label>
                                              <select class="form-control mselect2" name="appointment_types[]" multiple="multiple" id="appointment_types1">
                                                  <option value="1">In-person</option>
                                                  <option value="2">Webcam</option>
                                                  <option value="3">Phone</option>
                                                  <option value="4">Messaging</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-sm-6">
                                            <div class="form-group">
                                              <label for="color1" class="col-form-label">Color:</label>
                                              <select class="form-control" name="color" id="color1">
                        													<option value="success">Green</option>
                        													<option value="info">Blue</option>
                        													<option value="warning">Yellow</option>
                        													<option value="danger">Red</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                          </div>
                                      </div>
                                    </form>
                                  </div>
                                  
                                </div>
                            </div>
                            </div>
                        </p>
                    </div>
                </div>

                <table id="datatable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>						
                        <th>Duration</th>					
                        <th>Status</th>						
                        <th>Options</th>
                    </tr>
                    </thead>

                    <tbody>
                       
                        @foreach($appointment_services as $appointment_services)
                            <tr>
                                <td>{{$appointment_services->name}}</td>
                                <td>{{$appointment_services->description}}</td>
                                <td>${{$appointment_services->amount}}</td>								
                                <td>{{$appointment_services->duration}} min</td>
                                <td>{{ $appointment_services->active==1 ? 'Activated' : 'Inactive' }}</td>								
                                <td>
                                    <button class="btn btn-info mr-1 model_edit" service_id="{{$appointment_services->id}}">Edit</button>
                                    <button class="btn btn-danger service_del" service_id="{{$appointment_services->id}}">Delete</button>
                                     <?php
                                        $classbtn = array('warning','success' );
                                        if($appointment_services->active==1){
                                            $dd = $classbtn[0];
                                        }else{
                                            $dd = $classbtn[1];
                                        }
                                     ?>
                                    <a href="{{ route('account.services.change_status',$appointment_services->id) }}" class="btn btn-{{$dd}}" id="aaa">{{ $appointment_services->active==1 ? 'Inactivate' : 'Activate' }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="modal fade" id="edit_model" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="serviceModalLabel"> Edit Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('account.services.updateService')}}" method="post">
            @csrf()
          <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="hidden" name="id" class="form-control" id="serviceID">
                    <label for="name" class="col-form-label">Name:</label>
                    <input type="text" name="name" required class="form-control" id="name">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="description" class="col-form-label">Description:</label>
                    <input type="text" name="description" class="form-control" id="description" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="duration" class="col-form-label">Duration:</label>
                    <input type="number" name="duration" class="form-control" min="0" id="duration" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="amount" class="col-form-label">Amount:</label>
                    <input type="text" name="amount" class="form-control amount" id="amount" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="appointment_types" class="col-form-label">Appointment Type:</label>
                    <select class="form-control mselect2" name="appointment_types[]" multiple="multiple" id="appointment_types">
                        <option value="1">In-person</option>
                        <option value="2">Webcam</option>
                        <option value="3">Phone</option>
                        <option value="4">Messaging</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="color" class="col-form-label">Color:</label>
                    <select class="form-control" name="color" id="color">
                        <option value="success">Green</option>
                        <option value="info">Blue</option>
                        <option value="warning">Yellow</option>
                        <option value="danger">Red</option>
                    </select>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    var ajax_edit_url = "{{ route('account.services.getServiceById') }}";
    var ajax_delete_url = "{{ route('account.services.deleteServiceById') }}";
    var ajax_redirect_url = "{{ route('account.appointments.services') }}";
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
<!-- Responsive examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/services.js') }}"></script>
@endsection