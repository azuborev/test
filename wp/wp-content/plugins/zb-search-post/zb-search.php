<?php
/*
* Plugin Name: Zb-Search
* Description: Plugin adds widget for posts search
*/

require_once __DIR__ . '/class-zb-search-widget.php';

add_action('widgets_init', 'zb_search_widget');
function zb_search_widget() {
    register_widget('Zb_Search_Widget');
}

add_action( 'wp_enqueue_scripts', 'load_scripts' );
function load_scripts() {
    if ( ! wp_script_is( 'jquery', 'enqueued' )) {
        wp_deregister_script( 'jquery' );
        wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', [],false,true );
    }
    wp_register_script('search_ajax.js', plugins_url('.search_ajax.js', __FILE__), ['jquery'], false, true );
    wp_localize_script('xz-favorites-scripts', 'xzFavorites', ['url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('xz-favorites'), 'postId'=>$post->ID] );
}

https://www.youtube.com/watch?v=DNCPX5uuUBk