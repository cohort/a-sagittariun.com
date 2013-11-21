<?php
    $title = get_the_title();

    if (has_post_thumbnail($post->ID)) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        $img = $image[0];
    }

    $custom = get_post_custom($post->ID);
    $filename = $custom["filename"][0];
    $filesize = $custom["filesize"][0];
?>
--><div class="download">
    <a href="<?php echo get_stylesheet_directory_uri(); ?>/downloads/<?php echo $filename; ?>">
        <img src="<?php echo $img;?>" alt="">
        <p><?php echo $title; ?><br>(<?php echo $filesize; ?>)</p>
    </a>
</div><!--
