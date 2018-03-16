function loadPrivilege_Menu(){
	"use strict";
	var privilege = $('#search_id_privilege').val(),
		name = $('#search_name').val(),
		menu = $('#search_id_menu').val(),
		icon = $('#search_icon').val(),
		status = $('#search_active').val();
	
	jQuery.ajax({
			url:  domain+"user-management/privilege_menu/loadMenuSelect",
			dataType: "json",
			type: "POST",
			data: {
					'privilege' : privilege,
					'name' : name,
					'menu' : menu,
					'icon' : icon,
					'status' : status,
					'parent' : 0
				  },
			beforeSend: loadingShow('table-append'),
			success: function(data) {
										jQuery('#body-table').html('');
										var result = '', sort_up = '', sort_down='', edit='', del='';
											for(var i=0; i<data.rows.length; i++){												
																								
												var edit='';
												if(accessEdit=='1')
													edit = '<button onclick="view(\''+data.rows[i]['id']+'\')" style="cursor:pointer" class="btn btn-xs" data-target="#formAdd" data-toggle="modal" title="View Data"><span class="fa fa-search"></span></button>';
												var del='';
												if(accessDelete=='1')
													del = '<a data-toggle="modal" href="#formDelete" onclick="deleteID=\''+data.rows[i]['id']+'\', deleteUrl=\'user-management/privilege_menu/delete_PM\', deleteDataTable=\'table-append\'" style="cursor:pointer" class="btn red btn-xs" title="Delete Data"><span class="fa fa-trash-o"></span></a>';
												
												var sort_up = '';
												if(data.rows[i]['sort_up'] != null){
													sort_up = '<button onclick="editSorting(\''+data.rows[i]['id']+'\',\'up\')" style="cursor:pointer" class="btn btn-xs blue"><i class="fa fa-arrow-up"></i></button>';
												}
												
												var sort_down = '';
												if(data.rows[i]['sort_down'] != null){
													sort_down = '<button onclick="editSorting(\''+data.rows[i]['id']+'\',\'down\')" style="cursor:pointer" class="btn btn-xs blue"><i class="fa fa-arrow-down"></i></button>';
												}
												  
												var access_view = '<button onclick="editAccess(\''+data.rows[i]['id']+'\',\''+data.rows[i]['id_privilege']+'\',1)" style="cursor:pointer" class="btn btn-default btn-xs margin-bottom '+data.rows[i]['access_button']['view']+'" data-toggle="button" title="Accessing Menu"><span class="icon-screen-desktop"></span></button>',
													access_save = '<button onclick="editAccess(\''+data.rows[i]['id']+'\',\''+data.rows[i]['id_privilege']+'\',2)" style="cursor:pointer" class="btn btn-default '+data.rows[i]['access_button']['add']+' btn-xs" data-toggle="button" title="Save Data"><span class="fa fa-save"></span></button>',
													access_edit = '<button onclick="editAccess(\''+data.rows[i]['id']+'\',\''+data.rows[i]['id_privilege']+'\',4)" style="cursor:pointer" class="btn btn-default '+data.rows[i]['access_button']['edit']+' btn-xs" data-toggle="button" title="Edit Data"><span class="fa fa-edit"></span></button>',
													access_delete = '<button onclick="editAccess(\''+data.rows[i]['id']+'\',\''+data.rows[i]['id_privilege']+'\',8)" style="cursor:pointer" class="btn btn-default '+data.rows[i]['access_button']['delete']+' btn-xs" data-toggle="button" title="Delete Data"><span class="fa fa-trash-o"></span></button>';
												result += '<tr class="odd gradeX"><td>'+(i+1)+'</td><td>'+data.rows[i]['name_privilege']+'</td><td>'+data.rows[i]['name']+'</td><td>'+data.rows[i]['url']+'</td><td align="center"><span class="'+data.rows[i]['icon']+'"></span></td><td>'+data.rows[i]['status']+'</td><td>'+access_view+access_save+access_edit+access_delete+'</td><td>'+edit+' '+del+'</td></tr>';
											}
										$('#body-table').append(result);
										loadingHide('table-append');
									}
		   });	
}

