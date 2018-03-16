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
											} else {
												UIToastr.showToaster("error", data.title, data.message);
											}
											//loadingHide('body');
										}
			   });
	}
}

function getShipping(id, id_state){
	var ship_weight = $('#ship_weight').val(),
		total_price = $('#total_price').val();
	jQuery.ajax({
			url:  domain+"checkout/getShipping",
			dataType: "json",
			type: "POST",
			data : {'id':id, 'id_state':id_state, 'ship_weight':ship_weight, 'total_price':total_price},
			//beforeSend: loadingShow('body'),
			success: function(data) {
										if(data.count){
											$('#ship_destination').html(data.name_state);
											$('#etd').html(data.etd);
											$('#shipping-fee').html(data.shipping_fee_format);
											$('#review-shipping').html(data.shipping_fee_format);
											$('#grand-total').html(data.grand_total_format);
											$('#shipping_fee').val(data.shipping_fee);
											
										} else {
											/*UIToastr.showToaster("error", data.title, data.message);*/
										}
										//loadingHide('body');
									}
		   });
}


function processTransaction(){
	if(confirm("Are you sure want to place order this item?")){
		var id = $('#id').val(),
			id_customer_address = $('#address:checked').val(),
			payment_method = $('#payment_method:checked').val(),
			first_name = $('#billing_first_name').val(),
			last_name = $('#billing_last_name').val(),
			phone = $('#billing_phone').val(),
			address = $('#billing_address').val(),
			city = $('#billing_city').val(),
			ziptal_code = $('#billing_ziptal_code').val(),
			id_state = $('#billing_id_state').val(),
			email = $('#billing_email').val(),
			weight = $('#ship_weight').val(),
			shipping_fee = $('#shipping_fee').val(),
			qty = $('#total_qty').val(),
			grand_total = $('#total_price').val();
		jQuery.ajax({
				url:  domain+"checkout/setPayment",
				dataType: "json",
				type: "POST",
				data : {'id':id, 
						'id_customer_address':id_customer_address, 
						'payment_method':payment_method, 
						'first_name':first_name, 
						'last_name':last_name,
						'phone':phone,
						'address':address,
						'city':city,
						'ziptal_code':ziptal_code,
						'id_state':id_state,
						'email':email,
						'weight' : weight,
						'shipping_fee' : shipping_fee,
						'qty' : qty,
						'grand_total' : grand_total},
				//beforeSend: loadingShow('body'),
				success: function(data) {
											if(data.success){
												window.location = data.url;
											} else {
												UIToastr.showToaster("error", data.title, data.message);
											}
											//loadingHide('body');
										}
			   });
	}
}

function moveToBilling(){
	$('#billing-info').click();
}

function moveToShipping(){
	$('#shipping-fee-method').click();
}

function moveToReview(){
	$('#review').click();
}
