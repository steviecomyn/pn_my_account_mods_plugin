<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

?>

<?php

// Capture page url for active-link.
$page_url = $_SERVER['REQUEST_URI'];

// Capture the page before this one.
$previous_url = htmlspecialchars($_SERVER['HTTP_REFERER']);

// If the page *ISN'T* my-account, show the back button
if (strcmp($page_url, '/my-account/') !== 0)
    {
        echo '<h4 style=\"margin-bottom: 1.5em;\"><a style="color: #555;" href="'.$previous_url.'"><i class="fas fa-long-arrow-alt-left"></i> Back</a></h4>'; 
    }


?>

<?php


defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_navigation' ); ?>

<div class="woocommerce-MyAccount-content">
	<?php
		/**
		 * My Account content.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_content' );
	?>
</div>