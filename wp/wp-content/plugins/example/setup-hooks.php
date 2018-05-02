<?php

function wp_example_plugin_scripts_basic()
{
    // React scripts
    wp_register_script( 'example', plugins_url( 'build/admin.js', __FILE__ ), array(), time(), true );
    wp_register_style( 'example-css', plugins_url( 'build/bundle.css', __FILE__ ), array(), time() );

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script('example');
    wp_enqueue_style('example-css');

    wp_localize_script('example', 'wp_example_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));

}

add_action('admin_enqueue_scripts', 'wp_example_plugin_scripts_basic');
add_action('wp_enqueue_scripts', 'wp_example_plugin_scripts_basic');
