<?php
/**
 * Theme register
 *
 * @author EAS Team
 * @package enjoying-life
 */

if ( ! function_exists( 'register_theme_options' ) ) {
	/**
	 * Register theme options features
	 */
	function register_theme_options() {
		acf_add_options_page( array(
			'page_title' => 'Theme Options',
			'menu_title' => 'Theme Options',
			'menu_slug'  => 'theme-options',
			'capability' => 'edit_posts',
			'redirect'   => false
		) );
	}

	add_action( 'init', 'register_theme_options', 20 );
}

if ( ! function_exists( 'register_contact_page_options' ) ) {
	/**
	 * Register page contact us - options
	 */
	function register_contact_page_options() {
		acf_add_options_page( array(
			'page_title' => 'Contact Us',
			'menu_title' => 'Contact Us',
			'menu_slug'  => 'contact-us-options',
			'capability' => 'edit_posts',
			'redirect'   => false,
			'icon_url'   => 'dashicons-images-alt2'
		) );
	}

	add_action( 'init', 'register_contact_page_options', 20 );
}

/**
 * @param $title
 *
 * @return mixed
 */
function custom_wp_title( $title ) {
	$page_title = get_field( 'page_title' );

	if ( ! empty( $page_title ) ) {
		$title = $page_title;
	} elseif ( is_front_page() ) {
		$title = get_bloginfo( 'name' );
	}

	return $title;
}

if ( ! function_exists( 'filter_aioseop_title' ) ) {
	/**
	 * @param $title
	 *
	 * @return mixed
	 */
	function filter_aioseop_title( $title ) {
		$page_title_old = get_post_meta( get_the_ID(), 'aiosp_title', true );

		if ( empty( $page_title_old ) ) {
			$page_title_old = get_the_title();
		}
		$page_title_new = get_field( 'page_title' );

		if ( ! empty( $page_title_new ) ) {
			$title = str_replace( $page_title_old, $page_title_new, $title );
		}

		return $title;
	}

	add_filter( 'aioseop_title_page', 'filter_aioseop_title', 10, 1 );
}

$xss_clean = 'xss_clean';
add_filter( 'the_content', $xss_clean );
add_filter( 'get_the_content', $xss_clean );
add_filter( 'the_title', $xss_clean );
add_filter( 'get_the_title', $xss_clean );
add_filter( 'the_excerpt', $xss_clean );
add_filter( 'get_the_excerpt', $xss_clean );

//Remove XSS
function xss_clean( $data ) {
	$data = str_replace( array( '&amp;', '&lt;', '&gt;' ), array( '&amp;amp;', '&amp;lt;', '&amp;gt;' ), $data );
	$data = preg_replace( '/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data );
	$data = preg_replace( '/(&#x*[0-9A-F]+);*/iu', '$1;', $data );
	$data = html_entity_decode( $data, ENT_COMPAT, 'UTF-8' );

	// Remove any attribute starting with "on" or xmlns
	$data = preg_replace( '#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data );

	// Remove javascript: and vbscript: protocols
	$data = preg_replace( '#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data );
	$data = preg_replace( '#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data );
	$data = preg_replace( '#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data );

	// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
	$data = preg_replace( '#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data );
	$data = preg_replace( '#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data );
	$data = preg_replace( '#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data );

	// Remove namespaced elements (we do not need them)
	$data = preg_replace( '#</*\w+:\w[^>]*+>#i', '', $data );

	do {
		// Remove really unwanted tags
		$old_data = $data;
		$data     = preg_replace( '#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data );
	} while ( $old_data !== $data );

	// we are done...
	return $data;
}


/**
 * [remove_menus description]
 * @return [type] [description]
 */
// function remove_menus()
// {
// 	remove_menu_page('edit.php?post_type=acf-field-group');
// }
// add_action('admin_menu', 'remove_menus', 999);
