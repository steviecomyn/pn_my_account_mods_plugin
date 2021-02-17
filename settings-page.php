<?php

/*
 * @url	https://rudrastyh.com/wordpress/creating-options-pages.html
 */

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
		<div style="display: flex; align-content: center;">
		<img src="'.plugin_dir_url( __FILE__ ).'assets/images/pn-delta.svg" width="28" height="28" style="margin-right: 10px;">
		<h1 style="display: inline-block; padding: 0;">PageNorth - My Account Customisations</h1>
		</div>
		<form method="post" action="options.php">';

			settings_fields( 'pn_acc_settings' ); // settings group name
			do_settings_sections( 'pn-my-acc-settings-page' ); // just a page slug
			submit_button();

		echo '</form></div>';

	}


add_action( 'admin_init',  'pn_acc_register_setting' );
// Here we initiate the setting fields.
function pn_acc_register_setting()
	{
		
		register_setting(
			'pn_acc_settings', // settings group name
			'pn_acc_custom_page_1_toggle' // option name
		);
		
		register_setting(
			'pn_acc_settings', // settings group name
			'pn_acc_custom_page_1_post_id', // option name
			'absint' // sanitization function
		);

		add_settings_section(
			'pn_acc_extra_pages_settings', // section ID
			'Custom Pages', // title (if needed)
			'', // callback function (if needed)
			'pn-my-acc-settings-page' // page slug
		);

		add_settings_field(
			'pn_acc_custom_page_1_toggle', // UID
			'Custom Page 1 toggle', // Label
			'pn_acc_custom_page_1_toggle_render', // function which prints the field
			'pn-my-acc-settings-page', // page slug
			'pn_acc_extra_pages_settings', // section ID
			array( 
				'label_for' => 'pn_acc_custom_page_1_toggle',
				'class' => 'pn-acc-class', // for <tr> element
			)
		);

		add_settings_field(
			'pn_acc_custom_page_1_post_id', // UID
			'Custom Page 1 - Oxygen Reusable Part ID', // Label
			'pn_acc_custom_page_1_post_id_render', // function which prints the field
			'pn-my-acc-settings-page', // page slug
			'pn_acc_extra_pages_settings', // section ID
			array( 
				'label_for' => 'pn_acc_custom_page_1_post_id',
				'class' => 'pn-acc-class', // for <tr> element
			)
		);	
	}

// This renders the toggle switch to activate/deactive the first custom page.
function pn_acc_custom_page_1_toggle_render()
	{

		$option = get_option( 'pn_acc_custom_page_1_toggle', 'inactive');

		$active_checked = '';
        $inactive_checked = '';

        if($option === 'active')
            {
                $active_checked = 'checked';
				// Required to register new page being added.
				flush_rewrite_rules();

            }
        else
            {
                $inactive_checked = 'checked';
            }
		
	?>
			<input type="radio" id="pn_acc_custom_page_1_toggle" name="pn_acc_custom_page_1_toggle" value="active" <?php echo $active_checked; ?>>
			<label for="widget-on">Enabled</label><br>
			<input type="radio" id="pn_acc_custom_page_1_toggle" name="pn_acc_custom_page_1_toggle" value="inactive" <?php echo $inactive_checked; ?>>
			<label for="widget-off">Disabled</label><br>
			<p class="description">This Enables/Disables the first Custom Page.</p>
	<?php
		
	}

// This renders the text field to enter the oxy post id for the first custom page.
function pn_acc_custom_page_1_post_id_render()
	{
		// Get the post id from the settings in the DB.
		$post_id = get_option( 'pn_acc_custom_page_1_post_id', '0' );
		$disabled = '';

		if (get_option('pn_acc_custom_page_1_toggle') === 'inactive')
			{
				$disabled = 'disabled';
			}
		
		printf(
			'<input type="number" id="pn_acc_custom_page_1_post_id" name="pn_acc_custom_page_1_post_id" value="%s" '.$disabled.'/>',
			esc_attr( $post_id )
		);

		// Show a link to edit the given page.
		$url = 'https://ravencampervanconversions.co.uk/wp-admin/post.php?post='.$post_id.'&action=edit';
		printf('This is the Post ID of the Oxygen Reusable Part, <p class="description"><a href="'.$url.'">Click Here</a> to edit this page.</p>');
		
	}