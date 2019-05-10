<?php
/**
 * base functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @author  EAS Team
 * @package  enjoying-life
 */

if ( ! function_exists( 'enjoying-life_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function enjoying_life_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on base, use a find and replace
		 * to change 'base' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( THEME_NAME, get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'       => esc_html__( 'Primary', THEME_NAME ),
			'header-menu-1' => esc_html__( 'Header Menu 01', THEME_NAME ),
			'header-menu-2' => esc_html__( 'Header Menu 02', THEME_NAME ),
			'footer-menu-1' => esc_html__( 'Footer Menu 01', THEME_NAME ),
			'footer-menu-2' => esc_html__( 'Footer Menu 02', THEME_NAME ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'enjoying-life_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Add support for images size theme
		 */
		add_image_size( 'facility_thumb', 420, 294, true );
	}
endif;
add_action( 'after_setup_theme', 'enjoying_life_setup' );

/**
 * Enqueue scripts and styles.
 */
function enjoying_life_scripts() {
	wp_enqueue_style( 'jquery.scrollbar', get_template_directory_uri() . '/assets/js/scrollbar/jquery.scrollbar.css' );
	wp_enqueue_style( 'jquery.fancybox', get_template_directory_uri() . '/assets/js/fancybox/jquery.fancybox.min.css' );
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/styles/style.css' );
	wp_enqueue_style( 'animate-style', get_template_directory_uri() . '/assets/styles/animate.min.css' );
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/styles/bootstrap.min.css' );
	wp_enqueue_style( 'responsive-style', get_template_directory_uri() . '/assets/styles/responsive.css' );
	wp_enqueue_style( 'menu-style', get_template_directory_uri() . '/assets/styles/menu.css' );
	wp_enqueue_style( 'enjoying-custom', get_template_directory_uri() . '/assets/styles/enjoying-custom.css' );
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/assets/styles/custom.css' );
	wp_enqueue_style( 'icons', get_template_directory_uri() . '/assets/styles/all_icons.min.css' );
	wp_enqueue_style( 'font-face', get_template_directory_uri() . '/assets/font.css' );
	

	wp_enqueue_script( 'jquery-3.3.1', get_template_directory_uri() . '/assets/js/jquery/jquery-3.3.1.min.js', [], false, true);
	wp_enqueue_script( 'jquery.fancybox', get_template_directory_uri() . '/assets/js/fancybox/jquery.fancybox.min.js', [], false, true);
	wp_enqueue_script( 'jquery.scrollbar', get_template_directory_uri() . '/assets/js/scrollbar/jquery.scrollbar.min.js', [], false, true);
	wp_enqueue_script( 'modernizr-script', get_template_directory_uri() . '/assets/js/modernizr.js', [], false, true);
	wp_enqueue_script( 'common-script', get_template_directory_uri() . '/assets/js/common_scripts_min.js', [], false, true);
	wp_enqueue_script( 'validate-script', get_template_directory_uri() . '/assets/js/validate.js', [], false, true);
	wp_enqueue_script( 'jquery-tweet-script', get_template_directory_uri() . '/assets/js/jquery.tweet.min.js', [], false, true);
	wp_enqueue_script( 'functions-script', get_template_directory_uri() . '/assets/js/functions.js', [], false, true);

	wp_enqueue_script( 'jquery-validation', get_template_directory_uri() . '/js/jq-validation.js', array( 'jquery-3.3.1' ), '1.0', true );
	wp_enqueue_script( 'contact', get_template_directory_uri() . '/js/contact.js', array( 'jquery-3.3.1' ), '1.0', true );


	wp_localize_script( 'contact', 'WPObj', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_deregister_script('jquery');

}

add_action( 'wp_enqueue_scripts', 'enjoying_life_scripts' );

/**
 * admin scripts
 */
function enjoying_life_admin_scripts() {
	wp_enqueue_style( 'admin-style', get_template_directory_uri() . '/assets/css/admin.css' );
}

add_action( 'admin_enqueue_scripts', 'enjoying_life_admin_scripts' );


/**
 * @return string
 */
function no_wordpress_errors() {
	return 'Something is wrong!';
}

add_filter( 'login_errors', 'no_wordpress_errors' );

if( ! function_exists( 'filter_aioseop_title' ) ) {
    /**
     * @param $title
     * @return mixed
     */
    function filter_aioseop_title( $title )
    {
        $page_title_old = get_post_meta( get_the_ID(), 'aiosp_title', true );

        if( empty( $page_title_old ) ) {
            $page_title_old = get_the_title();
        }
        $page_title_new = get_field( 'page_title' );

        if ( !empty( $page_title_new ) ) {
            $title = str_replace( $page_title_old, $page_title_new, $title );
        }

        return $title;
    }

    add_filter( 'aioseop_title_page', 'filter_aioseop_title', 10, 1 );
}
/**
 * Theme register features
 */
require_once get_template_directory() . '/inc/theme-register.php';

/**
 * Theme Define
 */
require get_template_directory() . '/inc/theme-define.php';

/**
 * Theme breadcrumb
 */
require get_template_directory() . '/inc/theme-breadcrumb.php';

/**
 * Load modules
 */
require_once get_template_directory() . '/inc/theme-functions.php';
require_once get_template_directory() . '/inc/theme-ajax.php';
require_once get_template_directory() . '/inc/theme-helpers.php';
require_once get_template_directory() . '/inc/classes/WPCustomWalkerNavMenu.php';

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function enjoying_life_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'enjoying_life_content_width', 640 );
}

add_action( 'after_setup_theme', 'enjoying_life_content_width', 0 );


 