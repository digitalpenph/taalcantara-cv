<?php
/*
 * Main Functions
*/ 

function workflow_ahoy() {

  // let's get language support going, if you need it
  load_theme_textdomain( 'workflow', get_template_directory() . '/library/translation' );

  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'workflow_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'workflow_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'use_default_gallery_style', '__return_false' ); 

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'workflow_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  workflow_theme_support();

  // adding sidebars to WordPress (these are created in functions.php)
  add_action( 'widgets_init', 'workflow_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'workflow_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'workflow_excerpt_more' );

  /************* OEMBED SIZE OPTIONS *************/

  global $content_width;
  if ( ! isset( $content_width ) ) {
  $content_width = 640;
  }

  // Thumbnail sizes
  add_image_size( 'workflow-thumb-600', 600, 150, true );
  add_image_size( 'workflow-thumb-carousel', 400, 242, true );
  add_image_size( 'workflow-slider-image', 1280, 500, true );
  add_image_size( 'workflow-thumb-image-300by300', 300, 300, true );

} /* end workflow ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'workflow_ahoy' );


/************* THUMBNAIL SIZE OPTIONS *************/


add_filter( 'image_size_names_choose', 'workflow_custom_image_sizes' );
function workflow_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'workflow-thumb-600' => '600px by 150px',
        'workflow-thumb-300' => '300px by 100px',
        'workflow-slider-image' => '1280px by 500px'
    ) );
}


/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function workflow_register_sidebars() {
  register_sidebar(array(
    'id' => 'sidebar1',
    'name' => __( 'Posts Menu Widget Area', 'workflow' ),
    'description' => __( 'The Posts Menu Widget Area.', 'workflow' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'sidebar2',
    'name' => __( 'Page Menu Widget Area', 'workflow' ),
    'description' => __( 'The Page Menu Widget Area.', 'workflow' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer-1',
    'name' => __( 'Footer Widget Area 1', 'workflow' ),
    'description' => __( 'The Footer Widget Area.', 'workflow' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer-2',
    'name' => __( 'Footer Widget Area 2', 'workflow' ),
    'description' => __( 'The Footer Widget Area.', 'workflow' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer-3',
    'name' => __( 'Footer Widget Area 3', 'workflow' ),
    'description' => __( 'The Footer Widget Area.', 'workflow' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer-4',
    'name' => __( 'Footer Widget Area 4', 'workflow' ),
    'description' => __( 'The Footer Widget Area.', 'workflow' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));





} // don't remove this bracket!


function workflow_editor_styles() {
    add_editor_style( 'workflow-editor-style.css' );
}
add_action( 'admin_init', 'workflow_editor_styles' );

if ( ! function_exists( 'workflow_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 */
function workflow_paging_nav() {
  global $wp_query;

  // Don't print empty markup if there's only one page.
  if ( $wp_query->max_num_pages < 2 )
    return;
  ?>
  <div class="next-post-pagination" role="navigation">

      <?php if ( get_previous_posts_link() ) : ?>
      <?php previous_posts_link( __( 'Newer Posts <span class="fa fa-chevron-right"></span>', 'workflow' ) ); ?>
      <?php endif; ?>
      
      <?php if ( get_next_posts_link() ) : ?>
      <?php next_posts_link( __( '<span class="fa fa-chevron-left"></span> Older Posts', 'workflow' ) ); ?>
      <?php endif; ?>

      <span class="clearfix"></span>
    </div>
  <?php
}
endif;

/************* COMMENT LAYOUT *********************/

// Comment Layout
function workflow_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="//www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=100" class="load-gravatar avatar avatar-48 photo" height="100" width="100" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'workflow' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'workflow' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'workflow' ),'  ','') ) ?>
        <br>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'workflow' )); ?> </a></time>
        <?php comment_text() ?>
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </section>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!