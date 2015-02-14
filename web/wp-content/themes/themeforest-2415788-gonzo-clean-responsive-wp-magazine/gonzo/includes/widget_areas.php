<?php

/* HOOKS */

//add extra fields to category edit form hook
add_action ( 'edit_category_form_fields', 'category_sidebar_field');

// save extra category extra fields hook
add_action ( 'edited_category', 'category_sidebar_save');

//register custom sidebars
add_action( 'widgets_init', 'register_theme_sidebars_dynamic' );

/* END HOOKS */

/* REGISTER DEFAULT SIDEBARS */
if ( function_exists('register_sidebar') ) {   
	register_sidebar(array(	
		'name' => 'Sidebar',	
		'before_widget' => '<li id="%1$s" class="omc-widget %2$s">',	
		'after_widget' => '</li>',	
		'before_title' => '<h3 class="widgettitle"><span>',	
		'after_title' => '</span></h3>'   
	));

}


if ( function_exists('register_sidebar') ) {   
	register_sidebar(array(	
		'name' => 'Footer Column 1',	
		'before_widget' => '<div id="%1$s" class="omc-footer-widget %2$s">',	
		'after_widget' => '</div>',	
		'before_title' => '<h4>',	
		'after_title' => '</h4>'   
	));

}


if ( function_exists('register_sidebar') ) {   
	register_sidebar(array(	
		'name' => 'Footer Column 2',	
		'before_widget' => '<div id="%1$s" class="omc-footer-widget %2$s">',	
		'after_widget' => '</div>',	
		'before_title' => '<h4>',	
		'after_title' => '</h4>'   
	));

}


if ( function_exists('register_sidebar') ) {   
	register_sidebar(array(	
		'name' => 'Footer Column 3',	
		'before_widget' => '<div id="%1$s" class="omc-footer-widget %2$s">',	
		'after_widget' => '</div>',	
		'before_title' => '<h4>',	
		'after_title' => '</h4>'   
	));

}


if ( function_exists('register_sidebar') ) {   
	register_sidebar(array(	
		'name' => 'Footer Column 4',	
		'before_widget' => '<div id="%1$s" class="omc-footer-widget %2$s">',	
		'after_widget' => '</div>',	
		'before_title' => '<h4>',	
		'after_title' => '</h4>'   
	));

}




if ( function_exists('register_sidebar') ) {   
	register_sidebar(array(	
		'name' => 'Header Banner',	
		'before_widget' => '<div id="omc-top-banner">',	
		'after_widget' => '</div>',	
		'before_title' => '',	
		'after_title' => ''   
	));

}





/* FUNCTIONS */

/**
 * add sidebar field to category edit form callback function
 * 
 * @param  (object) $tag Term object
 * @author Ohad Raz
 * @return Void
 */
function category_sidebar_field( $tag ) {  
    $t_id = $tag->term_id;
    $cat_meta = get_option( "category_sidebars");
    $saved = '';
    //check for existing data 
    if (isset($cat_meta[$t_id]))
    	$saved = $cat_meta[$t_id];
    
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="cat_sidebar"><?php _e('Category Sidebar', 'gonzo'); ?></label></th>
		<td>
			<input type="text" name="cat_sidebar" id="cat_sidebar" size="3" style="width:60%;" value="<?php echo $saved; ?>"><br />
	        <span class="description"><?php _e('Create a sidebar for this category', 'gonzo'); ?></span>
	    </td>
	</tr>
	<?php
}



/**
 * save extra category extra fields callback function
 * 
 * @param  (int) $term_id 
 * @author Ohad Raz
 * @return Void
 */
function category_sidebar_save( $term_id ) {
    $cat_meta = get_option( "category_sidebars");
    if ( isset( $_POST['cat_sidebar'] ) && $_POST['cat_sidebar'] != '' ) {
        $cat_meta[$term_id] = $_POST['cat_sidebar'];
    }else{
    	//remove data
    	if (isset($cat_meta[$term_id]))
    		unset($cat_meta[$term_id]);
    }
    //save the option array
    update_option( "category_sidebars$t_id", $cat_meta);
}


