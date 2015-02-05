<?php

global $nz_ninzio;

/*  Excerpt max length
/*--------------------*/

    function nz_excerpt($limit) {
        
        $excerpt = get_the_excerpt();
        $limit++;

        $output = "";

        if ( mb_strlen( $excerpt ) > $limit ) {
            $subex = mb_substr( $excerpt, 0, $limit - 5 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );

            if ( $excut < 0 ) {
                $output .= mb_substr( $subex, 0, $excut );
            } else {
                $output .= $subex;
            }

            $output .= '[...]';

        } else {
            $output .= $excerpt;
        }

        return $output;
    }

/*  Excerpt more
/*-------------------*/

    function ninzio_excerpt_more() {
        global $post;
        echo '<a class="read-more" href="'. get_permalink($post->ID) . '" title="'.__("Read more about", TEMPNAME).' '.get_the_title($post->ID).'" >'.__("Read more", TEMPNAME).'<span class="icon-arrow-right9"></span></a>';
    }

/*  Simple pagination (Next & Prev Controls)
/*-------------------*/
    
    function ninzio_post_nav($post_id){
        $post_type  = (get_post_type($post_id)) ? get_post_type($post_id) : 'post';
        $prev_title = __('Previous post', TEMPNAME);
        $next_title = __('Next post', TEMPNAME);

        switch ($post_type) {
            case 'portfolio':
                $prev_title = __('Previous project', TEMPNAME);
                $next_title = __('Next project', TEMPNAME);
                break;
            case 'product':
                $prev_title = __('Previous product', TEMPNAME);
                $next_title = __('Next product', TEMPNAME);
                break;
            
            default:
                $prev_title = __('Previous post', TEMPNAME);
                $next_title = __('Next post', TEMPNAME);
                break;
        }

    ?>
        <?php if (is_single()): ?>
            <nav class="nz-clearfix ninzio-nav-single">  
              <?php previous_post_link( '%link', ''); ?>  
              <?php next_post_link( '%link', ''); ?>
            </nav>
        <?php endif ?>
    <?php }

/*  Advanced pagination (Numbered page navigation)
/*-------------------*/

    function ninzio_post_nav_num(){

        if( is_singular() ){
            return;
        }

        global $wp_query;
        $big = 99999999;

        echo "<nav class=ninzio-navigation>";
            echo paginate_links(array(
                'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
                'format'    => '?paged=%#%',
                'total'     => $wp_query->max_num_pages,
                'current'   => max(1, get_query_var('paged')),
                'show_all'  => false,
                'end_size'  => 2,
                'mid_size'  => 3,
                'prev_next' => true,
                'prev_text' => __('Prev', TEMPNAME),
                'next_text' => __('Next', TEMPNAME),
                'type'      => 'list'
            ));
        echo "</nav>";

    }
        
/*  Not found
/*-------------------*/

    function ninzio_not_found($post_type){

        $output = '';

        $output .= '<p class="ninzio-not-found">';

        switch ($post_type) {

            case 'portfolio':
                $output .= __('No projects found.', TEMPNAME);
                break;

            case 'general':
                $output .= __('No search results found. Try a different search', TEMPNAME);
                break;
            
            default:
                $output .= __('No posts found.', TEMPNAME);
                break;
        }

        $output .= '</p>';

        return $output;
    }

/*  Ninzio title
/*-------------------*/

    add_filter( 'wp_title', 'filter_wp_title' );
    function filter_wp_title( $title ) {
        global $page, $paged;

        if ( is_feed() ){
            return $title;
        }
            
        $site_description = get_bloginfo( 'description' );

        $filtered_title = $title . get_bloginfo( 'name' );
        $filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
        $filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', TEMPNAME), max( $paged, $page ) ) : '';

        return $filtered_title;
    }

/*  Hex to rgba
/*-------------------*/

    function ninzio_hex_to_rgba($hex, $o) {
        $hex = (string) $hex;
        $hex = str_replace("#", "", $hex);
        $hex = array_map('hexdec', str_split($hex, 2));
        return 'rgba('.implode(",", $hex).','.$o.')';
    }

/*  Hex to rgb shade
/*-------------------*/

    function ninzio_hex_to_rgb_shade($hex, $o) {
        $hex = (string) $hex;
        $hex = str_replace("#", "", $hex);
        $hex = array_map('hexdec', str_split($hex, 2));
        $hex[0] -= $o;
        $hex[1] -= $o;
        $hex[2] -= $o;
        return 'rgb('.implode(",", $hex).')';
    }

