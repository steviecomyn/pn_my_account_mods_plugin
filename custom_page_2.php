<?php

/**
 * @snippet       WooCommerce Add New Tab @ My Account
 * @compatible    WooCommerce 3.5.7
 * @url           https://www.businessbloomer.com/woocommerce-add-new-tab-account-page/
 */

// Check if the custom page is active before creating it.
if (get_option('pn_acc_custom_page_2_toggle') === 'active')
    {
        // Register new endpoint.
        add_action( 'init', 'pn_acc_add_faq_endpoint' );
        add_filter( 'query_vars', 'pn_acc_faq_query_vars', 0 );
        add_filter( 'woocommerce_account_menu_items', 'pn_acc_add_faq_link_my_account' );
        add_action( 'woocommerce_account_faq_endpoint', 'pn_acc_faq_content' );
        // Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format
    }
else
    {
        return;
    }


// ------------------
// 1. Register new endpoint to use for My Account page
// Note: Resave Permalinks or it will give 404 error
function pn_acc_add_faq_endpoint()
    {
        add_rewrite_endpoint( 'faq', EP_ROOT | EP_PAGES );
    }

// ------------------
// 2. Add new query var
function pn_acc_faq_query_vars( $vars )
    {
        $vars[] = 'faq';
        return $vars;
    }

// ------------------
// 3. Insert the new endpoint into the My Account menu
function pn_acc_add_faq_link_my_account( $items )
    {
        $items['faq'] = 'FAQs';
        return $items;
    }


// ------------------
// 4. Add content to the new endpoint
function pn_acc_faq_content()
    {
        // Use the given id to create the page shortcode.
        $shortcode = '[oxygen-template id="'.get_option('pn_acc_custom_page_2_post_id').'"]';

        echo do_shortcode( $shortcode );
    }