/**
 * Data Repository: Controls dataTables plugin and other functionality for switching layouts
 */

( function( $ ) {
    var table = $('#dataRepo').DataTable({
    	"info": false,
    	"lengthChange": false
    });
    
    // Sort
    $(".tableSort").click(function() {
    	var col = $(this).attr("data-sortCol");
    	table.order([col, 'asc']).draw();
    	$(".tableSort").not(this).removeClass("active");
    	$(this).addClass("active");
    });

    // Search
    $('#dataSearch').on( 'keyup click', function () {
        table.search(
	        $('#dataSearch').val()
	    ).draw();
    } );

} )( jQuery );