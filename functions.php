<?php
function nathaliemota_enqueue_styles() {
    wp_enqueue_style('nathaliemota-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'nathaliemota_enqueue_styles');

// Menu Principal
function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );

// Menu pied de page
function register_footer_menu() {
    register_nav_menu( 'footer-menu', __( 'Menu du pied de page', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_footer_menu' );


