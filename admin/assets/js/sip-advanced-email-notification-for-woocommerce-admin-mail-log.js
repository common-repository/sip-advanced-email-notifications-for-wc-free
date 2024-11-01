(function( $ ) {
	'use strict';

	$(document).ready(function() {

		$(".add_new_email_rules").on("click", function(e){
			
			if($(".free-email-notification-list-table tbody tr").length > 2){
				swal("Sorry", "You need to buy pro version to add unlimited email notifications.", "warning");
				e.preventDefault();
			}
		});


		// ATW
		if ( top.location.href != location.href ) top.location.href = location.href;

	});


})( jQuery );
