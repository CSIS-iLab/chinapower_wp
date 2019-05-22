<?php
/*
Plugin Name: CSIS Toolbar - CPP
*/

function cpp_script_register() {
    wp_register_script(
        'cpp.js',
        plugins_url( 'cpp.js', __FILE__ ),
        array( 'wp-rich-text', 'wp-element', 'wp-editor' )
    );
}
add_action( 'init', 'cpp_script_register' );

function cpp_enqueue_assets_editor() {
    wp_enqueue_script( 'cpp.js' );
}
add_action( 'enqueue_block_editor_assets', 'cpp_enqueue_assets_editor' );
