<?php

extract(shortcode_atts(array(
    'el_class' => '',
    'collapsible' => 'no',
    'active_tab' => '1'
), $atts));

$output = '';

$output .= '<div class="nz-accordion '.sanitize_html_class($el_class).'" data-collapsible='.esc_attr($collapsible).' data-active-tab="'.esc_attr($active_tab).'">';
	$output .= wpb_js_remove_wpautop($content);
$output .= '</div> ';

echo $output;