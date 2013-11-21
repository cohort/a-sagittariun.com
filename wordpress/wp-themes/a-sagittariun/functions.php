<?php
    include "functions/releases.php";
    include "functions/downloads.php";




/*
 * format download file units
 */
function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }
    return $bytes;
}

/*
 * set excerpt read more text
 * http://codex.wordpress.org/Function_Reference/the_excerpt
 */
function new_excerpt_more( $more ) {
    return '&hellip;  <span class="read-more"><a href="'.get_permalink().'" rel="bookmark">continue reading</a></span>';
}
add_filter('excerpt_more', 'new_excerpt_more');
