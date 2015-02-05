<?php 
	global $nz_ninzio;
	include('includes/header-opt.php'); 
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html data-color="<?php echo $nz_color; ?>" class="no-js ie6 oldie btn-<?php echo $nz_button_shape; ?> btn-<?php echo $nz_button_style; ?> <?php echo $blank_class; ?>" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html data-color="<?php echo $nz_color; ?>" class="no-js ie7 oldie btn-<?php echo $nz_button_shape; ?> btn-<?php echo $nz_button_style; ?> <?php echo $blank_class; ?>" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html data-color="<?php echo $nz_color; ?>" class="no-js ie8 oldie btn-<?php echo $nz_button_shape; ?> btn-<?php echo $nz_button_style; ?> <?php echo $blank_class; ?>" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html data-color="<?php echo $nz_color; ?>" class="no-js ie9 oldie btn-<?php echo $nz_button_shape; ?> btn-<?php echo $nz_button_style; ?> <?php echo $blank_class; ?>" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html data-color="<?php echo $nz_color; ?>" class="no-js btn-<?php echo $nz_button_shape; ?> btn-<?php echo $nz_button_style; ?> <?php echo $blank_class; ?>" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- META TAGS -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- LINK TAGS -->
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php if(isset($nz_ninzio['favicon']['url'])): ?>
	<link rel="shortcut icon" href="<?php echo esc_url($nz_ninzio['favicon']['url']); ?>" type="image/x-icon" />
	<?php endif; ?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php include("includes/dynamic-styles.php"); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- general wrap start -->
<div id="gen-wrap">
	<!-- wrap start -->
	<div id="wrap" class="nz-<?php echo $nz_layout; ?>">

		<header class="<?php echo $mob_class; ?>">

			<div class="logo-toggle">

				<div class="container nz-clearfix">
		
					<?php if (!empty($nz_mob_logo)): ?>

						<div class="logo logo-mob">
							<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
								<img class="retina" src="<?php echo $nz_mob_logo; ?>" alt="<?php bloginfo('name'); ?>">
							</a>
						</div>
						
					<?php endif ?>

					<div class="sidebar-toggle" title="<?php echo __('Open sidebar',TEMPNAME); ?>">
						<span>&nbsp;</span>
						<span>&nbsp;</span>
						<span>&nbsp;</span>
					</div>

					<div class="menu-toggle" title="<?php echo __('Toggle menu',TEMPNAME); ?>">
						<span>&nbsp;</span>
						<span>&nbsp;</span>
						<span>&nbsp;</span>
					</div>

				</div>

			</div>

			<div class="header-content">

				<nav class="header-menu mob-menu nz-clearfix">
					<?php if(has_nav_menu("header-menu")){wp_nav_menu($mobarg); } ?>
				</nav>

				<?php if ($nz_mob_search == "true"): ?>
					<div class="search nz-clearfix">
						<?php get_search_form(); ?>
					</div>
				<?php endif ?>

			</div>

		</header>

		<header class="<?php echo $desk_class; ?>">

			<?php if ($nz_desk_top == "true"): ?>

				<div class="header-top">

					<div class="container nz-clearfix">

						<?php if ($nz_ninzio['desk-slogan']): ?>
							<div class="desk-slogan">
								<?php echo do_shortcode(wp_kses_post($nz_ninzio['desk-slogan'])); ?>
							</div>
						<?php endif ?>

						<?php if ($nz_desk_sl_align == "left"): ?>

							<?php if ($nz_ninzio['desk-sl'] && $nz_ninzio['desk-sl'] == 1): ?>

								<div class="social-links nz-clearfix">
									<?php get_template_part('/includes/social-links' ); ?>
								</div>
								
							<?php endif ?>

							<?php if ($nz_ninzio['desk-ls'] && $nz_ninzio['desk-ls'] == 1): ?>

								<div class="ls nz-clearfix">
									<?php do_action('icl_language_selector'); ?>
								</div>
								
							<?php endif ?>

						<?php else: ?>
							
							<?php if ($nz_ninzio['desk-ls'] && $nz_ninzio['desk-ls'] == 1): ?>

								<div class="ls nz-clearfix">
									<?php do_action('icl_language_selector'); ?>
								</div>
								
							<?php endif ?>

							<?php if ($nz_ninzio['desk-sl'] && $nz_ninzio['desk-sl'] == 1): ?>

								<div class="social-links nz-clearfix">
									<?php get_template_part('/includes/social-links' ); ?>
								</div>
								
							<?php endif ?>

						<?php endif ?>

					</div>

				</div>
				
			<?php endif ?>

			<div class="header-content">

				<div class="container nz-clearfix">

					<div class="header-cont">
		
						<?php if (!empty($nz_desk_logo)): ?>

							<div class="logo logo-desk">
								<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
									<img class="retina" src="<?php echo $nz_desk_logo; ?>" alt="<?php bloginfo('name'); ?>">
								</a>
							</div>
							
						<?php endif ?>

						<?php if (!empty($nz_fixed_logo)): ?>

							<div class="logo logo-fixed">
								<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
									<img class="retina" src="<?php echo $nz_fixed_logo; ?>" alt="<?php bloginfo('name'); ?>">
								</a>
							</div>
							
						<?php endif ?>

						<?php if (!empty($nz_stuck_logo)): ?>

							<div class="logo logo-stuck">
								<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
									<img class="retina" src="<?php echo $nz_stuck_logo; ?>" alt="<?php bloginfo('name'); ?>">
								</a>
							</div>
							
						<?php endif ?>

						<div class="sidebar-toggle" title="<?php echo __('Open sidebar',TEMPNAME); ?>">
							<span>&nbsp;</span>
							<span>&nbsp;</span>
							<span>&nbsp;</span>
						</div>

						<?php if ($nz_ninzio['desk-search'] && $nz_ninzio['desk-search'] == 1): ?>
							<div class="search-toggle icon-search2"></div>
						<?php endif ?>

						<?php if ($nz_ninzio['desk-shop-cart'] && $nz_ninzio['desk-shop-cart'] == 1): ?>

							<?php if (class_exists('Woocommerce')): ?>
								<?php global $woocommerce;?>
								<div class="cart-toggle">
									<a class="cart-contents" href="#" title="<?php echo __('View your shopping cart', TEMPNAME); ?>">
						                <span class="icon-cart2"></span>
						                <span class="cart-info"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
						            </a>
										<div class="cart-dropdown nz-clearfix">
										<?php
											if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
												the_widget( 'WC_Widget_Cart', 'title=Cart' );
											} else {
												the_widget( 'WooCommerce_Widget_Cart', 'title=Cart' );
											}
										?>
										</div>
								</div>
							<?php endif; ?>
							
						<?php endif ?>

						<nav class="header-menu desk-menu nz-clearfix">
							<?php if(has_nav_menu("header-menu")){wp_nav_menu($arg); } ?>
						</nav>

					</div>

					<?php if ($nz_ninzio['desk-search'] && $nz_ninzio['desk-search'] == 1): ?>
						<div class="search nz-clearfix">
							<?php get_search_form(); ?>
						</div>
					<?php endif ?>
							
				</div>

			</div>

		</header>