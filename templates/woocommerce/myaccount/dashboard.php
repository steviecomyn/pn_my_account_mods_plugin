<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

// Brings in the plugin's constants file.
include('../../../assets/config.php');

?>

<?php

//============================================================================================================ PN_ACC_MODS //

    // Creates a uniform page title.
    function pn_acc_make_page_title($title)
        {
            $snippet = '<div class="wholesale-title-wrapper" style="width: 100%; background-color: #f5f5f5; display: grid; place-items: center;">
                        <div class="wholesale-title-box" style="background-color: #fff; padding: 16px; margin: 2em;display: grid; place-items: center;">
                            <h6 style="color: #444; margin: 0; padding-bottom: 10px;">By Rebecca Wholesale</h6>
                            <h2 style="font-weight: 700; margin: 0;">'.$title.'</h2>
                        </div>
                    </div>';

            return $snippet;

        }

    // Creates a personalised welcome message.
    function pn_acc_welcome_message($user_name)
        {
            $html_output = "";
            $welcome_string = "Welcome!"; 
            $numeric_date = date("G");
            
            // If no username is set, show a generic welcome.
            if (empty($user_name))
                {
                    //Display generic welcome. 
                    $html_output = "<div style=\"width: 100%; text-align:center;\"><h2>".$welcome_string."</h2><br>";
                }
            else
                {
                    //Start conditionals based on military time 
                    if ($numeric_date>=0&&$numeric_date<=11)
                    {
                        $welcome_string="Good Morning";
                    }
                    else if($numeric_date>=12&&$numeric_date<=17) 
                    {
                        $welcome_string="Good Afternoon"; 
                    }
                    else if($numeric_date>=18&&$numeric_date<=23) 
                    {
                        $welcome_string="Good Evening";
                    }

                    //Display our greeting 
                    $html_output = "<div style=\"width: 100%; text-align:center; margin-bottom: 70px;\"><h2><b>".$user_name."</b></h2><a href=\"/".MY_ACCOUNT_SLUG."/customer-logout/\" style=\"color: #000;\"><span>Log out</span></a></div>"; 
                }

            return $html_output;
        }

    // Adds the "active" class to link if on current page.
    function pn_acc_link_is_active($page_url, $link_url)
        {
            $class_added = "";

            if (strcmp($page_url, $link_url) == 0)
                {
                    $class_added = 'class="pn_acc_menu_item_active"';
                }

            echo $class_added;
        }

    // Checks if a user is a b2b customer or not
    function is_user_a_b2b_account()
        {      
            $user_is_b2b = get_user_meta(get_current_user_id(),'b2bking_b2buser', true);

            if ( $user_is_b2b[0] === 'y' )
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }

    // Used to create menu items.
    function create_menu_item($title, $url)
        {

            $menu_item_html = '<a href="'.$url.'" '.pn_acc_link_is_active($page_url, '/'.MY_ACCOUNT_SLUG.'/'.$url.'/').'><div class="menu-item"><span>'.$title.'</span></div></a>';

            return $menu_item_html;
        }

    
    // Capture current user for Personalised Welcome.
    global $current_user;
    wp_get_current_user();
    $user_name = $current_user->display_name;

    // Capture page url for active-link.
    $page_url = $_SERVER['REQUEST_URI'];

    // Bring in Plugin code to detect B2BKing.
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');

    $b2b = false;
    // If b2bking is installed, add extra menu items.
    if ( is_plugin_active( 'b2b-plugin/b2bking.php') && is_user_a_b2b_account() )
        {
            $b2b = true;
            echo "B2B is active & User is a B2B Customer";
        }

?>

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>

<?php

//============================================================================================================ PAGE_STARTS //

	echo "<h1 style=\"width: 100%; font-weight: bold; text-align: center; font-size: 3.5em;\">Welcome to your Dashboard</h1>";
    echo pn_acc_welcome_message($user_name);

	if ( is_user_logged_in() ) {

    $menu_items = array (
        array('Orders', '/'.MY_ACCOUNT_SLUG.'/orders/'),
        array('Orders', '/'.MY_ACCOUNT_SLUG.'/orders/')
    );

?>

    <div id="pn_myacc">
        <div class="menu-items-wrapper">

<?php
    
    if (get_option('pn_acc_custom_page_1_toggle') === 'active')
        {
            echo create_menu_item('Take a tour of the Features', $page_url.'feature_tour/');
        }

?>
            <a href="https://demo.pagenorth.cloud/shop/" target="_blank">
                <div class="menu-item">
                    <span>Browse Products</span>
                </div>
            </a>
        
        <?php 

            // If b2bking is installed, add extra menu items.
            if ( is_user_a_b2b_account() )
                {

                    // array('Sub-accounts', '/'.MY_ACCOUNT_SLUG.'/?subaccounts')

                    $b2b_menu_items = array (
                        array('Bulk Order', $page_url.'?bulkorder'),
                        array('Purchase Lists', $page_url.'?purchase-lists')
                    );

                    foreach ($b2b_menu_items as $menu_item)
                        {
                            echo create_menu_item($menu_item[0], $menu_item[1]);
                        }

                } // Closes the B2BKing Check.
            
        ?>

<?php
        if (get_option('pn_acc_custom_page_3_toggle') === 'active')
        {
            echo create_menu_item('Wishlist', $page_url.'wishlist/');
        }

        if (get_option('pn_acc_custom_page_4_toggle') === 'active')
            {
                echo create_menu_item('Personalisation', $page_url.'personalisation/');
            }

?>

            <a href="/account/orders/" <?php pn_acc_link_is_active($page_url, $page_url.'orders/'); ?>>
                <div class="menu-item">
                    <span>Order History</span>
                </div>
            </a>

            <a href="/account/edit-account/" <?php pn_acc_link_is_active($page_url, $page_url.'edit-account/') ?>>
                <div class="menu-item">
                    <span>Account details</span>
                </div>
            </a>

<?php

            if (get_option('pn_acc_custom_page_2_toggle') === 'active')
        {
            echo create_menu_item('FAQs', $page_url.'faq/');
        }
?>

        </div>
    </div>
    <br><br>
<?php

    }
    
?>

<p>
	<?php
	/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
	$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">order history</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
	if ( wc_shipping_enabled() ) {
		/* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
		$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">order history</a>, manage your <a href="%3$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
	}
	printf(
		wp_kses( $dashboard_desc, $allowed_html ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
	?>
</p>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */