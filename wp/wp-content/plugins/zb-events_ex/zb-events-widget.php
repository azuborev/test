<?php
class ZB_Events_Widget extends WP_Widget {
    public function __construct()
    {
        $args = [
            'name' => 'Upcoming events',
            'description' => 'Displays a block of upcoming events',
        ];
        parent::__construct('zb-events-widget', 'Upcoming events', $args);
    }

    // Creating widget front-end

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
        echo __( 'Hello, World!', 'wpb_widget_domain' );
        echo $args['after_widget'];
        var_dump($instance);
    }

    /*
     * widget backend
     */
    public function form( $instance ) {










        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'wpb_widget_domain' );
        }
// Widget admin form
        ?>


        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />


        <?php
    }

// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance )
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;

    }


/*

//    public function form($instance)
//    {
//        $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
<!--        <p>-->
<!--            <label for="--><?php //echo $this->get_field_id('title'); ?><!--">Заголовок:</label>-->
<!--            <input type="text" name="--><?php //echo $this->get_field_name('title'); ?><!--"-->
<!--                   value="--><?php //echo esc_attr( $title ); ?><!--" id="--><?php //echo $this->get_field_id('title'); ?><!--" class="widefat">-->
<!--        </p>-->
<!--        --><?php
//    }
//
//    public function widget($args, $instance)
//    {
//        if (!is_user_logged_in()) return;
//
//        echo $args['before_widget'];
//        echo $args['before_title'];
//        echo $instance['title'];
//        echo $args['after_title'];
//        xz_show_dashboard_front_widget();
//        echo $args['after_widget'];
//
//    }
//
//    public function update($new_instance, $old_instance)
//    {
//        $instance = [];
//        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
//        return $instance;
//    }
*/

}