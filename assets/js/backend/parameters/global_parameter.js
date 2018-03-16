function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"parameters/Globalparameter/getGlobalparameterData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_global_parameter'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#value').val(data.value);
											jQuery('#description').val(data.description);
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
										} else {
											
										}
										loadingHide('#form_global_parameter');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		value = jQuery('#value').val(),
		description = jQuery('#description').val();
	
	var form = $('#form_global_parameter');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"parameters/globalparameter/saveGlobal_Parameter",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'value' : value,
					'description' : description
				  },
			beforeSend: loadingShow('#form_global_parameter'),
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
										loadingHide('#form_global_parameter')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_value').val('');
	jQuery('#search_id').val('');
}

function clearForm(){
	jQuery('#id').val('');
	jQuery('#value').val('');
	jQuery('#description').val('');
	jQuery('#update_by').html('');
	jQuery('#update_time').html('');
}
