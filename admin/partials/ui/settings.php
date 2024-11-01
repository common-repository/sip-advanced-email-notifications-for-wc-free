<form method="post" action="options.php">
  <?php settings_fields( 'sip-advanced-eEmail-notification-settings-group' ); ?>
	<div class="card">
		<div class="card-body">
			<div class="row align-items-center">
				<div class="col-md-3">
					<div class="custom-control custom-checkbox"> 
						<?php 
							$checked = ' ';
							if ( get_option('do_not_log_emails_sent') == "true") { 
								$checked = ' checked="checked" ';
							}
						?>
						<input type="checkbox" class="custom-control-input"  id="emails_sents"name="do_not_log_emails_sent" value="true" <?php echo $checked; ?> />
						<label class="custom-control-label" for="emails_sents">
							<?php _e('Do not log emails sent', 'sip-advanced-email-notifications-for-wc-free' );?>
						</label>
					</div>
				</div>
				
			</div>
		</div>
		<div class="card-footer">
			<input type="submit" name="submit" id="submit" class="btn btn-danger" value="Save Changes">
		</div>
	</div>
</form>