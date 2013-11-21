<div class="downloads"><!--
<?php
    // get all downloads
    $args = array( 'post_type' => 'download', 'posts_per_page' => 100 );
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post();
        require "download.php";
    endwhile;
?>
--></div>