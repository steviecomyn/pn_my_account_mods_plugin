<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<?php

// Checks if a user is a b2b customer or not
    function is_user_a_b2b_account()
        {      
            $user_is_b2b = get_user_meta(get_current_user_id(),'b2bking_b2buser', true);

            if ( $user_is_b2b[0] === 'y' )
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }

		// If user is b2b, hide the coupon code input.
		if (is_user_a_b2b_account())
                {
                    ?>

					<style>
						.woocommerce-form-coupon-toggle {
							display: none !important;
						}
						#pwgc-redeem-gift-card-form {
							display: none !important;
						}
						.giftwrap-before-cart, #-woo-checkout-3-9 > div > div.wc-giftwrap.giftwrap_checkout.giftwrap-before-cart.giftwrap-after-cart.wcgwp_could_giftwrap > div > a {
							display: none !important;
						}		
					</style>

					<script>
					jQuery(document).ready(function($)
						{
							$('#pwgc-redeem-form').remove();
						});
					</script>

					<?php
                }



// Creates a uniform page title.
    function pn_acc_make_page_title($title)
        {
			$subtitle = "By Rebecca";
			
			if (is_user_a_b2b_account())
                {
                    $subtitle = "By Rebecca Wholesale";
                }
			
			$snippet = '<div class="brws_myacc_page_title_wrapper"><div class="brws_mycc_page_title_box"><h4>'.$subtitle.'</h4><h2>'.$title.'</h2></div></div>';

            return $snippet;
        }

	echo pn_acc_make_page_title('Checkout');

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
	
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
