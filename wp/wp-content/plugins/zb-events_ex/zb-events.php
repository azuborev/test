<?php
/*
 * Plugin Name: Zb-Events
 * Description: plugin for event planning
 */

require __DIR__ . '/functions.php';
require __DIR__ . '/create-extra-fields.php';
require __DIR__ . '/zb-events-widget.php';

add_action( 'init', 'zb_add_post_types' );
add_action( 'init', 'zb_add_taxonomy', 9 );
add_action( 'add_meta_boxes', 'zb_extra_fields', 1 );
add_action( 'save_post', 'zb_extra_fields_update', 0 );
add_action('widgets_init', 'zb_events_widget');

function zb_events_widget() {
    register_widget('ZB_Events_Widget');
}