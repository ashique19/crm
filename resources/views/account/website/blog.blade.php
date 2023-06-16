@extends('layouts.app')

@section('title')
<title>Website Blog</title>
@endsection

@section('styles')
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <a href="{{ route('account.website.createBlog') }}" class="btn btn-primary waves-effect waves-light">Create Post</a>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Manage Blog</h4>
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
                @if(Session::get('success_msg'))
                    <div class="alert alert-success alert-dismissable col-sm-12">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6><i class="icon fa fa-check"></i> {{Session::get('success_msg')}}</h6>
                    </div>
                @endif
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th class="icon-options">Options</th>
                    </thead>
                    <tbody>
                    @if($blogs)
                    @foreach($blogs as $blog)
                    <tr>
                        <td>
                            @if($blog->image)
                                <img src="{{ url('storage/blogs/'.$blog->image) }}" width="100px">
                            @else
                            @endif
                        </td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->status==1? 'Active':'Inactive' }}</td>
                        <td>
                            <a href="{{ route('account.website.editBlog',$blog->id) }}" class="btn btn-info mr-1 model_edit" blog_id="{{$blog->id}}" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="top" data-content="Edit Post">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <button class="btn btn-danger blog_del" type="button" blog_id="{{$blog->id}}" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="top" data-content="Remove Post">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                             <?php
                                $classbtn = array('warning','success' );
                                if($blog->status==1){
                                    $dd = $classbtn[0];
                                }else{
                                    $dd = $classbtn[1];
                                }
                             ?>
                            <button href="{{ route('account.website.change_status',$blog->id) }}" class="btn btn-{{$dd}} confirm_status" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="top" data-content="Update Status" >{!! $blog->status==1 ? '<i class="fa fa-ban" aria-hidden="true"></i>' : '<i class="fa fa-check" aria-hidden="true"></i>' !!}</button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('scripts')
<script type="text/javascript">
    var ajax_edit_url = "{{ route('account.website.getBlogById') }}";
    var ajax_delete_url = "{{ route('account.website.deleteBlogById') }}";
    var ajax_redirect_url = "{{ route('account.website.blog') }}";
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
<script src="{{ asset('assets/js/pages/websiteblog.js') }}"></script>
<script>
    $(document).ready(function() {
      $('.mselect2').select2();
      $('[data-toggle="popover"]').popover();
    });
</script>
@endsection