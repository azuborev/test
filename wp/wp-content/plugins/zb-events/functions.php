<?php

/*
 * registration post-type 'Events'
 */
function zb_add_post_types() {
    $labels = [
        'name'          => _x( 'Events', 'post type general name' ),
        'singular_name' => _x( 'Event', 'post type singular name' ),
        'add_new'       => __( 'Add event' ),
        'add_new_item'  => __( 'Add new event' ),
        'edit_item'     => __( 'Edit event' ),
        'new_item'      => __( 'New event' ),
        'all_items'     => __( 'All events' ),
        'view_item'     => __( 'View event' ),
        'menu_name'     => __( 'Events' ),
    ];
    $args = [
        'label'         => 'Event',
        'labels'        => $labels,
        'public'        => true,
        'menu_icon'     => 'dashicons-beer',
        'menu_position' => 5,
        'hierarchical'  => false,
        'supports'      => ['title', 'extra-fields'],
        'taxonomies'    => ['event-type'],
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'events']
    ];
    register_post_type('zb_event', $args);
}

/*
 * registration custom taxonomy
 */
function zb_add_taxonomy() {
    $labels = [
        'name'              => _x( 'Types', 'taxonomy general name' ),
        'singular_name'     => _x( 'Type', 'taxonomy singular name' ),
        'search_items'      =>  __( 'Search Types' ),
        'all_items'         => __( 'All Types' ),
        'view_items'        => __( 'View All Types' ),
        'edit_item'         => __( 'Edit Type' ),
        'update_item'       => __( 'Update Type' ),
        'add_new_item'      => __( 'Add New Type' ),
        'new_item_name'     => __( 'New Type Name' ),
        'menu_name'         => __( 'Types' ),
        'parent_item'       => __( 'Parent Type' ),
        'parent_item_colon' => __( 'Parent Type:' ),
    ];
    $args = [
        'labels'        => $labels,
        'show_ui'       => true,
        'query_var'     => true,
        'public'        => true,
        'hierarchical'  => true,
        'default_term'  => ['name' => 'Meeting']
    ];
     register_taxonomy('event-types', 'zb_event', $args);
}

function zb_show_events_front_widget($status, $count) {
    $args = [
            'post_type'         => 'zb_event',
            'posts_per_page'    => $count,
            'orderby'           => 'zb_date',
            'order'             => 'ASC',
            'meta_query'        => [
                                    ['key' => 'zb_status',
                                    'value' => $status]
                                    ],
            ];
    $events = get_posts( $args );
    if ( ! $events ) {
        return '<p>Event\'s List is Empty</p>';
    }
    $content = '<ul>';
    foreach( $events as $event ) {
        $content .= '<li>' . $event->zb_date.' | '.$event->post_title . '</li>';
    }
    $content .= '</ul>';
    return $content;
}

function zb_get_events_func($atts) {
    $params = shortcode_atts( [
                                'status'=> 'free',
                                'count' => 2,
                        ], $atts );
    $content = zb_show_events_front_widget($params['status'], $params['count']);
    return $content;
}















































