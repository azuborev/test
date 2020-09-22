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

        if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
            add_action('wp_register_scripts', array( $this, 'add_genius_scripts' ));
            add_action('wp_head', array( $this, 'add_genius_style' ) );
        }
    }

    public function form($instance)
    {
        $title = ( ! empty( $instance['title'] )) ? $instance['title'] : '';
        $post_number = ( ! empty( $instance['post_number'] )) ? $instance['post_number'] : '5';
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
        wp_enqueue_script('jq-hoverintent', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', ['jquery'],false,true );

        $number = ( $instance['post_number'] );
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        echo get_form();
        echo $args['after_widget'];


//        echo zb_show_events_front_widget($status, $count);
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

function get_form() {
    $form = '';
    $form .= '<p><input type="text" name="title" id="title" placeholder="Post\'s Title"></p>';
    $form .= '<p><input type="date" name="from_date" id="from_date"</p>';
    $form .= '<p><input type="submit" name="search_submit" id="search_submit"</p>';
    return $form;
}
//jQuery(document).ready( function() {
//    jQuery(".user_like").click( function(e) {
//        e.preventDefault();
//        post_id = jQuery(this).attr("data-post_id");
//        nonce = jQuery(this).attr("data-nonce");
//        jQuery.ajax({
//         type : "post",
//         dataType : "json",
//         url : myAjax.ajaxurl,
//         data : {action: "my_user_like", post_id : post_id, nonce: nonce},
//         success: function(response) {
//            if(response.type == "success") {
//                jQuery("#like_counter").html(response.like_count);
//            }
//            else {
//                alert("Your like could not be added");
//            }
//        }
//      });
//   });
//});