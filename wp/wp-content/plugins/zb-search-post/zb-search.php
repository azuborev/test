<?php
/*
* Plugin Name: Zb-Search
* Description: Plugin adds widget for posts search
*/

require_once __DIR__ . '/widgets/class-zb-search-widget.php';

function load_scripts() {
    if ( ! wp_script_is( 'jquery', 'enqueued' )) {
        wp_deregister_script( 'jquery' );
        wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', [],false,true );
    }
    wp_register_script('zb-search-ajax', plugins_url('js/zb_search_ajax.js', __FILE__), ['jquery'], false, true );
    wp_localize_script('zb-search-ajax', 'zb_ajax', ['url' => admin_url('admin-ajax.php')] );
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );

if ( wp_doing_ajax() ){
    function zb_get_post(){
        $date = esc_sql( $_POST['date'] );
        $posts_per_page = esc_sql( $_POST['number'] );

        function modify_posts_where( $where ) {
            $title = esc_sql( trim( $_POST['title'] ) );
            return $where . " AND post_title LIKE '%$title%'";
        }

        add_filter( 'posts_where', 'modify_posts_where' );
        $args = [
            'posts_per_page'    => $posts_per_page,
            'orderby'           => 'date',
            'order'             => 'DESC',
            'post_status'       => 'publish',
            'date_query'        => [
                [
                    'after' => $date,
                ],
            ],
        ];
        $query = new WP_Query($args);
        remove_filter( 'posts_where','modify_posts_where');
        wp_send_json_success($query->posts);
        wp_die();
    }

    add_action( 'wp_ajax_nopriv_zb-get-post', 'zb_get_post' );
    add_action( 'wp_ajax_zb-get-post', 'zb_get_post' );
}
