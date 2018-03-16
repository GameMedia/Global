$("#form-login").submit( function () {
	if ($('.login-form').validate().form()) {
		$.ajax({   
			type: "POST",
			data : $(this).serialize(),
			cache: false,  
			dataType: "json",
			url: domain+"login/auth",   
			success: function(response){
				if (response.success == true) {
					window.location.href = domain;
				} else {
					$('.alert span').html(response.message);
					$('#errorMessage').show();
					$('#password').val('');
				}
			}   
		});   
		return false;   
	}                
});