function view(id){
	"use strict";
	
	/*if(!accessEdit){
		saveAccessible(false);
	} else
		saveAccessible(true);*/
	jQuery.ajax({
			url:  domain+"user-management/privilege_menu/getPrivilege_MenuData",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id
				  },
			beforeSend: loadingShow('#form_privilege_menu'),
			success: function(data) {
										sessOut(data);
										if(data.count){
											jQuery('#id').val(data.id);
											jQuery('#name').val(data.name);
											jQuery('#description').val(data.description);
											jQuery('#url').val(data.url);
											jQuery('#icon').val(data.icon);
											jQuery('#parent').val(data.parent);
												
											if(data.status) {
												jQuery('#status').attr('checked', 'checked');
											} else 
												jQuery('#status').attr('checked');
																							
											bootstrapSwitch('status', data.status);
										} else {
											
										}
										loadingHide('#form_privilege_menu');
									}
		   });	
}

function editAccess(menu, privilege, access){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"user-management/privilege_menu/setAccess",
			dataType: "json",
			type: "POST",
			data: {
					'menu' : menu,
					'privilege' : privilege,
					'access' : access
				  },
			beforeSend: loadingShow('body'),
			success: function(data) {
										sessOut(data);
										if(data.success){
                    						UIToastr.showToaster("success", data.title, data.message);	
                    						loadPrivilege_Menu();
										} else {
											UIToastr.showToaster("error", data.title, data.message);
										}
										loadingHide('body');
									}
		   });
}

function editSorting(menu, position){
	"use strict";
	
	jQuery.ajax({
			url:  domain+"user-management/privilege_menu/setAccess",
			dataType: "json",
			type: "POST",
			data: {
					'menu' : menu,
					'position' : position
				  },
			beforeSend: loadingShow('body'),
			success: function(data) {
										sessOut(data);
										if(data.success){
                    						UIToastr.showToaster("success", data.title, data.message);	
                    						loadPrivilege_Menu();
										} else {
											UIToastr.showToaster("error", data.title, data.message);
										}
										loadingHide('body');
									}
		   });
}

function save(){
	var id = jQuery('#id').val(),
		description = jQuery('#description').val(),
		name = jQuery('#name').val(),
		url = jQuery('#url').val(),
		icon = jQuery('#icon').val(),
		parent = jQuery('#parent').val(),
		status = jQuery('#status').is(':checked') ? 1 : 0;
	
	var form = $('#form_privilege_menu');
	var error = $('.alert-error-save', form);
    var success = $('.alert-success-save', form);
		
	jQuery.ajax({
			url:  domain+"user-management/privilege_menu/cekUI_PM",
			dataType: "json",
			type: "POST",
			data: {
					'id' : id,
					'name' : name,
					'description' : description,
					'url' : url,
					'icon' : icon,
					'parent' : parent,
					'status' : status
				  },
			beforeSend: loadingShow('#form_privilege_menu'),
			success: function(data) {
										sessOut(data);
										if(data.success){
                    						error.hide();
                    						UIToastr.showToaster("success", data.title, data.message);	
                    						loadPrivilege_Menu();
											clearForm();
											
											jQuery(".btn-close-modal").trigger("click");
										} else {
											UIToastr.showToaster("error", data.title, data.message);
										}
										loadingHide('#form_privilege_menu')
									}
		   });	
}

function clearSearchForm(){
	//jQuery('#search_id_privilege').val('');
	jQuery('#search_name').val('');
	jQuery('#search_parent').val('');
	jQuery('#search_icon').val('');
	jQuery('#search_id_menu').val('');
	jQuery('#search_status').val('');
}

function clearForm(){
	jQuery('#id').val('');	
	jQuery('#name').val('');	
	jQuery('#description').val('');	
	jQuery('#icon').val('');	
	jQuery('#url').val('');	
	jQuery('#parent').val('');	
	
	jQuery('#status').prop('checked', false);
	
	bootstrapSwitch('status', false);
}
