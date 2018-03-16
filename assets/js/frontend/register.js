function save(){	
	var first_name = jQuery('#first_name').val(),
		last_name = jQuery('#last_name').val(),
		email = jQuery('#email').val(),
		phone = jQuery('#phone').val();
			
	var form = $('#form-register');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"register/addAccount",
			dataType: "json",
			type: "POST",
			data: {
					'first_name' 		: first_name,
					'last_name'			: last_name,
					'email' 			: email,
					'phone' 			: phone
				  },
			//beforeSend: loadingShow('body'),
			success: function(data) {
										if(data.success){
											error.hide();
											UIToastr.showToaster("success", data.title, data.message);	
											clearForm();
										} else {
											UIToastr.showToaster("error", data.title, data.message);
											jQuery('#errorMessage').css('display', 'block');
											jQuery('#errorMessageContent').html(data.message);
										}
										//loadingHide('body');
									}
		   });
}

function errorInput(title, message){	
	UIToastr.showToaster("error", title, message);
}

function clearForm(){
	jQuery('#first_name').val('');
	jQuery('#last_name').val('');
	jQuery('#phone').val('');
	jQuery('#email').val('');
}
