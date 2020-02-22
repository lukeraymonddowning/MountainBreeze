<?php

function mountain_breeze_enqueue()
{
    wp_deregister_script('jquery');
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('app', get_stylesheet_directory_uri() . '/dist/app.js');
}

add_action('wp_enqueue_scripts', 'mountain_breeze_enqueue');