/*  Post thumbnail based on layout
/*-------------------*/

    function ninzio_thumbnail ($layout, $post_id){

        $thumb_size = 'Ninzio-Uni';

        if (is_single()) {
                $thumb_size = 'Ninzio-Whole';
        } else {
            switch ($layout) {
                case 'large' :
                case 'medium':
                case 'small' :
                    $thumb_size = 'Ninzio-Uni';
                    break;
                    break;
                case 'full' :
                case 'standard':
                    $thumb_size = 'Ninzio-Whole';
                    break;
            }
        }

        ?>
        <?php if (has_post_thumbnail()): ?>
            <?php
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                $href            = (is_single()) ? $large_image_url[0] : get_permalink();
            ?>
            <a class="nz-more media" href="<?php echo $href; ?>">
                <div class="nz-thumbnail">
                    <?php echo get_the_post_thumbnail( $post_id, $thumb_size );?>
                    <div class="ninzio-overlay"></div>
                    <div class="post-date"><span><?php echo get_the_date("d");?></span><span><?php echo get_the_date("M");?></span></div>
                    <?php if (is_sticky($post_id)): ?>
                       <div class="post-sticky"><span class="icon-pushpin"></span></div> 
                    <?php endif ?>
                </div>
            </a>

        <?php endif ?>

    <?php }

    function ninzio_port_thumbnail ($layout, $post_id){

        $thumb_size = 'Ninzio-Uni';

        if (is_single()) {
                $thumb_size = 'Ninzio-Whole';
        } else {
            switch ($layout) {
                case 'large' :
                case 'medium':
                case 'small' :
                case 'image-grid-small':
                case 'image-grid-medium':
                case 'image-grid-large':
                case 'no-gap-grid-3':
                case 'no-gap-grid-4':
                    $thumb_size = 'Ninzio-Uni';
                    break;
                case 'full' :
                    $thumb_size = 'Ninzio-Whole';
                    break;
                case 'masonry-3':
                case 'masonry-4':
                    $thumb_size = 'full';
            }
        }

        ?>
        <?php if (has_post_thumbnail()): ?>
            <?php
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                $href            = (is_single()) ? $large_image_url[0] : get_permalink();
            ?>
            <a class="nz-more media" href="<?php echo $href; ?>">
                <div class="nz-thumbnail">
                    <?php echo get_the_post_thumbnail( $post_id, $thumb_size );?>
                    <div class="ninzio-overlay"></div>
                </div>
            </a>

        <?php endif ?>

    <?php }

/*  Post gallery
/*-------------------*/

    function ninzio_post_gallery ($layout, $post_id){

        global $nz_ninzio;
        $post_gallery_array = array();
        $thumb_size = 'Ninzio-Uni';

        if (!is_single()) {
            switch ($layout) {
                case 'large':
                case 'medium':
                case 'small' :
                $thumb_size = 'Ninzio-Uni';
                break;
                case 'full' :
                case 'standard':
                $thumb_size = 'Ninzio-Whole';
                break;
            }
        } elseif (is_single()) {
            $thumb_size = 'Ninzio-Whole';
        }

        if (class_exists('MultiPostThumbnails')) {

            if (MultiPostThumbnails::has_post_thumbnail('post', 'feature-image-2')) {
                $thumb_2 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-2', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-2', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_2);
            }

            if (MultiPostThumbnails::has_post_thumbnail('post', 'feature-image-3')) {
                $thumb_3 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-3', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-3', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_3);
            }

            if (MultiPostThumbnails::has_post_thumbnail('post', 'feature-image-4')) {
                $thumb_4 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-4', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-4', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_4);
            }

            if (MultiPostThumbnails::has_post_thumbnail('post', 'feature-image-5')) {
                $thumb_5 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-5', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-5', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_5);
            }

        }

        ?>
        <?php if (has_post_thumbnail()): ?>
            <div class="post-gallery media">
                <?php if (is_sticky($post_id)): ?>
                   <div class="post-sticky"><span class="icon-pushpin"></span></div> 
                <?php endif ?>
                <ul class="slides">
                    <li>
                        <?php
                            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                            $href            = (is_single()) ? $large_image_url[0] : get_permalink();
                        ?>
                        <a class="nz-more" data-lightbox-gallery="gallery3" href="<?php echo $href; ?>">
                            <div class="nz-thumbnail">
                                <?php echo get_the_post_thumbnail( $post_id, $thumb_size );?>
                                <div class="ninzio-overlay"></div>
                                <div class="post-date"><span><?php echo get_the_date("d");?></span><span><?php echo get_the_date("M");?></span></div>
                            </div>
                        </a>
                    </li>
                    <?php foreach ($post_gallery_array as $thumb): ?>
                        <li>
                            <?php $href2 = (is_single()) ? $thumb[1] : get_permalink(); ?>
                            <a class="nz-more" data-lightbox-gallery="gallery3" href="<?php echo $href2; ?>">
                                <div class="nz-thumbnail">
                                    <img src="<?php echo $thumb[0]; ?>" alt="<?php echo get_the_title(); ?>">
                                    <div class="ninzio-overlay"></div>
                                    <div class="post-date"><span><?php echo get_the_date("d");?></span><span><?php echo get_the_date("M");?></span></div>
                                </div>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
    <?php }

    function ninzio_port_gallery ($layout, $post_id){

        global $nz_ninzio;
        $post_gallery_array = array();
        $thumb_size = 'Ninzio-Three-Quarters';

        if (class_exists('MultiPostThumbnails')) {

            if (MultiPostThumbnails::has_post_thumbnail('portfolio', 'feature-image-2')) {
                $thumb_2 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-2', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-2', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_2);
            }

            if (MultiPostThumbnails::has_post_thumbnail('portfolio', 'feature-image-3')) {
                $thumb_3 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-3', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-3', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_3);
            }

            if (MultiPostThumbnails::has_post_thumbnail('portfolio', 'feature-image-4')) {
                $thumb_4 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-4', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-4', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_4);
            }

            if (MultiPostThumbnails::has_post_thumbnail('portfolio', 'feature-image-5')) {
                $thumb_5 = array(
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-5', $post_id, $size = $thumb_size),
                    MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'feature-image-5', $post_id, $size = 'full')
                );
                array_push($post_gallery_array, $thumb_5);
            }

        }

        ?>
        <?php if (has_post_thumbnail()): ?>
            <div class="post-gallery media">
                <ul class="slides">
                    <li>
                        <?php
                            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                            $href            = (is_single()) ? $large_image_url[0] : get_permalink();
                        ?>
                        <a class="nz-more" data-lightbox-gallery="gallery4" href="<?php echo $href; ?>">
                            <div class="nz-thumbnail">
                                <?php echo get_the_post_thumbnail( $post_id, $thumb_size );?>
                                <div class="ninzio-overlay"></div>
                            </div>
                        </a>
                    </li>
                    <?php foreach ($post_gallery_array as $thumb): ?>
                        <li>
                            <?php $href2 = (is_single()) ? $thumb[1] : get_permalink(); ?>
                            <a class="nz-more" data-lightbox-gallery="gallery4" href="<?php echo $href2; ?>">
                                <div class="nz-thumbnail">
                                    <img src="<?php echo $thumb[0]; ?>" alt="<?php echo get_the_title(); ?>">
                                    <div class="ninzio-overlay"></div>
                                </div>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
    <?php }

