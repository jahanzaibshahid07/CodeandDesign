<?php
/* Theme Name    : Awada
 * Theme Core Functions and Codes
 */
require get_template_directory() . '/functions/menu/default_menu_walker.php';
require get_template_directory() . '/functions/menu/awada_nav_walker.php';
require get_template_directory() . '/functions/custom/contact-widgets.php';
require get_template_directory() . '/functions/custom/recent-posts.php';
include get_template_directory() . '/inc/dashboard.php';
require_once get_template_directory() . '/inc/functions.php';
require_once dirname(__FILE__) . '/default_options.php';

if (!class_exists('Kirki')) {
    include_once dirname(__FILE__) . '/inc/kirki/kirki.php';
}

function awada_customizer_config()
{
    $args = array(
        'url_path'     => get_template_directory_uri() . '/inc/kirki/',
        'capability'   => 'edit_theme_options',
        'option_type'  => 'option',
        'option_name'  => 'awada_theme_options',
        'compiler'     => array(),
        'description'  => __('Visit our site for more great Products.If you like this theme please rate us 5 star', 'awada'),
    );
    return $args;
}
add_filter('kirki/config', 'awada_customizer_config');

require get_template_directory() . '/customizer.php';
add_action('after_setup_theme', 'awada_theme_setup');
$awada_theme_options = awada_theme_options();
function awada_theme_setup()
{
    global $content_width;
    //content width
    if (!isset($content_width)) {
        $content_width = 1068;
    }
    //px
    //supports featured image
    add_theme_support('post-thumbnails');
    load_theme_textdomain('awada', get_template_directory() . '/lang');
    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
        'primary'   => __('Primary menu', 'awada'),
        'secondary' => __('Footer Menu', 'awada'),
        'social'    => __('Social Links Menu', 'awada'),
    ));
    // theme support
    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');
    $args  = array('default-color' => '#ffffff', 'default-image' => '');
    $args1 = array(
        'width'             => 1350,
        'flex-height'       => true,
        'height'            => 250,
        'default-image'     => '',
        'header-text-color' => '222222',
        'wp-head-callback'  => 'awada_header_style',
    );
	// Add support for editor styles.
	add_theme_support( 'editor-styles' );
    add_editor_style('css/editor-style.css');
    add_theme_support('custom-background', $args);
    add_theme_support('custom-header', $args1);
    add_theme_support('automatic-feed-links');
    add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_theme_support('title-tag');
	add_post_type_support( 'page', 'excerpt' );
	// Enable support for selective refresh of widgets in Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );
	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );
    add_theme_support('custom-logo', array(
        'height'      => 50,
        'width'       => 150,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    // Recommend plugins
    add_theme_support('recommend-plugins', array(
        'fusion-slider'              => array(
            'name'            => 'Fusion Slider', // The plugin name.
            'active_filename' => 'fusion-slider/fusion-slider.php',
        ),
        'photo-video-gallery-master' => array(
            'name'            => 'Photo Video Gallery Master', // The plugin name.
            'active_filename' => 'photo-video-gallery-master/photo-video-gallery-master.php',
        ),
        'social-media-gallery'       => array(
            'name'            => 'Social Media Gallery', // The plugin name.
            'active_filename' => 'social-media-gallery/social-media-gallery.php',
        ),
        'coming-soon-master'         => array(
            'name'            => 'Coming Soon Master', // The plugin name.
            'active_filename' => 'coming-soon-master/coming-soon-master.php',
        ),
    ));
    add_image_size('awada_home_slider_bg_image', 1600, 600, true);
    add_image_size('awada_blog_full_thumb', 1090, 515, true);
    add_image_size('awada_blog_sidebar_thumb', 805, 350, true);
    add_image_size('awada_blog_two_sidebar_thumb', 520, 260, true);
    add_image_size('awada_blog_home_thumb', 330, 206, true);
    add_image_size('awada_recent_widget_thumb', 120, 77, true);
	add_image_size('awada_port_home_thumb', 330, 220, true);
}
if (!function_exists('awada_header_style')):
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see awada_custom_header_setup().
 */
    function awada_header_style()
{
        $header_text_color = get_header_textcolor();

        // If no custom options for text are set, let's bail.
        // get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
        if (get_theme_support('custom-header', '222222') === $header_text_color) {
            return;
        }

        // If we get this far, we have custom styles. Let's do this.
        ?>
		<style id="awada-custom-header-styles" type="text/css">
		<?php // Has the text been hidden?
        if ('blank' === $header_text_color): ?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php endif;?>
	</style>
	<?php
}
endif; // End of awada_header_style.
// Read more tag to formatting in blog page
function awada_content_more($read_more)
{
    return '<div class=""><a class="main-button" href="' . get_permalink() . '">' . __('Read More', 'awada') . '<i class="fa fa-angle-right"></i></a></div>';
}
add_filter('the_content_more_link', 'awada_content_more');
// Replaces the excerpt "more" text by a link
function awada_excerpt_more($more)
{
    return '<a href="' . get_permalink() . '" class="readmore">' . __('Read More...', 'awada') . '</a>';
}
add_filter('excerpt_more', 'awada_excerpt_more');
/*
 * Awada widget area
 */
add_action('widgets_init', 'awada_widget');
function awada_widget()
{
    /*sidebar*/
    $awada_theme_options = awada_theme_options();
    $col                 = 12 / (int) $awada_theme_options['footer_layout'];
    register_sidebar(array(
        'name'          => __('Primary Sidebar Widget Area', 'awada'),
        'id'            => 'primary-sidebar',
        'description'   => __('Right sidebar widget area', 'awada'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="title"><h2>',
        'after_title'   => '</h2></div>',
    ));
    register_sidebar(array(
        'name'          => __('Secondary Sidebar Widget Area', 'awada'),
        'id'            => 'secondary-sidebar',
        'description'   => __('Left sidebar widget area', 'awada'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="title"><h3>',
        'after_title'   => '</h3></div>',
    ));
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'awada'),
        'id'            => 'footer-widget',
        'description'   => __('Footer widget area', 'awada'),
        'before_widget' => '<div class="col-lg-' . $col . ' col-md-' . $col . ' col-sm-6 col-xs-12"><div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<div class="title"><h3>',
        'after_title'   => '</h3></div>',
    ));
}
/* Breadcrumbs  */
function awada_breadcrumbs()
{
    /* === OPTIONS === */
    $text['home']     = esc_html__('Home','awada'); // text for the 'Home' link
    $text['category'] = esc_html__('Category "%s"','awada'); // text for a category page
    $text['search']   = esc_html__('Search Results for "%s" Query','awada'); // text for a search results page
    $text['tag']      = esc_html__('Posts Tagged "%s"','awada'); // text for a tag page
    $text['author']   = esc_html__('Posted by %s','awada'); // text for an author page
    $text['404']      = esc_html__('Error 404','awada'); // text for the 404 page
    $text['page']     = esc_html__('Page %s','awada'); // text 'Page N'
    $text['cpage']    = esc_html__('Comment Page %s','awada'); // text 'Comment Page N'
    $wrap_before    = '<div class="breadcrumb pull-right" itemscope itemtype="http://schema.org/BreadcrumbList">'; // the opening wrapper tag
    $wrap_after     = '</div><!-- .breadcrumbs -->'; // the closing wrapper tag
    $sep            = '<span class="breadcrumbs__separator">&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;</span>'; // separator between crumbs
    $before         = '<span class="breadcrumbs__current">'; // tag before the current crumb
    $after          = '</span>'; // tag after the current crumb
    $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
    $show_current   = 1; // 1 - show current page title, 0 - don't show
    $show_last_sep  = 1; // 1 - show last separator, when current page title is not displayed, 0 - don't show
    /* === END OF OPTIONS === */
    global $post;
    $home_url       = home_url('/');
    $link           = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $link          .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
    $link          .= '<meta itemprop="position" content="%3$s" />';
    $link          .= '</span>';
    $parent_id      = ( $post ) ? $post->post_parent : '';
    $home_link      = sprintf( $link, $home_url, $text['home'], 1 );
    if ( is_home() || is_front_page() ) {
        if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;
    } else {
        $position = 0;
        echo $wrap_before;
        if ( $show_home_link ) {
            $position += 1;
            echo $home_link;
        }
        if ( is_category() ) {
            $parents = get_ancestors( get_query_var('cat'), 'category' );
            foreach ( array_reverse( $parents ) as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $cat = get_query_var('cat');
                echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }
        } elseif ( is_search() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $show_home_link ) echo $sep;
                echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['search'], get_search_query() ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }
        } elseif ( is_year() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_time('Y') . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;
        } elseif ( is_month() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
            elseif ( $show_last_sep ) echo $sep;
        } elseif ( is_day() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
            $position += 1;
            echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
            elseif ( $show_last_sep ) echo $sep;
        } elseif ( is_single() && ! is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $position += 1;
                $post_type = get_post_type_object( get_post_type() );
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
                if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                elseif ( $show_last_sep ) echo $sep;
            } else {
                $cat = get_the_category(); $catID = $cat[0]->cat_ID;
                $parents = get_ancestors( $catID, 'category' );
                $parents = array_reverse( $parents );
                $parents[] = $catID;
                foreach ( $parents as $cat ) {
                    $position += 1;
                    if ( $position > 1 ) echo $sep;
                    echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                }
                if ( get_query_var( 'cpage' ) ) {
                    $position += 1;
                    echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
                    echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
                } else {
                    if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                    elseif ( $show_last_sep ) echo $sep;
                }
            }
        } elseif ( is_post_type_archive() ) {
            $post_type = get_post_type_object( get_post_type() );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . $post_type->label . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }
        } elseif ( is_attachment() ) {
            $parent = get_post( $parent_id );
            $cat = get_the_category( $parent->ID ); 
            if($cat){
	            $catID = $cat[0]->cat_ID;
	            $parents = get_ancestors( $catID, 'category' );
	            $parents = array_reverse( $parents );
	            $parents[] = $catID;
	            foreach ( $parents as $cat ) {
	                $position += 1;
	                if ( $position > 1 ) echo $sep;
	                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
	            }
	            $position += 1;
	        }
            echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;
        } elseif ( is_page() && ! $parent_id ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_title() . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;
        } elseif ( is_page() && $parent_id ) {
            $parents = get_post_ancestors( get_the_ID() );
            foreach ( array_reverse( $parents ) as $pageID ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
            }
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;
        } elseif ( is_tag() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $tagID = get_query_var( 'tag_id' );
                echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }
        } elseif ( is_author() ) {
            $author = get_userdata( get_query_var( 'author' ) );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }
        } elseif ( is_404() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . $text['404'] . $after;
            elseif ( $show_last_sep ) echo $sep;
        } elseif ( has_post_format() && ! is_singular() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            echo get_post_format_string( get_post_format() );
        }
        echo $wrap_after;
    }
}

