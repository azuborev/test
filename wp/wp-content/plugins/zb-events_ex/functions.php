<?php

/*
 * registration post-type 'Events'
 */
function zb_add_post_types() {
    $labels = [
        'name' => _x( 'Events', 'post type general name' ),
        'singular_name' => _x( 'Event', 'post type singular name' ),
        'add_new' => __( 'Add event' ),
        'add_new_item' => __( 'Add new event' ),
        'edit_item' => __( 'Edit event' ),
        'new_item' => __( 'New event' ),
        'all_items' => __( 'All events' ),
        'view_item' => __( 'View event' ),
        'menu_name' => __( 'Events' ),
    ];
    $args = [
        'label' => 'Event',
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-beer',
        'menu_position' => 5,
        'hierarchical' => false,
        'supports' => ['title', 'extra-fields'],
        'taxonomies' => ['event-category'],
    ];
    register_post_type('zb_event', $args);
}

/*
 * registration custom taxonomy
 */
function zb_add_taxonomy() {
    $labels = [
        'name'                        => _x( 'Types', 'taxonomy general name' ),
        'singular_name'               => _x( 'Type', 'taxonomy singular name' ),
        'search_items'                =>  __( 'Search Types' ),
        'all_items'                   => __( 'All Types' ),
        'edit_item'                   => __( 'Edit Type' ),
        'update_item'                 => __( 'Update Type' ),
        'add_new_item'                => __( 'Add New Type' ),
        'new_item_name'               => __( 'New Type Name' ),
        'menu_name'                   => __( 'Types' ),
        'parent_item'       => __( 'Parent Type' ),
        'parent_item_colon' => __( 'Parent Type:' ),
    ];
    $args = [
        'hierarchical'  => true,
        'labels'        => $labels,
        'show_ui'       => true,
        'query_var'     => true,
        'default_term'  => ['name' => 'Meeting']
    ];
     register_taxonomy('event-type', 'zb_event', $args);
}