/*  Post format chat transcript
/*-------------------*/

    function ninzio_post_chat_format($content) {
        global $post;
        if (has_post_format('chat')) {
            $chatoutput = "<ul class=\"chat\">\n";
            $split = preg_split("/(\r?\n)+|(<br\s*\/?>\s*)+/", $content);

            foreach($split as $haystack) {
                if (strpos($haystack, ":")) {
                    $string = explode(":", trim($haystack), 2);
                    $who = strip_tags(trim($string[0]));
                    $what = strip_tags(trim($string[1]));
                    $row_class = empty($row_class)? " class=\"chat-highlight\"" : "";
                    $chatoutput = $chatoutput . "<li><span class='name'>$who</span><p>$what</p></li>\n";
                } else {
                    $chatoutput = $chatoutput . $haystack . "\n";
                }
            }

            $content = $chatoutput . "</ul>\n";
            return $content;
        } else { 
            return $content;
        }
    }
    add_filter( "the_content", "ninzio_post_chat_format", 9);

/*  Column converter
/*-------------------*/

    function ninzio_column_convert( $width, $front = true ) {
        if ( preg_match( '/^(\d{1,2})\/12$/', $width, $match ) ) {
            $w = 'col'.$match[1];
        } else {
            $w = 'col';
            switch ( $width ) {
                case "1/6" :
                    $w .= '2';
                    break;
                case "1/4" :
                    $w .= '3';
                    break;
                case "1/3" :
                    $w .= '4';
                    break;
                case "1/2" :
                    $w .= '6';
                    break;
                case "2/3" :
                    $w .= '8';
                    break;
                case "3/4" :
                    $w .= '9';
                    break;
                case "5/6" :
                    $w .= '10';
                    break;
                case "1/1" :
                    $w .= '12';
                    break;
                default :
                    $w = $width;
            }
        }
        $custom = $front ? get_custom_column_class( $w ) : false;
        return $custom ? $custom : $w;
    }

