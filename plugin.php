<?php
/*
Plugin Name:	0_PageNorth - My Account Customisation
Plugin URI:		https://www.pagenorth.co.uk
Description:	Adds customisations to the My Account pages.
Version:		0.4.1
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
function pm_myacc_enqueue_files()
	{
		// Loads FontAwesome 4.7 from a CDN.
		wp_register_style( 'font-awesome', FONTAWESOME_CDN );
		wp_enqueue_style( 'font-awesome' );

		// loads a My Accounts CSS file in the head.
		wp_register_style( 'myaccount-css', plugin_dir_url( __FILE__ ) . 'assets/css/style2.css' );
		wp_enqueue_style( 'myaccount-css');

		// Loads in the css for the brws tweaks.
		wp_register_style( 'brws-css', plugin_dir_url( __FILE__ ) . 'assets/css/brws-base-styles.css' );
		wp_enqueue_style( 'brws-css' );

		// Loads in the css for b2bking.
		wp_register_style( 'b2bking-css', plugin_dir_url( __FILE__ ) . 'assets/css/b2bking-tweaks.css' );
		wp_enqueue_style( 'b2bking-css' );
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
	} elseif ( 'form-checkout.php' === basename( $template ) ) {
		$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/woocommerce/checkout/form-checkout.php';
	}

	return $template;
}

// Adds a disclaimer at checkout, if you spend over £500 you get free shipping.

/**
 * @snippet       $$$ remaining to Free Shipping @ WooCommerce Cart
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.9
 */
 
add_action( 'woocommerce_before_cart', 'pn_free_shipping_cart_notice' );
  
function pn_free_shipping_cart_notice() {
  
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

// hide coupon field on cart page for wholesale
function hide_coupon_field_on_cart( $enabled ) {

	$user_is_b2b = get_user_meta(get_current_user_id(),'b2bking_b2buser', true);

	if ( $user_is_b2b[0] === 'y' ) {
		$enabled = false;
	}
	return $enabled;
}
add_filter( 'woocommerce_coupons_enabled', 'hide_coupon_field_on_cart' );


  /**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();

	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}

	return ! empty( $free ) ? $free : $rates;
}

add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );


// Hide non-wholesale products from B2B Customers.
function pn_hide_non_wholesale_from_b2b_users( $q ) {

    // Get the current user
    $current_user = wp_get_current_user();

    // Displaying only "Wholesale" category products to "whole seller" user role
    if ( in_array( 'b2bking_role_10078', $current_user->roles ) ) {
        // Set here the ID for Wholesale category 
        $q->set( 'tax_query', array(
            array(
                'taxonomy'	=> 'product_cat',
                'field'		=> 'term_id',
                'terms'		=> 97, // your category ID
				'operator'	=> 'IN'
            )
        ) ); 
    }
}

// Hide non-wholesale products from B2B Customers.
function pn_hide_wholesale_starter_packs_from_b2c_users( $q ) {

    // Get the current user
    $current_user = wp_get_current_user();

    // Displaying only "Wholesale" category products to "whole seller" user role
    if ( !in_array( 'b2bking_role_10078', $current_user->roles ) ) {
        // Set here the ID for Wholesale category 
        $q->set( 'tax_query', array(
            array(
                'taxonomy'	=> 'product_cat',
                'field'		=> 'term_id',
                'terms'		=> 107, // your category ID
				'operator'	=> 'NOT IN'
            )
        ) ); 
    }
}

add_action( 'woocommerce_product_query', 'pn_hide_non_wholesale_from_b2b_users' );
add_action( 'woocommerce_product_query', 'pn_hide_wholesale_starter_packs_from_b2c_users' );


// Used to show a header image on the category pages.
function wc_category_header_image() {
    if ( is_product_category() ){
        $term      = get_queried_object(); // get the WP_Term Object
        $image_id  = get_term_meta( $term->term_id, 'thumbnail_id', true );
        
        if( empty( $image_id ) && $term->parent > 0 ) {
            $image_id  = get_term_meta( $term->parent, 'thumbnail_id', true );
        }
        $image_src = wp_get_attachment_url( $image_id ); // Get the image Url
    
        if ( ! empty($image_src) ) {
          
            echo '<div class="brws-cat-header" style="display: block; width: 100% !important; background: url('.$image_src.'); background-size: cover; background-position: center; height: 400px;"></div>';
        }
    }
}

//Turn off backorders
add_filter( 'woocommerce_product_backorders_allowed', '__return_false' );

// Hide stock status on product pages
add_filter( 'woocommerce_get_stock_html', '__return_empty_string', 10, 2 );