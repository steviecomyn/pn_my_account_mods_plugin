<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward">
	<?php esc_html_e( 'Checkout', 'woocommerce' ); ?>
</a>
<style>
	#brws-continue-shopping {
		color: #242424;
		font-weight: bold;
		display: inline-block;
		margin-left: 6px;
	}

	#brws-continue-shopping:hover {
		color: #424242 !important;
	}

	#brws-continue-wrapper {
		display: flex;
		justify-content: center;
		flex-direction: row;
		margin-top: -5px;
	}
</style>
<div id="brws-continue-wrapper">or <a id="brws-continue-shopping" href="<?php echo wc_get_page_permalink( 'shop' ); ?>">continue shopping</a></div>



