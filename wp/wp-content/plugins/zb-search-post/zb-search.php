<?php
/*
* Plugin Name: Zb-Search
* Description: Plugin adds widget for posts search
*/

require __DIR__ . '/class-zb-search-widget.php';

add_action('widgets_init', 'zb_search_widget');

function zb_search_widget() {
    register_widget('Zb_Search_Widget');
}