<?php
/**
 * Add a custom shortcode for displaying a Oxygen template/reusable part.
 *
 * Sample usage: [oxygen-template id="478"]
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML output of the specified Oxygen template/reusable part.
 */

add_shortcode( 'oxygen-template', 'func_oxygen_template' );

function func_oxygen_template( $atts ) {

    return do_shortcode( get_post_meta( $atts['id'], 'ct_builder_shortcodes', true ) );

}