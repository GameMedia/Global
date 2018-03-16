function view(id){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"management-content/contents/getContentsData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_contents'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#id_game').val(data.id_game);
											jQuery('#id_gallery').val(data.id_gallery);
											jQuery('#id_content_type').val(data.id_content_type);
											jQuery('#name').val(data.name);
											jQuery('#publish_time').val(data.publish_time);
											jQuery('#seen').val(data.seen);
											jQuery('#short_desc').val(data.short_desc);
											jQuery('#short_desc_en').val(data.short_desc_en);
											CKEDITOR.instances.long_desc.setData( data.long_desc );
											CKEDITOR.instances.long_desc_en.setData( data.long_desc_en );
											jQuery('#update_by').html(data.update_by);
											jQuery('#update_time').html(data.update_time);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_contents');
									}
		   });	
}

function save(){
	var id = jQuery('#id').val(),
		id_game = jQuery('#id_game').val(),
		id_gallery = jQuery('#id_gallery').val(),
		id_content_type = jQuery('#id_content_type').val(),
		name = jQuery('#name').val(),
		publish_time = jQuery('#publish_time').val(),
		short_desc = jQuery('#short_desc').val(),
		short_desc_en = jQuery('#short_desc_en').val(),
		long_desc = CKEDITOR.instances.long_desc.getData(),
		long_desc_en = CKEDITOR.instances.long_desc_en.getData(),
		path_ori = jQuery('#path_ori').val(),
		path_thumb = jQuery('#path_thumb').val(),
		url_ori = jQuery('#url_ori').val(),
		url_thumb = jQuery('#url_thumb').val(),
		mime_type = jQuery('#img_mime').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_contents');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"management-content/contents/saveContents",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'id_game' : id_game,
					'id_gallery' : id_gallery,
					'id_content_type' : id_content_type,
					'name' : name,
					'publish_time' : publish_time,
					'short_desc' : short_desc,
					'long_desc' : long_desc,
					'short_desc_en' : short_desc_en,
					'long_desc_en' : long_desc_en,
					'path_ori' : path_ori,
					'path_thumb' : path_thumb,
					'url_ori' : url_ori,
					'url_thumb' : url_thumb,
					'mime_type' : mime_type,
					'status' : status
				  },
			beforeSend: loadingShow('#form_contents'),
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
										loadingHide('#form_contents')
									}
		   });	
}

function clearSearchForm(){
	jQuery('#search_id_content_type').val('');
	jQuery('#search_name').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#id_gallery').val('');	
	jQuery('#id_game').val('');	
	jQuery('#name').val('');
	jQuery('#seen').val('');
	jQuery('#publish_time').val('');
	jQuery('#short_desc').val('');
	jQuery('#short_desc_en').val('');
	jQuery('#path_ori').val('');
	jQuery('#path_thumb').val('');
	jQuery('#url_ori').val('');
	jQuery('#url_thumb').val('');
	jQuery('#img_mime').val('');
	CKEDITOR.instances.long_desc.setData('');
	CKEDITOR.instances.long_desc_en.setData('');
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}

function showView(value){
	if(value == 0){
		jQuery('#list-content').css('display', 'inline');
		jQuery('#view-content').css('display', 'none');
	} else if(value == 1){
		jQuery('#list-content').css('display', 'none');
		jQuery('#view-content').css('display', 'inline');
	} 
}

$(function () {
    'use strict';
    $('#fileupload').fileupload({
		url: domain+"managing-masters/galleries/uploadGalleries?files",
		type: 'POST',
		cache: false,
		dataType: 'json',
		processData: false, // Don't process the files
		contentType: false, // Set content type to false as jQuery will tell the server its a query string request,
        progressall: function (e, data) {
			$('.progress-bar').css(
                'width', '0%'
            );
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        },
		success: function(data, textStatus, jqXHR)
		{
			if(data.status){
				jQuery('#id_gallery').val('');
				jQuery('#path_ori').val(data.files['path_ori']);
				jQuery('#path_thumb').val(data.files['path_thumb']);
				jQuery('#url_ori').val(data.files['url_ori']);
				jQuery('#url_thumb').val(data.files['url_thumb']);
				jQuery('#img_width').val(data.files['img_width']);
				jQuery('#img_height').val(data.files['img_height']);
				jQuery('#img_mime').val(data.files['img_mime']);
				jQuery('#display-banner').html('<img src="'+data.icon+'" width="100" />').css('display','inline');
			} else {
				$('.progress-bar').css(
					'width', '0%'
				);
				UIToastr.showToaster("error", "Upload Banner", data.message);
			}
			loadingHide('body');
		},
		error: function(jqXHR, textStatus, errorThrown)
		{
			console.log('ERRORS: ' + textStatus);
			// STOP LOADING SPINNER
		}
	});
});
