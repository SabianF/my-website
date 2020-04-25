<?php
    if ( ! defined( 'ABSPATH' ) ) {
    	exit; // Exit if accessed directly.
    }
    
    add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
    function my_theme_enqueue_styles()
    {
        $parent_style = 'astra-block-editor-styles'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
        wp_enqueue_style
        (
            $parent_style
            ,get_template_directory_uri() . 'inc/assets/css/block-editor-styles/style.css'
        );
        wp_enqueue_style
        (
            'astra-child',
            get_stylesheet_directory_uri() . '/style.css',
            array( $parent_style ),
            wp_get_theme()->get('Version')
        );
    }
?>