<?php
/**
  * Plugin Name:    CSIS Toolbar - FullWidth
  * Description:    Affixes a button to the editor toolbar which will add the fullwidth shortcode to the block.
  * Version:        1.0
**/

function full_width_script_register() {
    wp_register_script(
        'fullWidth.js',
        plugins_url( 'fullWidth.js', __FILE__ ),
        array( 'wp-rich-text', 'wp-element', 'wp-editor' )
    );
}
add_action( 'init', 'full_width_script_register' );

function full_width_enqueue_assets_editor() {
    wp_enqueue_script( 'fullWidth.js' );
}
add_action( 'enqueue_block_editor_assets', 'full_width_enqueue_assets_editor' );