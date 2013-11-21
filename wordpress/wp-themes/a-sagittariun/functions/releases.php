<?php

/*
 * Add releases post type
 * See: http://net.tutsplus.com/tutorials/wordpress/rock-solid-wordpress-3-0-themes-using-custom-post-types/
 */


    /*
     * Add to admin
     * See: http://codex.wordpress.org/Function_Reference/register_post_type#Arguments
     */
    add_action('init', 'releases_register');
    function releases_register() {
        $args = array(
            'labels' => array(
                'name' => __('Music'),
                'menu_name' => __('Releases'),
                'singular_name' => __('Release'),
            ),
            'public' => true,
            'has_archive' => true,
            'exclude_from_search' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => true,
            'supports' => array('title', 'thumbnail'),
            'rewrite' => array('slug' => 'music'),
        );

        register_post_type( 'release' , $args );
    }



    /*
     * Custom inputs
     *
     */
    add_action("admin_init", "admin_init_release");
    add_action('save_post', 'save_release');

    function admin_init_release(){
        // http://codex.wordpress.org/Function_Reference/add_meta_box
        add_meta_box("releaseInfo-meta", "Release Options", "meta_options_release", "release", "normal", "low");
    }

    function meta_options_release(){
        global $post;
        $custom = get_post_custom($post->ID);

        $releaseId = $custom["releaseId"][0];
        $buyPhysicalLink = $custom["buyPhysicalLink"][0];
        $buyDigitalLink = $custom["buyDigitalLink"][0];
        $embedURL = $custom["embedURL"][0];

        echo '
            <style>
                .input-container { margin-bottom:1em; }
                .input-container label { display:inline-block; width:150px; vertical-align:top; }
                .input-container textarea { min-width:300px; min-height:150px; }
            </style>
            <div class="input-container">
                <label>Release ID:</label>
                <input name="releaseId" value="'.$releaseId.'" />
            </div>
            <div class="input-container">
                <label>Buy Physical Link:</label>
                <input name="buyPhysicalLink" value="'.$buyPhysicalLink.'" />
            </div>
            <div class="input-container">
                <label>Buy Digital Link:</label>
                <input name="buyDigitalLink" value="'.$buyDigitalLink.'" />
            </div>
            <div class="input-container">
                <label>Bandcamp Embed Code:</label>
                <textarea name="embedURL">'.$embedURL.'</textarea>
            </div>
        ';
    }


    function save_release(){
        global $post;
        update_post_meta($post->ID, "releaseId", $_POST["releaseId"]);
        update_post_meta($post->ID, "buyPhysicalLink", $_POST["buyPhysicalLink"]);
        update_post_meta($post->ID, "buyDigitalLink", $_POST["buyDigitalLink"]);
        update_post_meta($post->ID, "embedURL", $_POST["embedURL"]);
    }
