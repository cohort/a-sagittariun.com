<?php

    /*
     * Release listing
     */
    $custom = get_post_custom($post->ID);
    $releaseId = $custom["releaseId"][0];
    $buyPhysicalLink = $custom["buyPhysicalLink"][0];
    $buyDigitalLink = $custom["buyDigitalLink"][0];
    $embedURL = $custom["embedURL"][0];

    if (has_post_thumbnail($post->ID)) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        $bg = $image[0];
    }
?>

<article id="release-<?php the_ID(); ?>" <?php post_class(); ?> <?php if ($bg) { echo 'style="background-image: url('.$bg.')"'; } ?>>
    <header class="release-header">
        <h1 class="release-title"><?php the_title(); ?></h1>
        <h2 class="release-id"><?php echo $releaseId; ?></h2>
        <ul class="release-links">
            <li><a href="<?php echo $buyPhysicalLink;?>">Buy Physical</a></li>
            <li><a href="<?php echo $buyDigitalLink;?>">Buy Digital</a></li>
            <li><a href="#" class="release-toggle">Listen</a></li>
        </ul>
    </header>

    <div class="release-content">
        <?php echo $embedURL; ?>
    </div>
</article>
