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
        'label'         => __('Event'),
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

/*
 * render event's List from widget (frontend)
 */
function zb_show_events_front_widget($status, $count) {
    $args = [
            'post_type'         => 'zb_event',
            'posts_per_page'    => $count,
            'meta_key'          => 'zb_date',
            'orderby'           => 'meta_value',
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

/*
 * example shortcode [zb_events status="invite" count=3]
 */
function zb_render_events_func($atts) {
    $params = shortcode_atts( [
                                'status'=> 'free',
                                'count' => 2,
                        ], $atts );
    $content = zb_show_events_front_widget($params['status'], $params['count']);
    return $content;
}

function zb_extra_fields() {
    add_meta_box( 'extra_fields', 'Main fields', 'zb_extra_fields_box_func', 'zb_event', 'normal', 'high'  );
}

function zb_extra_fields_box_func( $post ){
    ?>
    <p><label>Date: <input type="date" name="extra[zb_date]" value="<?php echo get_post_meta($post->ID, 'zb_date', 1); ?>"
                           min="<?php echo date("Y-m-d") ?>" required></label></p>
    <p>
        <label>Status: <select name="extra[zb_status]" required>
                <?php $status = get_post_meta($post->ID, 'zb_status', 1); ?>
                <option value="free" <?php selected( $status, 'free' )?> >Free</option>
                <option value="invite" <?php selected( $status, 'invite' )?> >By invitation</option>
            </select></label>
    </p>
    <?php
}

function zb_extra_fields_update( $post_id ){
    if ( isset( $_POST['extra'] )) {
        foreach( $_POST['extra'] as $key => $value ){
            if( empty($value) ){
                delete_post_meta( $post_id, $key );
                continue;
            }
            update_post_meta( $post_id, $key, $value );
        }
    }
}
