<?php
/**
 * This is the default template part for the
 * email element in the shipping-address
 * purchase-requriements in the content-checkout template part.
 *
 * @since 1.4.0
 * @version 1.4.0
 * @package IT_Exchange
 *
 * WARNING: Do not edit this file directly. To use
 * this template in a theme, copy over this file to the
 * /exchange/content-checkout/elements/purchase-requirements/shipping-address/elements/
 * directory located in your theme.
*/
?>
<?php do_action( 'it_exchange_content_checkout_shipping_address_purchase_requirement_before_email_element' ); ?>
<div class="it-exchange-email">
	<?php it_exchange( 'shipping', 'email' ); ?>
</div>
<?php do_action( 'it_exchange_content_checkout_shipping_address_purchase_requirement_after_email_element' ); ?>
