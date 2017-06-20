<?php
/**
 * Custom Settings
 * Adds custom settings to the "General" settings option
 *
 * @package chinapower
 */

add_action('admin_init', 'chinapower_general_section');  
function chinapower_general_section() {  
    add_settings_section(  
        'chinapower_settings_section', // Section ID 
        'ChinaPower Settings', // Section Title
        'chinapower_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field( // Option 1
        'chinapower_itunesURL', // Option ID
        'iTunes URL', // Label
        'chinapower_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'chinapower_settings_section', // Name of our section
        array( // The $args
            'chinapower_itunesURL' // Should match Option ID
        )  
    ); 

    register_setting('general','chinapower_itunesURL', 'esc_attr');
}

function chinapower_section_options_callback() { // Section Callback
    echo '<p>General settings for the <em>ChinaPower</em> theme.</p>';  
}

function chinapower_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" class="regular-text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}