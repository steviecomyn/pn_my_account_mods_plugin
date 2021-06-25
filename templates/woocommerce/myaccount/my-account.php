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

// Brings in the plugin's constants file.
include(ABSPATH.'wp-content/plugins/pn_my_account_mods_plugin/assets/config.php');

if (empty($_GET['pn']))
	{
		$page_name = "Current Page";
	}
else
	{
		$page_name = $_GET['pn'];
	}

function check_if_we_need_a_back_button($page_url, $page_name)
	{
		// Check if we're on the My Account page, if not, add a back button.
		if ($page_url == WHOLESALE_DASHBOARD_SLUG or $page_url == MY_ACCOUNT_SLUG)
			{
				// Do nothing.
			}
		else
			{
				return create_back_button($page_url, $page_name);
			}
	}

// Create the back button for child pages of My Account.
function create_back_button($page_url, $page_name)
	{
		// If we've come from the wholesale dash, go back to that.
		if (strpos($page_url, WHOLESALE_DASHBOARD_SLUG) !== false)
			{
				$wholesale_home = get_site_url(null, '/wholesale/', 'https');
		
				//echo '<h4 class="brws_back_btn"><a style="color: #555;" href="'.$wholesale_home.'"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a></h4>';

				echo '<br><h5><a style="color: #555;" href="'.$wholesale_home.'"><i class="fa fa-home" aria-hidden="true"></i> Wholesale Dashboard</a> / '.$page_name.'</h5>';
			}
		
		// If we've come from my account, go back there.
		if (strpos($page_url, MY_ACCOUNT_SLUG) !== false)
			{
				$wholesale_home = get_site_url(null, '/account/', 'https');
		
				//echo '<h4 class="brws_back_btn"><a style="color: #555;" href="'.$wholesale_home.'"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a></h4>';

				echo '<br><h5><a style="color: #555;" href="'.$wholesale_home.'"><i class="fa fa-home" aria-hidden="true"></i> Account Dashboard</a> / '.$page_name.'</h5>';
			}
	}

	// function tidy_page_name($page_url)
	// 	{
	// 		if (strpos($page_url, "?")
	// 			{

	// 			}
	// 	}

// Capture page url for active-link.
$page_url = $_SERVER['REQUEST_URI'];

// If the page *ISN'T* my-account, show the back button
check_if_we_need_a_back_button($page_url, $page_name);


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



if (strcmp($page_url, WHOLESALE_DASHBOARD_SLUG.'?bulkorder&pn=Bulk%20Order%20Form') == 0 OR strcmp($page_url, MY_ACCOUNT_SLUG.'bulkorder/?pn=Bulk%20Order%20Form') == 0 OR strcmp($page_url, WHOLESALE_DASHBOARD_SLUG.'bulkorder/?pn=Bulk%20Order%20Form') == 0 OR strcmp($page_url, MY_ACCOUNT_SLUG.'?bulkorder&pn=Bulk%20Order%20Form') == 0)
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
		background-color: #fff !important;
		border: 1px solid #222;
		color: #222 !important;
		box-shadow: none !important;
		border-radius: 0 !important;
		font-size: 16px !important;
		padding: 16px 32px !important;
		font-family: 'Quattrocento', serif !important;
		text-transform: uppercase;
	}

	.b2bking_bulkorder_form_container_newline_button svg path {
		fill: #222 !important;
	}

	.b2bking_bulkorder_form_container_newline_container button:hover {
		background-color: #aaa !important;
		color: #fff !important;
	}

	.b2bking_bulkorder_form_container_newline_container button:hover svg path {
		fill: #fff !important;
	}

	button.b2bking_bulkorder_form_container_bottom_add_button {
		border-radius: 0 !important;
		background-color: #222 !important;
		font-family: 'Quattrocento', serif !important;
	}

	button.b2bking_bulkorder_form_container_bottom_add_button:hover {
		background-color: #353535 !important;
	}

	button.b2bking_bulkorder_form_container_bottom_save_button {
		border-radius: 0 !important;
		box-shadow: none !important;
		font-family: 'Quattrocento', serif !important;
		background: #222 !important;
		color: #fff !important;
	}

	button.b2bking_bulkorder_form_container_bottom_save_button:hover {
		background: #353535;
	}

	button.b2bking_bulkorder_form_container_bottom_save_button svg path {
		fill: #fff !important;
	}

	.b2bking_bulkorder_form_container_bottom_total, .b2bking_bulkorder_form_container_bottom_total strong span bdi {
		font-size: 24px !important;
		font-family: 'Quattrocento', serif !important;
	}

	.b2bking_bulkorder_clear {
		margin-top: 16px !important;
	}

	.b2bking_bulkorder_form_container_content_line_product {
		color: #222 !important;
	}

