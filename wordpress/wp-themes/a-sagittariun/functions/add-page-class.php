<?php

add_filter('body_class', 'add_body_class');
function add_body_class($classes) {

    if (is_page('dream-ritual')) {
        $classes[] = 'page-album page-album-dream-ritual';
    }
    if (is_page('elasticity')) {
        $classes[] = 'page-album page-album-elasticity';
    }

    return $classes;
}