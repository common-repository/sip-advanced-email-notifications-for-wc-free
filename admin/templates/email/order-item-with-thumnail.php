<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$order = wc_get_order($order_id);
	if ( sizeof( $order->get_items() ) > 0 ) {
	?>
	<table>
		<?php 
		foreach( $order->get_items() as $item ) {
			$_product = $item->get_product(); ?>
			<tr>
		  		<td>
		    		<a href="<?php echo $_product->get_permalink() ?>"><?php echo $_product->get_title() ?></a>
		  		</td>
		   		<td>
					<?php $_product_id = method_exists( $_product, 'get_id' ) ? $_product->get_id() : $_product->id; ?>
		    		<?php echo  get_the_post_thumbnail($_product_id, 'shop_catalog','' )?>
		  		</td>
			</tr>
			<?php
		}
		?>
	</table>
	<?php
}
?>