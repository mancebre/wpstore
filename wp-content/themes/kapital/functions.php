<?php

/*  CONSTANTAS
/*======================*/

    define( 'TEMPNAME', "kapital");
    define( 'TEMPPATH', get_template_directory_uri());
    define( 'IMAGES', TEMPPATH. "/images");

    // WPML CONSTANTAS
    define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
    define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);

/*  HANDLE EXTERNAL PLUGINS
/*======================*/
    
    add_action( 'tgmpa_register', 'ninzio_register_required_plugins' );
    function ninzio_register_required_plugins() {

        $plugins = array(

            array(
                'name'      => 'Contact Form 7',
                'slug'      => 'contact-form-7',
                'required'  => true,
            ),

            array(
                'name'      => 'Woocommerce',
                'slug'      => 'woocommerce',
                'required'  => false,
            ),

            array(
                'name'      => 'Envato WordPress Toolkit',
                'slug'      => 'envato-wordpress-toolkit-master',
                'source'    => get_template_directory() . '/plugins/envato-wordpress-toolkit-master.zip',
                'required'  => true,
                'force_activation' => true,
                'force_deactivation' => false,
                'external_url' => ''
            ),

            array(
                'name'      => 'WPBakery Visual Composer',
                'slug'      => 'js_composer',
                'source'    => get_template_directory() . '/plugins/js_composer.zip',
                'required'  => true,
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => ''
            )

        );

        $theme_text_domain = TEMPNAME;


        $config = array(
            'domain'            => $theme_text_domain,
            'default_path'      => '',                          // Default absolute path to pre-packaged plugins
            'parent_menu_slug'  => 'themes.php',                // Default parent menu slug
            'parent_url_slug'   => 'themes.php',                // Default parent URL slug
            'menu'              => 'install-required-plugins',  // Menu slug
            'has_notices'       => true,                        // Show admin notices or not
            'is_automatic'      => false,                       // Automatically activate plugins after installation or not
            'message'           => '',                          // Message to output right before the plugins table
            'strings'           => array(
                'page_title'                                => __( 'Install Required Plugins', TEMPNAME ),
                'menu_title'                                => __( 'Install Plugins', TEMPNAME ),
                'installing'                                => __( 'Installing Plugin: %s', TEMPNAME ), // %1$s = plugin name
                'oops'                                      => __( 'Something went wrong with the plugin API.', TEMPNAME ),
                'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
                'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
                'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
                'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
                'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
                'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
                'return'                                    => __( 'Return to Required Plugins Installer', TEMPNAME ),
                'plugin_activated'                          => __( 'Plugin activated successfully.', TEMPNAME ),
                'complete'                                  => __( 'All plugins installed and activated successfully. %s', TEMPNAME ), // %1$s = dashboard link
                'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
            )
        );

        tgmpa( $plugins, $config );

    }

/*  INCLUDES
/*======================*/

    if (!class_exists('MultiPostThumbnails') && file_exists( dirname( __FILE__ ) . '/includes/multi-post-thumbnails.php' ) ) {
        require_once(dirname( __FILE__ ) . '/includes/multi-post-thumbnails.php');
    }

    if (!class_exists('TGM_Plugin_Activation') && file_exists( dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php' ) ) {
        require_once(dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php');
    }

    if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/optionpanel/framework.php' ) ) {
        require_once(dirname( __FILE__ ) . '/optionpanel/framework.php' );
    }

    if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/optionpanel/config.php' ) ) {
        require_once( dirname( __FILE__ ) . '/optionpanel/config.php' );
    }

    if (defined( 'WPB_VC_VERSION' ) && file_exists( dirname( __FILE__ ) . '/plugins/js_composer.zip' ) ) {
        require_once('includes/ninzio_vc.php' );
    }

    require_once('includes/ninzio-functions.php' );
    require_once('includes/shortcodes.php' );
    require_once('includes/page-extended-options.php' );
    require_once('includes/post-extended-options.php' );
    require_once('includes/custom-ninzio-slider.php' );
    require_once('includes/custom-portfolio.php' );
    require_once('includes/widgets/custom-reglog.php' );
    require_once('includes/widgets/custom-mailchimp.php' );
    require_once('includes/widgets/custom-recent-entries.php' );
    require_once('includes/widgets/custom-flickr.php' );
    require_once('includes/widgets/custom-recent-portfolio.php' );
    require_once('includes/widgets/custom-facebook.php' );
    require_once('includes/widgets/custom-twitter.php' );

