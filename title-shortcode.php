<?php

add_shortcode( 'brws_title', 'brws_title_render' );
// Creates the shortcode to generate a universal title for all wholesale pages.
function brws_title_render( $atts, $content = null, $tag = '' )
    {
        $a = shortcode_atts( array(
            'subtitle' => 'By Rebecca'
            ), $atts );
        
        $output = '<div class="brws_myacc_page_title_wrapper"><div class="brws_mycc_page_title_box"><h4>'.esc_attr( $a['subtitle'] ).'</h4><h2>'.$content.'</h2></div></div>';
        
        return $output;
    }