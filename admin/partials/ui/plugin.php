<?php 

$src_image = SIP_AENWCF_URL . 'admin/partials/assets/images/';
$extensions = array(
  '1' => (object) array(
      'image_url' => $src_image . 'icon-social-proof.png',
      'url'       => SIP_SPWC_PLUGIN_URL . '?utm_source=wordpress.org&utm_medium=SIP-panel&utm_content=v'. SIP_AENWCF_VERSION .'&utm_campaign=' .SIP_AENWCF_UTM_CAMPAIGN,
      'title'     => SIP_SPWCF_PLUGIN,
      'desc'      => __( 'Display real time proof of your sales and customers.<br>', 'sip-advanced-email-notifications-for-wc-free' ),
  ),
  '2' => (object) array(
      'image_url' => $src_image . 'icon-front-end-bundler.png',
      'url'       => SIP_FEBWC_PLUGIN_URL . '?utm_source=wordpress.org&utm_medium=SIP-panel&utm_content=v'. SIP_AENWCF_VERSION .'&utm_campaign=' .SIP_AENWCF_UTM_CAMPAIGN,
      'title'     => SIP_FEBWC_PLUGIN,
      'desc'      => __( 'Bundle maker with real time offers.<br><br>', 'sip-advanced-email-notifications-for-wc-free' ),
  ),
  '3' => (object) array(
      'image_url' => $src_image . 'icon-reviews-shortcode.png',
      'url'       => SIP_RSWC_PLUGIN_URL . '?utm_source=wordpress.org&utm_medium=SIP-panel&utm_content=v'. SIP_AENWCF_VERSION .'&utm_campaign=' .SIP_AENWCF_UTM_CAMPAIGN,
      'title'     => SIP_RSWC_PLUGIN,
      'desc'      => __( 'Display product reviews in any post/page with a shortcode.', 'sip-advanced-email-notifications-for-wc-free' ),
  ),
  '4' => (object) array(
      'image_url' => $src_image . 'icon-advanced-email.png',
      'url'       => SIP_AENWC_PLUGIN_URL . '?utm_source=wordpress.org&utm_medium=SIP-panel&utm_content=v'. SIP_AENWCF_VERSION .'&utm_campaign=' .SIP_AENWCF_UTM_CAMPAIGN,
      'title'     => SIP_AENWC_PLUGIN,
      'desc'      => __( 'Powerful email automation.', 'sip-advanced-email-notifications-for-wc-free' ),
  ),
  '5' => (object) array(
      'image_url' => $src_image . 'icon-cookie-check.png',
      'url'       => SIP_CCWC_PLUGIN_URL . '?utm_source=wordpress.org&utm_medium=SIP-panel&utm_content=v'. SIP_AENWCF_VERSION .'&utm_campaign=' .SIP_AENWCF_UTM_CAMPAIGN,
      'title'     => SIP_CCWC_PLUGIN,
      'desc'      => __( '<br>Encourage visitors to enable cookies so you don’t lose sales.', 'sip-advanced-email-notifications-for-wc-free' ),
   ),
);

?>

<div id="sip-wraper" class="row">
	<?php 
  	$i = 0;
  	foreach ( (array) $extensions as $i => $extension ) {
		// Attempt to get the plugin basename if it is installed or active.
		$image_url   = $extension->image_url ;
		$url 		 = $extension->url ;
		$title		 = $extension->title ;
		$description = $extension->desc ; 
			?>
			<div class="col-md-4 col-xl-4 mg-t-10">	<div class="card">  <div class="card-header"> <h5 class="card-title"><?php echo $title ?></h5></div> 	 <div class="card-body text-center">    <p><?php echo $description ?></p>	<img class="img-fluid img-wid" src="<?php echo $image_url; ?>"  alt="<?php echo $title; ?>">   </div>    <div class="card-footer text-center">  <a class=" btn btn-danger" title="<?php echo $title; ?>" href="<?php echo $url; ?>" target="_blank">Learn more</a>   </div>  </div></div>
		<?php $i++; 
	} 
	?>
	<div class="sip-version">
	  <?php $get_optio_version = get_option( 'sip_version_value' ); echo "SIP Version " . $get_optio_version; ?>
	</div>
</div><!-- .shopitpress -->