</style>
<?php
	}

if (strcmp($page_url, WHOLESALE_DASHBOARD_SLUG.'?purchase-lists&pn=Purchase%20Lists') == 0 OR strcmp($page_url, MY_ACCOUNT_SLUG.'purchase-lists/?pn=Purchase%20Lists') == 0 OR strcmp($page_url, WHOLESALE_DASHBOARD_SLUG.'purchase-lists/?pn=Purchase%20Lists') == 0 OR strcmp($page_url, MY_ACCOUNT_SLUG.'?purchase-lists&pn=Purchase%20Lists') == 0)
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
		background-color: #222 !important;
		border-radius: 0 !important;
		text-transform: uppercase !important;
		font-family: 'Quattrocento', serif !important;
		-webkit-transition: all .2s ease-in-out;
		transition: all .2s ease-in-out;
	}

	#b2bking_purchase_list_new_button:hover {
		background-color: #353535;
	}

	button.b2bking_purchase_lists_view_list {
		background: #222 !important;
		padding: 6px 32px !important;
		border-radius: 0 !important;
		text-transform: uppercase !important;
		font-family: 'Quattrocento', serif !important;
		-webkit-transition: all .2s ease-in-out;
		transition: all .2s ease-in-out;
	}

	button.b2bking_purchase_lists_view_list:hover {
		background: #353535 !important;
	}
</style>
<?php
	}

if (strcmp($page_url, WHOLESALE_DASHBOARD_SLUG.'edit-account/?pn=Account%20Details') == 0 OR strcmp($page_url, MY_ACCOUNT_SLUG.'?edit-account&pn=Account%20Details') == 0 OR strcmp($page_url, WHOLESALE_DASHBOARD_SLUG.'?edit-account&pn=Account%20Details') == 0 OR strcmp($page_url, MY_ACCOUNT_SLUG.'edit-account/?pn=Account%20Details') == 0)
	{
?>
<style>
	form.woocommerce-EditAccountForm.edit-account, .u-columns.woocommerce-Addresses.col2-set.addresses {
		padding: 1em !important;
	}

	div.addresses {
		padding-bottom: 2em;
	}

	.woocommerce-MyAccount-content > .button {
		background-color: #000 !important;
		color: #fff !important;
	}
</style>

<?php
	}

	if (strcmp($page_url, WHOLESALE_DASHBOARD_SLUG.'wishlist/?pn=Wholesale%20Starter%20Packs') == 0)
	{
?>
<script>
	// Hides the slider on the wholesale starter packs page, as it's already featured in the page futher up.
jQuery(document).ready(function($)
	{
		$("#section-34-15331").remove();
	});
</script>
<style>
	/* .b2bking_myaccount_individual_offer_container {
		background: #fff;
		border-radius: 0;
        box-shadow: none;
	}

	.b2bking_myaccount_individual_offer_top {
		background: #fff;
		color: #222;
		border-radius: 0;
		font-family: 'Quattrocento', serif !important;
	}

	.b2bking_myaccount_individual_offer_header_line {
		border-bottom: 0;
	}

	.b2bking_myaccount_individual_offer_bottom_line_button {
		background-color: #222 !important;
		border-radius: 0 !important;
		text-transform: uppercase !important;
		font-family: 'Quattrocento', serif !important;
		-webkit-transition: all .2s ease-in-out;
		transition: all .2s ease-in-out;
	}

	.b2bking_myaccount_individual_offer_bottom_line_button:hover {
		background-color: #353535;
	} */
</style>
<?php

}

?>