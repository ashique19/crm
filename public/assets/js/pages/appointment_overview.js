$(document).ready(function(){
	$('.model_edit').click(function(e){
		//edit_model
		var apmt_id = $(this).attr('apmt_id');

		$('#edit_model').modal('show');
		$.ajax({
		    url: ajax_edit_url,
		    data: {id: apmt_id,_token: $('meta[name="csrf-token"]').attr('content') },
		    type: 'POST',
		    success:function(res){
		    	var data = res.data;
		    	$("#appmt_id").val(data.id);
		    	$("#first_name").val(data.first_name);
		    	$("#last_name").val(data.last_name);
		    	$("#email").val(data.email);
		    	$("#phone").val(data.phone);
		    	$("#service").val(data.appointment_service_id);
		    	$("#availability").val(data.appointment_availability_id);
		    	$("#type").val(data.appointment_type);
		    }
		});
	});
	$('.appmnt_del').click(function(){
		var apmt_id = $(this).attr('apmt_id');
		swal({
			title: 'Are you sure?',
			text: "Are you sure that you want to delete this appointment?",
			showCancelButton: true,
			confirmButtonText: 'Confirm',
			cancelButtonText: 'Cancel',
			showLoaderOnConfirm: true,
			preConfirm: function (){
				return new Promise(function (resolve, reject){
				    $.ajax({
				    	url: ajax_delete_url,
						data: {id: apmt_id,action: 'apmt_delete',_token: $('meta[name="csrf-token"]').attr('content') },
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
              html: '<p>Appointment Deleted!</p>',
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
});
