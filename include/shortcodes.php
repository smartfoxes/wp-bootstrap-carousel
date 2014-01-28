<?php

add_shortcode( 'carousel' , "wp_bootstrap_shortcodes_carousel");

function wp_bootstrap_shortcodes_carousel($atts, $content="") {
    $class = isset($atts['class']) ? $atts['class'] : null;
    return do_shortcode("
    <div class=\"carousel {$class}\">
        {$content}
    </div>
    ");
}
