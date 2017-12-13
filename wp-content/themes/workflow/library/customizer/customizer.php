<?php
/*******************************************************************
* These are settings for the Theme Customizer in the admin panel. 
*******************************************************************/
if ( ! function_exists( 'workflow_theme_customizer' ) ) :
  function workflow_theme_customizer( $wp_customize ) {
    
  
    /* color scheme option */
    $wp_customize->add_setting( 'workflow_color_settings', array (
      'default' => '#54616f',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'workflow_color_settings', array(
      'label'    => __( 'Primary Color Scheme', 'workflow' ),
      'section'  => 'colors',
      'settings' => 'workflow_color_settings',
    ) ) );


    $wp_customize->add_setting( 'workflow_color_settings_2', array (
      'default' => '#46B349',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'workflow_color_settings_2', array(
      'label'    => __( 'Secondary Color Scheme', 'workflow' ),
      'section'  => 'colors',
      'settings' => 'workflow_color_settings_2',
    ) ) );

    
    /* logo option */
    $wp_customize->add_section( 'workflow_logo_section' , array(
      'title'       => __( 'Site Logo', 'workflow' ),
      'priority'    => 1,
      'description' => __( 'Upload a logo to replace the default site name in the header', 'workflow' ),
    ) );
    
    $wp_customize->add_setting( 'workflow_logo', array(
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'workflow_logo', array(
      'label'    => __( 'Choose your logo (ideal width is 100-350px and ideal height is 35-40)', 'workflow' ),
      'section'  => 'workflow_logo_section',
      'settings' => 'workflow_logo',
    ) ) );
    
    $wp_customize->add_setting( 'workflow_favicon', array(
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'workflow_favicon', array(
      'label'    => __( 'Choose your favicon (ideal width and height is 16x16 or 32x32)', 'workflow' ),
      'section'  => 'workflow_favicon_section',
      'settings' => 'workflow_favicon',
    ) ) );
    
    /* social media option */
    $wp_customize->add_section( 'workflow_social_section' , array(
      'title'       => __( 'Social Media Icons', 'workflow' ),
      'priority'    => 32,
      'description' => __( 'Optional media icons in the header', 'workflow' ),
    ) );
    
    $wp_customize->add_setting( 'workflow_facebook', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'workflow_facebook', array(
      'label'    => __( 'Enter your Facebook url', 'workflow' ),
      'section'  => 'workflow_social_section',
      'settings' => 'workflow_facebook',
      'priority'    => 101,
    ) ) );
  
    $wp_customize->add_setting( 'workflow_twitter', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'workflow_twitter', array(
      'label'    => __( 'Enter your Twitter url', 'workflow' ),
      'section'  => 'workflow_social_section',
      'settings' => 'workflow_twitter',
      'priority'    => 102,
    ) ) );
    
    $wp_customize->add_setting( 'workflow_google', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'workflow_google', array(
      'label'    => __( 'Enter your Google+ url', 'workflow' ),
      'section'  => 'workflow_social_section',
      'settings' => 'workflow_google',
      'priority'    => 103,
    ) ) );
    
    $wp_customize->add_setting( 'workflow_pinterest', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'workflow_pinterest', array(
      'label'    => __( 'Enter your Pinterest url', 'workflow' ),
      'section'  => 'workflow_social_section',
      'settings' => 'workflow_pinterest',
      'priority'    => 104,
    ) ) );
    
    $wp_customize->add_setting( 'workflow_linkedin', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'workflow_linkedin', array(
      'label'    => __( 'Enter your Linkedin url', 'workflow' ),
      'section'  => 'workflow_social_section',
      'settings' => 'workflow_linkedin',
      'priority'    => 105,
    ) ) );
    
    $wp_customize->add_setting( 'workflow_youtube', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'workflow_youtube', array(
      'label'    => __( 'Enter your Youtube url', 'workflow' ),
      'section'  => 'workflow_social_section',
      'settings' => 'workflow_youtube',
      'priority'    => 106,
    ) ) );
    
    $wp_customize->add_setting( 'workflow_tumblr', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'workflow_tumblr', array(
      'label'    => __( 'Enter your Tumblr url', 'workflow' ),
      'section'  => 'workflow_social_section',
      'settings' => 'workflow_tumblr',
      'priority'    => 107,
    ) ) );
    
    $wp_customize->add_setting( 'workflow_instagram', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'workflow_instagram', array(
      'label'    => __( 'Enter your Instagram url', 'workflow' ),
      'section'  => 'workflow_social_section',
      'settings' => 'workflow_instagram',
      'priority'    => 108,
    ) ) );
    
    $wp_customize->add_setting( 'workflow_flickr', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'workflow_flickr', array(
      'label'    => __( 'Enter your Flickr url', 'workflow' ),
      'section'  => 'workflow_social_section',
      'settings' => 'workflow_flickr',
      'priority'    => 109,
    ) ) );
    
    $wp_customize->add_setting( 'workflow_vimeo', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'workflow_vimeo', array(
      'label'    => __( 'Enter your Vimeo url', 'workflow' ),
      'section'  => 'workflow_social_section',
      'settings' => 'workflow_vimeo',
      'priority'    => 110,
    ) ) );
    
    $wp_customize->add_setting( 'workflow_rss', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'workflow_rss', array(
      'label'    => __( 'Enter your RSS url', 'workflow' ),
      'section'  => 'workflow_social_section',
      'settings' => 'workflow_rss',
      'priority'    => 112,
    ) ) );
    
    $wp_customize->add_setting( 'workflow_email', array (
      'sanitize_callback' => 'sanitize_email',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'workflow_email', array(
      'label'    => __( 'Enter your email address', 'workflow' ),
      'section'  => 'workflow_social_section',
      'settings' => 'workflow_email',
      'priority'    => 113,
    ) ) );

     /* author bio in posts option */
    $wp_customize->add_section( 'workflow_slider_section' , array(
      'title'       => __( 'Display Homepage Slider', 'workflow' ),
      'priority'    => 33,
      'description' => __( 'Option to Display Homepage Slider', 'workflow' ),
    ) );
    
    $wp_customize->add_setting( 'workflow_slider', array (
      'default' => true,
      'sanitize_callback' => 'workflow_sanitize_checkbox',
    ) );
    
    $wp_customize->add_control('slider', array(
      'settings' => 'workflow_slider',
      'label' => __('Display Homepage Slider', 'workflow'),
      'section' => 'workflow_slider_section',
      'type' => 'checkbox',
    ));
    

     /* author bio in posts option */
    $wp_customize->add_section( 'workflow_author_bio_section' , array(
      'title'       => __( 'Display Author Bio', 'workflow' ),
      'priority'    => 35,
      'description' => __( 'Option to disable the author bio in the posts.', 'workflow' ),
    ) );
    
    $wp_customize->add_setting( 'workflow_author_bio', array (
      'default' => true,
      'sanitize_callback' => 'workflow_sanitize_checkbox',
    ) );
    
    $wp_customize->add_control('author_bio', array(
      'settings' => 'workflow_author_bio',
      'label' => __('Display Author Bio', 'workflow'),
      'section' => 'workflow_author_bio_section',
      'type' => 'checkbox',
    ));

    /* center nav option */
    $wp_customize->add_section( 'workflow_center_nav_section' , array(
      'title'       => __( 'Centered logo and navigation', 'workflow' ),
      'priority'    => 37,
      'description' => __( 'Option to Display Logo and Navigation in the center.', 'workflow' ),
    ) );
    
    $wp_customize->add_setting( 'workflow_centered_nav', array (
      'sanitize_callback' => 'workflow_sanitize_checkbox',
    ) );
    
    $wp_customize->add_control('centered_nav', array(
      'settings' => 'workflow_centered_nav',
      'label' => __('Display Logo and Navigation in the center?', 'workflow'),
      'section' => 'workflow_center_nav_section',
      'type' => 'checkbox',
    ));
  
  }
endif;
add_action('customize_register', 'workflow_theme_customizer');


/**
 * Sanitize checkbox
 */
if ( ! function_exists( 'workflow_sanitize_checkbox' ) ) :
  function workflow_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
      return 1;
    } else {
      return '';
    }
  }
endif;

/**
 * Sanitize integer input
 */
if ( ! function_exists( 'workflow_sanitize_integer' ) ) :
  function workflow_sanitize_integer( $input ) {
    return absint($input);
  }
endif;