function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"user-management/Privileges/getPrivilegesData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_privileges'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#id_user_type').val(data.id_user_type);
											jQuery('#name').val(data.name);
											jQuery('#default_menu').val(data.default_menu);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_privileges');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		id_user_type = jQuery('#id_user_type').val(),
		name = jQuery('#name').val(),
		default_menu = jQuery('#default_menu').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_privileges');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"user-management/privileges/savePrivileges",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_user_type' : id_user_type,
					'name' : name,
					'default_menu' : default_menu,
					'status' : status
				  },
			beforeSend: loadingShow('#form_privileges'),
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
										loadingHide('#form_privileges')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_id_user_type').val('');
	jQuery('#search_name').val('');
	jQuery('#search_default_menu').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#id_user_type').val('');	
	jQuery('#name').val('');	
	jQuery('#default_menu').val('');	
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
