<?php

	extract(shortcode_atts(array(
		'color'      => '',
		'back_color' => '',
		'pl'=> '0',
      'pr'=> '0',
      'pt'=> '0',
      'pb'=> '0'
	), $atts));
   
   $styles = "";
   $output = "";

   if (isset($back_color) && !empty($back_color)) {
   		$styles .= 'background-color:'.$back_color.';';
   }

   if (isset($color) && !empty($color)) {
   		$styles .= 'color:'.$color.';';
   }

   if (isset($pl) && !empty($pl)) {$styles .= 'padding-left:'.absint($pl).'px;';}
   if (isset($pr) && !empty($pl)) {$styles .= 'padding-right:'.absint($pr).'px;';}
   if (isset($pt) && !empty($pl)) {$styles .= 'padding-top:'.absint($pt).'px;';}
   if (isset($pb) && !empty($pl)) {$styles .= 'padding-bottom:'.absint($pb).'px;';}

   $output = '<div style="'.esc_attr($styles).'" class="nz-column-text nz-clearfix">'.do_shortcode($content).'</div>';
   echo $output;
	
?>