<?php

	global $nz_ninzio, $post;

	$blank_class = "";

	/*	MIX
	/*---------------------------------*/

		$nz_layout         = ($nz_ninzio['layout'] ) ? $nz_ninzio['layout'] : "wide";
		$nz_button_style   = ($nz_ninzio['button-style']) ? $nz_ninzio['button-style'] : "normal";
		$nz_button_shape   = ($nz_ninzio['button-shape']) ? $nz_ninzio['button-shape'] : "square";
		$nz_color          = ($nz_ninzio['main-color']) ? $nz_ninzio['main-color'] : "#08ade4";

	/*	DESK
	/*---------------------------------*/

		$nz_desk_logo           = (isset($nz_ninzio['desk-logo']['url']) && !empty($nz_ninzio['desk-logo']['url'])) ? esc_url($nz_ninzio['desk-logo']['url']) : "";
		$nz_desk_sidebar        = ($nz_ninzio['sidebar'] && $nz_ninzio['sidebar'] == 1) ? "true" : "false";
		$nz_desk_height         = ($nz_ninzio['desk-height']) ? $nz_ninzio['desk-height'] : "90";
		$nz_desk_top            = ($nz_ninzio['desk-top'] && $nz_ninzio['desk-top'] == 1) ? "true" : "false";
		$nz_desk_sl             = ($nz_ninzio['desk-sl'] && $nz_ninzio['desk-sl'] == 1) ? "true" : "false";
		$nz_desk_sl_align       = ($nz_ninzio['desk-sl-align']) ? $nz_ninzio['desk-sl-align'] : "right";
		$nz_desk_ind            = ($nz_ninzio['desk-ind'] && $nz_ninzio['desk-ind'] == 1) ? "true" : "false";
		$nz_desk_ls             = ($nz_ninzio['desk-ls'] && $nz_ninzio['desk-ls'] == 1) ? "true" : "false";
		$nz_desk_fixed          = ($nz_ninzio['fixed'] && $nz_ninzio['fixed'] == 1) ? "true" : "false";
		$nz_desk_menu_effect    = ($nz_ninzio['desk-menu-effect']) ? $nz_ninzio['desk-menu-effect'] : "none";
		$nz_desk_submenu_effect = ($nz_ninzio['desk-submenu-effect']) ? $nz_ninzio['desk-submenu-effect'] : "fade";
		$nz_fixed_height        = ($nz_ninzio['fixed-height']) ? $nz_ninzio['fixed-height'] : "90";
		$nz_fixed_logo          = (isset($nz_ninzio['fixed-logo']['url']) && !empty($nz_ninzio['fixed-logo']['url'])) ? esc_url($nz_ninzio['fixed-logo']['url']) : "";
		$nz_stuck               = ($nz_ninzio['stuck'] && $nz_ninzio['stuck'] == 1) ? "true" : "false";
		$nz_stuck_top           = ($nz_ninzio['stuck-top'] && $nz_ninzio['stuck-top'] == 1) ? "true" : "false";
		$nz_stuck_height        = ($nz_ninzio['stuck-height']) ? $nz_ninzio['stuck-height'] : "90";
		$nz_stuck_logo          = (isset($nz_ninzio['stuck-logo']['url']) && !empty($nz_ninzio['stuck-logo']['url'])) ? esc_url($nz_ninzio['stuck-logo']['url']) : "";

	/*	MOB
	/*---------------------------------*/

		$nz_mob_height = ($nz_ninzio['mob-height']) ? $nz_ninzio['mob-height'] : "90";
		$nz_mob_int    = ($nz_ninzio['mob-int'] && $nz_ninzio['mob-int'] == 1) ? "true" : "false";
		$nz_mob_search = ($nz_ninzio['mob-search'] && $nz_ninzio['mob-search'] == 1) ? "true" : "false";
		$nz_mob_logo   = (isset($nz_ninzio['mob-logo']['url']) && !empty($nz_ninzio['mob-logo']['url'])) ? esc_url($nz_ninzio['mob-logo']['url']) : "";

		if (empty($nz_mob_logo)) {$nz_mob_logo = $nz_desk_logo;}

	/*---------------------------------*/

		if (is_page()) {
			$values      = get_post_custom( get_the_ID() );
			$blank       = (isset( $values['blank'][0]) && !empty($values['blank'][0])) ? $values["blank"][0] : 'false';
			$nz_stuck    = (isset( $values['header_stuck'][0]) && !empty($values['header_stuck'][0])) ? $values["header_stuck"][0] : $nz_stuck;
			$blank_class = "blank-".$blank;
		}

		if (is_home() || is_author() || is_archive() || is_day() || is_tag() || is_category() || is_month() || is_day() || is_year()) {
			$nz_stuck  = ($nz_ninzio['blog-hs'] && $nz_ninzio['blog-hs'] == 1) ? "true" : "false";
		}

		if (is_archive() && 'portfolio' == get_post_type( $post )) {
			$nz_stuck  = ($nz_ninzio['port-hs'] && $nz_ninzio['port-hs'] == 1) ? "true" : "false";
		}

		if (is_404() || is_search()) {
			$nz_stuck = "false";
		}

		if (function_exists('is_woocommerce')) {
			if (is_woocommerce()) {
				$nz_stuck  = ($nz_ninzio['shop-hs'] && $nz_ninzio['shop-hs'] == 1) ? "true" : "false";
			}
		}

		if (is_single()) {
			$values    = get_post_custom( get_the_ID() );
			$nz_stuck  = (isset( $values['header_stuck'][0]) && !empty($values['header_stuck'][0])) ? $values["header_stuck"][0] : $nz_stuck;
		}

		if (empty($nz_fixed_logo)) {$nz_fixed_logo = $nz_desk_logo;}
		if (empty($nz_stuck_logo)) {$nz_stuck_logo = $nz_desk_logo;}

	/*	HEADER ATTRS
	/*---------------------------------*/

		$mob_class  = "header mob-header";
		$mob_class .= " mob-height-".$nz_mob_height;
		$mob_class .= " mob-int-".$nz_mob_int;
		$mob_class .= " mob-sidebar-".$nz_desk_sidebar;
		$mob_class .= " mob-search-".$nz_mob_search;

		$desk_class  = "header desk";
		$desk_class .= " desk-height-".$nz_desk_height;
		$desk_class .= " desk-sl-".$nz_desk_sl;
		$desk_class .= " desk-sl-align-".$nz_desk_sl_align;
		$desk_class .= " desk-ls-".$nz_desk_ls;
		$desk_class .= " desk-di-".$nz_desk_ind;
		$desk_class .= " desk-fixed-".$nz_desk_fixed;
		$desk_class .= " fixed-height-".$nz_fixed_height;
		$desk_class .= " stuck-height-".$nz_stuck_height;
		$desk_class .= " stuck-".$nz_stuck;
		$desk_class .= " effect-".$nz_desk_menu_effect;
		$desk_class .= " sub-effect-".$nz_desk_submenu_effect;
		$desk_class .= " desk-sidebar-".$nz_desk_sidebar;
		$desk_class .= " top-".$nz_desk_top;
		$desk_class .= " stuck-top-".$nz_stuck_top;

		$mobarg = array( 
			'theme_location' => 'header-menu', 
			'depth'          => 3, 
			'container'      => false, 
			'menu_id'        => 'mob-header-menu',
			'link_before'    => '<span class="mi"></span><span class="txt">',
			'link_after'     => '</span><span class="di icon-arrow-down8"></span>'
		);

		$arg = array( 
			'theme_location' => 'header-menu', 
			'depth'          => 3, 
			'container'      => false, 
			'menu_id'        => 'header-menu',
			'link_before'    => '<span class="mi"></span><span class="txt">',
			'link_after'     => '</span><span class="di icon-arrow-down8"></span>'
		);

?>