<?php

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 */
/**
* Apply Color Scheme
*/
if ( ! function_exists( 'workflow_apply_color' ) ) :
function workflow_apply_color() {
$header_text_color = get_header_textcolor();
$primary_color_1 = get_theme_mod('workflow_color_settings');
$primary_color_2 = get_theme_mod('workflow_color_settings_2');
if($header_text_color){
?>
<style>
  #logo a,
  .nav li a,
  .social-icons a,
  .nav li.current-menu-item a{
    color: <?php echo "#" . esc_attr($header_text_color,'workflow'); ?>;
  }
</style>
<?php
}
if ( get_theme_mod('workflow_color_settings') ) {
?>
<style>    
  .archive-title,
  .widgettitle,
  .footer-widgets h4,
    #main-navigation a:hover,
  #main-navigation a:focus,
  .social-icons a .fa:hover,
  .social-icons a .fa:focus{
    color: <?php echo esc_attr($primary_color_1,'workflow'); ?>;
  }
  .blog-list .item .thumb-wrap .no-bg,
   .mobile-menu #main-navigation{
    background-color: <?php echo esc_attr($primary_color_1,'workflow'); ?>;
  }
</style>
<?php
}

if ( get_theme_mod('workflow_color_settings_2') ) {
?>
<style>
  .header[role="banner"],
  .blog-list .item .meta-tags-bottom .post-link a,
  button, 
  html input[type="button"], 
  input[type="reset"], 
  input[type="submit"],
  .blue-btn,  
  #submit,
  .wp-caption,
  #main-navigation div#close,
  .nav li ul.children li a, 
  .nav li ul.sub-menu li a,
  .nav li ul.sub-menu li a:hover,
  .nav li ul.sub-menu li a:focus,
  .nav li ul.children li a:hover, 
  .nav li ul.sub-menu li a:focus{
    background-color: <?php echo esc_attr($primary_color_2,'workflow'); ?>;
  }
  .blog-list .item .thumb-wrap .meta-tags h1 a:hover,
  .blog-list .item .thumb-wrap .meta-tags h1 a:focus,
  .scrollToTop span,
  a,
  a:hover,
  a:focus,
  footer.footer[role="contentinfo"] a:hover,
  footer.footer[role="contentinfo"] a:focus,
  .blog-list .item .meta-tags-bottom .cat-tag a:hover, 
  .blog-list .item .meta-tags-bottom .cat-tag a:focus,
  .entry-content p a,
  .article-footer h3, 
  #comments-title, 
  .comment-reply-title,
  .comment-reply-link{
    color: <?php echo esc_attr($primary_color_2,'workflow'); ?>;
  }
  .entry-content blockquote{
    border-color: <?php echo esc_attr($primary_color_2,'workflow'); ?>;
  }
</style>
<?php
}

}
endif;
add_action( 'wp_head', 'workflow_apply_color' );