/* Blog Pagination */
if (!function_exists('awada_pagination')) {
    function awada_pagination()
    {
        global $wp_query;
        $big   = 999999999; // need an unlikely integer
        $pages = paginate_links(array(
            'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'    => '?paged=%#%',
            'current'   => max(1, get_query_var('paged')),
            'total'     => $wp_query->max_num_pages,
            'prev_next' => false,
            'type'      => 'array',
            'prev_next' => true,
            'prev_text' => '&#171;',
            'next_text' => '&#187;',
        ));
        if (is_array($pages)) {
            $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
            echo "<div class='pagination_wrapper'><ul class='pagination'>";
            foreach ($pages as $page) {
                echo "<li>$page</li>";
            }
            echo "</ul></div>";
        }
    }
}

/*** Post pagination ***/
function awada_pagination_link()
{?>
    <div class="next_prev text-center">
		<ul class="pager">
			<li class="previous"><?php previous_post_link('%link', sprintf('&laquo %s',__('Older', 'awada')));?></li>
			<li class="next"><?php next_post_link('%link', sprintf('%s &raquo;',__('Newer', 'awada')));?></li>
		</ul>
	</div><?php
}

// Enqueue Style and Script
add_action('wp_enqueue_scripts', 'awada_enqueue_style');
function awada_enqueue_style()
{
    $awada_theme_options = awada_theme_options();
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('owl-theme-default', get_template_directory_uri() . '/css/owl.theme.default.css');
	wp_enqueue_style('awada', get_stylesheet_uri());
	if ($awada_theme_options['color_scheme'] != '') {
        wp_enqueue_style('color-scheme', get_template_directory_uri() . '/css/skins/' . $awada_theme_options['color_scheme']);
    }
	wp_enqueue_style( 'awada-font-awesome', get_template_directory_uri() . '/css/all.css' );
	wp_enqueue_style('fontawesome-v4-shims', 'https://use.fontawesome.com/releases/v5.9.0/css/v4-shims.css');
    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css');
	wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl-carousel.css');
    wp_enqueue_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
    //Slider
    wp_enqueue_style('slider-style', get_template_directory_uri() . '/css/slider/slider-style.css');
    wp_enqueue_style('custom.css', get_template_directory_uri() . '/css/slider/custom.css');

    wp_enqueue_script('jquery');
    if (is_singular()) {
        wp_enqueue_script("comment-reply");
    }

    // Google Fonts
    wp_enqueue_style('PT-Sans', '//fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic');
}
add_action('wp_footer', 'awada_enqueue_in_footer');
function awada_enqueue_in_footer()
{
    $awada_theme_options = awada_theme_options();
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap.min', get_template_directory_uri() . '/js/bootstrap.js');
    wp_enqueue_script('menu', get_template_directory_uri() . '/js/menu.js');
    wp_enqueue_script('owl.carousel.min', get_template_directory_uri() . '/js/owl.carousel.js');
    wp_enqueue_script('wow.min', get_template_directory_uri() . '/js/wow.js');
    //Slider
    wp_enqueue_script('modernizr.custom', get_template_directory_uri() . '/js/slider/modernizr.custom.79639.js');
    wp_enqueue_script('jquery.ba-cond.min', get_template_directory_uri() . '/js/slider/jquery.ba-cond.js');
    wp_enqueue_script('jquery.slitslider', get_template_directory_uri() . '/js/slider/jquery.slitslider.js');

    wp_enqueue_script('jquery.prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js');
    wp_enqueue_script('jquery.fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js');
    wp_enqueue_script('jquery.mb.YTPlayer', get_template_directory_uri() . '/js/jquery.mb.YTPlayer.js', array('jquery'));
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js');
    wp_enqueue_script('masonry');
    wp_enqueue_script('imagesloaded');
    wp_localize_script('custom-js', 'screenReaderText', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'ppp'     => $awada_theme_options['home_load_post_num'],
        'noposts' => $awada_theme_options['blog_no_more_post'],
    ));

    if ($awada_theme_options['show_load_more_btn']) {
        wp_enqueue_script('load-posts', get_template_directory_uri() . '/js/load-more.js');
    }
    if (class_exists('WooCommerce')) {
        if (is_shop() || is_cart() || is_product() || is_checkout() || is_product_category()) {
            wp_enqueue_script('jquery.dcjqaccordion', get_template_directory_uri() . '/js/jquery.dcjqaccordion.js', array('jquery'));
            $dcjq = '  jQuery(".product-categories").dcAccordion({
					saveState: false,
					autoExpand: true,
					showCount: true,
				});
			jQuery(".dcjq-icon").click(function(){
				jQuery(this).toggleClass("less");
			});';
            wp_add_inline_script('jquery.dcjqaccordion', $dcjq);
        }
    }
    // Support for HTML5
    //[if lt IE 9]
    wp_enqueue_script('html5-shiv', get_template_directory_uri() . '/js/html5_shiv.js');
    wp_script_add_data('html5-shiv', 'conditional', 'lt IE 9');
    //[endif]
}
// Comment Function
function awada_comments($comments, $args, $depth)
{
    extract($args, EXTR_SKIP);
    if ('div' == $args['style']) {
        $add_below = 'comment';
    } else {
        $add_below = 'div-comment';
    }
    ?>
    <li <?php comment_class(empty($args['has_children']) ? '' : 'parent')?> id="comment-<?php comment_ID()?>">
        <article class="comment">
            <?php if ($args['avatar_size'] != 0) {
        echo get_avatar($comments, $args['avatar_size'], null, null, $arrayName = array('class' => 'img-circle comment-avatar'));
    }
    ?>
            <div class="comment-content">
            <h4 class="comment-author">
            <?php printf('%s', get_comment_author());?><small class="comment-meta"><?php printf(__('%1$s at %2$s', 'awada'), get_comment_date(), get_comment_time());?></small>
            <span class="comment-reply"><?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])));?></span>
            </h4><?php
