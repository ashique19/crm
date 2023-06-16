@extends('layouts.admin')

@section('title')
    <title>SEO Settings</title>
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
        <h2>SEO Settings</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <table id="datatable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>url</th>
                        <th>title</th>
                        <th>description</th>
                        <th>options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($seoSettings as $setting)
                        <tr>
                            <td>/{{ $setting->url }}</td>
                            <td>{{ $setting->title }}</td>
                            <td>{{ $setting->description }}</td>
                            <td>
                                <a href="{{url($setting->url)}}" target="_blank" class="btn btn-icon" title="View Post"><i class="fa fa-eye blue-font"></i></a>
                                <a href="#" data-toggle="modal" data-target="#editSetting" data-setting-id={{ $setting->id }} class="btn btn-icon edit_seo" title="Edit Post"><i class="fa fa-pencil-square-o brown-font"></i></a>
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
<div class="modal fade" id="editSetting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="update-seo-form" action="{{ route('admin.settings.update_seo') }}" method="post">
            @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Seo Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="error-msg"></div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
                    <input type="hidden" id="seo_id" name="setting_id" value="">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="update-seo" class="btn btn-primary">Update</button>
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
        $(".edit_seo").click(function(){
            let id = $(this).data("setting-id");
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/settings/get_seo') }}"+"/"+id,
                success: function(resultData) {
                    $("#title").val(resultData.title);
                    $("#description").val(resultData.description);
                    $("#seo_id").val(resultData.id);
                }
            });
        });

        $( "#update-seo-form" ).on( "submit", function( event ) {
            event.preventDefault();
            const obj = $( this ).serializeArray().reduce((o, item) => Object.assign(o, {[item.name]: item.value}), {});
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.settings.update_seo') }}",
                data: obj,
                success: function(resultData) {
                   if(resultData.status==422) {
                        $('#error-msg').html(`
                            <div class="alert alert-danger alert-block">
                                <strong>${resultData.errors.title}</strong>
                            </div>
                        `)
                   }else {
                        location.reload();
                   }
                }
            });
        });
    });
    </script>
@endsection