/*  THEME SUPPORTS
/*======================*/

    /*  Thumbnail support
    /*-------------------*/

        if ( function_exists( 'add_theme_support' ) ) {

            add_theme_support( 'post-thumbnails');
            add_image_size( 'Ninzio-Uni', 640, 540, true );            // Uni
            add_image_size( 'Ninzio-Half', 570, 480, true );           // Half
            add_image_size( 'Ninzio-One-Third', 370, 300, true );      // One third
            add_image_size( 'Ninzio-Three-Quarters', 870, 570, true ); // Two thirds
            add_image_size( 'Ninzio-Whole', 1170, 570, true );         // Whole

        }

        function custom_image_sizes( $sizes ) {
        
            $new_sizes = array();
            
            $added_sizes = get_intermediate_image_sizes();

            foreach( $added_sizes as $key => $value) {
                if($value != 'post-thumbnails' || $value != 'shop_thumbnail' || $value != 'shop_catalog' || $value != 'shop_single'){
                    $new_sizes[$value] = $value;
                }
            }

            $new_sizes = array_merge( $new_sizes, $sizes );
            
            return $new_sizes;
        }
        add_filter('image_size_names_choose', 'custom_image_sizes', 11, 1);

    /*  Multiple post/portfolio thumbnails
    /*-------------------*/

        if (class_exists('MultiPostThumbnails')) {

            // MultiPostThumbnails for posts

            new MultiPostThumbnails(
                array(
                    'label'     => __('2nd Featured Image', TEMPNAME),
                    'id'        => 'feature-image-2',
                    'post_type' => 'post'
                )
            );
            new MultiPostThumbnails(
                array(
                    'label'     => __('3rd Featured Image', TEMPNAME),
                    'id'        => 'feature-image-3',
                    'post_type' => 'post'
                )
            );
            new MultiPostThumbnails(
                array(
                    'label'     => __('4th Featured Image', TEMPNAME),
                    'id'        => 'feature-image-4',
                    'post_type' => 'post'
                )
            );
            new MultiPostThumbnails(
                array(
                    'label'     => __('5th Featured Image', TEMPNAME),
                    'id'        => 'feature-image-5',
                    'post_type' => 'post'
                )
            );


            // MultiPostThumbnails for portfolio

            new MultiPostThumbnails(
                array(
                    'label'     => __('2nd Featured Image', TEMPNAME),
                    'id'        => 'feature-image-2',
                    'post_type' => 'portfolio'
                )
            );
            new MultiPostThumbnails(
                array(
                    'label'     => __('3rd Featured Image', TEMPNAME),
                    'id'        => 'feature-image-3',
                    'post_type' => 'portfolio'
                )
            );
            new MultiPostThumbnails(
                array(
                    'label'     => __('4th Featured Image', TEMPNAME),
                    'id'        => 'feature-image-4',
                    'post_type' => 'portfolio'
                )
            );
            new MultiPostThumbnails(
                array(
                    'label'     => __('5th Featured Image', TEMPNAME),
                    'id'        => 'feature-image-5',
                    'post_type' => 'portfolio'
                )
            );
        }

    /*  Enable shorcodes in widgets
    /*-------------------*/

        add_filter('widget_text', 'do_shortcode');

    /*  HTML5 gallery and caption support (3.9 addition)
    /*-------------------*/

        add_theme_support( 'html5', array( 'gallery', 'caption' ) );

    /*  Content width
    /*-------------------*/

        if ( ! isset( $content_width ) ) {
            $content_width = 1200;
        }

    /*  Enable excerpt for pages
    /*-------------------*/

        add_action('init', 'page_excerpt');
        function page_excerpt() {
            add_post_type_support( 'page', 'excerpt' );
        }

    /*  Enable post formats for posts
    /*-------------------*/

        add_theme_support( 'post-formats', array( 'aside', 'audio', 'video', 'image', 'gallery', 'link', 'quote', 'status', 'chat') );
        add_post_type_support( 'post', 'post-formats' );

    /*  Enable automatic feed links
    /*-------------------*/

        add_theme_support( 'automatic-feed-links' );

    /*  Flush rewrite rules
    /*-------------------*/

        add_action( 'after_switch_theme', 'ninzio_flush_rewrite_rules' );
        function ninzio_flush_rewrite_rules() {
             flush_rewrite_rules();
        }

    /*  Languages
    /*-------------------*/

        add_action('after_setup_theme', 'ninzio_language_setup');
        function ninzio_language_setup(){
            load_theme_textdomain(TEMPNAME, get_template_directory() . '/languages');
        }

    /*  Menu
    /*-------------------*/

        function ninzio_register_menu() {

            register_nav_menus(
                array(
                  'header-menu'      => __( 'Header Menu', TEMPNAME ),
                  'one-page-bullets' => __( 'One Page Bullets', TEMPNAME ),
                  'footer-menu'      => __( 'Footer Menu', TEMPNAME )
                )
            );
          
        }
        add_action( 'after_setup_theme', 'ninzio_register_menu' );

    /*  Sidebar
    /*-------------------*/

        if ( function_exists( 'register_sidebar' ) ){

            register_sidebar( 
                array (
                'name'          => __( 'Main sidebar', TEMPNAME),
                'id'            => 'main-widget-area',
                'description'   => __('Main widget area', TEMPNAME),
                'class'         => 'main-widget-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h6 class="widget_title">',
                'after_title'   => '</h6>' )
            );

            register_sidebar( 
                array (
                'name'          => __( 'Blog sidebar', TEMPNAME),
                'id'            => 'blog-widget-area',
                'description'   => __('Main widget area', TEMPNAME),
                'class'         => 'blog-widget-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h6 class="widget_title">',
                'after_title'   => '</h6>' )
            );

            register_sidebar( 
                array (
                'name'          => __( 'Portfolio sidebar', TEMPNAME),
                'id'            => 'portfolio-widget-area',
                'description'   => __('Portfolio widget area', TEMPNAME),
                'class'         => 'portfolio-widget-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h6 class="widget_title">',
                'after_title'   => '</h6>' )
            );

            register_sidebar( 
                array (
                'name'          => __( 'Shop sidebar', TEMPNAME),
                'id'            => 'shop-widget-area',
                'description'   => __('Shop widget area', TEMPNAME),
                'class'         => 'shop-widget-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h6 class="widget_title">',
                'after_title'   => '</h6>' )
            );

            for ($i=1; $i < 4; $i++) { 
                register_sidebar( 
                    array (
                    'name'          => __( 'Page sidebar #'.$i, TEMPNAME),
                    'id'            => 'page-widget-area-'.$i,
                    'description'   => __('Page widget area', TEMPNAME),
                    'class'         => 'page-widget-area',
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h6 class="widget_title">',
                    'after_title'   => '</h6>' )
                );
            }

            register_sidebar( 
                array (
                'name'          => __( 'Footer sidebar', TEMPNAME),
                'id'            => 'footer-widget-area',
                'description'   => __('Footer widget area', TEMPNAME),
                'class'         => 'footer-widget-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h6 class="widget_title">',
                'after_title'   => '</h6>' )
            );

        }

    /*  WooCommerce
    /*-------------------*/

        global $pagenow;
        if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'nz_woo_img', 1 );

        function nz_woo_img() {
            $catalog = array(
                'width'     => '570',
                'height'    => '480',
                'crop'      => 1
            );
            $single = array(
                'width'     => '600',
                'height'    => '640',
                'crop'      => 1
            );
            $thumbnail = array(
                'width'     => '100',
                'height'    => '100',
                'crop'      => 1 
            );

            update_option( 'shop_catalog_image_size', $catalog );
            update_option( 'shop_single_image_size', $single );
            update_option( 'shop_thumbnail_image_size', $thumbnail );
        }


        //change the position of add to cart
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
        add_action('woocommerce_before_shop_loop_item_title', 'nz_procut_thumb_cart_before', 10 );
        add_action('woocommerce_after_shop_loop_item_title', 'nz_procut_thumb_cart_after', 10 );

        function nz_procut_thumb_cart_before() { ?>
            <div class="product-wrap">
                <div class="product-body">
                    <div class="nz-thumbnail">
                        <?php echo woocommerce_get_product_thumbnail();?>
                        <div class="ninzio-overlay"></div>
                    </div>
                    <div class="product-det">

        <?php 
        }

        function nz_procut_thumb_cart_after() { ?>
                        <div class="ninzio-card-wrapper">
                            <?php woocommerce_get_template( 'loop/add-to-cart.php' ); ?>
                            <div class="shop-loader">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>

        <?php 
        }

        //change the product-category structure
        add_action('woocommerce_before_subcategory_title', 'nz_procut_cat_thumb_start', 5 );
        add_action('woocommerce_before_subcategory_title', 'nz_procut_cat_thumb_end', 10 );
        add_action('woocommerce_after_subcategory_title', 'nz_procut_cat_thumb_end2', 10 );

        function nz_procut_cat_thumb_start() { ?>
            
           <div class="product-body">
                <div class="nz-thumbnail">
                    <div class="ninzio-overlay"></div>
        <?php 
        }

        function nz_procut_cat_thumb_end() { ?>
                </div>
                <div class="product-det cat-det">
        <?php 
        }

        function nz_procut_cat_thumb_end2() { ?>
                </div>
           </div>
        <?php 
        }

        // Ensure cart contents update when products are added to the cart via AJAX
        add_filter('add_to_cart_fragments', 'nz_add_to_cart');
        function nz_add_to_cart( $fragments ) {
            
            global $woocommerce;
            ob_start(); ?>
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
            <?php

            $fragments['a.cart-contents'] = ob_get_clean();
            return $fragments;

        }

        // insert tabs in summary
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
        add_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 1);  

        //wrap single product image in column div
        add_action( 'woocommerce_before_single_product_summary', 'ninzio_column_open_div', 2);
        add_action( 'woocommerce_before_single_product_summary', 'ninzio_column_close_div', 20);
        add_action( 'woocommerce_after_single_product_summary',  'ninzio_clearfix_div', 2);

        function ninzio_column_open_div(){ echo "<div class='single-product-image'>";}
        function ninzio_column_close_div(){echo "</div><div class='single-product-summary'>";}
        function ninzio_clearfix_div(){echo '</div><div class="nz-clearfix"></div>';}

        //remove wooCommerce prettyPhoto
        global $woocommerce;
        if($woocommerce) {
            
            function ninzio_remove_pretty_photo(){
                wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
                wp_dequeue_style( 'woocommerce_chosen_styles' );
                wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
                wp_dequeue_script( 'prettyPhoto-init' );
                wp_dequeue_script( 'prettyPhoto' );
                wp_dequeue_script( 'wc-chosen' );
            }
            
            add_action( 'wp_enqueue_scripts', 'ninzio_remove_pretty_photo', 99 );

            global $nz_ninzio;

            if ($nz_ninzio['shop-rp'] == 0) {
                // remove related products
                remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
            }

        }

        // related products number
        function woo_related_products_limit() {
          global $product, $nz_ninzio;

            $posts_per_page = ($nz_ninzio['shop-rpn']) ? $nz_ninzio['shop-rpn'] : 4;
            
            $args = array(
                'post_type'             => 'product',
                'no_found_rows'         => 1,
                'posts_per_page'        => $posts_per_page,
                'ignore_sticky_posts'   => 1,
                'orderby'               => 'rand',
                'post__not_in'          => array($product->id)
            );
            return $args;
        }
        add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );
        add_theme_support( 'woocommerce' );

        add_filter( 'woocommerce_enqueue_styles', '__return_false' );

    /*  Custom file upload mime types
    /*-------------------*/

        add_filter('upload_mimes', 'ninzio_custom_upload_mimes');
        function ninzio_custom_upload_mimes ( $existing_mimes=array() ) {
            $existing_mimes['ttf']  = 'application/x-font-ttf';
            $existing_mimes['otf']  = 'application/x-font-opentype';
            $existing_mimes['woff'] = 'application/font-woff';
            $existing_mimes['svg']  = 'image/svg+xml';
            $existing_mimes['eot']  = 'application/vnd.ms-fontobject';
            return $existing_mimes;
        }

    /*  Visual Composer
    /*-------------------*/

        if(function_exists('vc_set_as_theme')) vc_set_as_theme();

