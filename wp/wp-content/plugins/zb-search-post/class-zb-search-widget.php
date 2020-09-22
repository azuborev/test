<?php



class ZB_Search_Widget extends WP_Widget
{
    public function __construct()
    {
        $args = [
            'name' => __( 'Post-Search' ),
            'description' => __( 'You can search posts by date or title' ),
        ];
        parent::__construct('zb-search-widget', 'Post-Search', $args);
    }

    public function form($instance)
    {
        $title = ( ! empty( $instance['title'] )) ? $instance['title'] : '';
        $post_number = ( ! empty( $instance['post_number'] )) ? $instance['post_number'] : '';
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" type="text"
                   name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $title ); ?>">
        </p>
            <p>
                <label for="<?php echo $this->get_field_id('post_number'); ?>"><?php _e( 'Number of posts:' ) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('post_number'); ?>" type="text"
                       name="<?php echo $this->get_field_name('post_number'); ?>" value="<?php echo esc_attr( $post_number ); ?>">
            </p>
<?php
    }

    public function widget($args, $instance)
    {
        $count = ( $instance['event_number'] ) ? $instance['event_number'] : '';
        $status = ( $instance['event_status'] ) ? $instance['event_status'] : '';

        echo $args['before_widget'];
        echo $args['before_title'];
        echo $instance['event_title'];
        echo $args['after_title'];
        echo zb_show_events_front_widget($status, $count);
        echo $args['after_widget'];
    }


    public function update($new_instance, $old_instance)
    {
        $instance = [];
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['post_number'] =( intval( $new_instance['post_number'] ) ) ?
                                    strip_tags( $new_instance['post_number'] ) : $old_instance['post_number'] ;
        return $instance;
    }
}