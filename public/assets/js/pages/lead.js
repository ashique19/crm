$(document).ready(function(){
	$('.datatable').DataTable();
	$('.phone').inputmask("(999) 999-9999");
	$('.model_edit').click(function(e){
		//edit_model
		var lead_id = $(this).attr('lead_id');

		$('#leadEditModal').modal('show');
		$.ajax({
			url: ajax_edit_url,
			data: {id: lead_id,_token: $('meta[name="csrf-token"]').attr('content') },
			type: 'POST',
			success:function(res){
				var data = res.data[0];
				$('#leadId').val(data.id);
				$('#first_name1').val(data.first_name);
				$('#last_name1').val(data.last_name);
				$('#email1').val(data.email);
				$('#phone1').val(data.phone);
				$('#conversion_point1').val(data.conversion_point);
				$('#status1').val(data.status);
				$('#notes1').val(data.notes);
			}
		});
	});
	$('.lead_del').click(function(){
		var lead_id = $(this).attr('lead_del');
		swal({
		title: 'Are you sure?',
		text: "Are you sure that you want to delete this lead?", 
		showCancelButton: true,
		confirmButtonText: 'Confirm',
		cancelButtonText: 'Cancel',
		showLoaderOnConfirm: true,
		preConfirm: function (){
			return new Promise(function (resolve, reject){
				$.ajax({
					url: ajax_delete_url,
					data: {id: lead_id,action: 'lead_delete',_token: $('meta[name="csrf-token"]').attr('content') },
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
			html: '<p>Lead Deleted!</p>',
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