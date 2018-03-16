function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"parameters/Usertype/getUsertypeData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_user_type'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#name').val(data.name);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
											
											if(data.isAdmin) {
												jQuery('#isAdmin').attr('checked', 'checked');
											} else 
												jQuery('#isAdmin').attr('checked');
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('isAdmin', data.isAdmin);
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_user_type');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		name = jQuery('#name').val(),
		isAdmin = jQuery('#isAdmin').is(':checked') ? 1 : 0,
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_user_type');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"parameters/usertype/saveUser_type",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'name' : name,
					'isAdmin' : isAdmin,
					'status' : status
				  },
			beforeSend: loadingShow('#form_user_type'),
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
										loadingHide('#form_user_type')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_name').val('');
	jQuery('#search_isAdmin').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#name').val('');	
	
	jQuery('#isAdmin').prop('checked', false);
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('isAdmin', false);
	bootstrapSwitch('status', false);
}
