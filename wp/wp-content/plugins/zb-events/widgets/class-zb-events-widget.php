<?php

function zb_events_widget() {
    register_widget('ZB_Events_Widget');
}
add_action('widgets_init', 'zb_events_widget');

class ZB_Events_Widget extends WP_Widget {
    public function __construct()
    {
        $args = [
            'name' => __( 'Upcoming events' ),
            'description' => __( 'Displays a block of upcoming events' ),
        ];
        parent::__construct('zb-events-widget', __('Upcoming events'), $args);
    }

    public function form($instance)
    {
        $event_count = count(get_posts(['post_type' => 'zb_event']));
        $title = ( ! empty( $instance['event_title'] )) ? $instance['event_title'] : '';
        $status = ( ! empty( $instance['event_status'] )) ? $instance['event_status'] : '';
        $number = ( ! empty( $instance['event_number'] )) ? $instance['event_number'] : '';
        if ( !empty($event_count) ) {
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('event_title'); ?>"><?php _e( 'Title' ) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('event_title'); ?>" type="text"
                       name="<?php echo $this->get_field_name('event_title'); ?>" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('event_status'); ?>"><?php _e( 'Status' ) ?></label>
                <select class="widefat" name="<?php echo $this->get_field_name('event_status'); ?>" id="<?php echo $this->get_field_id('event_status'); ?>">
                    <option value="free" <?php selected( $status, 'free' )?> ><?php _e('Free') ?></option>
                    <option value="invite" <?php selected( $status, 'invite' )?> ><?php _e('By invitation') ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('event_number'); ?>"><?php _e( 'Number' ) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('event_number'); ?>" type="text"
                       name="<?php echo $this->get_field_name('event_number'); ?>" value="<?php echo esc_attr( $number ); ?>">
            </p>
            <?php
        } else {
            ?>
            <p><?php  _e('Create new events'); ?></p>
            <?php
        }

    }

    public function widget($args, $instance)
    {
        $title = apply_filters( 'widget_title', $instance['event_title'] );
        $count = ( $instance['event_number'] ) ?: '';
        $status = ( $instance['event_status'] ) ?: '';

        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
        echo zb_show_events_front_widget($status, $count);
        echo $args['after_widget'];
    }


    public function update($new_instance, $old_instance)
    {
        $instance = [];
        $instance['event_title'] = ( ! empty( $new_instance['event_title'] ) ) ? strip_tags( $new_instance['event_title'] ) : '';
        $instance['event_status'] = strip_tags( $new_instance['event_status'] );
        $instance['event_number'] =( intval( $new_instance['event_number'] ) ) ? strip_tags( $new_instance['event_number'] ) : $old_instance['event_number'] ;
        return $instance;
    }
}
