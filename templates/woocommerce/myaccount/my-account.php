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

function check_if_we_need_a_back_button($page_url)
	{
		// Check if we're on the My Account page, if not, add a back button.
		if ($page_url == MY_ACCOUNT_SLUG or $page_url == WHOLESALE_DASHBOARD_SLUG)
			{
				// Do nothing.
			}
		else
			{
				return create_back_button();
			}
	}

// Create the back button for child pages of My Account.
function create_back_button()
	{
		// Capture the page before this one.
		$previous_url = htmlspecialchars($_SERVER['HTTP_REFERER']);
		
		echo '<h4 style=\"\"><a style="color: #555;" href="'.$previous_url.'"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a></h4>';
	}

// Capture page url for active-link.
$page_url = $_SERVER['REQUEST_URI'];

// If the page *ISN'T* my-account, show the back button
check_if_we_need_a_back_button($page_url);


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

if (strcmp($page_url, WHOLESALE_DASHBOARD_SLUG.'?bulkorder') == 0)
	{
?>

<script>
jQuery(document).ready(function($)
	{
		$('#b2bking_myaccount_bulkorder_container').prepend('<div class="brws_myacc_page_title_wrapper"><div class="brws_mycc_page_title_box"><h4>By Rebecca Wholesale</h4><h2>Bulk Order Form</h2></div></div>');

		$('#b2bking_myaccount_bulkorder_title').empty();
	});
</script>

<style>
	.b2bking_bulkorder_form_container, .b2bking_myaccount_bulkorder_container {
		background-color: #fff;
		border: 0;
		box-shadow: none;
		font-family: 'Quattrocento', serif !important;
	}

	.b2bking_bulkorder_form_container_top {
		background-color: #fff;
		color: #222;
		display: none;
	}

	.b2bking_bulkorder_form_container_content {
		border: 0;
		box-shadow: none;
	}

	.b2bking_bulkorder_form_container_content_header_product {
		color: #222;
		font-family: 'Quattrocento', serif !important;
	}

	.b2bking_bulkorder_form_container_content_line {
		border-bottom: 1px solid #ccc;
		padding-top: 16px !important;
	}

	.b2bking_bulkorder_form_container_content_line input {
		background-color: #f5f5f5 !important;
		border-radius: 0 !important;
	}

	select#b2bking_bulkorder_searchby_select {
		background-color: #fff !important;
		color: #222;
		border-radius: 0;
		box-shadow: none;
		font-family: 'Quattrocento', serif !important;
	}

	.b2bking_bulkorder_form_container_newline_container {
		margin-top: 16px !important;
	}

	.b2bking_bulkorder_form_container_newline_container button {
		background-color: #939393 !important;
		border: 1px solid #222;
		color: #fff !important;
		box-shadow: none !important;
		border-radius: 0 !important;
		font-size: 16px !important;
		padding: 16px 32px !important;
		font-family: 'Quattrocento', serif !important;
	}

	.b2bking_bulkorder_form_container_newline_container button:hover {
		background-color: #666 !important;
	}

	button.b2bking_bulkorder_form_container_bottom_add_button {
		border-radius: 0 !important;
		background-color: #000 !important;
		font-family: 'Quattrocento', serif !important;
	}

	button.b2bking_bulkorder_form_container_bottom_add_button:hover {
		background-color: #333 !important;
	}

	button.b2bking_bulkorder_form_container_bottom_save_button {
		border-radius: 0 !important;
		box-shadow: none !important;
		font-family: 'Quattrocento', serif !important;
	}

	.b2bking_bulkorder_form_container_bottom_total, .b2bking_bulkorder_form_container_bottom_total strong span bdi {
		font-size: 24px !important;
		font-family: 'Quattrocento', serif !important;
	}

	.b2bking_bulkorder_clear {
		margin-top: 16px !important;
	}

</style>
<?php
	}

if (strcmp($page_url, WHOLESALE_DASHBOARD_SLUG.'?purchase-lists') == 0)
	{
?>
<script>
jQuery(document).ready(function($)
	{
		$('.woocommerce-MyAccount-content').prepend('<div class="brws_myacc_page_title_wrapper"><div class="brws_mycc_page_title_box"><h4>By Rebecca Wholesale</h4><h2>Purchase Lists</h2></div></div>');

		$('.b2bking_purchase_lists_top_title').empty();
	});
</script>

<style>
#b2bking_purchase_list_new_button {
	background-color: #000 !important;
	border-radius: 0 !important;
}

#b2bking_purchase_list_new_button:hover {
	background-color: #333;
}
</style>
<?php
	}
?>