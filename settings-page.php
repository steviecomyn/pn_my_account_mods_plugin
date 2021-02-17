<?php

add_action( 'admin_menu', 'pn_acc_settings_page' );

function pn_acc_settings_page() {

	add_options_page(
		'PageNorth - My Account Customisations', // page <title>Title</title>
		'My Account Mods', // menu link text
		'manage_options', // capability to access the page
		'pn-my-acc-settings', // page URL slug
		'pn_acc_settings_init', // callback function with content
		2 // priority
	);

}

function pn_acc_settings_init(){

	echo 'Hello There';

}