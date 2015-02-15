<?php

require_once TEMPLATEPATH.'/../../../ace/misc/wordpress.php';

require_once (trailingslashit( get_template_directory() ) . 'includes/user-rating.php');

load_theme_textdomain('gonzo', trailingslashit( get_template_directory() ) . 'languages');

$locale = get_locale();
$locale_file = trailingslashit( get_template_directory() ) . "languages/$locale.php";
if (is_readable($locale_file))
    require_once($locale_file);

if (!isset($content_width)) $content_width = 900;

add_theme_support('post-thumbnails');

add_theme_support('automatic-feed-links');

register_nav_menus(array(
    'primary' => __('Primary Navigation', 'gonzo'),
    'mobile' => __('Mobile Navigation', 'gonzo'),
    'copyright' => __('Footer Copyright Menu', 'gonzo'),
    'toplevel' => __('Top Secondary Menu', 'gonzo')
));


// Calls in All scripts & styles
function load_gonzo_child_styles()
{
    if (is_admin()) return;
    
    wp_dequeue_style('main_css');
    //wp_enqueue_style('main_css', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('main_css', Ace::vres('/wp-content/uploads/x/style.css'));
}
add_action('init', 'load_gonzo_child_styles', 11);

function load_gonzo_scripts()
{
    if (is_admin()) return;

    wp_enqueue_script('jquery');
    wp_register_script('modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.0.6.min.js');
    wp_enqueue_script('modernizr');
    wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js');
    wp_enqueue_script('scripts');


}

add_action('init', 'load_gonzo_scripts');

// Calls in metabox scripts/js
function load_gonzo_metabox()
{
    if (!is_admin()) return;

    wp_enqueue_style('metabox_css_load', get_template_directory_uri() . '/includes/classes/meta-box/css/style.css');
    wp_enqueue_style('metabox_color_load', get_template_directory_uri() . '/includes/classes/meta-box/css/color.css');
    wp_register_script('metabox-js-gonzo', get_template_directory_uri() . '/includes/classes/meta-box/js/gonzo.js');
    wp_enqueue_script('metabox-js-gonzo');
    wp_register_script('metabox-js-clone', get_template_directory_uri() . '/includes/classes/meta-box/js/clone.js');
    wp_enqueue_script('metabox-js-clone');
    wp_register_script('metabox-js-color', get_template_directory_uri() . '/includes/classes/meta-box/js/color.js');
    wp_enqueue_script('metabox-js-color');

}
add_action('init', 'load_gonzo_metabox', 11);


// Enable threaded comments
function enable_threaded_comments()
{
    if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('get_header', 'enable_threaded_comments');


// Link to seperated functions
require_once (trailingslashit( get_template_directory() ) . 'includes/widget_areas.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/multiple_excerpts.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/comments.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/kreisi_pagination.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/thumbnails.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/menu-alterations.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/classes/Tax-meta-class/class-usage.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/widget-video.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/widget-facebook-fans.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/widget-latest-posts.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/widget-best-reviews.php');
/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );
/**
 * Theme Options
 */
require( trailingslashit( get_template_directory() ) . 'includes/theme-options.php' );

// Link to plugins

require_once (trailingslashit( get_template_directory() ) . 'includes/plugins/gallery-to-slideshow/gallery-to-slideshow.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/plugins/tabber-tabs-widget/tabber-tabs.php');

// Link to shortcodes
require_once (trailingslashit( get_template_directory() ) . 'includes/shortcodes/columns-shortcode.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/shortcodes/buttons-shortcode.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/shortcodes/loops-shortcode.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/shortcodes/tabs-shortcode.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/shortcodes/toggle-shortcode.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/shortcodes/infobox-shortcode.php');
require_once (trailingslashit( get_template_directory() ) . 'includes/shortcodes/embed-shortcode.php');


// Re-define meta box path and URL
define('RWMB_URL', trailingslashit(get_template_directory() . '/includes/classes/meta-box'));
define('RWMB_DIR', trailingslashit(get_template_directory() . '/includes/classes/meta-box'));

// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';

// Include the meta box definition (This is the file where you define meta boxes, see `demo/demo.php`)
include get_template_directory() . '/includes/meta-box-config.php';


// Remove image titles
add_filter('the_content', 'remove_img_titles', 1000);
add_filter('post_thumbnail_html', 'remove_img_titles', 1000);
add_filter('wp_get_attachment_image', 'remove_img_titles', 1000);

function remove_img_titles($text)
{

    // Get all title="..." tags from the html.
    $result = array();
    preg_match_all('|title="[^"]*"|U', $text, $result);

    // Replace all occurances with an empty string.
    foreach ($result[0] as $img_tag) {
        $text = str_replace($img_tag, '', $text);
    }

    return $text;
}

// Get rid of the font-size on the tagcloud widget
add_filter("widget_tag_cloud_args", 'my_tag_cloud_args');
function my_tag_cloud_args($in)
{
    return "smallest=0.9&largest=0.9&number=23&orderby=name&unit=em";
}


