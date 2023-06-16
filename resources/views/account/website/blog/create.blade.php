@extends('layouts.app')

@section('title')
<title>Website Create Blog</title>
@endsection

@section('styles')
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
                <a href="{{ route('account.website.blog') }}" class="btn btn-primary waves-effect waves-light">All Posts</a>
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
                <form action="{{ route('account.website.addblog')}}" method="post" enctype="multipart/form-data">
                    @csrf()
                  <div class="col-md-8 offset-md-2">
                    <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="title" class="col-form-label">Title:</label>
                            <input type="text" name="title" class="form-control" id="title" required>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="content" class="col-form-label">Content:</label>
                            <textarea name="content" rows="15" class="" id="content" required></textarea>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="meta_keywords" class="col-form-label">Meta Keywords :</label>
                            <textarea class="form-control" name="meta_keywords" id="meta_keywords"></textarea>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="meta_description" class="col-form-label">Meta Description:</label>
                            <textarea class="form-control" name="meta_description" id="meta_description"></textarea>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="image" class="col-form-label">Image:</label>
                            <input type="file" name="image" target_img="imgPreview1" class="form-control" id="image" required>
                            <img src="" id="imgPreview1" width="50px">
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Close</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                  </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/websiteblog.js') }}"></script>
<script>
    $(document).ready(function() {
      $('.mselect2').select2();
      $('[data-toggle="popover"]').popover();
    });
    $('#content').summernote({
      height: 300,   //set editable area's height
    });
</script>
@endsection