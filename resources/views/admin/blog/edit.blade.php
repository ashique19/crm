@extends('layouts.admin')

@section('title')
    <title>Blog</title>
@endsection

@section('styles')
<!-- Summernote css -->
<link href="{{ url('assets/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />
<style type="text/css">
  /*.add_selected_image img{
    border: 3px solid;
  }*/

  .blog_images{
    padding: 5px;
  }
  .add_selected_image{
    background: #0088cc;
  }

  .loader {
    border: 10px solid #f3f3f3;
    border-radius: 50%;
    border-top: 10px solid #3498db;
    width: 75px;
    height: 75px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
    margin: 0 auto;
  }

  /* Safari */
  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

</style>
@endsection()

@section('content')

<div class="row mb-4">
  <div class="col-md-6">
    <h2>Edit Post</h2>
  </div>
  <div class="col-md-6 float-right">
    <a href="{{route('admin.blog.create')}}" class="btn btn-md btn-success mr-2 float-sm-right mt-3 mb-2"> Create Post <i class="fa fa-plus-square"></i></a>
    <a href="{{route('admin.blog')}}" class="btn btn-md btn-secondary mr-2 float-sm-right mt-3 mb-2"> All Post <i class="fa fa-list"></i></a>
  </div>
</div>  

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <form method="POST" action="{{ route('admin.blog.update', $post->id) }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
			<input type="hidden" value="" id="selected_img" name="selected_img">
			<input type="hidden" value="" id="single_image" name="single_image">
            <label for="title">Title:</label>
            <input type="text" value="{{$post->title}}" id="title" class="form-control" name="title">
          </div>
          <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control summernote" name="content" id="content" rows="5">{{$post->content}}</textarea>
          </div>
			<div class="form-group">
				{{-- <label for="image">Upload image or select image from related images:</label>
				<input type="file" class="form-control" name="image" id="image"> --}}
				<img src="{{ url('storage/blog/'.$post->image) }}" id="image_src" width="100">
				@if(Auth::user()->id == '1')
				<div class="form-group">
				  <label for="search_image">Search for an image:</label>
				  <input type="text" class="form-control" name="search_image" id="search_image" value="">
				</div>
				<p><label>Related Images</label></p>
				<div class="blog_image_list">No image found!</div>
				@endif
			</div>		  
          <div class="form-group">
            <label for="meta_keywords">Meta Keywords:</label>
            <input type="text" value="{{$post->meta_keywords}}" id="meta_keywords" class="form-control" name="meta_keywords">
          </div>
          <div class="form-group">
            <label for="meta_description">Meta Description:</label>
            <input type="text" value="{{$post->meta_description}}" id="meta_description" class="form-control" name="meta_description">
          </div>
          <div class="checkbox">
            <label for="status1">Status:
            <input type="checkbox" value="1" id="status1" name="status" {{ $post->status=='1'?'checked':'' }}></label>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div> <!-- end col -->
</div> <!-- end row -->


@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $("#search_image").change(function(){
        var title = $(this).val();
        $('.blog_image_list').empty();
        $('.blog_image_list').addClass('loader');
        $.ajax({
            url: "{{ route('admin.blog.search_image') }}",
            data: {title: title,_token: $('meta[name="csrf-token"]').attr('content') },
            type: 'POST',
            dataType: 'json',
            success:function(res){
              $('.blog_image_list').html(res.html);
              $('#single_image').val(res.single);
              $('.blog_image_list').removeClass('loader');
            }
        });
      });
      $(document).on('click','.blog_images',function(){
          $('.blog_images.add_selected_image').removeClass('add_selected_image');
          $(this).addClass('add_selected_image');
          var img_src = $(this).find("img");
          $('#selected_img').val(img_src.attr('src'));
      });
    });  
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#image_src').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#image").change(function() {
      readURL(this);
    });
  </script>
<!--Wysiwig js-->
<script src="{{ url('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

<script>
	jQuery(document).ready(function(){
		$('.summernote').summernote({
			height: 300,                 // set editor height
			minHeight: null,             // set minimum height of editor
			maxHeight: null,             // set maximum height of editor
			focus: true                 // set focus to editable area after initializing summernote
		});
	});
</script>

@endsection