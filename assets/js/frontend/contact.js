function save(){	
	var id_content = jQuery('#id_content').val(),
		name = jQuery('#name').val(),
		title = jQuery('#title').val(),
		email = jQuery('#email').val(),
		message = jQuery('#message').val();
			
	var form = $('#form-message');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"contact/addMessage",
			dataType: "json",
			type: "POST",
			data: {
					'name' 		: name,
					'title'		: title,
					'email' 	: email,
					'message' 	: message
				  },
			//beforeSend: loadingShow('body'),
			success: function(data) {
										if(data.success){
											error.hide();
											UIToastr.showToaster("success", data.title, data.message);	
											clearForm();
										} else {
											UIToastr.showToaster("error", data.title, data.message);
										}
										//loadingHide('body');
									}
		   });
}

function errorInput(title, message){	
	UIToastr.showToaster("error", title, message);
}

function clearForm(){
	jQuery('#name').val('');
	jQuery('#email').val('');
	jQuery('#title').val('');
	jQuery('#message').val('');
}
