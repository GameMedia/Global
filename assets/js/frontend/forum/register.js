function register(){
    jQuery('#button-submit').attr('disabled', 'disabled');
    jQuery('#button-submit').html('Loading...');
    jQuery.ajax({
            type: "POST",
            data : jQuery('#form_register').serialize(),
            cache: false,  
            dataType: "json",
            url: domain+"register/do",   
            success: function(response){
                if (response.status == true) {
                    window.location.href = response.url;
                } else {
                    $('.alert span').html(response.message);
                    $('#errorMessage').show();
                    $('#password').val('');
                    $('#conf_password').val('');
                }

                jQuery('#button-submit').removeAttr('disabled');
                jQuery('#button-submit').html('Login <i class="m-icon-swapright m-icon-white"></i>');
            }   
        }); 
}