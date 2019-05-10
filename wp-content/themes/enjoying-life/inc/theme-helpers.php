<?php
/**
 * Theme helpers
 *
 * @author EAS Team
 * @package enjoying-life
 */

/**
 * Limit excerpt to a number of characters without cutting last word
 *
 * @param string $value
 *
 * @return string
 */
function custom_short_excerpt( $value, $limit = 100, $end = '...' ) {

	if ( mb_strwidth( $value, 'UTF-8' ) <= $limit ) {
		return $value;
	}

	return rtrim( mb_strimwidth( $value, 0, $limit, '', 'UTF-8' ) ) . $end;
}

/**
 * @param $aVars
 *
 * @return array
 */
function add_query_vars( $aVars ) {
	$aVars[] = "date";
	$aVars[] = "year1";
	$aVars[] = "month1";

	return $aVars;
}

add_filter( 'query_vars', 'add_query_vars' );

/**
 * @param $wp_query
 * @param int $posts_per_page
 *
 * @return WP_Query
 */
function get_category_query( $wp_query, $posts_per_page = 10 ) {
	$queries  = $wp_query->tax_query->queries;
	$date     = explode( '-', get_query_var( 'date' ) );
	$arg_date = [];

	if ( count( $date ) > 0 ) {
		$arg_date['year'] = intval( $date[0] );
		set_query_var( 'year1', $date[0] );

		if ( count( $date ) == 2 ) {
			$arg_date['monthnum'] = $date[1];

			set_query_var( 'month1', $date[1] );
		}

		$arg_date['column']   = 'post_date';
		$arg_date['relation'] = 'AND';

	}

	$args['post_type']      = 'post';
	$args['post_status']    = 'publish';
	$args['posts_per_page'] = $posts_per_page;
	$page_query             = 'paged';
	$paged                  = ( get_query_var( $page_query ) ) ? get_query_var( $page_query ) : 1;
	$args[ $page_query ]    = $paged;
	
	if ( count( $queries ) > 0 ) {
		$args['tax_query'] = [ $queries[0] ];
	}

	$args['date_query'] = $arg_date;

	return new WP_Query( $args );
}

/**
 * @param $x
 *
 * @return string
 */
function customarchives_join( $x ) {
	global $wpdb;

	return $x . " INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)";
}

/**
 * @param $x
 *
 * @return string
 */
function customarchives_where( $x ) {
	global $wpdb;

	$category = get_category_by_slug( 'info' );
	$exclude  = $category->term_id;

	if ( ! empty( $exclude ) ) {
		return $x . " AND $wpdb->term_taxonomy.taxonomy = 'category' AND $wpdb->term_taxonomy.term_id IN ($exclude)";
	}

	return $x . " AND $wpdb->term_taxonomy.taxonomy = 'category'";
}

/**
 * @param $link_html
 * @param $url
 * @param $text
 * @param $format
 *
 * @return string
 */
function customarchives_link( $link_html, $url, $text, $format ) {
	global $wpdb;
	$results = $wpdb->get_results( $wpdb->last_query );
	$dates   = explode( '/', $url );

	if ( 'with_plus' == $format ) {
		$count_date = count( $dates );
		$year       = $dates[ $count_date - 2 ];
		$month      = $dates[ $count_date - 1 ];
		$url        = home_url( '/' ) . 'info?date=' . $year . '-' . $month;
		$count      = 0;

		foreach ( $results as $result ) {
			if ( $result->year == $year && $result->month == $month ) {
				$count += $result->posts;
			}
		}

		$link_html = "<li class='c-box__table__item'><a  title='' href='$url'><span>$text(" . $count . ")</span><em class='c-icon c-icon__arrow--head'></em></a></li>";
	}

	return $link_html;
}

add_filter( 'get_archives_link', 'customarchives_link', 10, 4 );

/**
 * @param $max_num_pages
 *
 * @return array|string|void
 */
function get_pagination( $max_num_pages ) {
	return paginate_links( [
		'enjoying-life'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
		'total'     => $max_num_pages,
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'format'    => '?paged=%#%',
		'type'      => 'array',
		'prev_next' => true,
		'prev_text' => '<span>&lt;</span>',
		'next_text' => '<span>&gt;</span>',
		'mid_size'  => 4
	] );
}


