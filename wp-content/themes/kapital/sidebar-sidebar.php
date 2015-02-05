<aside class="main-widget-area widget-area">
<div class="sidebar-close" title="<?php echo __('Close sidebar',TEMPNAME); ?>">
	<span>&nbsp;</span>
	<span>&nbsp;</span>
</div>
<?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar('main-widget-area') ) : ?><?php endif; ?>
</aside>