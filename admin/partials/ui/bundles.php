<div class="card">
	<div style="display: block;">
		<?php

			if(isset($_GET["message"]) && $_GET["message"] == 0){
				echo '<div class="notice notice-warning is-dismissible">
						<p>'.esc_html__('You need to buy pro version to add unlimited email notifications.', 'sip-advanced-email-notifications-for-wc-free').'</p>
					</div>';
			}

			global $wpdb;

			$table = new Sip_Advanced_Email_Notification_WC_Admin_Post_Tab_Free();
			$table->prepare_items();

			$message = '';
			if ('delete' === $table->current_action()) {
				$count = 1;
				if(is_array($_REQUEST['id'])){
					$count = count($_REQUEST['id']);
				}
				$message = '<div class="updated below-h2" id="message"><p>' . sprintf(esc_html__('Items deleted: %d', 'sip-advanced-email-notifications-for-wc-free'), $count) . '</p></div>';
			}
		?>			  
		<div class="card-header">
			<h2 class="h5 mg-b-0">
				<?php _e('Email Notification', 'sip-advanced-email-notifications-for-wc-free')?> 
				<a class="add_new_email_rules text-decoration-none mg-l-10 btn btn-danger" href="<?php echo get_admin_url(get_current_blog_id(), 'post-new.php?post_type=a_e_n_shop');?>">
					<?php _e('Add new', 'sip-advanced-email-notifications-for-wc-free')?>
				</a>
			</h2>
			<span class="icon32 icon32-posts-post" id="icon-edit"></span>
		</div>
		<div class="card-body">
			<?php echo $message; ?>
			<form id="bundles-table" method="GET">
				<?php $table->display(); ?>
				<input type="hidden" name="page" value="<?php echo esc_html($_REQUEST['page']); ?>"/>
			</form>
		</div>	
	</div>
</div>


