
var TableAjax = function () {
		
    var handleRecords = function (datatable, url) {
		var grid = new Datatable();

        grid.init({
            src: $("#"+datatable),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: { 
                "bStateSave": true, 
                "lengthMenu": [
                    [10, 20, 50, 100, 150],
                    [10, 20, 50, 100, 150] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": domain+url, // ajax source
                },
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc
                // Disable sorting on the no-sort class
				"aoColumnDefs" : [ {
					"bSortable" : false,
					"aTargets" : [ "no-sort" ]
				} ]
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }
    
    return {
        //main function to initiate the module
        init: function (datatable, url) {
            handleRecords(datatable, url);
        }
    };

}();


/*
 * Show/UnShow Column
 */ 
$('select.toggle-vis').on( 'change', function (e) {
	e.preventDefault();
	
	// Get the column API object
	var table = $("#datatable").DataTable();
	var listCol = $(this).val();
	var listTotal = $('select.toggle-vis option').length;
	for(var i=0; i<listTotal; i++){
		
		if(in_array(i, listCol) != -1){
			table.column( i ).visible( true );
		} else {
			table.column( i ).visible( false );
		}
		
	}
} );


