@extends('layouts.admin')

@section('title')
    <title>Site Settings</title>
@endsection

@section('styles')
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
</div>
@endif
<div class="row mb-4">
    <div class="col-md-6">
        <h2>Site Settings</h2>
    </div>
</div>	
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">

                                            <table id="datatable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Key</th>
                                                    <th>Display Name</th>
                                                    <th>Value</th>
                                                    <th>Details</th>
                                                    <th>Type</th>				
                                                    <th>Options</th>								
                                                </tr>
                                                </thead>
                                                <tbody>
												@foreach($siteSettings as $setting)
                                                <tr>											
                                                    <td>{{ $setting->key }}</td>
                                                    <td>{{ $setting->display_name }}</td>
                                                    <td>{{ $setting->value }}</td>
                                                    <td>{{ $setting->details }}</td>		
                                                    <td>{{ $setting->type }}</td>   						
													<td>
													<a href="#" class="btn btn-icon" title="Edit setting"><i class="fa fa-pencil-square-o brown-font edit_setting" setting_id="{{ $setting->id }}" data-toggle="modal" data-target="#editeModal"></i></a>
													</td>
                                                </tr>
												@endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                           <!-- Modal -->
                            <div class="modal fade" id="editeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <form action="{{ route('admin.settings.update_setting') }}" method="post">
                                @csrf
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Site Settings</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                <div class="modal-body">
                                    <div class="row">
                                      <div class="col-sm-3"> <label>Display Name:</label>  </div>
                                       <div class="col-sm-9"> <input type="text" name="display_name" class="form-control" id="display_name">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                   <div class="col-sm-3"><label>Value:</label> </div> 
                                   <div class="col-sm-9"> <input type="text" name="value" class="form-control" id="value">
                                   </div>
                                </div>
                                <br>
                                <div class="row">
                                   <div class="col-sm-3">
                                   <label>Details:</label> 
                                   </div> 
                                   <div class="col-sm-9"> <textarea name="details" id="details" class="form-control"></textarea>
                                   </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-sm-3">
                                   <label>Type:</label> </div> 
                                   <div class="col-sm-9"> 
                                    <select id="type" name="type" class="form-control">
                                      <option value="text">text</option>
                                      <option value="image">image</option>
                                    </select>
                                   </div>
                                </div>
                                <br>
                                <div class="row">
                                   <div class="col-sm-3">
                                   <label>Order:</label> </div> 
                                   <div class="col-sm-9"><input type="text" name="order" class="form-control" id="order">
                                   </div>
                                </div>
                                  <input type="hidden" name="setting_id" id="setting_id">
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Update">
                                  </div>
                                </div>
                              </div>
                            </form>
                         </div>
@endsection

@section('scripts')

<script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>

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
<script type="text/javascript">
$(document).ready(function(){
    $('#datatable').dataTable( {
      "bDestroy": true,  
      "ordering": false
    });

    $("#datatable").on('click','.edit_setting', function(){
     var id = $(this).attr("setting_id");
        $.ajax({
              type: 'POST',
              url: "{{ route('admin.settings.get_settings') }}",
              data: { "_token": "{{ csrf_token() }}","id": id},
              success: function(resultData) { 
                $("#setting_id").val(resultData.id);
                $("#display_name").val(resultData.display_name);
                $("#value").val(resultData.value);
                $("#details").val(resultData.details);
                $("#type").val(resultData.type);
                $("#order").val(resultData.order);
                $("#group").val(resultData.group);
              }
        });
    });
});
</script>
@endsection