/*  Breadcrumbs
/*-------------------*/

    function ninzio_breadcrumbs() {


        /* === OPTIONS === */
        $text['home']     = __('Home',TEMPNAME); // text for the 'Home' link
        $text['category'] = __('Archive by Category "%s"',TEMPNAME); // text for a category page
        $text['search']   = __('Search Results for "%s" Query',TEMPNAME); // text for a search results page
        $text['tag']      = __('Posts Tagged "%s"',TEMPNAME); // text for a tag page
        $text['author']   = __('Articles Posted by %s',TEMPNAME); // text for an author page
        $text['404']      = __('Error 404',TEMPNAME); // text for the 404 page

        $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
        $show_on_home   = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
        $show_title     = 1; // 1 - show the title for the links, 0 - don't show
        $delimiter      = ''; // delimiter between crumbs
        $before         = '<span class="current">'; // tag before the current crumb
        $after          = '</span>'; // tag after the current crumb
        /* === END OF OPTIONS === */

        global $post;
        $home_link    = home_url('/');
        $link_before  = '<span typeof="v:Breadcrumb">';
        $link_after   = '</span>';
        $link_attr    = ' rel="v:url" property="v:title"';
        $link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
        $parent_id    = $parent_id_2 = $post->post_parent;
        $frontpage_id = get_option('page_on_front');

        global $nz_ninzio;

        if ($nz_ninzio['breadcrumbs'] && $nz_ninzio['breadcrumbs'] == 1) {

            if (is_home() || is_front_page()) {

                if ($show_on_home == 1) {echo '<div class="nz-breadcrumbs nz-clearfix"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';}

            } else {

                echo '<div class="nz-breadcrumbs nz-clearfix" xmlns:v="http://rdf.data-vocabulary.org/#">';
                if ($show_home_link == 1) {
                    echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
                    if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
                }

                if ( is_category() ) {
                    $this_cat = get_category(get_query_var('cat'), false);
                    if ($this_cat->parent != 0) {
                        $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                        if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                        $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                        echo $cats;
                    }
                    if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

                } elseif ( is_search() ) {
                    echo $before . sprintf($text['search'], get_search_query()) . $after;

                } elseif ( is_day() ) {
                    echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                    echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
                    echo $before . get_the_time('d') . $after;

                } elseif ( is_month() ) {
                    echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                    echo $before . get_the_time('F') . $after;

                } elseif ( is_year() ) {
                    echo $before . get_the_time('Y') . $after;

                } elseif ( is_single() && !is_attachment() ) {
                    if ( get_post_type() != 'post' ) {
                        $post_type = get_post_type_object(get_post_type());
                        $slug = $post_type->rewrite;
                        $label = $post_type->labels->singular_name;
                        if ($slug['slug'] == 'product') {
                            $label = __('Shop',TEMPNAME);
                            echo '<span>'.$label.'</span>';
                        } else {
                            printf($link, $home_link . $slug['slug'] . '/', $label); 
                        }
                        if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
                    } else {
                        $cat = get_the_category(); $cat = $cat[0];
                        $cats = get_category_parents($cat, TRUE, $delimiter);
                        if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                        $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                        echo $cats;
                        if ($show_current == 1) echo $before . get_the_title() . $after;
                    }

                } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $label = $post_type->labels->singular_name;
                    if ($slug['slug'] == 'product') {
                        $label = __('Shop',TEMPNAME);
                        echo '<span>'.$label.'</span>';
                    } else {
                        echo $before . $label . $after;
                    }
                } elseif ( is_attachment() ) {
                    $parent = get_post($parent_id);
                    $cat = get_the_category($parent->ID); $cat = $cat[0];
                    if ($cat) {
                        $cats = get_category_parents($cat, TRUE, $delimiter);
                        $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                        $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                        if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                        echo $cats;
                    }
                    printf($link, get_permalink($parent), $parent->post_title);
                    if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

                } elseif ( is_page() && !$parent_id ) {
                    if ($show_current == 1) echo $before . get_the_title() . $after;

                } elseif ( is_page() && $parent_id ) {
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs = array();
                        while ($parent_id) {
                            $page = get_page($parent_id);
                            if ($parent_id != $frontpage_id) {
                                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                            }
                            $parent_id = $page->post_parent;
                        }
                        $breadcrumbs = array_reverse($breadcrumbs);
                        for ($i = 0; $i < count($breadcrumbs); $i++) {
                            echo $breadcrumbs[$i];
                            if ($i != count($breadcrumbs)-1) echo $delimiter;
                        }
                    }
                    if ($show_current == 1) {
                        if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
                        echo $before . get_the_title() . $after;
                    }

                } elseif ( is_tag() ) {
                    echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

                } elseif ( is_author() ) {
                    global $author;
                    $userdata = get_userdata($author);
                    echo $before . sprintf($text['author'], $userdata->display_name) . $after;

                } elseif ( is_404() ) {
                    echo $before . $text['404'] . $after;

                } elseif ( has_post_format() && !is_singular() ) {
                    echo get_post_format_string( get_post_format() );
                }

                if ( get_query_var('paged') ) {
                    if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
                    echo __('Page',TEMPNAME) . ' ' . get_query_var('paged');
                    if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
                }

            }

        }

    }

?>