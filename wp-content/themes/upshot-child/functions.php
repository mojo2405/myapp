<?php

add_action( 'wp_enqueue_scripts', 'upshot_parent_theme_styles' );
function upshot_parent_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}