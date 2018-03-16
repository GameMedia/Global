var Lock = function () {

	var handleLock = function() {
		$('.lock-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                userpass: {
	                    required: true
	                }
	            },

	            messages: {
	                userpass: {
	                    required: "Password is required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.lock-form')).show();
	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });

	        $('.lock-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.lock-form').validate().form()) {
	                    $('.lock-form').submit();
	                }
	                return false;
	            }
	        });
	        
	        $(".lock-form").submit( function () {
                if ($('.lock-form').validate().form()) {
                    $.ajax({   
                        type: "POST",
                        data : $(this).serialize(),
                        cache: false,  
                        dataType: "json",
                        url: domain+"backend/authLock",   
                        success: function(response){
                            if (response.status == true) {
                                window.location.href = response.url;
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
	}

	return {
        //main function to initiate the module
        init: function () {        	
            handleLock();
        }
    };

}();
