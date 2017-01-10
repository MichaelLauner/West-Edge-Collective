<?php

/**
* Custom Login Page
*/
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a {
            background:url('.get_bloginfo('template_directory').'/images/logo.png) !important;
            background-size:175px 118px !important;
            background-position:center !important;
            background-repeat: no-repeat !important;
            height:120px !important;
            width:312px !important;
        }
    </style>';
}
add_action('login_head', 'my_custom_login_logo');


/**
* Default Dash Colors
*/
function set_default_admin_color($user_id) {
	$args = array(
		'ID' => $user_id,
		'admin_color' => 'light'
	);
	wp_update_user( $args );
}
add_action('user_register', 'set_default_admin_color');

//Remove Color Settings
if ( !current_user_can('manage_options') )
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

add_filter('get_user_option_admin_color', 'change_admin_color');
function change_admin_color($result) {
    return 'light';
}


/**
* Hide Custom Field Box
*/
function remove_metaboxes() {
    // remove_meta_box( 'postcustom' , 'page' , 'normal' ); //removes custom fields for page
    // remove_meta_box( 'postcustom' , 'post' , 'normal' ); //removes custom fields for post
}
add_action( 'admin_menu' , 'remove_metaboxes' );


/**
* Admin Side CSS
*/
function wec_custom_dashbaard() {
  echo '<style>

  </style>';
}
add_action('admin_head', 'wec_custom_dashbaard');

/**
 * Enqueue scripts and styles.
 */
function west_edge_collective_scripts() {
	wp_enqueue_style( 'west-edge-collective-style', get_template_directory_uri() . '/styles/main.css' );

	wp_enqueue_script( 'west-edge-collective-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'west-edge-collective-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'west_edge_collective_scripts' );

/**
 *  Remove h1 from the WordPress editor.
 *
 *  @param   array  $init  The array of editor settings
 *  @return  array         The modified edit settings
 */
function wp_remove_h1_from_editor( $init ) {
    $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;';
    return $init;
}
add_filter( 'tiny_mce_before_init', 'wp_remove_h1_from_editor' );
