<?php

/*
 * Add downloads post type
 * See: http://net.tutsplus.com/tutorials/wordpress/rock-solid-wordpress-3-0-themes-using-custom-post-types/
 */


    /*
     * Add to admin
     * See: http://codex.wordpress.org/Function_Reference/register_post_type#Arguments
     */
    add_action('init', 'downloads_register');
    function downloads_register() {
        $args = array(
            'labels' => array(
                'name' => __('Downloads (About Page)'),
                'menu_name' => __('Downloads'),
                'singular_name' => __('Download'),
            ),
            'public' => true,
            'has_archive' => true,
            'exclude_from_search' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => true,
            'supports' => array('title', 'thumbnail'),
            'rewrite' => array('slug' => 'download'),
        );

        register_post_type( 'download' , $args );
    }



    /*
     * Custom inputs
     *
     */
    add_action("admin_init", "admin_init_download");
    add_action('save_post', 'save_download');

    function admin_init_download(){
        // http://codex.wordpress.org/Function_Reference/add_meta_box
        add_meta_box("downloadInfo-meta", "Downloadable details", "meta_options_download", "download", "normal", "low");
    }

    function meta_options_download(){
        global $post;
        $custom = get_post_custom($post->ID);

        wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');

        $filename = $custom["filename"][0];
        $filesize = $custom["filesize"][0];

        echo '
            <style>
                .input-container { margin-bottom:1em; }
                .input-container label { display:inline-block; width:150px; vertical-align:top; }
            </style>
            <div class="input-container">
                <label>Filename:</label>
                <input name="filename" value="'.$filename.'" />
            </div>
            <div class="input-container">
                <label>File size:</label>
                <input name="filesize" value="'.$filesize.'" />
            </div>
        ';
    }


    function save_download($id){
        global $post;

        update_post_meta($post->ID, "filename", $_POST["filename"]);
        update_post_meta($post->ID, "filesize", $_POST["filesize"]);
    }
