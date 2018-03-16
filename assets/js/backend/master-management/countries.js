function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"master-management/Countries/getCountriesData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_countries'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#code').val(data.code);
											jQuery('#name').val(data.name);
											jQuery('#description').val(data.description);
											jQuery('#prefix').val(data.prefix);
											jQuery('#utc_timezone').val(data.utc_timezone);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_countries');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		code = jQuery('#code').val(),
		name = jQuery('#name').val(),
		description = jQuery('#description').val(),
		utc_timezone = jQuery('#utc_timezone').val(),
		prefix = jQuery('#prefix').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_countries');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"master-management/countries/checkUI_CO",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'code' : code,
					'name' : name,
					'description' : description,
					'utc_timezone' : utc_timezone,
					'prefix' : prefix,
					'status' : status
				  },
			beforeSend: loadingShow('#form_countries'),
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
										loadingHide('#form_countries')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_code').val('');
	jQuery('#search_name').val('');
	jQuery('#search_description').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#code').val('');	
	jQuery('#name').val('');	
	jQuery('#description').val('');	
	jQuery('#utc_timezone').val('');	
	jQuery('#prefix').val('');	
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
