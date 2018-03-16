function add2cart(id){	
	jQuery.ajax({
			url:  domain+"products/add2cart",
			dataType: "json",
			type: "POST",
			data : {'id':id},
			//beforeSend: loadingShow('body'),
			success: function(data) {
										sessOut(data);
										if(data.success){
											UIToastr.showToaster("success", data.title, data.message);
										} else {
											UIToastr.showToaster("error", data.title, data.message);
											jQuery('#errorMessage').css('display', 'block');
											jQuery('#errorMessageContent').html(data.message);
										}
										//loadingHide('body');
									}
		   });
}