// Enable post thumbnail preview for custom columns
if (!function_exists('fb_AddThumbColumn') && function_exists('add_theme_support')) {

    // for post and investments

    function fb_AddThumbColumn($cols)
    {
        $cols['thumbnail'] = __('Thumbnail', 'gonzo');
        return $cols;
    }

    function fb_AddThumbValue($column_name, $post_id)
    {

        if ('thumbnail' == $column_name) {
            // thumbnail of WP 2.9
            $thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
            // image from gallery
            $attachments = get_children(array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image'));
            if ($thumbnail_id)
                $thumb = wp_get_attachment_image($thumbnail_id, 'small-square', true);
            elseif ($attachments) {
                foreach ($attachments as $attachment_id => $attachment) {
                    $thumb = wp_get_attachment_image($attachment_id, 'small-square', true);
                }
            }
            if (isset($thumb) && $thumb) {
                echo $thumb;
            } else {
                echo __('None', 'gonzo');
            }
        }
    }

    // for posts
    add_filter('manage_posts_columns', 'fb_AddThumbColumn');
    add_action('manage_posts_custom_column', 'fb_AddThumbValue', 10, 2);

    // for investments
    add_filter('manage_investments_columns', 'fb_AddThumbColumn');
    add_action('manage_investments_custom_column', 'fb_AddThumbValue', 10, 2);
}


// Replace the default ellipsis
function trim_excerpt($text)
{
    return rtrim($text, '[...]');
}

add_filter('get_the_excerpt', 'trim_excerpt');

class Description_Walker extends Walker_Nav_Menu
{
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
        $classes = empty ($item->classes) ? array() : (array)$item->classes;

        $class_names = join(
            ' '
            , apply_filters(
                'nav_menu_css_class'
                , array_filter($classes), $item
            )
        );

        !empty ($class_names)
            and $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= "<li id='menu-item-$item->ID' $class_names>";

        $attributes = '';

        !empty($item->attr_title)
            and $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
        !empty($item->target)
            and $attributes .= ' target="' . esc_attr($item->target) . '"';
        !empty($item->xfn)
            and $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
        !empty($item->url)
            and $attributes .= ' href="' . esc_attr($item->url) . '"';
        !empty($item->description)
            and $attributes .= ' id="' . esc_attr($item->description) . '"';

        // insert description for top level elements only
        // you may change this
        $description = (!empty ($item->description) and 0 == $depth)

            ? '<small class="nav_desc">' . esc_attr($item->description) . '</small>' : '';

        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = $args->before
            . "<a $attributes>"
            . $args->link_before
            . $title
            . '</a> '
            . $args->link_after
            . $description
            . $args->after;

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
            , $item_output
            , $item
            , $depth
            , $args
            , $id
        );
    }
}

// Hide the admin bar for development
//add_filter( 'show_admin_bar', '__return_false' );


add_theme_support('post-formats', array('video', 'gallery', 'audio'));

// add post-formats to posts
add_post_type_support('post', 'post-formats');


// Remove the image dimensions to make the theme responsive
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);

function remove_thumbnail_dimensions($html)
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Add social media links to the user page

function add_social_contactmethod($contactmethods)
{
    // Add Networks
    $contactmethods['twitter'] = 'Twitter URL';
    $contactmethods['facebook'] = 'Facebook URL';
    $contactmethods['linkedin'] = 'Linkedin URL';
    $contactmethods['soundcloud'] = 'Soundcloud URL';
    $contactmethods['youtube'] = 'YouTube URL';
    $contactmethods['google'] = 'Google+ URL';

    return $contactmethods;
}

add_filter('user_contactmethods', 'add_social_contactmethod', 10, 1);

function dropcap($atts, $content = null)
{
    return '<em class="omc-dropcap">' . $content . '</em>';
}

add_shortcode('dropcap', 'dropcap');


/**
 * Register AdPress Styles
 * 
 * @return bool
 */
function register_adpress_styles()
{

    if (!class_exists('wp_adpress_register_style')) {
        return false;
    }
    $gonzo_styles = array(
        'pr-468x60' => array(
            'list' => array('pr-468x60')
        ),
        'pr-728x90' => array(
            'list' => array('pr-728x90')
        ),
        'pr-125x125' => array(
            'list' => array('pr-125x125')
        ),
        'pr-300x250' => array(
            'list' => array('pr-300x250')
        ),
        'pr-300x100' => array(
            'list' => array('pr-300x100')
        ),
        'pr-misc-a' => array(
            'list' => array('pr-misc-a')
        ),
        'pr-misc-b' => array(
            'list' => array('pr-misc-b')
        ),
        'pr-misc-c' => array(
            'list' => array('pr-misc-c')
        ),
        'pr-misc-d' => array(
            'list' => array('pr-misc-d')
        ),
    );

    new wp_adpress_register_style('gonzo_468x60', 'Gonzo 468x60', $gonzo_styles['pr-468x60']);
    new wp_adpress_register_style('gonzo_728x90', 'Gonzo 728x90', $gonzo_styles['pr-728x90']);
    new wp_adpress_register_style('gonzo_125x125', 'Gonzo 125x125', $gonzo_styles['pr-125x125']);
    new wp_adpress_register_style('gonzo_300x250', 'Gonzo 300x250', $gonzo_styles['pr-300x250']);
    new wp_adpress_register_style('gonzo_300x100', 'Gonzo 300x100', $gonzo_styles['pr-300x100']);
    new wp_adpress_register_style('gonzo_misc-a', 'Gonzo Misc. A', $gonzo_styles['pr-misc-a']);
    new wp_adpress_register_style('gonzo_misc-b', 'Gonzo Misc. B', $gonzo_styles['pr-misc-b']);
    new wp_adpress_register_style('gonzo_misc-c', 'Gonzo Misc. C', $gonzo_styles['pr-misc-c']);
    new wp_adpress_register_style('gonzo_misc-d', 'Gonzo Misc. D', $gonzo_styles['pr-misc-d']);
}

/*
 * Calls the function during the init hook
 */
add_action('init', 'register_adpress_styles');

