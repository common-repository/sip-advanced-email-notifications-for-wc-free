<?php 

$src_image = SIP_AENWCF_URL . 'admin/partials/assets/images/';
$extensions = array(
    '1' => (object) array(
        'image_url' => $src_image . 'icon-wpgumby.png',
        'url'       => SIP_WPGUMBY_THEME_URL . '?utm_source=wordpress.org&utm_medium=SIP-panel&utm_content=v'. SIP_AENWCF_VERSION .'&utm_campaign=' .SIP_AENWCF_UTM_CAMPAIGN,
        'title'     => SIP_WPGUMBY_THEME,
        'desc'      => __( 'Flat and responsive WooCommerce theme.<br>', 'sip-cookie-check' ),
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