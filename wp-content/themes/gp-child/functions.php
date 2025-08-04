<?php

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

function gp_scripts()
{
    wp_enqueue_style('gp-style', get_template_directory_uri() . '/style.css', array(), _S_VERSION);

    wp_enqueue_style('swiper-css', get_stylesheet_directory_uri() . '/inc/swiper/swiper-bundle.min.css', array(), null);
     wp_enqueue_style('fancy-styles', get_stylesheet_directory_uri() . '/inc/fancybox/jquery.fancybox.min.css', array(), null);
    //wp_style_add_data('purple-web-style', 'rtl', 'replace');
    // wp_deregister_script('jquery');
    // wp_enqueue_script('jquery_scripts', get_template_directory_uri() . '/js/jquery-3.7.1.min.js', array(), _S_VERSION, true);
    wp_enqueue_script('gp-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), null, true);
    wp_enqueue_script('fancy-scripts', get_stylesheet_directory_uri() . '/inc/fancybox/jquery.fancybox.min.js', array(), null, true);
    wp_enqueue_script('swiper-js', get_stylesheet_directory_uri() . '/inc/swiper/swiper-bundle.min.js', array(), null, true);
    wp_enqueue_script('swiper-scripts', get_stylesheet_directory_uri() . '/inc/swiper/slider-scripts.js', array(), null, true);
    wp_enqueue_script('theme-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), null, true);
     wp_enqueue_script('woo-scripts', get_stylesheet_directory_uri() . '/js/woo-scripts.js', array(), null, true);
    // wp_enqueue_script('imask-scripts', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js', array(), null, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'gp_scripts');

add_action('after_setup_theme', 'gut_styles');

function gut_styles()
{
    add_theme_support('editor-styles');
    add_editor_style('css/admin-styles.css');
}


require 'inc/current-temp.php';
require 'inc/carbon-fields.php';
require 'inc/woo.php';


// Contact Form 7 remove auto added p tags
add_filter('wpcf7_autop_or_not', '__return_false');