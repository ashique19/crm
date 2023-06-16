@extends('layouts.app')

@section('title')
<title>Email</title>
@endsection


@section('styles')
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <button type="button" class="btn btn-primary waves-effect waves-light btn-create_email" data-toggle="modal" data-target="#addEmail">Create Email</button>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Emails</h4>
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
                            
                @if (Session::has('alerts'))
                    @foreach (Session::get('alerts') as $alert)
                        <div class="alert {{ $alert['class'] }} notification {{ $alert['status'] }} closeable text-center">{{ $alert['message'] }}</div>
                    @endforeach
                @endif                            

                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Disk Quota</th>
                                        <th>Change Password</th>
                                        <th>Access Webmail</th>                                 
                                        <th>Connect Devices</th>                               
                                        <th>Options</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                            @foreach($emails as $email)
                                <tr>
                                    <td>
                                        {{ $email->email }}
                                    </td>
                                    <td>
                                    {{ round($email->diskused) }} / {{ $email->humandiskquota }}
                                    </td>
                                    <td>
                                        <button class="mass-complete btn btn-sm btn-default edit-password" data-toggle="modal" data-target="#changeEmailPassword" data-id="{{ $email->email }}">Change Password</button>
                                    </td>
                                    <td>
                                        <a href="{{ env('APP_URL').'/webmail' }}" class="btn btn-sm btn-secondary" target="_blank">Access Webmail</a>
                                    </td>                                    
                                    <td>
                                        <button class="mass-complete btn btn-sm btn-default connect-devices" data-id="{{$email->email}}" data-toggle="modal" data-target="#connectDevices">Connect Devices</button>
                                    </td>
                                    <td>
                                        <div class="icon-options">
                                            <a href="#" class="delete-button btn btn-md btn-danger" data-id="{{$email->email}}" title="Delete Email"><i class="fa fa-trash"></i></a>
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



@include('account.email.partials.add_email')
@include('account.email.partials.change_email_password')
@include('account.email.partials.connect_device')

@endsection

@section('scripts')
    @if (count($errors) > 0 && old('action') == 'create')
        <script>
            $(function () {
                $('#addEmail').modal('show');
            });
        </script>
    @elseif (count($errors) > 0)
        <script>
            $(function () {
                $('#changeEmailPassword').modal('show');
            });
        </script>
    @endif

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
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script>
        $(function () {
            var dataTable = $('#data-table').DataTable({
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Anything",
                    paginate: {
                        first:      "First",
                        last:       "Last",
                        next:       '<i class="sl sl-icon-arrow-right"></i></a>',
                        previous:   '<i class="sl sl-icon-arrow-left"></i></a>'
                    }
                },
                dom: 'it<"pagination-container"p>'
            });
            //To Customize DataTable Paginator
            $('.pagination-container').append('<nav class="pagination"></nav>');
            var datatablePaginator = $('#data-table_paginate').detach();
            $('nav.pagination').append(datatablePaginator);
            $('#data-table_wrapper').removeClass("form-inline");
            //To Customize DataTable Filter Search box
            $('.dataTableFilter').keyup(function(){
                dataTable.search($(this).val()).draw() ;
            });
            $('.btn-create_email').on('click', function () {
                $('#addEmail').find('.form-group').removeClass('has-danger');
                $('#addEmail').find('.form-control-feedback').remove();
            });
            
          $('.delete-button').click(function (event) {
            var ajax_redirect_url = "{{ route('account.email.index') }}";
         event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var token = $('[name="_token"]').val();
            swal({
            text: "Are you sure that you want to delete "+id+"?", 
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            showLoaderOnConfirm: true,
            preConfirm: function (){
                return new Promise(function (resolve, reject){
                    $.ajax({
                         url: "{{ url('/account/emails/delete') }}",
                                    type: 'post',
                                    data: {_method: 'delete', _token :token, email: id},
                        success: function(response) {
                            
                            if(response == 'Delete email success')
                            resolve(response)
                        },
                        error: function(a, b, c){
                            reject("error message")
                        }
                    });

                });
            },
            allowOutsideClick: false
            }).then(function (response) {
                swal({
                title: 'Success',
                type: 'success',
                html: '<p>Email Deleted!</p>',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Close!',
                allowOutsideClick: false
                }).then(function () {
                    window.location = ajax_redirect_url;
                });
            },function(dismiss) {
                if(dismiss === 'cancel' || dismiss === 'close') {

                } 
            });
    });


            
            $('.edit-password').on('click', function () {
                $('#changeEmailPassword').find('.form-group').removeClass('has-danger');
                $('#changeEmailPassword').find('.form-control-feedback').remove();
                $('#edit_email-email').html($(this).data('id'));
                $('#change-password').find('input[name="email"]').val($(this).data('id'));
            });
            
            $('.connect-devices').on('click', function () {
                $('#connect_devices-email').html($(this).data('id'));
            });
        });
    </script>
@endsection