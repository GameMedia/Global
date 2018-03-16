function save(){	
	var form = $('#form-personal');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"account/updateAccount",
			dataType: "json",
			type: "POST",
			data : $('#form-personal').serialize(),
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

function saveAddress(){	
	var form = $('#form-address');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"account/saveAddress",
			dataType: "json",
			type: "POST",
			data : $('#form-address').serialize(),
			//beforeSend: loadingShow('body'),
			success: function(data) {
										if(data.success){
											error.hide();
											UIToastr.showToaster("success", data.title, data.message);	
											clearFormAddress();
											jQuery("#add-new-address").click();
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

function clearFormAddress(){
	jQuery('#address_id').val('');
	jQuery('#address_first_name').val('');
	jQuery('#address_last_name').val('');
	jQuery('#address_address').val('');
	jQuery('#address_city').val('');
	jQuery('#address_ziptal_code').val('');
	jQuery('#address_phone').val('');
	jQuery('#address_id_country').val('');
	jQuery('#address_id_state').val('');
	jQuery('#address_additional_info').val('');
}
