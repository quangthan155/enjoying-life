<?php
/**
 * Theme functions
 *
 * @author EAS Team
 * @package enjoying-life
 */

/**
 * Check Device Mobile
 *
 * @return bool
 */
function check_wp_is_mobile()
{
	static $is_mobile;

	if (isset($is_mobile)) {
		return $is_mobile;
	}

	$http_user_agent_key = 'HTTP_USER_AGENT';

	if (empty($_SERVER[$http_user_agent_key])) {
		$is_mobile = false;
	} elseif ((strpos($_SERVER[$http_user_agent_key], 'Mobile') !== false && strpos($_SERVER[$http_user_agent_key], 'iPad') === false)
		|| strpos($_SERVER[$http_user_agent_key], 'Android') !== false
		|| strpos($_SERVER[$http_user_agent_key], 'Silk/') !== false
		|| strpos($_SERVER[$http_user_agent_key], 'Kindle') !== false
		|| strpos($_SERVER[$http_user_agent_key], 'BlackBerry') !== false
		|| strpos($_SERVER[$http_user_agent_key], 'Opera Mini') !== false
	) {
		$is_mobile = true;
	} else {
		$is_mobile = false;
	}

	return $is_mobile;
}

/**
 * Get Template Component
 *
 * @author EAS Team
 *
 * @param $component_name
 * @param string $template_slug
 */
function get_template_component($component_name, $template_slug = 'template-components')
{
	$template_path = $template_slug . '/' . $component_name;

	get_template_part($template_path);
}

/**
 * Get Data Component
 *
 * @param $post_id
 * @param $file_name
 *
 * @return array|bool
 */
function get_data_component($post_id, $file_name)
{
	$data_component = [];

	$component_name = basename($file_name, '.php');

	if (have_rows('components', $post_id)) {
		the_row();
		if (get_row_layout() !== $component_name) {
			return false;
		}

		$data_component = get_sub_field($component_name);
	}

	$data_component['prefix'] = get_device_prefix();
	$data_component['id']     = get_row_index();
	$data_component['class']  = sprintf('c-%1$s" data-component="%1$s', $component_name);
	$data_component['name']   = $component_name;

	return $data_component;
}

/**
 *
 * Load Template Components
 *
 * @author EAS Team
 *
 * @param $post_id
 * @param bool $is_enable_cache
 * @param string $template_slug
 */
function load_template_components($post_id, $is_enable_cache = false, $template_slug = 'template-components')
{
	$fields = get_field('components', $post_id);

	if ($is_enable_cache) {
		$data_component_key = 'data_component_';
		$cache_fields       = get_transient($data_component_key . $post_id);

		if (empty($cache_fields)) {
			set_transient($data_component_key . $post_id, $fields, 12 * HOUR_IN_SECONDS);
		} else {
			$fields = $cache_fields;
		}
	}

	if (empty($fields)) {
		return;
	}

	foreach ($fields as $data) {
		$acf_fc_layout_key = 'acf_fc_layout';
		if (!isset($data[$acf_fc_layout_key])) {
			continue;
		}

		$component_id = $data[$acf_fc_layout_key];

		$template_name = $template_slug . '/' . $component_id;
		$template_path = sprintf('%s.php', get_template_directory() . '/' . $template_name);

		if (file_exists($template_path)) {
			get_template_part($template_name);
		}
	}
}
/**
 * Get Primary Menu  PC
 */
function get_primary_menu()
{
	wp_nav_menu(array(
		'theme_location' => 'primary',
		'depth' => 1, // 1 = no dropdowns, 2 = with dropdowns.
		'container' => 'ul',
		'menu_class' => 'menu',
		'walker' => new WPCustomWalkerNavMenu(),
	));
}

/**
 * Get Header Menu  PC
 */
function get_header_menu_pc()
{
	wp_nav_menu(array(
		'theme_location' => 'header-menu-pc',
		'depth' => 1, // 1 = no dropdowns, 2 = with dropdowns.
		'container' => 'ul',
		'menu_class' => 'c-navbar c-navbar--mobile',
		'walker' => new WPCustomWalkerNavMenu(),
	));
}

