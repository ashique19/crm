@extends('layouts.app')

@section('title')
<title>Website Leads</title>
@endsection

@section('styles')
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
	<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .nav{
            display: inherit;
        }
        .cat_tabs li a.active{
            color: #fff !important;
            background-image: linear-gradient(-20deg, #fc6076 0%, #ff9a44 100%) !important;
            background-color: #ff9a44 !important;
        }
    </style>

@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#leadAddModal">Add Lead</button>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Manage Leads</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="row">
    <div class="col-3">
        <div class="card m-b-20">
            <div class="card-body">
                <ul class="list-unstyled nav cat_tabs" role="tablist">
                    @foreach($status AS $key=>$st)
                    <li class="">
                        <a class="nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ $key==0?'active show':'' }}" data-toggle="tab" href="#{{ Str::slug($st['name'],'-') }}{{ $key }}" role="tab" aria-selected="false">{{ $st['name'] }} ({{ $st['count'] }})</a> 
                    </li>
                    @endforeach            
                </ul>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="card m-b-20">
            <div class="card-body">
                @if(Session::get('success_msg'))
                    <div class="alert alert-success alert-dismissable col-sm-12">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6><i class="icon fa fa-check"></i> {{Session::get('success_msg')}}</h6>
                    </div>
                @endif
                <div class="tab-content">
                    @foreach($status AS $key=>$st)
                        <div class="tab-pane p-3 {{ $key==0?'active show':'' }}" id="{{ Str::slug($st['name'],'-') }}{{ $key }}" role="tabpanel">
                            <div id="datatable_wrapper{{$key}}" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable{{$key}}" class="table table-bordered datatable">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Conversion Point</th>
                                                <th>Registration</th>						
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($leads AS $lead)
                                                    @if($lead->status == $key)		
                                                     <tr>
                                                        <td>{{$lead->first_name}} {{$lead->last_name}}</td>
                                                        <td>{{$lead->email}}</td>
                                                        <td>{{$lead->phone}}</td>
                                                        <td>{{ucwords(str_replace('_',' ',$lead->conversion_point))}}</td>
                                                        <td>{{ Carbon\Carbon::parse($lead->created_at)->format('m/d/Y') }}</td>							
                                                        <td>
                                                            <button class="btn btn-info mr-1 model_edit" lead_id="{{$lead->id}}">
                                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            </button>
                                                            <button class="btn btn-danger lead_del" type="button" lead_del="{{$lead->id}}">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </button>
                                                        </td> 
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="modal fade" id="leadAddModal" tabindex="-1" role="dialog" aria-labelledby="leadAddModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="leadAddModalLabel"> 
                Add Lead
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('account.website.addLead')}}" id="leadAddForm" method="post" enctype="multipart/form-data">
                @csrf()
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="first_name" class="col-form-label">First name:</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-form-label">Last name:</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="email" name="email" class="form-control" id="email" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="phone" class="col-form-label">Phone:</label>
                                <input type="text" name="phone" class="form-control phone" id="phone" >
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p id="phone_or_email_required" style="display: none; color: #8a6d3b;"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="conversion_point" class="col-form-label">Conversion point:</label>
                                <select name="conversion_point" class="form-control" id="conversion_point" required>
                                    <option value="phone">Phone</option>
                                    <option value="contact_form">Contact Form</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="status12" class="col-form-label">Status:</label>
                                <select name="status" class="form-control" id="status12" required>
                                    <option value="0">New Lead</option>
                                    <option value="1">Client</option>
                                    <option value="2">Inactive Client</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="notes" class="col-form-label">Notes:</label>
                                <textarea name="notes" class="form-control" id="notes"></textarea>
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
<div class="modal fade" id="leadEditModal" tabindex="-1" role="dialog" aria-labelledby="leadEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leadEditModalLabel"> 
                    Edit Lead
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('account.website.updateLead')}}" id="leadEditForm" method="post" enctype="multipart/form-data">
                    @csrf()
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <input type="hidden" name="id" id="leadId">
                                <label for="first_name1" class="col-form-label">First name:</label>
                                <input type="text" name="first_name" class="form-control" id="first_name1" required>
                              </div>
                                <div class="form-group">
                                <label for="last_name1" class="col-form-label">Last name:</label>
                                <input type="text" name="last_name" class="form-control" id="last_name1" required>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="email1" class="col-form-label">Email:</label>
                                <input type="email" name="email" class="form-control" id="email1" >
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="phone1" class="col-form-label">Phone:</label>
                                <input type="text" name="phone" class="form-control phone" id="phone1" >
                              </div>
                            </div>
                            <div class="col-sm-12">
                                <p id="phone_or_email_required1" style="display: none; color: #8a6d3b;"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="conversion_point1" class="col-form-label">Conversion point:</label>
                                <select name="conversion_point" class="form-control" id="conversion_point1" required>
                                    <option value="phone">Phone</option>
                                    <option value="contact_form">Contact Form</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="status1" class="col-form-label">Status:</label>
                                <select name="status" class="form-control" id="status1" required>
                                    <option value="0">New Lead</option>
                                    <option value="1">Client</option>
                                    <option value="2">Inactive Client</option>
                                </select>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="notes1" class="col-form-label">Notes:</label>
                                <textarea name="notes" class="form-control" id="notes1"></textarea>
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

@endsection

@section('scripts')
<script type="text/javascript">
    var ajax_edit_url = "{{ route('account.website.getLeadById') }}";
    var ajax_delete_url = "{{ route('account.website.deleteLeadById') }}";
    var ajax_redirect_url = "{{ route('account.website.leads') }}";
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
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/lead.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#leadAddForm").submit(function(e){
            var email = $('#email').val();
            var phone = $('#phone').val();
            if(!isEmpty(phone) || !isEmpty(email)){
                // Form Submit
            }else{
                $('#phone_or_email_required').show().text('Email or Phone is required.');
                e.preventDefault();
            }
        });

        $("#leadEditForm").submit(function(e){
            var email = $('#email1').val();
            var phone = $('#phone1').val();
            if(!isEmpty(phone) || !isEmpty(email)){
                // Form Submit
            }else{
                $('#phone_or_email_required1').show().text('Email or Phone is required.');
                e.preventDefault();
            }
        });
    });
    function isEmpty(val) {
        if(val.length ==0 || val.length ==null){
            return true;
        }else{
            return false;
        }
    }
</script>
@endsection