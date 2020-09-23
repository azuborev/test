<?php

function zb_search_widget() {
    register_widget('Zb_Search_Widget' );
}
add_action( 'widgets_init', 'zb_search_widget' );

class ZB_Search_Widget extends WP_Widget
{
    public function __construct()
    {
        $args = [
            'name' => __( 'Post-Search' ),
            'description' => __( 'You can search posts by date or title' ),
        ];
        parent::__construct('zb-search-widget', __('Post-Search'), $args);
    }

    public function form($instance)
    {
        $title = ( $instance['title'] ) ?: '';
        $post_number = ( $instance['post_number'] ) ?: '5';
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" type="text"
                   name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $title ); ?>">
        </p>
            <p>
                <label for="<?php echo $this->get_field_id('post_number'); ?>"><?php _e( 'Number of posts:' ) ?></label>
                <input id="<?php echo $this->get_field_id('post_number'); ?>" type="text"
                       name="<?php echo $this->get_field_name('post_number'); ?>"
                       value="<?php echo esc_attr( $post_number ); ?>" size="3">
            </p>
<?php
    }

    public function widget($args, $instance)
    {
        wp_enqueue_script('zb-search-ajax', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', ['jquery'],false,true );

        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        echo zb_get_form($instance['post_number']);
        echo $args['after_widget'];
    }


    public function update($new_instance, $old_instance)
    {
        $instance = [];
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['post_number'] =( is_numeric( $new_instance['post_number'] ) ) ?
                                    strip_tags( $new_instance['post_number'] ) : '5' ;
        return $instance;
    }
}

function zb_get_form($number) {
    $form = '<p><input type="text" name="title" id="title" placeholder="Post\'s Title"></p>';
    $form .= '<p><input type="date" name="from_date" id="from_date"></p>';
    $form .= '<p><input type="hidden" name="number" id="number" value="'.$number.'"></p>';
    $form .= '<p><button id="reset_button">reset</button></p>';
    $form .= '<div id="post_links"></div>';
    return $form;
}
