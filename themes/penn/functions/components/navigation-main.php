<?php
/**
 * Mega Nav Walker
 */
class Mega_Walker_Nav_Menu extends Walker_Nav_Menu {
	// Capture our parent item for a sub-menu
	private $current_item;

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

		$id_field = $this->db_fields['id'];

		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

			if ( $args[0]->has_children ) {
				// Get the count of child elements
				// Pass it as an arg.
				$children_count       = count( $children_elements[ $element->$id_field ] );
				$args[0]->child_count = $children_count;
				$args[0]->children    = $children_elements[ $element->$id_field ];
			}
		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array $args An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		global $wpdb;

		// Setup sub-menu ID
		$sub_menu_id            = $this->current_item->ID ? ' id="sub-menu-' . esc_attr( $this->current_item->ID ) . '"' : '';
		$indent                 = str_repeat( "\t", $depth );
		$sub_menu_level         = $depth + 1;
		$child_count            = property_exists( $args, 'child_count' ) ? $args->child_count : 0;
		$children_have_children = false;

		// Check if this level's children have children
		// This is done by checking if any menu posts have
		// these menu items as their parent.
		if ( $args->has_children ) {
			$child_ids = [];

			// Get all the menu item IDs for this level
			foreach ( $args->children as $child => $key ) {
				array_push( $child_ids, $key->ID );
			}

			// Prepare for an IN Select Statement
			$child_ids = implode( ',', $child_ids );

			$query = "
				SELECT COUNT(post_id) AS count
				FROM $wpdb->postmeta
				WHERE $wpdb->postmeta.meta_key = '_menu_item_menu_item_parent'
				AND $wpdb->postmeta.meta_value IN ($child_ids);
			";

			$results = $wpdb->get_results( $query, 'ARRAY_A' )[0];

			if ( $results['count'] > 0 ) {
				$children_have_children = true;
			}
		}

		$children_have_children_class = $children_have_children ? 'has-children-with-children' : '';

		$output .= "\n$indent<ul $sub_menu_id class=\"sub-menu sub-menu-level-$sub_menu_level menu-child-count-$child_count $children_have_children_class\" aria-hidden=\"true\">\n";
	}

	/**
	 * @see      Walker::start_el()
	 * @since    3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array|object $args
	 * @param int $id
	 *
	 * @internal param int $current_page Menu item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$full_width    = get_field( 'full_width', $item->ID ); // Optional, make item full width.
		$section_title = get_field( 'section_title', $item->ID );

		// Setup our parent item
		$this->current_item = $item;

		// Setup parent anchor class
		$parent_anchor_class = 'is-parent-trigger';

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		// Customize and add our parent and current classes
		$classes[] = ( $args->has_children ) ? 'is-parent' : '';
		$classes[] = ( $item->current ) ? 'is-current' : '';
		$classes[] = ( $full_width ) ? 'is-full-width' : '';
		$classes[] = ( $section_title ) ? 'has-section-title' : '';

		/**
		 * Filter the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param object $item The current menu item.
		 * @param array $args An array of {@see wp_nav_menu()} arguments.
		 * @param int $depth Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param object $item The current menu item.
		 * @param array $args An array of {@see wp_nav_menu()} arguments.
		 * @param int $depth Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $class_names;

		// If a section title is set, append value as data attribute
		if ( $section_title ) {
			$output .= " data-title='$section_title' ";
		}

		$output .= '>';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) && ! $args->has_children ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) && ! $args->has_children ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) && ! $args->has_children ? $item->url : '';

		/**
		 * Filter the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 * @type string $title Title attribute.
		 * @type string $target Target attribute.
		 * @type string $rel The rel attribute.
		 * @type string $href The href attribute.
		 * }
		 *
		 * @param object $item The current menu item.
		 * @param array $args An array of {@see wp_nav_menu()} arguments.
		 * @param int $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value      = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;

		if ( $args->has_children ) {
			$item_level   = $depth + 1;
			$item_output .= '<button' . $id . ' ' . $attributes . "class='$parent_anchor_class is-parent-trigger-level-$item_level' data-level='$item_level' ";
			$item_output .= 'type="button" aria-haspopup="true" aria-expanded="false">';
		} else {
			$item_output .= '<a' . $attributes . '>';
		}

		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ( $args->has_children ) ? '<span class="far fa-angle-right"></span></button>' : '</a>';
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param array $args An array of {@see wp_nav_menu()} arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
