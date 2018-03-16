function processConfirmation(){
	if(confirm("Are you sure want to submit payment confirmation?")){
		jQuery.ajax({
				url:  domain+"payment_confirmation/processConfirmation",
				dataType: "json",
				type: "POST",
				data : $('#form-payment-confirmation').serialize(),
				//beforeSend: loadingShow('body'),
				success: function(data) {
											if(data.success){
												UIToastr.showToaster("success", data.title, data.message);
												
												window.location = data.url;
											} else {
												UIToastr.showToaster("error", data.title, data.message);
											}
											//loadingHide('body');
										}
			   });
	}
}