if ($comments->comment_approved == '0') {?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'awada');?></em><br/>
        </div><?php } else {comment_text();}?>
    </div>
   </article><!-- End .comment -->
<?php
}
add_filter('comment_reply_link', 'awada_replace_reply_link_class');
function awada_replace_reply_link_class($class)
{
    $class = str_replace("class='comment-reply-link", "class='comment-reply btn btn-sm btn-primary btn-shadow", $class);
    return $class;
}

add_filter('get_avatar', 'awada_change_avatar_css');
function awada_change_avatar_css($class)
{
    $class = str_replace("class='avatar", "class='img-circle alignleft ", $class);
    return $class;
}
/* woocommerce support */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'awada_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'awada_theme_wrapper_end', 10);
function awada_theme_wrapper_start()
{
    $awada_theme_options = awada_theme_options();
    $layout              = $awada_theme_options['page_layout'];
    if ($layout == 'fullwidth') {$class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';} else { $class = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';}
    // get_template_part('breadcrumbs');
    echo '<section class="blog-wrapper">
            <div class="container">';
    if ($layout == 'leftsidebar') {get_sidebar();}
    echo '<div class="shop_wrapper ' . $class . '">
                  <div class="general_row">';
}
function awada_theme_wrapper_end()
{
    $awada_theme_options = awada_theme_options();
    $layout              = $awada_theme_options['page_layout'];
    echo '</div>
			</div>';
    if ($layout == 'rightsidebar') {get_sidebar();}
    ;
    echo '</div>
		</section>';
}