/**
 * Get posts by category name
 */
if ( ! function_exists( 'get_posts_by_category_name' ) ) {
	function get_posts_by_category_name( $cat_name, $posts_per_page = 5 ) {
		$args = array(
			'posts_per_page' => $posts_per_page,
			'offset'         => 0,
			'category_name'  => $cat_name,
			'orderby'        => 'date',
			'order'          => 'desc',
			'post_type'      => 'post',
			'post_status'    => 'publish'
		);

		return get_posts( $args );
	}
}

/**
 * [check_data_empty description]
 *
 * @param  [type] $obj [description]
 *
 * @return [type]      [description]
 */
function check_data_empty( $obj ) {
	if ( empty( $obj ) ) {
		return false;
	}

	return $obj;
}

/**
 * [insert_title_tag_output description]
 *
 * @param  [type] $position [description]
 *
 * @return void
 */
function insert_title_tag_output( $position ) {
	check_data_empty( $position );
	if ( is_home() || is_front_page() ) {
		$logo_start = '<h1 class="c-header__logo">';
		$logo_end   = '</h1>';
	} else {
		$logo_start = '<h2 class="c-header__logo">';
		$logo_end   = '</h2>';
	}

	switch ( $position ) {
		case 'start':
			echo $logo_start;
			break;
		case 'end':
			echo $logo_end;
			break;
		default:
			break;
	}
}

/**
 * Get Head Meta
 */
function get_head_meta() {
	$page_title       = get_field( 'page_title' );
	$page_description = get_field( 'page_description' );
	$page_favicon     = get_field( 'other_settings', 'option' );

	echo sprintf( '<meta name="title" content="%s">', $page_title );
	echo sprintf( '<meta name="description" content="%s">', $page_description );
	echo sprintf( '<link rel="shortcut icon" href="%s" />', $page_favicon );
}

add_action( 'wp_head', 'get_head_meta' );

/**
 * Get a montlhy archive list for a custom post type
 *
 * @param  string $cpt Slug of the custom post type
 * @param  boolean $echo Whether to echo the output
 *
 * @return array         Return the output as an array to be parsed on the template level
 */
function get_cpt_archives( $cpt, $category_slug = '' ) {
	$category   = get_category_by_slug( $category_slug );
	$categories = get_term_children( $category->term_id, 'category' );
	$categories = array_merge( $categories, [ $category->term_id ] );
	$categories = implode( ',', $categories );

	global $wpdb;
	$query   = "SELECT $wpdb->posts.* FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) ";
	$query   .= "INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) ";
	$query   .= "WHERE post_type = '$cpt' AND post_status = 'publish' AND $wpdb->term_taxonomy.taxonomy = 'category' AND $wpdb->term_taxonomy.term_id in ($categories) ";
	$query   .= "GROUP BY YEAR(wp_posts.post_date), MONTH(wp_posts.post_date)  ORDER BY wp_posts.post_date DESC";
	$results = $wpdb->get_results( $query );
	$archive = array();
	if ( $results ) {
		foreach ( $results as $r ) {
			$post_date = strtotime( $r->post_date );
			$year      = date( 'Y', $post_date );
			$month_num = date( 'm', $post_date );
			$link      = home_url() . '/info?date=' . $year . '-' . $month_num;
			$count     = get_count_post_by_date( $cpt, $year, $month_num );

			$this_archive = array(
				'month' => $month_num,
				'year'  => $year,
				'link'  => $link,
				'title' => date_i18n( 'Y年n月', $post_date ),
				'count' => $count
			);

			if ( ! array_key_exists( $year, $archive ) ) {
				$archive[ $year ] = [];
			}

			array_push( $archive[ $year ], $this_archive );
		}
	}

	return $archive;
}

/**
 * @param $post_type
 * @param $year
 * @param $month
 *
 * @return int
 */
function get_count_post_by_date( $post_type, $year, $month ) {
	$query = new WP_Query( array(
		'post_type'      => $post_type,
		'post_status'    => 'publish',
		'category_name'  => 'info',
		'date_query'     => array(
			array(
				'year'  => $year,
				'month' => $month
			),
		),
		'posts_per_page' => - 1,
	) );

	return $query->post_count;
}
