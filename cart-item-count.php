<?php

add_shortcode ('pn_woo_cart_count', 'pn_woo_cart_count' );
/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
function pn_woo_cart_count() {
	ob_start();
 
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL
  
        ?>
        <a class="cart-contents" href="<?php echo $cart_url; ?>" title="My Basket">
	    <?php
        if ( $cart_count > 0 ) {
       ?>
            <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php
        }
        ?>
        </a>
        <?php
	        
    return ob_get_clean();
 
}

add_filter( 'woocommerce_add_to_cart_fragments', 'pn_woo_cart_but_count' );
/**
 * Add AJAX Shortcode when cart contents update
 */
function pn_woo_cart_but_count( $fragments ) {
 
    ob_start();
    
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();
    
    ?>
    <a class="cart-contents" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">
	<?php
    if ( $cart_count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php            
    }
        ?></a>
    <?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
    
    return $fragments;
}

// add_action('wp_head', 'pn_cart_count_styles', 100);

// function pn_cart_count_styles()
// {
//  echo "<style>
 
//  .cart-contents {
//     position: relative;
//     display: flex !important;
//     flex-flow: column nowrap;
//     justify-content: center;
// }

// .cart-contents:hover {
//     text-decoration: none;
// }

// .cart-contents-count {
// 	position: absolute;
//     top: 1px;
//    	right: 1px;
//    	transform: translateY(-105%) translateX(55%);
// 	font-family: Arial, Helvetica, sans-serif;
// 	font-weight: normal;
// 	font-size: 10px;
// 	line-height: 14px;
// 	height: 14px;
//    	width: 14px;
// 	vertical-align: middle;
// 	text-align: center;
// 	color: #fff;
//     	background: #000;
//     	border-radius: 50%;
//     	padding: 1px;  
// }</style>";
// }

?>