/*  STYLES
/*======================*/
    
    function ninzio_add_menu_icons_styles(){
    ?>
    <style>
        #adminmenu .menu-icon-portfolio div.wp-menu-image:before {content: "\f322";}
        #adminmenu .menu-icon-ninzio-slider div.wp-menu-image:before {content: "\f233"; }
    </style>
    <?php
    }
    add_action( 'admin_head', 'ninzio_add_menu_icons_styles' );

/*  SCRIPTS
/*======================*/

    function ninzio_script()
    {
        if(!is_admin())
        {
            
            global $nz_ninzio;

            if($nz_ninzio['google-api']) {
                wp_enqueue_script( 'gmap', 'https://maps.googleapis.com/maps/api/js?key='.esc_attr($nz_ninzio['google-api']).'&sensor=true', array(), '', false);
            }

            wp_enqueue_script( 'modernizr', TEMPPATH . '/js/modernizr.js', array(), false);
            wp_enqueue_script( 'easing', TEMPPATH . '/js/jquery.easing.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'lightbox', TEMPPATH . '/js/nivo-lightbox.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'mobileEvents', TEMPPATH . '/js/jquery.mobile-events.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'owlCarousel', TEMPPATH . '/js/owl.carousel.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'imagesloaded', TEMPPATH . '/js/imagesloaded.pkgd.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'ninzioslider', TEMPPATH . '/js/jquery.ninzio-slider.js', array('jquery'), '', true);
            wp_enqueue_script( 'easy-pie-chart', TEMPPATH . '/js/jquery.easy-pie-chart.js', array('jquery'), '', true);
            wp_enqueue_script( 'animateColors', TEMPPATH . '/js/jquery.animate-colors-min.js', array('jquery'), '', true);
            wp_enqueue_script( 'shuffle', TEMPPATH . '/js/jquery.shuffle.js', array('jquery'), '', true);
            wp_enqueue_script( 'inview', TEMPPATH . '/js/jquery.inview.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'fs', TEMPPATH . '/js/jquery.flexslider.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'slick', TEMPPATH . '/js/slick.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'mousewheel', TEMPPATH . '/js/jquery.mousewheel.js', array('jquery'), '', true);
            wp_enqueue_script( 'perfect-scrollbar', TEMPPATH . '/js/perfect-scrollbar.min.js', array('jquery'), '', true);
            if ($nz_ninzio['smooth-scroll'] && $nz_ninzio['smooth-scroll'] == 1) {
                wp_enqueue_script( 'smoothscroll', TEMPPATH . '/js/smoothscroll.js', array('jquery'), '', true);
            }
            wp_enqueue_script( 'single-page-nav', TEMPPATH . '/js/jquery.singlePageNav.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'controller', TEMPPATH . '/js/controller.js', array('jquery'), '', true);
        }  
    
    }
    add_action( 'wp_enqueue_scripts', 'ninzio_script' );

/* ADMIN STYLES/SCRIPTS
/*======================*/

    function admin_scripts_styles() {
        wp_enqueue_script( 'ninzio-admin', TEMPPATH . '/js/admin-scripts.js', array('jquery'), '', true);
        wp_enqueue_style( 'admin-styles', TEMPPATH . '/css/admin-styles.css', array(), '', 'all' );
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'jquery-ui-spinner' );
        wp_enqueue_script( 'jquery-ui-sortable' );
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
        wp_enqueue_media();

        return;
    }
    add_action('admin_enqueue_scripts','admin_scripts_styles');

    /* REMOVE PRICES */
    // remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    // remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
    /* END REMOVE PRICES */

    /**
     * Change Add To Cart Text
     */
    add_filter( 'add_to_cart_text', 'woo_custom_cart_button_text' ); // < 2.1
    add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_cart_button_text' ); // 2.1 +

    function woo_custom_cart_button_text_1() {

        return __( 'Enquire', 'woocommerce' );

    }

    add_filter( 'add_to_cart_text', 'woo_custom_cart_button_text' ); // < 2.1
    add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' ); // 2.1 +

    function woo_custom_cart_button_text() {

        return __( 'Enquire', 'woocommerce' );
    }

?>