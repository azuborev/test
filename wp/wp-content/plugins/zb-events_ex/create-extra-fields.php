<?php

function zb_extra_fields() {
    add_meta_box( 'extra_fields', 'Main fields', 'zb_extra_fields_box_func', 'zb_event', 'normal', 'high'  );
}

function zb_extra_fields_box_func( $post ){
    ?>
    <p><label>Date: <input type="date" name="extra[date]" value="<?php echo get_post_meta($post->ID, 'date', 1); ?>" required></label></p>
    <p>
        <label>Status: <select name="extra[status]" required>
                <?php $status = get_post_meta($post->ID, 'status', 1); ?>
                <option value="free" <?php selected( $status, 'free' )?> >Free</option>
                <option value="invite" <?php selected( $status, 'invite' )?> >By invitation</option>
            </select></label>
    </p>
    <?php
}

function zb_extra_fields_update( $post_id ){
    if ( empty( $_POST['extra'] ) || wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id )) {
        return false;
    }
    foreach( $_POST['extra'] as $key => $value ){
        if( empty($value) ){
            delete_post_meta( $post_id, $key );
            continue;
        }
        update_post_meta( $post_id, $key, $value );
    }
    return $post_id;
}