<?php

/**
 * Plugin Name: ACF Copy Field Names
 * Description: Adds a button to the side of the Field Group Editor to copy all field names.
 * Version: 2.0.0
 * Plugin URI: https://github.com/Brugman/acf-copy-field-names
 * Author: Tim Brugman
 * Author URI: https://timbr.dev/
 * Text Domain: acf-copy-field-names
 */

defined( 'ABSPATH' ) || exit;

define( 'ACFN_VERSION', '2.0.0' );

function acfn_should_load()
{
    $load = false;

    global $pagenow;
    if ( $pagenow == 'post.php' && $_GET['action'] == 'edit' )
    {
        global $post;
        if ( isset( $post ) && $post->post_type == 'acf-field-group' )
            $load = true;
    }

    return $load;
}

add_action( 'admin_enqueue_scripts', function () {
    if ( !acfn_should_load() )
        return;
    // register
    wp_register_script(
        'clipboardjs', // name
        plugin_dir_url( __FILE__ ).'clipboard.min.js', // url
        [], // deps
        '2.0.11', // ver
        true // in_footer
    );
    wp_register_script(
        'acf-copy-field-names', // name
        plugin_dir_url( __FILE__ ).'acf-copy-field-names.js', // url
        ['clipboardjs'], // deps
        ACFN_VERSION, // ver
        true // in_footer
    );
    // enqueue
    wp_enqueue_script( 'clipboardjs' );
    wp_enqueue_script( 'acf-copy-field-names' );
});

