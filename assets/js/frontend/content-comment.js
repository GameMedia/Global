function save(){	
	var id_content = jQuery('#id_content').val(),
		name = jQuery('#name').val(),
		website = jQuery('#website').val(),
		email = jQuery('#email').val(),
		comment = jQuery('#comment').val();
			
	var form = $('#form-comment');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"content/addComment",
			dataType: "json",
			type: "POST",
			data: {
					'id_content'		: id_content,
					'name' 				: name,
					'website'			: website,
					'email' 			: email,
					'comment' 			: comment
				  },
			//beforeSend: loadingShow('body'),
			success: function(data) {
										if(data.success){
											error.hide();
											UIToastr.showToaster("success", data.title, data.message);	
											clearForm();
										} else {
											UIToastr.showToaster("error", data.title, data.message);
										}
										//loadingHide('body');
									}
		   });
}

function errorInput(title, message){	
	UIToastr.showToaster("error", title, message);
}

function clearForm(){
	jQuery('#name').val('');
	jQuery('#email').val('');
	jQuery('#website').val('');
	jQuery('#comment').val('');
}
