<?php
// Might be useful https://wpdevdesign.com/shortcode-for-displaying-oxygen-templates-and-reusable-parts/

/**
 * @snippet       WooCommerce Add New Tab @ My Account
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.7
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

// ------------------
// 1. Register new endpoint to use for My Account page
// Note: Resave Permalinks or it will give 404 error

function pn_acc_add_feature_tour_endpoint() {
    add_rewrite_endpoint( 'feature_tour', EP_ROOT | EP_PAGES );
}

add_action( 'init', 'pn_acc_add_feature_tour_endpoint' );


// ------------------
// 2. Add new query var

function pn_acc_feature_tour_query_vars( $vars ) {
    $vars[] = 'feature_tour';
    return $vars;
}

add_filter( 'query_vars', 'pn_acc_feature_tour_query_vars', 0 );

// ------------------
// 3. Insert the new endpoint into the My Account menu

function pn_acc_add_feature_tour_link_my_account( $items ) {
    $items['feature_tour'] = 'Feature Tour';
    return $items;
}

add_filter( 'woocommerce_account_menu_items', 'pn_acc_add_feature_tour_link_my_account' );


// ------------------
// 4. Add content to the new endpoint

function pn_acc_feature_tour_content() {
echo do_shortcode( '[oxygen-template id="544"]' );
}

add_action( 'woocommerce_account_feature_tour_endpoint', 'pn_acc_feature_tour_content' );
// Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format