$(document).ready(function(){
	$('.model_edit').click(function(e){
		//edit_model
		var blog_id = $(this).attr('blog_id');

		$('#postEditModal').modal('show');
		$.ajax({
			url: ajax_edit_url,
			data: {id: blog_id,_token: $('meta[name="csrf-token"]').attr('content') },
			type: 'POST',
			success:function(res){
				var data = res.data;
				$("#blogID").val(data.id);
				$("#title1").val(data.title);
				$("#content1").summernote("code", data.content);
				$("#meta_keywords1").val(data.meta_keywords);
				$("#meta_description1").val(data.meta_description);
				$("#blog_image").html('<img src="'+data.image+'" id="imgPreview" width="50px">');
			}
		});
	});
	$('.blog_del').click(function(){
		var blog_id = $(this).attr('blog_id');
		swal({
		title: 'Are you sure?',
		text: "Are you sure that you want to delete this blog?", 
		showCancelButton: true,
		confirmButtonText: 'Confirm',
		cancelButtonText: 'Cancel',
		showLoaderOnConfirm: true,
		preConfirm: function (){
			return new Promise(function (resolve, reject){
				$.ajax({
					url: ajax_delete_url,
					data: {id: blog_id,action: 'blog_delete',_token: $('meta[name="csrf-token"]').attr('content') },
					type: 'POST',
					success: function(response) {
						if(response.status == 'success')
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
			html: '<p>Blog Deleted!</p>',
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
	$('.confirm_status').click(function(){
		var blog_id = $(this).attr('blog_id');
		var href 	= $(this).attr('href');
		swal({
		text: "Are you sure that you want to change the status?", 
		showCancelButton: true,
		confirmButtonText: 'Confirm',
		cancelButtonText: 'Cancel',
		showLoaderOnConfirm: true,
		preConfirm: function (){
			return new Promise(function (resolve, reject){
				$.ajax({
					url: href,
					data: {id: blog_id,action: 'blog_status_change',_token: $('meta[name="csrf-token"]').attr('content') },
					type: 'GET',
					success: function(response) {
						if(response.status == 'success')
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
			html: '<p>Blog Status Changed!</p>',
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
	$(document).on('change','#image1',function() {
		var target_img = $(this).attr('target_img');
  		readURL(this, target_img);
	});
	$(document).on('change','#image',function() {
		var target_img = $(this).attr('target_img');
  		readURL(this,target_img);
	});
});
function readURL(input,target_img) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#'+target_img).attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}