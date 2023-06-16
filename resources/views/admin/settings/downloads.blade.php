@extends('layouts.admin')

@section('title')
    <title>Downloads</title>
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
        <h2>Downloads</h2>
    </div>
    <div class="col-md-6 float-right">
        <a href="#" data-toggle="modal" data-target="#add-download-modal" class="btn btn-md btn-success mr-2 float-sm-right mt-3 mb-2"> Create Download <i class="fa fa-plus-square"></i></a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Category</th>
                        <th>Name</th>
                        <th>File</th>
                        <th>Status</th>
                        <th>options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($downloads as $download)
                    <tr>
                        <td>{{ $download->category->name }}</td>
                        <td>{{ $download->name }}</td>
                        <td>{{ $download->file }}</td>
                        <td>{{ $download->active == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="#" class="edit_download" data-download-id={{ $download->id  }} data-toggle="modal" data-target="#edit-download-modal" class="btn btn-icon" title="Edit Post"><i class="fa fa-pencil-square-o brown-font"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<!-- Add Modal -->
<div class="modal fade" id="add-download-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="add-download-form" action="{{ route('admin.settings.add_downloads') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Download</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="error-msg"></div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name"  placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" name="category" id="category">
                        <option value="" >Select Category</option>
                        @foreach($categories as $categoryItem)
                        <option value="{{ $categoryItem->id }}">{{ $categoryItem->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">File</label>
                    <input name="file" type="file" class="form-control" id="file">
                </div>

                <div class="form-check">
                    <input name="active" value="1" type="checkbox" class="form-check-input" id="active">
                    <label class="form-check-label" for="active">Active</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit-download-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="update-downlaod-form" action="{{ route('admin.settings.update_setting') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Download</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="edit-error-msg"></div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="edit-name"  placeholder="Enter name">
                    <input type="hidden" name="id" id="download-id">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" name="category" id="edit-category">
                        <option value="" >Select Category</option>
                        @foreach($categories as $categoryItem)
                        <option value="{{ $categoryItem->id }}">{{ $categoryItem->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">File</label>
                    <input name="file" type="file" class="form-control" id="file">
                    <p id="file-name"></p>
                </div>

                <div class="form-check">
                    <input name="active" value="1" type="checkbox" class="form-check-input" id="edit-active">
                    <label class="form-check-label" for="edit-active">Active</label>
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
        $(".edit_download").click(function(){
            let id = $(this).data("download-id");
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/settings/downloads') }}"+"/"+id,
                success: function(resultData) {
                    $("#edit-name").val(resultData.name);
                    $(`#edit-category option[value='${resultData.category_id}']`).prop('selected', true);
                    $("#edit-active").prop('checked', !!+resultData.active);
                    $("#download-id").val(resultData.id);
                    $("#file-name").html(resultData.file);
                }
            });
        });

        $("#update-downlaod-form").on('submit',function(event){
            event.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.settings.update_download') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(resultData) {
                    console.log(resultData);
                   if(resultData.status==422) {
                        let html = []
                       for (var key in resultData.errors) {
                            if (resultData.errors.hasOwnProperty(key)) {
                                html.push('<div>'+resultData.errors[key]+ '</div>');
                            }
                        }
                        $('#edit-error-msg').html('<div class="alert alert-danger alert-block">'+html.join('\n')+'</div>')
                   }else {
                        location.reload();
                   }
                }
            });
        });

        $( "#add-download-form" ).on( "submit", function( event ) {
            event.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.settings.add_downloads') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(resultData) {

                   if(resultData.status==422) {
                        let html = []
                       for (var key in resultData.errors) {
                            if (resultData.errors.hasOwnProperty(key)) {
                                html.push('<div>'+resultData.errors[key]+ '</div>');
                            }
                        }
                        $('#error-msg').html('<div class="alert alert-danger alert-block">'+html.join('\n')+'</div>')
                   }else {
                        location.reload();
                   }
                }
            });
        });
    });
</script>


@endsection

