<?php

extract(shortcode_atts(array(
	'title' => '',
	'open'  => 'false'
), $atts));

$output = '';

if($open == 'true'){
	$open = "active";
}

$output .= '<div class="'.sanitize_html_class($open).' toggle-title nz-clearfix">';
	$output .= '<span class="toggle-title-header">'.sanitize_title($title).'</span><span class="arrow icon-plus4"></span>';
$output .= '</div> ';
$output .= '<div id="'.sanitize_title($title).'" class="toggle-content nz-clearfix">';
    $output .= wpb_js_remove_wpautop($content);
$output .= '</div>';

echo $output;