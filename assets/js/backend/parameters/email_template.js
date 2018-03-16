function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"parameters/email_template/getEmail_TemplateData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_email_template'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#name').val(data.name);
											jQuery('#code').val(data.code);
											jQuery('#title').val(data.title);
											jQuery('#id_email').val(data.id_email);
											
											CKEDITOR.instances.content.setData( data.content );
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_email_template');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		name = jQuery('#name').val(),
		id_email = jQuery('#id_email').val(),
		code = jQuery('#code').val(),
		title = jQuery('#title').val(),
		content = CKEDITOR.instances.content.getData(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_email_template');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"parameters/email_template/saveEmail_Template",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'name' : name,
					'id_email' : id_email,
					'code' : code,
					'title' : title,
					'content' : content,
					'status' : status
				  },
			beforeSend: loadingShow('#form_email_template'),
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
										loadingHide('#form_email_template')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_name').val('');
	jQuery('#search_id_email').val('');
	jQuery('#search_code').val('');
	jQuery('#search_title').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#name').val('');
	jQuery('#id_email').val('');
	jQuery('#code').val('');
	CKEDITOR.instances.content.setData('');
	jQuery('#title').val('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