/* Ajax Load Moe posts */
add_action('wp_ajax_nopriv_awada_more_post_ajax', 'awada_more_post_ajax');
add_action('wp_ajax_awada_more_post_ajax', 'awada_more_post_ajax');

if (!function_exists('awada_more_post_ajax')) {
    function awada_more_post_ajax()
    {

        $awada_theme_options = awada_theme_options();
        $ppp                 = (isset($_POST['ppp'])) ? $_POST['ppp'] : 3;
        $offset              = (isset($_POST['offset'])) ? $_POST['offset'] : 0;
        
        /* $port_id = ($awada_theme_options['portfolio_post'] == ''?'':$awada_theme_options['portfolio_post']);
        $portfolio_id = intval($port_id); */
        
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $ppp,
            'offset'         => $offset
        );
        if (isset($awada_theme_options['home_post_cat']) && !empty($awada_theme_options['home_post_cat'])) {
            $args['category__in'] = $awada_theme_options['home_post_cat'];
        }

        $loop = new WP_Query($args);
        $out  = '';
        $i    = 1;
        if ($loop->have_posts()):
            while ($loop->have_posts()):
                $loop->the_post();

                $out .= '<div class="col-lg-4 awada-grid-item">
                <div class="blog-carousel">
                    <div class="content_entry">';
                        $img_class = array('class' => 'img-responsive full-width');
                            if (has_post_thumbnail()) {
                                $url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                                $out .= get_the_post_thumbnail(get_the_ID(),'awada_blog_home_thumb', $img_class);
                            $out .= '<div class="magnifier">
                                <div class="buttons">
                                    <a class="st" rel="bookmark" href="'.get_the_permalink().'"><i class="fa fa-link"></i></a>
                                    <a class="sf" data-gal="prettyPhoto[product-gallery]" href="'. esc_url($url).'"><i class="fa fa-expand"></i></a>
                                </div><!-- end buttons -->
                            </div><!-- end magnifier -->';
                            }
                    $out .= '</div><!-- end content_entry -->
                    <div class="blog-header">'.
                    sprintf(    '<h3><a href="%s" title="%s">%s</a></h3>', get_permalink(), the_title_attribute( 'echo=0' ), get_the_title() ).'
                        <div class="blog-meta">
                            <span><i class="fa fa-calendar"></i>'.get_the_date(get_option('date_format'), get_the_ID()).'</span>
                            <span><i class="fa fa-comment"></i>';
                            if ( comments_open() ) {
                                $num_comments = get_comments_number();
                        if ( $num_comments == 0 ) {
                            $comments = __('No Comments', 'awada');
                        } elseif ( $num_comments > 1 ) {
                            $comments = $num_comments . __(' Comments', 'awada');
                        } else {
                            $comments = __('1 Comment', 'awada');
                        }
                        $out .= '<a href="' . get_comments_link() .'">'. $comments.'</a>';
                    } else {
                        $out .=  __('Comments Off', 'awada');
                    }
                    $out .= '</span><span><i class="fa fa-user"></i> <a href="'. esc_url(get_author_posts_url(get_the_author_meta('ID'))).'">'.esc_attr(get_the_author()).'</a></span>
                        </div><!-- end blog-meta -->
                    </div><!-- end blog-header -->
                    <div class="blog-desc">
                        '.get_the_excerpt().'
                    </div><!-- end blog-desc -->
                </div>
                    <div class="awada_blog_shadow"></div>
            </div><!-- end blog-carousel -->';
        endwhile;
        endif;

        wp_reset_postdata();

        wp_die($out);
    }
}

// Add style for dashboard, overlap meta boxes on posts(editor)
add_action('admin_head', 'awada_metabox_style');
function awada_metabox_style() {
	echo '<style>
	.block-editor-writing-flow {
	height: auto;}
	</style>';
}