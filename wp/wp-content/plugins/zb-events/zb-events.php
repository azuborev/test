<?php
/*
 * Plugin Name: Zb-Events
 * Description: Plugin for event planning
 */

require __DIR__ . '/functions.php';
require __DIR__ . '/class-zb-events-widget.php';

add_action( 'init', 'zb_add_post_types' );
add_action( 'init', 'zb_add_taxonomy' );
add_action( 'add_meta_boxes', 'zb_extra_fields' );
add_action( 'save_post', 'zb_extra_fields_update' );
add_action('widgets_init', 'zb_events_widget');

function zb_events_widget() {
    register_widget('ZB_Events_Widget');
}

add_shortcode('zb_events', 'zb_render_events_func');