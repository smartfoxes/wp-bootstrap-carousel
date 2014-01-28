<?php

/**
* Add custom post types
*/
add_action( 'init', 'wp_bootstrap_carousel_create_post_type' );
add_action( 'add_meta_boxes', 'wp_bootstrap_carousel_landing_pages_metaboxes' );

function wp_bootstrap_carousel_create_post_type() {
    register_post_type( 'carousel_slide',
		array(
			'labels' => array(
				'name' => __( 'Slides' ),
				'singular_name' => __( 'Slide' ),
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Slide',    		    
			),
    		'public' => true,
    		'has_archive' => false,
    		'show_ui' => true,
    		'supports' => array(
    		    'title','editor','thumbnail'
    	    ),
    	    'rewrite' => array(
    	        'slug' => 'wp-btstrp-slide',
    	        'with_front' => false,
    	        'ep_mask' => EP_PAGES
    	    ),
    	    'capability_type' => 'post'
		)
	);
}

function wp_bootstrap_carousel_landing_pages_metaboxes() {
    add_meta_box(
        'wp_bootstrap_carousel_slide_options',
        __( 'Slide Options', 'wp_bootstrap_carousel_textdomain' ),
        'wp_bootstrap_carousel_slide_options_metabox_html',
        "carousel_slide",
        "normal"
    );
}

function wp_bootstrap_carousel_slide_options_metabox_html($post) {
    
    wp_nonce_field( 'wp_bootstrap_carousel_slide_options', 'wp_bootstrap_carousel_slide_options_metabox_nonce' );
    
    $url = get_post_meta( $post->ID, '_wp_bootstrap_carousel_url', true );      
    
    ?>
    <p>
    <label for="wp_bootstrap_carousel_url">Link URL</label>
    <input class="widefat" type="text" id="wp_bootstrap_carousel_url" name="wp_bootstrap_carousel_url" value="<?php echo esc_attr( $url ); ?>" />
    </p>
    <?php		
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function wp_bootstrap_carousel_save_postdata( $post_id ) {
    // Check if our nonce is set.
    
    if ( ! isset( $_POST['wp_bootstrap_carousel_slide_options_metabox_nonce'] ) ) {
        return $post_id;
    }
    $nonce = $_POST['wp_bootstrap_carousel_slide_options_metabox_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'wp_bootstrap_carousel_slide_options' ) ) {
        return $post_id;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    // Check the user's permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;    
    }

    $url = sanitize_text_field( $_POST['wp_bootstrap_carousel_url'] );
    update_post_meta( $post_id, '_wp_bootstrap_carousel_url', $url );    
}
add_action( 'save_post', 'wp_bootstrap_carousel_save_postdata' );
