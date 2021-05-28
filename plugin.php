<?php
/*
Plugin Name:	0_PageNorth - My Account Customisation
Plugin URI:		https://www.pagenorth.co.uk
Description:	Adds customisations to the My Account pages.
Version:		0.3.3
Author:			PageNorth ltd
Author URI:		https://www.pagenorth.co.uk
License:		GPL-2.0+
License URI:	http://www.gnu.org/licenses/gpl-2.0.txt

This plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with This plugin. If not, see {URI to Plugin License}.
*/

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

//============================================================================================================ INCLUDES //

// This code adds in the settings(constants).
include('assets/config.php');
// This brings in the settings page code.
include('settings-page.php');
// This code adds the ability to use shortcodes to place Oxygen Reusable Template parts in pages.
include('oxygen-shortcode.php');
// This code adds the ability to use shortcodes render the page titles.
include('title-shortcode.php');
// This code adds the ability to add new pages to My Account, using the above shortcodes.
include('custom_page_1.php');
// This code adds the ability to add new pages to My Account, using the above shortcodes.
include('custom_page_2.php');
// This code adds the ability to add new pages to My Account, using the above shortcodes.
include('custom_page_3.php');
// This code adds the ability to add new pages to My Account, using the above shortcodes.
include('custom_page_4.php');

//============================================================================================================ WP_HOOKS //

add_action( 'wp_enqueue_scripts', 'pm_myacc_enqueue_files' );
/**
 *  This loads the required CSS to style the My Account Modifications.
 */
function pm_myacc_enqueue_files() {

	// Loads FontAwesome 4.7 from a CDN.
	wp_register_style( 'font-awesome', FONTAWESOME_CDN );
    wp_enqueue_style( 'font-awesome' );

	// loads a My Accounts CSS file in the head.
	wp_register_style( 'myaccount-css', plugin_dir_url( __FILE__ ) . 'assets/css/style.css' );
	wp_enqueue_style( 'myaccount-css' );

	// Loads in the css for the brws tweaks.
	wp_register_style( 'brws-css', plugin_dir_url( __FILE__ ) . 'assets/css/brws-base-styles.css' );
	wp_enqueue_style( 'brws-css' );

}

add_filter( 'woocommerce_locate_template', 'pn_acc_intercept_wc_template', 10, 3 );
/**
 * Filter the given template path to use local templates found in this plugin instead of the ones in WooCommerce.
 *
 * @param string $template      Default template file path.
 * @param string $template_name Template file slug.
 * @param string $template_path Template file name.
 *
 * @return string The new Template file path.
 */
function pn_acc_intercept_wc_template( $template, $template_name, $template_path ) {

	// Here we define the pages to replace with local (to this plugin) versions.
	if ( 'dashboard.php' === basename( $template ) ) {
		$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/woocommerce/myaccount/dashboard.php';
	} elseif ( 'form-edit-account.php' === basename( $template ) ) {
		$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/woocommerce/myaccount/form-edit-account.php';
	} elseif ( 'orders.php' === basename( $template ) ) {
		$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/woocommerce/myaccount/orders.php';
	} elseif ( 'my-account.php' === basename( $template ) ) {
		$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/woocommerce/myaccount/my-account.php';
	} elseif ( 'cart.php' === basename( $template ) ) {
		$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/woocommerce/cart/cart.php';
	} elseif ( 'proceed-to-checkout-button.php' === basename( $template ) ) {
		$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/woocommerce/cart/proceed-to-checkout-button.php';
	} elseif ( 'cart-totals.php' === basename( $template ) ) {
		$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/woocommerce/cart/cart-totals.php';
	}

	return $template;
}
// This picks up logged in users and redirects them to the "My Account" page when visiting the wholesale page.
// function add_b2c_login_check()
// {

// 	if ( is_user_logged_in() && is_page(WHOLESALE_PAGE_ID) ) {
		
// 		wp_redirect('https://byrebecca.pagenorth.dev/account/');
//         exit;
//     }
// }

// add_action('wp', 'add_b2c_login_check');

// This adds support for custom thumbnail sizes, required for the cart page.
add_theme_support( 'post-thumbnails' );

add_image_size( 'brws-cart-thumb', 180, 180 );

// Adds a disclaimer at checkout, if you spend over £500 you get free shipping.

/**
 * @snippet       $$$ remaining to Free Shipping @ WooCommerce Cart
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.9
 */
 
add_action( 'woocommerce_before_cart', 'bbloomer_free_shipping_cart_notice' );
  
function bbloomer_free_shipping_cart_notice() {
  
   $min_amount = 500; //change this to your free shipping threshold

   $user_is_b2b = get_user_meta(get_current_user_id(),'b2bking_b2buser', true);
   
   $current = WC()->cart->subtotal;

   // If this is a wholesale order.
    if ( $user_is_b2b[0] === 'y' )
    {
		// Remind them of the £500 order free shipping.
		if ( $current < $min_amount ) {
			$added_text = 'Get free shipping if you order ' . wc_price( $min_amount - $current ) . ' more!';
			$return_to = wc_get_page_permalink( 'shop' );
			$notice = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( $return_to ), 'Continue Shopping', $added_text );
			wc_print_notice( $notice, 'notice' );
		}

	}
  
}


// // Hide coupon codes from Wholesalers.
// function woo_get_user_role() {
// 	global $current_user;
// 	$user_roles = $current_user->roles;
// 	$user_role = array_shift($user_roles);
// 	return $user_role;
//   }
  
  // hide coupon field on cart page for wholesale
  function hide_coupon_field_on_cart( $enabled ) {

	$user_is_b2b = get_user_meta(get_current_user_id(),'b2bking_b2buser', true);

	if ( $user_is_b2b[0] === 'y' ) {
	  $enabled = false;
	}
	return $enabled;
  }
  add_filter( 'woocommerce_coupons_enabled', 'hide_coupon_field_on_cart' );