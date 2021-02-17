<?php

add_action( 'admin_menu', 'pn_acc_settings_page' );
// Initiate the settings page.
function pn_acc_settings_page()
	{
		// Creates the settings page.
		add_options_page(
			'PageNorth - My Account Customisations', // page <title>Title</title>
			'PN - My Account', // menu link text
			'manage_options', // capability to access the page
			'pn-my-acc-settings-page', // page URL slug
			'pn_acc_settings_init', // callback function with content
			2 // priority
		);

	}

function pn_acc_settings_init()
	{
		// This sets up the settings form.
		echo '<div class="wrap">
		<h1>PageNorth - My Account Customisations</h1>
		<form method="post" action="options.php">';

			settings_fields( 'pn_acc_settings' ); // settings group name
			do_settings_sections( 'pn-my-acc-settings-page' ); // just a page slug
			submit_button();

		echo '</form></div>';

	}


add_action( 'admin_init',  'pn_acc_register_setting' );
// Here we initiate the setting fields.
function pn_acc_register_setting(){
	
	register_setting(
		'pn_acc_settings', // settings group name
		'homepage_text', // option name
		'sanitize_text_field' // sanitization function
	);
	
	add_settings_section(
		'pn_acc_extra_pages_settings', // section ID
		'', // title (if needed)
		'', // callback function (if needed)
		'pn-my-acc-settings-page' // page slug
	);
	
	add_settings_field(
		'homepage_text',
		'Homepage text',
		'pn_acc_text_field_html', // function which prints the field
		'pn-my-acc-settings-page', // page slug
		'pn_acc_extra_pages_settings', // section ID
		array( 
			'label_for' => 'homepage_text',
			'class' => 'pn-acc-class', // for <tr> element
		)
	);
	
}
	
function pn_acc_text_field_html(){
	
	$text = get_option( 'homepage_text' );
	
	printf(
		'<input type="text" id="homepage_text" name="homepage_text" value="%s" />',
		esc_attr( $text )
	);
	
}