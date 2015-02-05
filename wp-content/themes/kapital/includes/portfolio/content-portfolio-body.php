<?php

	global $nz_ninzio;				
	$nz_solo_layout    = "false";
	$nz_port_sidebar        = ($nz_ninzio['port-wa']) ? $nz_ninzio['port-wa'] : "none";
	$nz_port_width          = ($nz_ninzio['port-width'] && $nz_ninzio['port-width'] == 1) ? "true" : "false";
	$nz_port_animation      = ($nz_ninzio['port-animation'] && $nz_ninzio['port-animation'] == 1) ? "true" : "false";
	$nz_port_layout         = ($nz_ninzio['port-layout']) ? $nz_ninzio['port-layout'] : "medium";
	$nz_port_pag            = ($nz_ninzio['port-pag'] && $nz_ninzio['port-pag'] == 1) ? "true" : "false";

	if ($nz_port_layout == "no-gap-grid-3" || $nz_port_layout == "no-gap-grid-4" || $nz_port_layout == "masonry-3" || $nz_port_layout == "masonry-4") {
		$nz_port_sidebar   = "none";
	}
	if ($nz_port_sidebar == "left" || $nz_port_sidebar == "right") {$nz_port_width = "false";}

	if (is_single()) {
		$values = get_post_custom( $post->ID );
		$nz_solo_layout    = (isset( $values['layout'][0]) && !empty($values['layout'][0]) ) ? $values["layout"][0] : "false";
	}

?>
<div class="port-layout-wrap solo-<?php echo $nz_solo_layout; ?> <?php echo $nz_port_layout; ?>">
	
	<?php if (!is_single()): ?>
		<div class="loop width-<?php echo $nz_port_width; ?>">
			<div class="container">
				<section class="content port-layout animation-<?php echo $nz_port_animation; ?> <?php echo $nz_port_layout; ?> nz-clearfix">

					<?php if ($nz_port_sidebar == "right"): ?>

						<section class="main-content left">
							<div class="nz-portfolio-posts"><?php get_template_part( '/includes/portfolio/content-portfolio-post' ); ?></div>
						</section>
						<aside class="sidebar">
							<?php get_sidebar('portfolio'); ?>
						</aside>

					<?php elseif ($nz_port_sidebar == "left"): ?>

						<aside class="sidebar">
							<?php get_sidebar('portfolio'); ?>
						</aside>
						<section class="main-content right">
							<div class="nz-portfolio-posts"><?php get_template_part( '/includes/portfolio/content-portfolio-post' ); ?></div>
						</section>
						
					<?php else: ?>
						<div class="nz-portfolio-posts"><?php get_template_part( '/includes/portfolio/content-portfolio-post' ); ?></div>
					<?php endif ?>
				</section>
			</div>
		</div>
	<?php elseif(is_single()): ?>
		<div class="container">
			<section class='content nz-clearfix'>
				<?php if ($nz_solo_layout == "false"): ?>
					<div class="single-post-top">
					<?php ninzio_post_nav($post->ID); ?>
					<?php
						$values = get_post_custom( $post->ID );
						$nz_rh = (isset( $values['rh'][0]) && !empty($values['rh'][0])) ? $values["rh"][0] : "true";
					?>
					<?php if ($nz_rh == "false"): ?>
						<?php if ( '' != get_the_title() ){ ?>
							<h2 class="post-title project-title"><?php echo get_the_title() ?></h2>
						<?php } ?>
					<?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="nz-portfolio-posts"><?php get_template_part( '/includes/portfolio/content-portfolio-post' ); ?></div>
			</section>
		</div>
	<?php endif; ?>
	<?php 
		if ($nz_port_pag == "true") {
			ninzio_post_nav_num();
		} else {
			global $query_string;
			query_posts( $query_string . '&posts_per_page=-1' );
		}
	?>
		
</div>
</div>