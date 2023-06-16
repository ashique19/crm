$(document).ready(function(){
	$('.mselect2').select2();
	$(".amount").on("input", function(evt) {
	   var self = $(this);
	   self.val(self.val().replace(/[^0-9\.]/g, ''));
	   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
	   {
	     evt.preventDefault();
	   }
	 });
	$('.model_edit').click(function(e){
		//edit_model
		var service_id = $(this).attr('service_id');

		$('#edit_model').modal('show');
		$.ajax({
			url: ajax_edit_url,
			data: {id: service_id,_token: $('meta[name="csrf-token"]').attr('content') },
			type: 'POST',
			success:function(res){
				var data = res.data;

				$("#serviceID").val(data.id);
				$("#name").val(data.name);
				$("#description").val(data.description);
				$("#duration").val(data.duration);
				$("#amount").val(data.amount);
				$("#color").val(data.color);
				$("#appointment_types").val(data.appointment_types.split(','));
				$(".mselect2").select2({
					data: function() {
					 	return {results: data.appointment_types.split(',')}; 
					}
				});
			}
		});
	});
	$('.service_del').click(function(){
		var service_id = $(this).attr('service_id');
		swal({
		title: 'Please confirm.',
		text: "Are you sure that you want to delete this service?", 
		showCancelButton: true,
		confirmButtonText: 'Confirm',
		cancelButtonText: 'Cancel',
		showLoaderOnConfirm: true,
		preConfirm: function (){
			return new Promise(function (resolve, reject){
				$.ajax({
					url: ajax_delete_url,
					data: {id: service_id,action: 'service_delete',_token: $('meta[name="csrf-token"]').attr('content') },
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
			html: '<p>Service Deleted!</p>',
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