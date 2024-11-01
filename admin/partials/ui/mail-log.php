<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Plugin settings page
*/

	$maillogs_obj = new Maillogs_List_Free();
	?>
<div class="card">
<div class="card-body">	
		<div id="posftstuff">
			<div id="post-body" class="metabox-holder columns-1">
				<div id="post-body-content">
					<div class="meta-box-sortables ui-sortable">
					<?php $maillogs_obj->views();?>
						<form method="post">
							<?php
							$maillogs_obj->prepare_items();
							$maillogs_obj->display(); ?>
						</form>
					</div>
				</div>
			</div>
			<br class="clear">
		</div>
	
		<div class="modal fade sip-aenwc-modal-fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		    	<form class="form-horizontal" id="edit-form">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="edit-modal-label"><?php _e('Edit selected email', 'sip-advanced-email-notifications-for-wc-free' ); ?></h4>
			      </div>
			      <div class="modal-body">
			      		<input type="hidden" id="edit-id" value="" class="hidden">
			        	<div class="form-group">
					    	<label for="subject" class="col-sm-2"><?php _e('E-mail Subject', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
					    	<div class="col-sm-10">
					      		<input type="text" class="form-control" id="subject" name="subject" placeholder="E-mail Subject" required>
					    	</div>
					  	</div>
					  	<div class="form-group">
					    	<label for="content" class="col-sm-2"><?php _e('E-mail Content', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
					    	<div class="col-sm-10">
					      		<textarea class="form-control" rows="5" id="content" name="content" placeholder="E-mail content" required></textarea>
					    	</div>
					  	</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Close', 'sip-advanced-email-notifications-for-wc-free' ); ?></button>
			        <button type="submit" class="btn btn-danger"><?php _e('Save changes', 'sip-advanced-email-notifications-for-wc-free' ); ?></button>
			      </div>
		      	</form>
		    </div>
		  </div>
		</div>

		<div class="modal fade sip-aenwc-modal-fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="detail-modal-label">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		    	<form class="form-horizontal" id="edit-form">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="detail-modal-label"><?php _e('Selected email', 'sip-advanced-email-notifications-for-wc-free' ); ?></h4>
			      </div>
			      <div class="modal-body">
			      		<input type="hidden" id="edit-id" value="" class="hidden">
			        	<div class="form-group">
					    	<label for="subject" class="col-sm-2"><?php _e('E-mail Subject', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
					    	<div class="col-sm-10">
					      		<input type="text" class="form-control" readonly id="detail-subject" name="subject" placeholder="E-mail Subject" required>
					    	</div>
					  	</div>
					  	<div class="form-group">
					    	<label for="content" class="col-sm-2"><?php _e('E-mail Content', 'sip-advanced-email-notifications-for-wc-free' ); ?></label>
					    	<div class="col-sm-10">
					      		<textarea class="form-control" rows="5" readonly id="detail-content" name="content" placeholder="E-mail content" required></textarea>
					    	</div>
					  	</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Close', 'sip-advanced-email-notifications-for-wc-free' ); ?></button>
			      </div>
		      	</form>
		    </div>
		  </div>
		</div>
	</div>	</div>
	

