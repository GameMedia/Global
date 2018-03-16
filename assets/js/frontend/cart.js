function clearCart(id_transaction, id){
	if(id != ''){
		var msg = "Are you sure want to delete this item?";
	} else {
		var msg = "Are you sure want to clear cart?";
	}
	if(confirm(msg)){
		jQuery.ajax({
				url:  domain+"cart/clear",
				dataType: "json",
				type: "POST",
				data : {'id':id,'id_transaction':id_transaction},
				//beforeSend: loadingShow('body'),
				success: function(data) {
											if(data.success){
												UIToastr.showToaster("success", data.title, data.message);
											} else {
												UIToastr.showToaster("error", data.title, data.message);
											}
											//loadingHide('body');
										}
			   });
	}
}

function updateCart(id){
	if(confirm("Are you sure want to update this item?")){
		var qty = $('#qty_'+id).val();
		jQuery.ajax({
				url:  domain+"cart/update",
				dataType: "json",
				type: "POST",
				data : {'id':id,'qty':qty},
				//beforeSend: loadingShow('body'),
				success: function(data) {
											if(data.success){
												UIToastr.showToaster("success", data.title, data.message);
												window.location = domain+'cart';
											} else {
												UIToastr.showToaster("error", data.title, data.message);
											}
											//loadingHide('body');
										}
			   });
	}
}

function setCheckout(id){
	if(confirm("Are you sure want to Checkout ?")){
		jQuery.ajax({
				url:  domain+"cart/checkout",
				dataType: "json",
				type: "POST",
				data : {'id':id},
				//beforeSend: loadingShow('body'),
				success: function(data) {
											if(data.success){
												UIToastr.showToaster("success", data.title, data.message);
												window.location = domain+'checkout';
											} else {
												UIToastr.showToaster("error", data.title, data.message);
											}
											//loadingHide('body');
										}
			   });
	}
}
