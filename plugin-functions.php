<?php

// Include the constants page, just in-case.
// include( PN_PLUGIN_PATH.'assets/config.php' );

// require_once( trailingslashit( ABSPATH ) .'wp-load.php' );


// echo "GOT HERE!!!!!!!!!!!!!!!!!!!! FUNCTIONS PAGE";

// This uses the page url to determine if a back button is required.
// function check_if_we_need_a_back_button($page_url)
// 	{
// 		// Check if we're on the My Account page, if not, add a back button.
// 		if ($page_url == WHOLESALE_DASHBOARD_SLUG or $page_url == MY_ACCOUNT_SLUG)
// 			{
// 				// Do nothing.
// 			}
// 		else
// 			{
// 				//create_back_button();
// 			}
// 	}

// // Create the back button for child pages of My Account.
// function create_back_button()
// 	{
// 		// Capture the page before this one.
// 		$previous_url = htmlspecialchars($_SERVER['HTTP_REFERER']);
// 		$wholesale_home = get_site_url(null, '/wholesale/', 'https');
		
// 		echo '<h4 class="brws_back_btn"><a style="color: #555;" href="'.$wholesale_home.'"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a></h4>';

// 		$slug = basename(get_permalink());

// 		echo '<br>';

// 		$pagename = "Test Page";

// 		return '<h5><a style="color: #555;" href="'.$wholesale_home.'"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a> / '.$pagename.'</h5>';

// 	}

// // Creates a personalised welcome message.
// function pn_acc_welcome_message($user_name)
//     {
//         $welcome_message = "";
//         $welcome_string = "Welcome!"; 
//         $numeric_date = date("G");
        
//         // If no username is set, show a generic welcome.
//         if (empty($user_name))
//             {
//                 //Display generic welcome. 
//                 return $welcome_string;
//             }
//         else
//             {
//                 //Start conditionals based on military time 
//                 if ($numeric_date>=0&&$numeric_date<=11)
//                 {
//                     $welcome_string = "Good Morning, ";
//                 }
//                 else if($numeric_date>=12&&$numeric_date<=17) 
//                 {
//                     $welcome_string = "Good Afternoon, "; 
//                 }
//                 else if($numeric_date>=18&&$numeric_date<=23) 
//                 {
//                     $welcome_string = "Good Evening, ";
//                 }

//                 //Display our greeting 
//                 return $welcome_message = $welcome_string.$user_name;
//             }
//     }

// // Adds the "active" class to link if on current page.
// function pn_acc_link_is_active($page_url, $link_url)
//     {
//         $class_added = "";

//         if (strcmp($page_url, $link_url) == 0)
//             {
//                 $class_added = 'class="pn_acc_menu_item_active"';
//             }

//         echo $class_added;
//     }

// // Checks if a user is a b2b customer or not
// function is_user_a_b2b_account()
//     {      
//         $user_is_b2b = get_user_meta(get_current_user_id(),'b2bking_b2buser', true);

//         if ( $user_is_b2b[0] === 'y' )
//             {
//                 return true;
//             }
//         else
//             {
//                 return false;
//             }
//     }

// // Used to create menu items.
// function create_menu_item($title, $url)
//     {

//         $menu_item_html = '<a href="'.$url.'" '.pn_acc_link_is_active($page_url, '/'.MY_ACCOUNT_SLUG.'/'.$url.'/').'><div class="menu-item"><span>'.$title.'</span></div></a>';

//         return $menu_item_html;
//     }
?>