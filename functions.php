<?php
function oranguttheme1_setup() {

    load_theme_textdomain( 'oranguttheme1', get_template_directory() . '/languages' );

    add_theme_support( 'post-thumbnails' );
  }

add_action( 'after_setup_theme', 'oranguttheme1_setup' );


function oranguttheme1_excerpt_more( $more ) {
    return ' [...]';
}

add_filter('excerpt_more', 'oranguttheme1_excerpt_more');
?>