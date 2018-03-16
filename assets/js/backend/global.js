var deleteID = "",
	deleteUrl = "",
	deleteDataTable = "";
var cloneID = "",
	cloneUrl = "",
	cloneDataTable = "";

function loadingShow(id){
	Metronic.blockUI({'target':id});
}

function loadingHide(id){
	Metronic.unblockUI(id);
}

function remove_toggle(id){
	jQuery('.'+id).toggle('slow');
}

function activeTab(id){
	jQuery('.'+id).addClass('active');
	jQuery('#'+id).addClass('active');
} 

function inactiveTab(id){
	jQuery('.'+id).removeClass('active');
	jQuery('#'+id).removeClass('active');
}

function bootstrapSwitch(id, value){
	if(value){
		jQuery('.bootstrap-switch-id-'+id).removeClass('bootstrap-switch-off');
		jQuery('.bootstrap-switch-id-'+id).addClass('bootstrap-switch-on');
		
	} else {
		jQuery('.bootstrap-switch-id-'+id).removeClass('bootstrap-switch-on');
		jQuery('.bootstrap-switch-id-'+id).addClass('bootstrap-switch-off');
	}
}

function bootstrapMultiselect(id){
	$('#'+id).multiselect({
	  enableClickableOptGroups: true
	});
}

function setDeleteID(id){
	deleteID = 	id;
}

function deleteData(){
	if(deleteUrl != "" && deleteID != "" && deleteDataTable != ""){		
		jQuery.ajax({
				url:  domain+deleteUrl,
				dataType: "json",
				type: "POST",
				data: {
						'id' : deleteID
					  },
				beforeSend: loadingShow("#formDelete"),
				success: function(data) {
											sessOut(data);
											if(data.success){
												UIToastr.showToaster("success", data.title, data.message);	
												jQuery("#"+deleteDataTable).DataTable().ajax.reload();
											} else {
												UIToastr.showToaster("error", data.title, data.message);
											}
											loadingHide("#formDelete")
										}
			   });
	} else
		UIToastr.showToaster("error", "Delete", "Please Check your parameters.");
}

function cloneData(){
	if(cloneUrl != "" && cloneID != "" && cloneDataTable != ""){		
		jQuery.ajax({
				url:  domain+cloneUrl,
				dataType: "json",
				type: "POST",
				data: {
						'id' : cloneID
					  },
				beforeSend: loadingShow("#formClone"),
				success: function(data) {
											sessOut(data);
											if(data.success){
												UIToastr.showToaster("success", data.title, data.message);	
												jQuery("#"+cloneDataTable).DataTable().ajax.reload();
											} else {
												UIToastr.showToaster("error", data.title, data.message);
											}
											loadingHide("#formClone")
										}
			   });
	} else
		UIToastr.showToaster("error", "Clone", "Please Check your parameters.");
}

function getSelect(id_query, id_value, title, url, target){
	$('#'+target).val('');
	$('#'+target).attr('disabled', 'disabled');
	if(id_query != ""){
		jQuery.ajax({
				url:  domain+url,
				dataType: "json",
				type: "POST",
				data: {
						'id_query' : id_query
					  },
				beforeSend: loadingShow('#'+target),
				success: function(data) {
											var result = '<option value="">- Choose '+title+' -</option>';
											if(data.count){	
												for(var i=0; i<data.rows.length; i++){
													result += "<option value='"+data.rows[i]['id']+"'>"+data.rows[i]['name']+"</option>";
												}
												$('#'+target).html(result);
												$('#'+target).removeAttr('disabled');
												
												$('#'+target).val(id_value);
											}
											loadingHide('#'+target);
										}
			   });	
	}
}

function sessOut(data){
	if(data.success == 'out')
		window.location = data.url;
}

/*
 * Checking In Array variable
 */ 
function in_array(needle, haystack){
    var found = 0;
    for (var i=0, len=haystack.length;i<len;i++) {
        if (haystack[i] == needle) return i;
            found++;
    }
    return -1;
}
