<?php
  /*
    Plugin Name: WP Bootstrap Carousel
    Plugin URI: https://github.com/smartfoxes/wp-bootstrap-carousel.git
    Description: Slides carousel for the bootstrap based themes
    Version: 0.9
    Author: Smart Foxes Inc
    Author URI: http://www.smartfoxes.ca
    License: MIT
  */

require_once dirname( __FILE__ ) . '/include/custom_post_types.php';
require_once dirname( __FILE__ ) . '/include/shortcodes.php';

/*if ( is_admin() ):
	require_once dirname( __FILE__ ) . '/admin.php';
endif;
*/

//add_image_size( 'uwplp-icon', 40, 40, true );
