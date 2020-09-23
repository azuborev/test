<?php
/*
* Plugin Name: Zb-Search
* Description: Plugin adds widget for posts search
*/

require_once __DIR__ . '/widgets/class-zb-search-widget.php';

add_action( 'wp_enqueue_scripts', 'load_scripts' );
function load_scripts() {
    if ( ! wp_script_is( 'jquery', 'enqueued' )) {
        wp_deregister_script( 'jquery' );
        wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', [],false,true );
    }
    wp_register_script('zb-search-ajax', plugins_url('js/zb_search_ajax.js', __FILE__), ['jquery'], false, true );
    wp_localize_script('zb-search-ajax', 'zb_ajax', ['url' => admin_url('admin-ajax.php')] );
}
if ( wp_doing_ajax() ){
    add_action( 'wp_ajax_nopriv_zb-get-post', 'zb_get_post' );
    add_action( 'wp_ajax_zb-get-post', 'zb_get_post' );

    function zb_get_post(){
        $title = trim( $_POST['title'] );
        $date = $_POST['date'];
        $posts_per_page = $_POST['number'];

        //validation
        $args = [
            'posts_per_page'    => $posts_per_page,
            's'                 => $title,

            'date_query'        => [
                    [
                        'after' => $date,
                    ],
            ],
        ];
        $query = new WP_Query($args);
        wp_send_json_success($query->posts);
        wp_die();
    }
}

