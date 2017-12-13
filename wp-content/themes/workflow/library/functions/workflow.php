<?php

// remove injected CSS for recent comments widget
function workflow_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function workflow_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function workflow_scripts_and_styles() {

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

		// modernizr (without media query polyfill)
		wp_enqueue_script( 'workflow-modernizr', get_template_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array('jquery'), '2.5.3', false );

		
		wp_enqueue_style( 'workflow-scroll-style', get_template_directory_uri() . '/library/css/jquery.mCustomScrollbar.css', array(), '', 'all' );
		wp_enqueue_style( 'workflow-font', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '', 'all' );
		// ie-only style sheet
		wp_enqueue_style( 'workflow-ie-only', get_template_directory_uri() . '/library/css/ie.css', array(), '' );

		// register main stylesheet
		wp_enqueue_style('workflow-fonts', '//fonts.googleapis.com/css?family=Roboto:400,100,300,400italic,500,700,900');
		wp_enqueue_style( 'workflow-stylesheet', get_template_directory_uri() . '/library/css/style.min.css', array(), '', 'all' );
		if ( is_home() ){
			wp_enqueue_style( 'workflow_slick', get_template_directory_uri() . '/library//slick/slick.css', array(), '' );
            wp_enqueue_style( 'workflow_slick_theme', get_template_directory_uri() . '/library//slick/slick-theme.css', array(), '' );
		}
		wp_enqueue_style( 'workflow-main-stylesheet', get_template_directory_uri() . '/style.css', array(), '', 'all' );

	    // comment reply script for threaded comments
	    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			  wp_enqueue_script( 'comment-reply' );
	    }

		//adding scripts file in the footer
		wp_enqueue_script( 'workflow-scroll-js', get_template_directory_uri() . '/library/js/jquery.mCustomScrollbar.concat.min.js', array('jquery'), '', true);
		wp_enqueue_script( 'workflow-js', get_template_directory_uri() . '/library/js/scripts.js', array('jquery'), '', true );

		if ( is_home() ){
			wp_enqueue_script( 'workflow_slick_js', get_template_directory_uri() . '/library//slick/slick.min.js', array(), '', true );
			wp_enqueue_script( 'workflow-scripts-home', get_template_directory_uri() . '/library/js/scripts-home.js', array('jquery'), '', true );
		}
		$wp_styles->add_data( 'workflow-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

}
/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function workflow_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );
	// default thumb size
	set_post_thumbnail_size( 600, 600 );
	
	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',    // background image default
	    'default-color' => 'ffffff',    // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	add_theme_support( 'title-tag' );

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'workflow' ),   // main nav in header
		)
	);
	$args = array(
	'default-image'          => '',
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => 'ffffff',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $args );

} /* end workflow theme support */


if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function workflow_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
    add_action( 'wp_head', 'workflow_render_title' );
    
    add_filter( 'wp_title', 'workflow_rw_title', 10, 3 );
	function workflow_rw_title( $title, $sep, $seplocation ) {
	  global $page, $paged;

	  // Don't affect in feeds.
	  if ( is_feed() ) return $title;

	  // Add the blog's name
	  if ( 'right' == $seplocation ):
	    $title .= get_bloginfo( 'name' );
	  else:
	    $title = get_bloginfo( 'name' ) . $title;
	  endif;

	  // Add the blog description for the home/front page.
	  $site_description = get_bloginfo( 'description', 'display' );

	  if ( $site_description && ( is_home() || is_front_page() ) ):
	    $title .= " {$sep} {$site_description}";
	  endif;

	  // Add a page number if necessary:
	  if ( $paged >= 2 || $page >= 2 ):
	    $title .= " {$sep} " . sprintf( __( 'Page %s', 'workflow' ), max( $paged, $page ) );
	  endif;

	  return $title;

	} // end better title

endif;



function workflow_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'workflow_more_link_scroll' );

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function workflow_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function workflow_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...<a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read ', 'workflow' ) . get_the_title($post->ID).'">'. __( 'read more', 'workflow' ) .'</a>';
}

add_action( 'wp_enqueue_media', 'workflow_mgzc_media_gallery_zero_columns' );
function workflow_mgzc_media_gallery_zero_columns(){
    add_action( 'admin_print_footer_scripts', 'workflow_mgzc_media_gallery_zero_columns_script', 999);
}
function workflow_mgzc_media_gallery_zero_columns_script(){
?>
<script type="text/javascript">
jQuery(function(){
    if(wp.media.view.Settings.Gallery){
        wp.media.view.Settings.Gallery = wp.media.view.Settings.extend({
            className: "gallery-settings",
            template: wp.media.template("gallery-settings"),
            render: function() {
                wp.media.View.prototype.render.apply( this, arguments );
                // Append an option for 0 (zero) columns if not already present...
                var $s = this.$('select.columns');
               
                   $s.find('option[value="5"]').remove();
                   $s.find('option[value="6"]').remove();
                   $s.find('option[value="7"]').remove();
                   $s.find('option[value="8"]').remove();
                   $s.find('option[value="9"]').remove();
                // Select the correct values.
                _( this.model.attributes ).chain().keys().each( this.update, this );
                return this;
            }
        });
    }
});
</script>
<?php
}

function workflow_required_function(){
	wp_link_pages(); // For theme checker purposes only
}