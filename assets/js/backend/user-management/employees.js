function view(id){
	"use strict";

	jQuery.ajax({
			url:  domain+"user-management/Employees/getEmployeesData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_employees'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#id_user_type').val(data.id_user_type);
											jQuery('#name').val(data.name);
											jQuery('#email').val(data.email);
											jQuery('#phone').val(data.phone);
											jQuery('#address').val(data.address);
											jQuery('#username').val(data.username);
											jQuery('#password').val(data.password);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
												
											getSelect(data.id_user_type, data.id_privilege, privilegeTitle, privilegeUrl, 'id_privilege');
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_employees');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		id_user_type = jQuery('#id_user_type').val(),
		id_privilege = jQuery('#id_privilege').val(),
		name = jQuery('#name').val(),
		email = jQuery('#email').val(),
		phone = jQuery('#phone').val(),
		address = jQuery('#address').val(),
		username = jQuery('#username').val(),
		password = jQuery('#password').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_employees');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"user-management/employees/saveEmployees",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_user_type' : id_user_type,
					'id_privilege' : id_privilege,
					'name' : name,
					'email' : email,
					'phone' : phone,
					'address' : address,
					'username' : username,
					'password' : password,
					'status' : status
				  },
			beforeSend: loadingShow('#form_employees'),
			success: function(data) {
										sessOut(data);
										if(data.success){
                    						error.hide();
                    						UIToastr.showToaster("success", data.title, data.message);	
                    						$('#datatable').DataTable().ajax.reload();
											clearForm();
											jQuery(".btn-close-modal").trigger("click");
										} else {
											UIToastr.showToaster("error", data.title, data.message);
										}
										loadingHide('#form_employees');
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_id_user_type').val('');
	jQuery('#search_name').val('');
	jQuery('#search_email').val('');
	jQuery('#search_username').val('');
	jQuery('#search_phone').val('');
	jQuery('#search_status').val('');
	getSelect('', '', '', '', 'search_id_privilege');
}

function clearForm(){
	jQuery('#id').val('');
	jQuery('#id_user_type').val('');
	jQuery('#name').val('');
	jQuery('#email').val('');
	jQuery('#phone').val('');
	jQuery('#address').val('');
	jQuery('#username').val('');
	jQuery('#password').val('');
	jQuery('#conf_password').val('');
	
	getSelect('', '', '', '', 'id_privilege');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
