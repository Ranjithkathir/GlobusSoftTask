// Call the dataTables jQuery plugin
$(document).ready(function () {
  	$('#employeeListTable').DataTable({
	    /* No ordering applied by DataTables during initialisation */
	    "order": [],
	    "language": {
	      "emptyTable": "No Employees Found"
	    },
	    dom: 'Bfrtip',
        buttons: [
            {
                extend:    'excelHtml5',
                className: 'btn-success',
                text:      'Export Excel <i class="fas fa-file-excel"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                className: 'btn-danger',
                text:      'Export CSV <i class="fas fa-file-csv"></i>',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                className: 'btn-info',
                text:      'Export PDF <i class="fas fa-file-pdf"></i>',
                titleAttr: 'PDF'
            }
        	
        ]
	 });
});
