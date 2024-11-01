<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$order = wc_get_order($order_id);
if ( sizeof( $order->get_items() ) > 0 ) {

	foreach( $order->get_items() as $item ) {
		$_product = $item->get_product();
		?>
		<a href="<?php echo $_product->get_permalink() ?>"><?php echo $_product->get_title() ?></a>
		<br>
		<?php 
	}
	}

?>
