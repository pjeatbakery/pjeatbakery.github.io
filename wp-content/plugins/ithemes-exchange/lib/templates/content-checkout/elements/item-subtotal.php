<?php
/**
 * The main template file for the Subtotal detail
 * in the cart-items element for content-checkout
 * template part.
 *
 * @since 1.1.0
 * @version 1.1.0
 * @package IT_Exchange
 *
 * WARNING: Do not edit this file directly. To use
 * this template in a theme, copy over this file
 * to the exchange/content-checkout/elements/
 * directory located in your theme.
*/
?>

<?php do_action( 'it_exchange_content_checkout_before_item_subtotal_element' ); ?>
<div class="it-exchange-cart-item-subtotal it-exchange-table-column">
	<?php do_action( 'it_exchange_content_checkout_begin_item_subtotal_element_label' ); ?>
	<div class="it-exchange-table-column-inner">
		<?php it_exchange( 'cart-item', 'subtotal' ); ?>
	</div>
	<?php do_action( 'it_exchange_content_checkout_end_item_subtotal_element_label' ); ?>
</div>
<?php do_action( 'it_exchange_content_checkout_after_item_subtotal_element' ); ?>