<?php
/*
Plugin Name:	0_PageNorth - My Account Customisation
Plugin URI:		https://www.pagenorth.co.uk
Description:	Adds customisations to the My Account pages.
Version:		0.2
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

	// Loads FontAwesome 5.1 from a CDN.
	wp_register_style( 'font-awesome', FONTAWESOME_CDN );
    wp_enqueue_style( 'font-awesome' );

	// loads a My Accounts CSS file in the head.
	wp_register_style( 'myaccount-css', plugin_dir_url( __FILE__ ) . 'assets/css/br-styles.css' );
	wp_enqueue_style( 'myaccount-css' );

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
	}

	return $template;
}