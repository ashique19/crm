@extends('layouts.admin')

@section('title')
    <title>Blog</title>
@endsection

@section('styles')
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />  
@endsection

@section('content')


<div class="row mb-4">
    <div class="col-md-6">
        <h2>Blog</h2>
    </div>
    <div class="col-md-6 float-right">
        @if (Auth::user()->id==1)
        <a href="#" class="mass-delete btn btn-md btn-danger float-sm-right mt-3 mb-2">Delete <i class="fa fa-trash"></i></a>
        @endif
        <a href="{{route('admin.blog.create')}}" class="btn btn-md btn-success mr-2 float-sm-right mt-3 mb-2"> Create Post <i class="fa fa-plus-square"></i></a>
    </div>
</div>  

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                    <tr>
                      <th><input type="checkbox" class="filled-in primary-color" id="select-all" /><label for="select-all"></label></th>
                      <th>User</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Status</th>
                      <th class="icon-options">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td><input type="checkbox" class="filled-in primary-color case" id="{{$post->id}}" /><label for="{{$post->id}}"></label></td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            <img src="{{ url('storage/blog/'.$post->image) }}" width="100">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{$post->status ? 'Active' : 'Pending'}}</td>
                        <td>
                            <a href="{{url('blog').'/'.$post->slug}}" target="_blank" class="btn btn-icon" title="View Post"><i class="fa fa-eye blue-font"></i></a>
                            <a href="{{route('admin.blog.edit', $post->id)}}" class="btn btn-icon" title="Edit Post"><i class="fa fa-pencil-square-o brown-font"></i></a>
                            @if (Auth::user()->id==1)
                            <a href="javascript:void(0);" class="delete-button btn btn-icon" data-id="{{$post->id}}" title="Delete Post"><i class="fa fa-trash red-font"></i></a>
                            @endif
                            <a href="javascript:void(0);" class="activate-button btn btn-icon {{$post->status ? 'hidden': ''}}" data-id="{{$post->id}}" title="Activate Post"><i class="fa fa-check-square green-font"></i></a>
                            <a href="javascript:void(0);" class="deactivate-button btn btn-icon {{$post->status ? '': 'hidden'}}" data-id="{{$post->id}}" title="Deactivate Post"><i class="fa fa-window-close-o red-font"></i></a>
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
<!-- Responsive examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#datatable').DataTable({
      paging: true,
      bFilter: false,
      ordering: false,
      searching: true,
    } );
} );
</script>

    <script>
        $(document).ready(function() {
            //To Customize DataTable Paginator
            $('.pagination-container').append('<nav class="pagination"></nav>');
            var datatablePaginator = $('#blog-table_paginate').detach();
            $('nav.pagination').append(datatablePaginator);
            $('#blog-table_wrapper').removeClass("form-inline");

            //To Customize DataTable Filter Search box
            $('.dataTableFilter').keyup(function(){
                dataTable.search($(this).val()).draw();
            });
            // ---- End of DataTable ---- //

            $('#select-all').click(function(event) {
                if(this.checked) { // check select status
                      $('.case').each(function() { //loop through each checkbox
                      this.checked = true;  //select all checkboxes with class "checkbox"   
                      $(this).closest("tr").addClass("selected");              
                 });
                 }else{
                       $('.case').each(function() { //loop through each checkbox
                       this.checked = false; //deselect all checkboxes with class "checkbox"
                       $(this).closest("tr").removeClass("selected");
                 });        
                }
            });

            $('.delete-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var token = $('[name=_token]').val();
                swal({
                title: 'Confirm Action',
                text: "Confirm Delete ?", 
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                showLoaderOnConfirm: true,
                preConfirm: function (){
                    return new Promise(function (resolve, reject){
                        $.ajax({
                            url: '{{ route("admin.blog.destroy") }}',
                            type: 'post',
                            data: {_method: 'delete', _token :token,id: id},
                            success: function(response) {
                                if(response == 'success')
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
                    html: '<p>Post Deleted!</p>',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Close!',
                    allowOutsideClick: false
                    }).then(function () {
                        window.location = '{{ route("admin.blog") }}';
                    });
                },function(dismiss) {
                    if(dismiss === 'cancel' || dismiss === 'close') {

                    } 
                });
              
            });

            $('.activate-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var thisBtn = $(this).parents('.icon-options');
                var status = selector.children('.post-status');
                var token = $('[name=_token]').val();
                swal({
                title: 'Confirm Action',
                text: "Confirm Activation ?", 
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                showLoaderOnConfirm: true,
                preConfirm: function (){
                    return new Promise(function (resolve, reject){
                        $.ajax({
                            url: '{{ route("admin.blog.activate") }}',
                            type: 'post',
                            data: {_token :token,id: id},
                            success: function(response) {
                                if(response == 'success')
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
                    html: '<p>Post Activated!</p>',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Close!',
                    allowOutsideClick: false
                    }).then(function () {
                        window.location = '{{ route("admin.blog") }}';
                    });
                },function(dismiss) {
                    if(dismiss === 'cancel' || dismiss === 'close') {

                    } 
                });
            });

            $('.deactivate-button').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var selector = $(this).parents('tr');
                var thisBtn = $(this).parents('.icon-options');
                var status = selector.children('.post-status');
                var token = $('[name=_token]').val();
                swal({
                title: 'Confirm Action',
                text: "Confirm Deactivation ?", 
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                showLoaderOnConfirm: true,
                preConfirm: function (){
                    return new Promise(function (resolve, reject){
                        $.ajax({
                            url: '{{ route("admin.blog.deactivate") }}',
                            type: 'post',
                            data: {_token :token,id: id},
                            success: function(response) {
                                if(response == 'success')
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
                    html: '<p>Post Deactivated!</p>',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Close!',
                    allowOutsideClick: false
                    }).then(function () {
                        window.location = '{{ route("admin.blog") }}';
                    });
                },function(dismiss) {
                    if(dismiss === 'cancel' || dismiss === 'close') {

                    } 
                });
            });

            $('.mass-delete').click(function(event){
                event.preventDefault();
                var id = [];
                var selector = [];
                $("tbody input:checkbox:checked").each(function(){
                    id.push($(this).attr('id'));
                    selector.push($(this).parents('tr'));
                });
                
                if(id.length == '0'){
                    swal({
                        title: 'Warning',
                        text: "Please Select Row !", 
                    });
                    return;
                }
                var token = $('[name=_token]').val();
                swal({
                title: 'Confirm Action',
                text: "Confirm Mass Delete ?", 
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                showLoaderOnConfirm: true,
                preConfirm: function (){
                    return new Promise(function (resolve, reject){
                        $.ajax({
                            url: '{{ route("admin.blog.massdestroy") }}',
                            type: 'post',
                            data: {_token :token,id: id},
                            success: function(response) {
                                if(response == 'success')
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
                    html: '<p>Mass Deleted!</p>',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Close!',
                    allowOutsideClick: false
                    }).then(function () {
                        window.location = '{{ route("admin.blog") }}';
                    });
                },function(dismiss) {
                    if(dismiss === 'cancel' || dismiss === 'close') {

                    } 
                });
            });
        });
    </script>

@endsection
