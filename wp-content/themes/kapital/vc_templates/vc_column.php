<?php

	extract(shortcode_atts(array(
		'width'   => '1/1',
		'animate' => 'false',
		'effect'  => 'fade-left',
		'margin_b' => 'true',
		'text_align' => 'left',
		'border_width' => '',
		'border_color' => '',
		'color'       => '',
		'back_color' => '',
		'el_class'=> '',
		'pl'=> '0',
		'pr'=> '0',
		'pt'=> '0',
		'pb'=> '0'
	), $atts));

	$output = "";
	$styles = "";
	$width  = ninzio_column_convert($width);

	if ($margin_b == "false") {
		$margin_b = 'data-margin="false"';
	} else {
		$margin_b = "";
	}

	if (isset($pl) && !empty($pl)) {$styles .= 'padding-left:'.absint($pl).'px;';}
	if (isset($pr) && !empty($pl)) {$styles .= 'padding-right:'.absint($pr).'px;';}
	if (isset($pt) && !empty($pl)) {$styles .= 'padding-top:'.absint($pt).'px;';}
	if (isset($pb) && !empty($pl)) {$styles .= 'padding-bottom:'.absint($pb).'px;';}

	if (isset($color) && !empty($color)) {
		$styles .= 'color:'.$color.';';
	}

	if (isset($back_color) && !empty($back_color)) {
		$styles .= 'background-color:'.$back_color.';';
	}

	if (isset($border_width) && !empty($border_width)) {
		if (isset($border_color) && !empty($border_color)) {
			$styles .= 'box-shadow: inset 0 0 0 '.absint($border_width).'px '.$border_color.';';
		}
	}

	$output .= '<div class="col '.$width.' '.sanitize_html_class($el_class).' col-animate-'.sanitize_html_class($animate).'" data-align="'.esc_attr($text_align).'" data-effect="'.esc_attr($effect).'" '.$margin_b.'>';
		$output .='<div class="col-inner" style="'.esc_attr($styles).'">'.do_shortcode($content).'</div>';
	$output .= '</div>';
	echo $output;
	
?>