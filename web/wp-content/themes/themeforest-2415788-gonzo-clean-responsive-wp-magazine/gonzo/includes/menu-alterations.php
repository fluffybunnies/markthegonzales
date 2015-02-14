<?php
// Add the search widget to the navigation
add_filter('wp_nav_menu_items','add_search_box', 10, 2);
function add_search_box($items, $args) {
	if( $args->theme_location == 'primary' ) {
        $items .= '<li id="omc-header-search">				
						<span id="omc-search-overlay">'. __('Search', 'gonzo') .' &rarr;</span>
						<form method="get" id="desktop-search" class="omc-search-form" action="'.get_bloginfo('url').'/">
							<input type="text" class="omc-header-search-input-box" value=""  name="s" id="fffff">
							<input type="submit" class="omc-header-search-button" id="searchsubmit" value="">
						</form>
					</li>';
 
    return $items;
	
	}
	
	// convert the mobile menu into a select dropdown
	elseif ( $args->theme_location == 'mobile' ) {
	
		$menu_name = 'mobile';

		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$menu_list = '<select id="omc-mobile-menu"><option value="#">'. __('Navigation', 'gonzo').'</option>';

		foreach ( (array) $menu_items as $key => $menu_item ) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$menu_list .= '<option value="' . $url . '">' . $title . '</option>';
		}
		$menu_list .= '</select>';
		} else {
		$menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
		}
		// $menu_list now ready to output
		
		return $menu_list;
	}
	
	elseif ( $args->theme_location == 'copyright' ) {
		
		return $items;
		
	}
	
	else {
	
		return $items;
	
	}
	
}

