<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css' );

// END ENQUEUE PARENT ACTION
// Eating Richly Disable owl carousel plugin

function eating_richly_remove_parent_theme_junk() {
    wp_dequeue_script( 'owl-carousel' );
    wp_dequeue_style( 'owl-carousel' );
}
add_action( 'wp_print_scripts', 'eating_richly_remove_parent_theme_junk', 100 );
