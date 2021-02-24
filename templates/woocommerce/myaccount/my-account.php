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

// Brings in the plugin's constants file.
include('../../../assets/config.php');

// Capture page url for active-link.
$page_url = $_SERVER['REQUEST_URI'];

// Capture the page before this one.
$previous_url = htmlspecialchars($_SERVER['HTTP_REFERER']);

// If the page *ISN'T* my-account, show the back button
if (strcmp($page_url, '/'.MY_ACCOUNT_SLUG.'/') !== 0)
    {
        echo '<h4 style=\"\"><a style="color: #555;" href="'.$previous_url.'"><i class="fas fa-long-arrow-alt-left"></i> Back</a></h4><br>';

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
<?php

if (strcmp($page_url, '/'.MY_ACCOUNT_SLUG.'/?bulkorder') == 0)
	{
?>
<script>
var bulk_order_form_wrapper =  document.getElementById("b2bking_myaccount_bulkorder_container");
var snippet = '<div class="wholesale-title-wrapper" style="width: 100%; background-color: #f5f5f5; display: grid; place-items: center; margin: 32px 0;"><div class="wholesale-title-box" style="background-color: #fff; padding: 16px; margin: 2em;display: grid; place-items: center;"><h6 style="color: #444; margin: 0; padding-bottom: 10px;">By Rebecca Wholesale</h6><h1 style="font-weight: 700; margin: 0;">Bulk Order Form</h1></div></div>';

// Create new div and populate with html.
var div = document.createElement("div");
div.id = "brwc-box";
bulk_order_form_wrapper.prepend(div);
var box = document.getElementById("brwc-box");
box.innerHTML = snippet;

// Remove old title.
var old_title = document.getElementById("b2bking_myaccount_bulkorder_title");
old_title.remove();
</script>
<?php

	}

	if (strcmp($page_url, '/'.MY_ACCOUNT_SLUG.'/?purchase-lists') == 0)
	{
?>
<script>
var purchase_lists_wrapper =  document.getElementsByClassName("woocommerce-MyAccount-content");

purchase_lists_wrapper.style.background = 'red';

var snippet = '<div class="wholesale-title-wrapper" style="width: 100%; background-color: #f5f5f5; display: grid; place-items: center; margin: 32px 0;"><div class="wholesale-title-box" style="background-color: #fff; padding: 16px; margin: 2em;display: grid; place-items: center;"><h6 style="color: #444; margin: 0; padding-bottom: 10px;">By Rebecca Wholesale</h6><h1 style="font-weight: 700; margin: 0;">Purchase Lists</h1></div></div>';

    
var div = document.createElement("div");
div.innerHTML = snippet;

purchase_lists_wrapper.prepend(div);

var old_title = document.getElementsByClassName("b2bking_purchase_lists_top_title");
old_title.remove();
</script>
<?php

	}

?>