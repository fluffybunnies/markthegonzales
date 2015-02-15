<?php
// Create Multiple Excerpt Lengths
function wpe_module_a($length) {
    return 12;
}
function wpe_minislider($length) {
    return 25;
}
function blog_1($length) {
    return 36;
}
function blog_2($length) {
    return 20;
}
function blog_3($length) {
    return 40;
}
function module_c($length) {
    return 9;
}
function module_b($length) {
    return 20;
}


function wpe_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
 
	$output = str_replace('[&hellip', '', $output);

    echo $output;
}



?>