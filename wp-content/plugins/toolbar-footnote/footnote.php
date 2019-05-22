<?php
/*
Plugin Name: CSIS Toolbar - Footnote
*/

function footnote_script_register() {
    wp_register_script(
        'footnote.js',
        plugins_url( 'footnote.js', __FILE__ ),
        array( 'wp-rich-text', 'wp-element', 'wp-editor' )
    );
}
add_action( 'init', 'footnote_script_register' );

function footnote_enqueue_assets_editor() {
    wp_enqueue_script( 'footnote.js' );
}
add_action( 'enqueue_block_editor_assets', 'footnote_enqueue_assets_editor' );