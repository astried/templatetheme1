<?php
/**
 * Register meta boxes.
 */
function orangutantheme_register_meta_boxes() {
    add_meta_box( 'orangutantheme-post', __( 'Post Custom Fields', 'orangutantheme' ), 'orangutantheme_display_callback', 'post' );
}
add_action( 'add_meta_boxes', 'orangutantheme_register_meta_boxes' );

function orangutantheme_display_callback( $post ) {
    include plugin_dir_path( __FILE__ ) . './form-post.php';
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function orangutantheme_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    
    $fields = [
        'orangutantheme_postbanner',
        'orangutantheme_blogpost-widget',
        'orangutantheme_blogpost-comments'
    ];

    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}
add_action( 'save_post', 'orangutantheme_save_meta_box' );

?>