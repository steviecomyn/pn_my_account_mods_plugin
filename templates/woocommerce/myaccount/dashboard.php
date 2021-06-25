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
//include(ABSPATH.'wp-content/plugins/pn_my_account_mods_plugin/assets/config.php');


//============================================================================================================ PN_ACC_MODS //

// Creates a personalised welcome message.
function pn_acc_welcome_message($user_name)
    {
        $welcome_message = "";
        $welcome_string = "Welcome!"; 
        $numeric_date = date("G");
        
        // If no username is set, show a generic welcome.
        if (empty($user_name))
            {
                //Display generic welcome. 
                return $welcome_string;
            }
        else
            {
                //Start conditionals based on military time 
                if ($numeric_date>=0&&$numeric_date<=11)
                {
                    $welcome_string = "Good Morning, ";
                }
                else if($numeric_date>=12&&$numeric_date<=17) 
                {
                    $welcome_string = "Good Afternoon, "; 
                }
                else if($numeric_date>=18&&$numeric_date<=23) 
                {
                    $welcome_string = "Good Evening, ";
                }

                //Display our greeting 
                return $welcome_message = $welcome_string.$user_name;
            }
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


    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly.
    }

    $allowed_html = array(
        'a' => array(
            'href' => array(),
        ),
    );


//============================================================================================================ PAGE_STARTS //
?>

<div id="pn_myacc">
            <h2 class="brws-page-title">
<?php
            if (is_user_a_b2b_account())
                {
                    echo "Wholesale Dashboard";
                }
            else
                {
                    echo "Account Dashboard";
                }
?>      
            </h2>
            <div class="brws-header-bar">
                <div class="brws-username" style="display: flex; align-content: center;">
                    <b>
                    <?php echo pn_acc_welcome_message($user_name); ?>
                    </b>
                </div>
                
                <a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="brws-logout" style="display: flex; align-content: center;">
                    <img src="<?php echo plugin_dir_url( __FILE__ ); ?>../../../assets/images/logout.svg" alt="Log out" style="margin-right: 8px;">
                    <b style="white-space: nowrap;">Log out</b>
                </a>
            </div>

<?php
            // If b2bking is installed, add extra menu items.
            if ( is_user_a_b2b_account() )
                {
?>
            <div class="brws-info-box">
                <img src="<?php echo plugins_url( '../../../assets/images/info.svg' , __FILE__ ); ?>" alt="Information" width="20" height="20">
                <p style="margin: 0;">This is your wholesale dashboard, here you can change your account details, like your <a href="<?php echo wc_get_endpoint_url( 'edit-account' ); ?>">password</a>, your <a href="<?php echo wc_get_endpoint_url( 'edit-account' ); ?>">delivery and billing addresses</a>, and <a href="<?php echo wc_get_endpoint_url( 'edit-account' ); ?>">payment details</a>. You can create bulk orders within the bulk order form page, and view your orders in <a href="<?php echo wc_get_endpoint_url( 'orders' ); ?>">Order History</a>. We also have a Feature Tour and FAQ if you need any help with how to use our wholesale service. Min Spend for Wholesale is <b>£200+VAT</b>, Carriage Paid <b>£500+VAT</b>.</p>
            </div>

<?php
                } // closes the B2B check.
            else
                { // Starts B2C.
?>
            <div class="brws-info-box">
                <img src="<?php echo plugins_url( '../../../assets/images/info.svg' , __FILE__ ); ?>" alt="Information" width="20" height="20">
                <p style="margin: 0;">This is your account dashboard, here you can change your account details, like your <a href="<?php echo wc_get_endpoint_url( 'edit-account' ); ?>">password</a>, your <a href="<?php echo wc_get_endpoint_url( 'edit-account' ); ?>">delivery and billing addresses</a>, and <a href="<?php echo wc_get_endpoint_url( 'edit-account' ); ?>">payment details</a>. You can view your previous orders in <a href="<?php echo wc_get_endpoint_url( 'orders' ); ?>">Order History</a>.</p>
            </div>

<?php
                }
            
            

	if ( is_user_logged_in() ) {

    $menu_items = array (
        array('Orders', '/'.MY_ACCOUNT_SLUG.'/orders/'),
        array('Orders', '/'.MY_ACCOUNT_SLUG.'/orders/')
    );

?>

    <div id="pn_myacc">
        <div class="menu-items-wrapper">

<?php
    
    if (get_option('pn_acc_custom_page_1_toggle') === 'active' AND is_user_a_b2b_account())
        {
            echo create_menu_item('Take a tour of the Features', $page_url.'feature_tour/?pn=Take%20a%20Tour%20of%20the%20Features');
        }


    echo create_menu_item('Browse Products', wc_get_page_permalink( 'shop' ));


        // If b2bking is installed, add extra menu items.
        if ( is_user_a_b2b_account() )
            {

                $b2b_menu_items = array (
                    array('Bulk Order', $page_url.'?bulkorder&pn=Bulk%20Order%20Form'),
                    array('Purchase Lists', $page_url.'?purchase-lists&pn=Purchase%20Lists'),
                    //array('Wholesale Starter Packs', $page_url.'?offers&pn=Wholesale%20Starter%20Packs')
                );

                // Loop through the menu items and create links
                foreach ($b2b_menu_items as $menu_item)
                    {
                        echo create_menu_item($menu_item[0], $menu_item[1]);
                    }

            } // Closes the B2BKing Check.
            
        // If the 3rd custom page is active in the settings, show a nav link for it.
        if (get_option('pn_acc_custom_page_3_toggle') === 'active' AND is_user_a_b2b_account())
        {
            echo create_menu_item('Wholesale Starter Packs', $page_url.'wishlist/?pn=Wholesale%20Starter%20Packs');
        }

        // If the 4th custom page is active in the settings, show a nav link for it.
        if (get_option('pn_acc_custom_page_4_toggle') === 'active' AND is_user_a_b2b_account())
            {
                echo create_menu_item('Personalisation', $page_url.'personalisation/?pn=Personalisation');
            }


        // Create menu items
        echo create_menu_item('Orders', $page_url.'orders/?pn=Orders');
        echo create_menu_item('Account Details', $page_url.'edit-account/?pn=Account%20Details');


    // If the 2nd custom page is active in the settings, show a nav link for it.
    if (get_option('pn_acc_custom_page_2_toggle') === 'active' AND is_user_a_b2b_account())
        {
            echo create_menu_item('FAQs', $page_url.'faq/?pn=Frequently%20Asked%20Questions');
        }
?>

        </div>
    </div>
    <br><br>
<?php

    }
    
?>

</div><!-- Close "#pn_acc"  -->

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