<?php 
/*-----------------------------------------------------------------------------------*/
/* custom functions below */
/*-----------------------------------------------------------------------------------*/

define('workflow_THEMEURL', get_template_directory_uri());
define('workflow_IMAGES', workflow_THEMEURL.'/images'); 
define('workflow_JS', workflow_THEMEURL.'/js');
define('workflow_CSS', workflow_THEMEURL.'/css');

if(is_user_logged_in()){
  add_action( 'wp_head', 'BIGPIX_user_login' );
  function BIGPIX_user_login(){ ?>
    <style>#main-navigation{top: 30px!important;}</style>
    <?php
  }
}

add_filter( 'post_thumbnail_html', 'workflow_remove_thumbnail_dimensions', 10, 3 );
function workflow_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_filter( 'the_content', 'workflow_remove_br_gallery', 11, 2);
function workflow_remove_br_gallery($output) {
    return preg_replace('/<br style=(.*)>/mi','',$output);
}

function workflow_author_excerpt() {
      $text_limit = 100; //Words to show in author bio excerpt
      $read_more  = ""; //Read more text
      $end_of_txt = "...";
      $url_of_author  = get_author_posts_url(get_the_author_meta('ID'));
      $short_desc_author = wp_trim_words(strip_tags(
                          get_the_author_meta('description')), $text_limit, 
                          $end_of_txt);

      return $short_desc_author;
   }

function workflow_catch_that_image() {
  global $post;
  $pattern = '|<img.*?class="([^"]+)".*?/>|';
  $transformed_content = apply_filters('the_content',$post->post_content);
  preg_match($pattern,$transformed_content,$matches);
  if (!empty($matches[1])) {
    $classes = explode(' ',$matches[1]);
    $id = preg_grep('|^wp-image-.*|',$classes);
    if (!empty($id)) {
      $id = str_replace('wp-image-','',$id);
      if (!empty($id)) {
        $id = reset($id);
        $transformed_content = wp_get_attachment_url($id);  
        return $transformed_content;
      }
    }
  }
  
}

function workflow_catch_that_image_thumb() {
  global $post;
  $pattern = '|<img.*?class="([^"]+)".*?/>|';
  $transformed_content = apply_filters('the_content',$post->post_content);
  preg_match($pattern,$transformed_content,$matches);
  if (!empty($matches[1])) {
    $classes = explode(' ',$matches[1]);
    $id = preg_grep('|^wp-image-.*|',$classes);
    if (!empty($id)) {
      $id = str_replace('wp-image-','',$id);
      if (!empty($id)) {
        $id = reset($id);
        $transformed_content = wp_get_attachment_image($id,'thumbnail');  
         return $transformed_content;
      }
    }
  }
 
}

function workflow_catch_gallery_image_full()  { 
    global $post;
    $gallery = get_post_gallery( $post, false );
    if ( !empty($gallery['ids']) ) {
      $ids = explode( ",", $gallery['ids'] );
      $total_images = 0;
      foreach( $ids as $id ) {
        $link = wp_get_attachment_url( $id );
        $total_images++;
        
        if ($total_images == 1) {
          $first_img = $link;
          return $first_img;
        }
      }
    } 
}

function workflow_catch_gallery_image_thumb()  { 
    global $post;
    $gallery = get_post_gallery( $post, false );
    if ( !empty($gallery['ids']) ) {
      $ids = explode( ",", $gallery['ids'] );
      $total_images = 0;
      foreach( $ids as $id ) {
        
        $image  = wp_get_attachment_image( $id, 'thumbnail');
        $total_images++;
        
        if ($total_images == 1) {
          $first_img = $image;
          return $first_img;
        }
      }
    } 
}
/* social icons*/
function workflow_social_icons()  { 
  $social_networks = array(
      "workflow_facebook" => "fa-facebook", "workflow_twitter" => "fa-twitter", "workflow_google" => "fa-google-plus",
      "workflow_pinterest" => "fa-pinterest", "workflow_linkedin" => "fa-linkedin", "workflow_youtube" => "fa-youtube",
      "workflow_tumblr" => "fa-tumblr", "workflow_instagram" => "fa-instagram", "workflow_flickr" => "fa-flickr",
      "workflow_vimeo" => "fa-vimeo-square", "workflow_rss" => "fa-rss"
  );

  foreach ($social_networks as $key => $icon) {
     
      if (get_theme_mod( $key )): ?>
       <a href="<?php echo esc_url( get_theme_mod($key) ); ?>" class="social-tw" title="<?php echo esc_attr( get_theme_mod( $key ) ); ?>" target="_blank"><i class="fa <?php echo $icon; ?>"></i></a>
      <?php endif;
  }

  if(get_theme_mod('workflow_email')): ?>
        <a href="mailto:<?php echo esc_attr(get_theme_mod('workflow_email')); ?>" class="social-tw" title="<?php echo esc_attr( get_theme_mod('workflow_email')); ?>" target="_blank"><i class="fa fa-envelope"></i> </i></a>
  <?php endif;
}

function workflow_index_query($query) {
  if ($query->is_home() && $query->is_main_query()) {
    $query->set('post__not_in', get_option( 'sticky_posts' ));
  }
}

add_action('pre_get_posts', 'workflow_index_query');

/**
 *
 * This script will prompt the users to install the plugin required to
 * enable the "Menu Item" custom post type for magazino theme.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.3.6
 * @author     Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/library/class/class-tgm.php';

add_action( 'workflow_register', 'workflow_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the workflow library
 * and one from the .org repo.
 *
 * The variable passed to workflow_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into workflow_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function workflow_register_required_plugins() {
 
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
 
 
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Recent Posts Widget With Thumbnails',
            'slug'      => 'recent-posts-widget-with-thumbnails',
            'required'  => false,
        ),
 
    );
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'workflow-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'workflow' ),
            'menu_title'                      => __( 'Install Plugins', 'workflow' ),
            'installing'                      => __( 'Installing Plugin: %s', 'workflow' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'workflow' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' , 'workflow'), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' , 'workflow'), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' , 'workflow'), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' , 'workflow'), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' , 'workflow'), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' , 'workflow'), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' , 'workflow'), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' , 'workflow'), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' , 'workflow'),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' , 'workflow'),
            'return'                          => __( 'Return to Required Plugins Installer', 'workflow' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'workflow' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'workflow' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    workflow( $plugins, $config );
 
}
/* DON'T DELETE THIS CLOSING TAG */ ?>