/**
 * Get Header Menu SP
 */
function get_header_menu_sp()
{
	wp_nav_menu(array(
		'container'      => false,
		'theme_location' => 'header-menu-sp',
		'menu_id'        => 'header-menu-sp',
		'before'         => '',
		'after'          => '',
		'link_before'    => '',
		'link_after'     => '',
		'menu_class'     => 'mainmenu no-list-style',
		'walker'         => new WPCustomWalkerNavMenu()
	));
}

/**
 * Get Footer Menu  PC
 */
function get_footer_menu_pc()
{
	wp_nav_menu(array(
		'theme_location' => 'footer-menu-pc',
		'depth' => 1, // 1 = no dropdowns, 2 = with dropdowns.
		'container' => 'ul',
		'menu_class' => 'c-navbar',
		'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
		'walker' => new WPCustomWalkerNavMenu(),
	));
}

/**
 * Get Footer Menu  PC
 */
function get_footer_menu_sp()
{
	wp_nav_menu(array(
		'theme_location' => 'footer-menu-sp',
		'depth' => 1, // 1 = no dropdowns, 2 = with dropdowns.
		'container' => 'ul',
		'menu_class' => 'c-navbar',
		'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
		'walker' => new WPCustomWalkerNavMenu(),
	));
}

/**
 * @return string
 */
function get_device_prefix()
{
	return check_wp_is_mobile() ? '_sp' : '_pc';
}

/**
 * Get background of the page is detected before
 * 
 * @return string
 * QuangTN
 */
function get_background_url() {
	if(is_category()) {
		return $background_url = get_field( 'banner' , THEME_OPTION_KEY )[  'category' ];
	}
	elseif(is_single()) {
		return $background_url = get_field( 'banner' , THEME_OPTION_KEY )[  'post' ];
	}
	elseif(is_404()) {
		return $background_url = get_field( 'banner' , THEME_OPTION_KEY )[  'post' ];
	}
	else {
		return $background_url = get_field( 'page_banner' , get_the_ID() )[  'url' ];
	}
}

/**
 * Remove thumbnail support of post type page 
 * 
 * @return void
 * QuangTN
 */
function remove_thumbnail_support(){
    remove_post_type_support('page','thumbnail');
}
add_action('init','remove_thumbnail_support');

/**
 * get_post_pagination
 *
 * @param  [type] $query
 *
 * @return [type]
 */
function get_post_pagination($wp_query)
{
	$pagination = paginate_links([
		'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
		'total' => $wp_query->max_num_pages,
		'current' => max(1, get_query_var('paged')),
		'format' => '?paged=%#%',
		'type' => 'array',
		'prev_next' => true,
		'prev_text' => '<em class="prev"></em>',
		'next_text' => '<em class="next"></em>',
		'mid_size' => 1,
	]);

	if (!empty($pagination)) : ?>
		<div class="u-flex u-flex__justify-content--center">
			<ul class="c-pagination">
				<?php foreach ($pagination as $item) : ?>
					<li><?php echo $item; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif;
}

function get_posts_by_category_name($category_name, $numberposts)
{
	$defaults = array(
		'numberposts'      => $numberposts,
		'category_name'    => $category_name,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'include'          => array(),
		'exclude'          => array(),
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'suppress_filters' => true,
	);

	return get_posts($defaults);
}

function get_page_title() {
	$page_title         = get_field( 'page_title' , get_the_ID() );
	$page_description   = get_field( 'page_description' , get_the_ID() );

	if($page_title == '')       
	{ 
		if(is_single())             
		{ 
			$page_title = get_the_title(); 
		}
		else {
			$page_title = get_bloginfo('name');
		} 
	}
	if($page_description == '') { $page_description = get_bloginfo('description'); };
	if(is_category())           { $page_title = 'お知らせ'; } 
	if(is_404())                { $page_title = '404 NOT FOUND'; } 
	
	return $page_title;
}
