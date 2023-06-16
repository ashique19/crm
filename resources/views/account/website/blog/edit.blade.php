@extends('layouts.app')

@section('title')
<title>Website Create Blog</title>
@endsection

@section('styles')
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
               <form action="{{ route('account.website.updateBlog')}}" method="post" enctype="multipart/form-data">
                      @csrf()
                  <div class="col-md-8 offset-md-2">
                    <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <input type="hidden" name="id" class="form-control" id="blogID" value="{{ $blog->id }}">
                            <label for="title1" class="col-form-label">Title:</label>
                            <input type="text" name="title" value="{{ $blog->title }}" class="form-control" id="title1" required>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="content1" class="col-form-label">Content:</label>
                            <textarea name="content" class="" id="content" required>{{ $blog->content }}</textarea>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="meta_keywords1" class="col-form-label">Meta Keywords:</label>
                            <textarea class="form-control" name="meta_keywords" id="meta_keywords1">{{ $blog->meta_keywords }}</textarea>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="meta_description1" class="col-form-label">Meta Description:</label>
                             <textarea class="form-control" name="meta_description" id="meta_description1">{{ $blog->meta_description }}</textarea>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="image1" class="col-form-label">Image:</label>
                            <input type="file" name="image" target_img="imgPreview" class="form-control" id="image1">
                            @if($blog->image)
                              <img src="{{ $blog->image }}" id="imgPreview" width="50px">
                            @endif
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