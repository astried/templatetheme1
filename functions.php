<?php
//Include Theme Options
include_once "includes/theme-options.php";

//Theme Ajax
include_once "includes/theme-ajax.php";

//Theme metaboxes
include_once "includes/metaboxes.php";

//Include Theme Functions
include_once "includes/functions.php";

function orangutantheme_setup() {

    load_theme_textdomain( 'orangutantheme', get_template_directory() . '/languages' );

    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
}

add_action( 'after_setup_theme', 'orangutantheme_setup' );

function orangutantheme_excerpt_more( $more ) {
    return ' [...]';
}

add_filter('excerpt_more', 'orangutantheme_excerpt_more');


function orangutantheme_menu() {
  register_nav_menu('primary-menu',__( 'Primary Menu' ));
}
add_action( 'init', 'orangutantheme_menu' );

//If this on admin dashboard
if(is_admin())
{
	function orangut_themecustom_scripts()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_media();

		wp_enqueue_style('theme-bootstrap', get_template_directory_uri(). '/vendor/bootstrap/css/bootstrap.css');
		wp_enqueue_style('theme-font-awesome', get_template_directory_uri(). '/css/font-awesome/css/font-awesome.css');

		wp_enqueue_script('theme-bootstrap', get_template_directory_uri(). '/vendor/bootstrap/js/bootstrap.js');

		wp_enqueue_script('theme_customize-scripts', get_template_directory_uri(). '/js/theme_customize_scripts.js', 
							array(	'jquery-ui-sortable',
			                        'jquery-ui-draggable',
			                        'jquery-ui-droppable',
			                        'jquery',
			                        'media-upload',
			                        'thickbox'
			                        )
						);

		$ajax_url =  admin_url( 'admin-ajax.php' );

		wp_localize_script( 'theme_customize-scripts', 'orutajax',
			            array( 'url' => $ajax_url,
			                   'nonce' => wp_create_nonce( 'orangutantheme-admin-nonce' )
			                )
			         );
	}


	function orangut_themegeneral_scripts()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_media();
				
		wp_enqueue_script('theme_general-scripts', get_template_directory_uri(). '/js/theme_general_scripts.js', 
							array(	'jquery',
			                        'media-upload',
			                        'thickbox'
			                        )
						);

		$ajax_url =  admin_url( 'admin-ajax.php' );

		wp_localize_script( 'theme_general-scripts', 'orutajax',
			            array( 'url' => $ajax_url,
			                   'nonce' => wp_create_nonce( 'orangutantheme-admin-nonce' )
			                )
			         );		

		wp_enqueue_style('theme-admin', get_template_directory_uri(). '/css/admin-style.css');		
	}

	if(isset($_GET['page']) && $_GET['page'] == "orut_theme-options" ){
		add_action('admin_enqueue_scripts', 'orangut_themecustom_scripts');	
	}
	
	add_action('admin_enqueue_scripts', 'orangut_themegeneral_scripts');

}else{

	function orangut_frontend_scripts()
	{
		wp_enqueue_script('jquery');

		wp_enqueue_style('theme-style', get_stylesheet_uri() );
		wp_enqueue_style('theme-bootstrap', get_template_directory_uri(). '/vendor/bootstrap4/css/bootstrap.css' );
		wp_enqueue_style('theme-font-awesome', get_template_directory_uri(). '/css/font-awesome/css/font-awesome.css');

		wp_enqueue_script('theme-bootstrap', get_template_directory_uri(). '/vendor/bootstrap4/js/bootstrap.js' );
		wp_enqueue_script('theme-bootstrap-bundle', get_template_directory_uri(). '/vendor/bootstrap4/js/bootstrap.bundle.js' );

		wp_enqueue_script('theme_frontend-scripts', get_template_directory_uri(). '/js/theme_frontend.js', 
							array( 'jquery' )
						);

		$ajax_url =  admin_url( 'admin-ajax.php' );

		wp_localize_script( 'theme_frontend-scripts', 'orutajax',
			            array( 'url' => $ajax_url,
			                   'nonce' => wp_create_nonce( 'orangutantheme-nonce' )
			                )
			         );				
	}

	add_action('wp_enqueue_scripts', 'orangut_frontend_scripts');	

}

?>