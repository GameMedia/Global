function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"parameters/Email/getEmailData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_email'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#name').val(data.name);
											jQuery('#email_user').val(data.email_user);
											jQuery('#email_pass').val(data.email_pass);
											jQuery('#host').val(data.host);
											jQuery('#port').val(data.port);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_email');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		name = jQuery('#name').val(),
		email_user = jQuery('#email_user').val(),
		email_pass = jQuery('#email_pass').val(),
		host = jQuery('#host').val(),
		port = jQuery('#port').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_email');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"parameters/email/checkUI_Em",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'name' : name,
					'email_user' : email_user,
					'email_pass' : email_pass,
					'host' : host,
					'port' : port,
					'status' : status
				  },
			beforeSend: loadingShow('#form_email'),
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
										loadingHide('#form_email')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_name').val('');
	jQuery('#search_email_user').val('');
	jQuery('#search_host').val('');
	jQuery('#search_port').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#name').val('');
	jQuery('#email_user').val('');
	jQuery('#email_pass').val('');
	jQuery('#host').val('');
	jQuery('#port').val('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
