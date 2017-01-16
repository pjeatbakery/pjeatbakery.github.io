<?php
/**
 * This is the default template for the
 * super-widget-checkout actions loop.
 *
 * @since 1.1.0
 * @version 1.1.0
 * @package IT_Exchange
 *
 * WARNING: Do not edit this file directly. To use
 * this template in a theme, copy over this file
 * to the exchange/super-widget-checkout/loops directory
 * located in your theme.
*/
?>

<?php
// Two actions or one?
$actions_count = ( ( it_exchange( 'coupons', 'accepting', array( 'type' => 'cart' ) ) || it_exchange( 'coupons', 'has-applied', array( 'type' => 'cart' ) ) ) && it_exchange_get_global( 'can_edit_purchase_quantity' ) ) || ( it_exchange_is_multi_item_cart_allowed() && it_exchange_get_cart_products_count() > 1 ) ? ' two-actions' : '';
?>

<?php do_action( 'it_exchange_super_widget_cart_before_actions_loop' ); ?>
<?php do_action( 'it_exchange_super_widget_cart_before_actions_wrap' ); ?>
<div class="cart-actions-wrapper <?php echo $actions_count; ?>">
	<?php if ( it_exchange_is_multi_item_cart_allowed() && it_exchange_get_cart_products_count() > 1 ) : ?>
		<?php foreach( it_exchange_get_template_part_elements( 'super-widget-checkout', 'multi-item-cart-actions', array( 'multi-item-cancel', 'multi-item-checkout' ) ) as $element ) : ?>
			<?php it_exchange_get_template_part( 'super-widget-checkout/elements/' . $element ); ?>
		<?php endforeach; ?>
	<?php else : ?>
		<?php foreach( it_exchange_get_template_part_elements( 'super-widget-checkout', 'single-item-cart-actions', array( 'single-item-update-coupons', 'single-item-update-quantity' ) ) as $element ) : ?>
			<?php it_exchange_get_template_part( 'super-widget-checkout/elements/' . $element ); ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
<?php do_action( 'it_exchange_super_widget_cart_after_actions_wrap' ); ?>
<?php do_action( 'it_exchange_super_widget_cart_after_actions_loop' ); ?>
