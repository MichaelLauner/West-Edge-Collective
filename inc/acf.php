<?php
/**********************************************
* Custom Field Functionality
**********************************************/

// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');

function my_acf_settings_path( $path ) {

     // update path
     $path = get_stylesheet_directory() . '/inc/advanced-custom-fields-pro/';

     // return
     return $path;

}

// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir( $dir ) {

     // update path
     $dir = get_stylesheet_directory_uri() . '/inc/advanced-custom-fields-pro/';

     // return
     return $dir;

}

// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', 'my_acf_show_admin');

function my_acf_show_admin( $show ) {

    return current_user_can('manage_options');

}

// 4. Include ACF
include_once( get_stylesheet_directory() . '/inc/advanced-custom-fields-pro/acf.php' );

// Google Maps Key
function my_acf_init() {

	acf_update_setting('google_api_key', 'AIzaSyBWwDTgt2YL4nwzoKCH4TN9wJbxor2tNV4');
}

add_action('acf/init', 'my_acf_init');

/*
* Filter Relationship Results To Only Show Top Level
**/
function my_relationship_query( $args, $field, $post_id ) {

    // only show children of the current post being edited
    $args['post_parent'] = 0;


	// return
    return $args;

}
// filter for every field
add_filter('acf/fields/relationship/query', 'my_relationship_query', 10, 3);
