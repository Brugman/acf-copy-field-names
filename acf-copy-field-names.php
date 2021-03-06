<?php

/**
 * Plugin Name: ACF Copy Field Names
 * Description: Adds a button to the side of the Field Group Editor to copy all field names.
 * Version: 1.0.0
 * Plugin URI: https://github.com/Brugman/acf-copy-field-names
 * Author: Tim Brugman
 * Author URI: https://timbr.dev/
 * Text Domain: acf-copy-field-names
 */

if ( !defined( 'ABSPATH' ) )
    exit;

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
        plugin_dir_url( __FILE__ ).'vendor/clipboard.min.js', // url
        ['jquery'], // deps
        '2.0.4', // ver
        true // in_footer
    );
    wp_register_script(
        'acf-copy-field-names', // name
        plugin_dir_url( __FILE__ ).'acf-copy-field-names.js', // url
        ['jquery','clipboardjs'], // deps
        '1.0.0', // ver
        true // in_footer
    );
    // enqueue
    wp_enqueue_script( 'clipboardjs' );
    wp_enqueue_script( 'acf-copy-field-names' );
});

function acf_copy_field_names_meta_box( $post )
{
?>
<p><a href="#" class="js-acf-copy-field-names button button-secondary button-large"><?php _e( 'Copy all fields names' ); ?></a></p>
<?php
}

add_action( 'add_meta_boxes_acf-field-group', function ( $post ) {
    if ( !acfn_should_load() )
        return;
    add_meta_box(
        'acf-copy-field-names-div',
        __( 'Copy Field Names' ),
        'acf_copy_field_names_meta_box',
        null,
        'side',
        'default'
    );
});

