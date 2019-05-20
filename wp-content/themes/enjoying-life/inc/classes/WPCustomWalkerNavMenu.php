<?php
/**
 * Class WPCustomWalkerNavMenu
 *
 * @package shinseikai
 * @author HiepTT
 */

class WPCustomWalkerNavMenu extends Walker_Nav_Menu {
	/**
	 * @param string $output
	 * @param int $depth
	 * @param array $args
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// Depth-dependent classes
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// Build HTML for output.
		$output .= "\n" . $indent . '<ul>' . "\n";
	}

	/**
	 * @param string $output
	 * @param WP_Post $item
	 * @param int $depth
	 * @param array $args
	 * @param int $id
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent       = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
		$classes      = $item->classes;
		$has_children = in_array( 'menu-item-has-children', $classes );
		$is_active    = in_array( 'current_page_item', $classes ) || in_array( 'current-menu-item', $classes );

		// Build HTML.
		if ( $has_children ) {
			if ( $is_active ) {
				$output .= $indent . '<li class="active submenu">';
			} 
			else {
				$output .= $indent . '<li class="submenu">';
			}
		}
		else {
			if ( $is_active ) {
				$output .= $indent . '<li class="active">';
			} 
			else {
				$output .= $indent . '<li>';
			}			
		}

		// Link attributes.
		$attributes = ! empty( $item->title ) ? ' title="' . esc_attr( $item->title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes .= 'id="menu-item-' . $item->ID . '"';

		if ( $has_children ) {
			$attributes .= 'class="show-submenu"';			

		} else  {
			$attributes .= 'class="c-sub__menu" data-parent-id="' . $item->menu_item_parent . '"';
		}


		// Build HTML output and pass through the proper filter.
		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);
		$output      .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