/**
 * Register all custom sidebars
 *  
 * @author Ohad Raz
 * @return Void
 */
function register_theme_sidebars_dynamic(){
    global $wpdb;
    $meta_key = 'omc_page_sidebar';
	//post and pages sidebars
	$widgetized_pages = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = %s", $meta_key));
	 
	if($widgetized_pages){
	    foreach($widgetized_pages as $w_page){
	        $widget_id = strtolower(str_replace(' ', '_', $w_page));
	        register_sidebar(array(
	            'name' => $w_page,
	            'id'   => 'jw_widgetsection_'.$widget_id,
	            'description'   => '',
	            'before_widget' => '<li id="%1$s" class="omc-widget %2$s">',
	            'after_widget' => '</li>',
	            'before_title' => '<h3 class="widgettitle"><span>',
	            'after_title' => '</span></h3>'
	        ));
	     }// For each
	}//End If

	//categories
	$widgetized_categories = get_option('category_sidebars');
	if($widgetized_categories){
	    foreach($widgetized_categories as $w_cat){
	        $widget_id = strtolower(str_replace(' ', '_', $w_cat));
	        register_sidebar(array(
	            'name' => $w_cat,
	            'id'   => 'jw_widgetsection_'.$widget_id,
	            'description'   => '',
	            'before_widget' => '<li id="%1$s" class="omc-widget %2$s">',
	            'after_widget' => '</li>',
	            'before_title' => '<h3 class="widgettitle"><span>',
	            'after_title' => '</span></h3>'
	        ));
		}// For each
	}//End If
}

/**
 * function to get the sidebar to display's name 
 * 
 * @author Ohad Raz
 * @return (string) sidebar's name
 */
function get_sidebar_name(){
    //default sidebar name
    $sidebar_name = 'Sidebar';
   	/* Get special sidebar if it exists for page/post/cpt */
   	
   	if (is_single()|| is_page() || is_singular()){
    	global $post;
        $post_custom = get_post_meta($post->ID,'omc_page_sidebar',true);
        if (!empty($post_custom)){
        	return $post_custom;
        }else{
            /*check if post category has a custom sidebar */
            $post_categories = wp_get_post_categories( $post->ID );
            foreach((array)$post_categories as $c){
                $has_sidebar = get_category_sidebar_name($c);
                if (false != $has_sidebar){
                    return $has_sidebar;
                }
            }
        }
    }elseif(is_category()){
    	/* Get special sidebar if it exists for category */
    	$term_id = get_query_var( 'cat' );
        $has_sidebar = get_category_sidebar_name($term_id);
        if (false != $has_sidebar){
            return $has_sidebar;
        }
    }//end category check

    //if we go here then return default sidebar name
    return $sidebar_name; 
}

/**
 * function to get the category or its parents sidebar to display's name 
 * 
 * @author Ohad Raz
 * @return (int) category id
 */
function get_category_sidebar_name($cat_id= null){
    if (null == $cat_id){
        return false;
    }
    $cat_sidebars = get_option('category_sidebars');
    $current_term = get_term_by( $cat_id, $cat_id, 'category');
    //if a sidebar exists for this category the return its name
    if (isset($current_term->term_id)){
        if (isset($cat_sidebars[$current_term->term_id])){
            return $cat_sidebars[$current_term->term_id];
        }else{
            //check if a custom sidebar is set to one of the categories parents
            $cat = $current_term;
            while ( $cat->parent > 0) {
                if (isset($cat_sidebars[$cat->parent]))
                    return $cat_sidebars[$cat->parent];
                else
                    $cat = get_category($cat->parent);
            }//end while
        }
    }
    return false;

}