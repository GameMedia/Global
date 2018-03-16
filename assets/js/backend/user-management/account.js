var FormValidation = function () {
    var handleValidation = function() {
            var form = $('#form_account');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.parent(".input-group").size() > 0) {
                        error.insertAfter(element.parent(".input-group"));
                    } else if (element.attr("data-error-container")) { 
                        error.appendTo(element.attr("data-error-container"));
                    } else if (element.parents('.radio-list').size() > 0) { 
                        error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                    } else if (element.parents('.radio-inline').size() > 0) { 
                        error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                    } else if (element.parents('.checkbox-list').size() > 0) {
                        error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                    } else if (element.parents('.checkbox-inline').size() > 0) { 
                        error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                   $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success.show();
                    error.hide();
                    save();
                }

            });
    }
    
    return {
        //main function to initiate the module
        init: function () {
            handleValidation();
        }
    };

}();

var FormValidationChangePassword = function () {
    var handleValidationChangePassword = function() {
            var form = $('#form_change_password');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                rules: {
                    change_password_email_user: {
                        required: true
                    }, 
                    change_password_curr_password: {
						required: true
					}, 
                    change_password_new_password: {
						required: true
					}, 
                    change_password_conf_password: {
						required: true,
						equalTo: '#change_password_new_password'
					}
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.parent(".input-group").size() > 0) {
                        error.insertAfter(element.parent(".input-group"));
                    } else if (element.attr("data-error-container")) { 
                        error.appendTo(element.attr("data-error-container"));
                    } else if (element.parents('.radio-list').size() > 0) { 
                        error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                    } else if (element.parents('.radio-inline').size() > 0) { 
                        error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                    } else if (element.parents('.checkbox-list').size() > 0) {
                        error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                    } else if (element.parents('.checkbox-inline').size() > 0) { 
                        error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                   $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success.show();
                    error.hide();
                    saveChangePassword();
                }

            });
    }
    
    return {
        //main function to initiate the module
        init: function () {
            handleValidationChangePassword();
        }
    };

}();

function save(){
	var id = jQuery('#id_employee').val(),
		email = jQuery('#email').val(),
		phone = jQuery('#phone').val(),
		address = jQuery('#address').val();
	
	var form = $('#form_account');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"user-management/account/saveAccountPass",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'email' : email,
					'phone' : phone,
					'address' : address
				  },
			beforeSend: loadingShow('#form_account'),
			success: function(data) {
										sessOut(data);
										if(data.success){
                    						error.hide();
                    						UIToastr.showToaster("success", data.title, data.message);	
											clearForm();
										} else {
											UIToastr.showToaster("error", data.title, data.message);
										}
										loadingHide('#form_account')
									}
		   });	
}

function saveChangePassword(){
	var id = jQuery('#change_password_id').val(),
		curr = jQuery('#change_password_curr_password').val(),
		pass = jQuery('#change_password_new_password').val();
	
	var form = $('#form_change_password');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"user-management/account/saveChangePassword",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'curr' : curr,
					'pass' : pass
				  },
			beforeSend: loadingShow('#form_change_password'),
			success: function(data) {
										sessOut(data);
										if(data.success){
                    						error.hide();
                    						UIToastr.showToaster("success", data.title, data.message);
										} else {
											UIToastr.showToaster("error", data.title, data.message);
										}
										clearChangePassword();
										loadingHide('#form_change_password')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_name').val('');
	jQuery('#search_isAdmin').val('');
	jQuery('#search_status').val('');
}

function clearChangePassword(){
	jQuery('#change_password_curr_password').val('');
	jQuery('#change_password_new_password').val('');
	jQuery('#change_password_conf_password').val('');
}
