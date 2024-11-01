(function( $ ) {
	'use strict';


	/* jQuery(document).ready(function($) {
		$("body").tooltip({ selector: '[data-toggle=tooltip]' });
	}); */

	jQuery(document).ready( function($) {

		$('.summernote').summernote({
			placeholder: 'write here...',
			tabsize: 2,
			height: 120,
			height: 300,                 // set editor height
			minHeight: null,             // set minimum height of editor
			maxHeight: null,             // set maximum height of editor
			focus: true,                  // set focus to editable area after initializing summernote
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'underline', 'clear']],
				['color', ['color']],
				['fontsize', ['fontsize']],
				['para', ['ul', 'ol', 'paragraph']],
				['table', ['table']],
				['insert', ['link', 'picture', 'video']],
				['view', ['codeview']]
			],
			codemirror: { // codemirror options
				theme: 'monokai'
			},
		});





	
	 	$('.preview-email').on('click', function(e) { 

			var email_edbody = $(this).closest('.email_chain_box_email_preview').find('.summernote').summernote('code');
			
			var screenTop = $(document).scrollTop();
			var wheight = $(window).height();

			wheight = wheight/3;
		    var email_template = "<!DOCTYPE html>";
		    email_template += "<html>";
		    email_template += "<body>";
		    email_template += email_edbody;
		    email_template += "</body>";
		    email_template += "</html>";
			console.log(email_edbody);
			$(".output-email-preview").contents().find('html').html(email_template);
			$('#myModal').show("slow");
		});

		$(".close").on("click", function(){
			$("#myModal").hide("slow");
		});
		window.onclick = function(event) {
			if (event.target == $("#myModal")) {
				$("#myModal").hide("slow");
			}
		}

	 	$('.hover_bkgr_fricc').on('click', function(e) { 
			$('.hover_bkgr_fricc').hide();
			$('body').removeClass('sip-email-body-tag');
		});

	 	$('.popupCloseButton').on('click', function(e) { 
			$('.hover_bkgr_fricc').hide();
			$('body').removeClass('sip-email-body-tag');
		});


	 	$('#sip_a_e_n_wc_test_email_button').on('click', function(e) { 

			var id = $("#sip_a_e_n_wc_test_email_id").val();
			var sip_a_e_n_wc_test_email = $("#sip_a_e_n_wc_test_email").val();
			
			$('#sip-a-e-n-wc-test-email-'+id).show();

			var data = {
				'action': 'sip_aenwc_send_test_email',
				'id' : id,
				'custom_email_address': sip_a_e_n_wc_test_email
			};

			$.post( sip_aenwc_ajax.ajax_url, data ).done(function( html ) {

				$('#sip-a-e-n-wc-test-email-'+id).hide();
			});
		});

	 });

})( jQuery );