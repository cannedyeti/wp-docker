<?php

// START CUSTOMIZER
function prr_custom_register( $wp_customize ) {
  $wp_customize->add_section('prr_header_settings', array(
    'title'   => 'PRR Header Settings'
  ));

  $wp_customize->add_setting('header_color', array(
    'default'  => '#ffffff',
  ));


  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
        'label'      => __( 'Header Color', 'gesso' ),
        'section'    => 'prr_header_settings',
      )
  ));

//   $wp_customize->add_setting('site_image', array(
//     'type' => 'theme_mod',
//     'capability' => 'edit_theme_options',
//     'sanitize_callback' => 'absint'
// ));
//
//   $wp_customize->add_control(
//     new WP_Customize_Media_Control( $wp_customize, 'site_image', array(
//     'label' => __( 'Site Header Image', 'gesso' ),
//     'section' => 'prr_header_settings',
//     'mime_type' => 'image',
//     )
//   ));

  // PRR THEME SETTINGS
  $wp_customize->add_panel('prr_component_theme_settings', array(
    'title'   => 'PRR Component Theme Settings'
  ));

  $wp_customize->add_section('prr_dark_theme_settings', array(
    'title'   => 'PRR Dark Theme Settings',
    'panel'   => 'prr_component_theme_settings'
  ));

  $wp_customize->add_section('prr_light_theme_settings', array(
    'title'   => 'PRR Light Theme Settings',
    'panel'   => 'prr_component_theme_settings'
  ));

  $wp_customize->add_section('prr_default_theme_settings', array(
    'title'   => 'PRR Default Theme Settings',
    'panel'   => 'prr_component_theme_settings'
  ));

  // DARK THEME FONT COLOR
  $wp_customize->add_setting('dark_theme_font_color', array(
    'default'  => '#ffffff',
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'dark_theme_font_color', array(
        'label'      => __( 'Dark Theme Font Color', 'gesso' ),
        'section'    => 'prr_dark_theme_settings',
      )
  ));

  // DARK THEME HEADER FONT COLOR
  $wp_customize->add_setting('dark_theme_header_font_color', array(
    'default'  => '#ffffff',
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'dark_theme_header_font_color', array(
        'label'      => __( 'Dark Theme Header Font Color', 'gesso' ),
        'section'    => 'prr_dark_theme_settings',
      )
  ));

  // DARK THEME BG COLOR
  $wp_customize->add_setting('dark_theme_background_color', array(
    'default'  => '#000000',
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'dark_theme_background_color', array(
        'label'      => __( 'Dark Theme Background Color', 'gesso' ),
        'section'    => 'prr_dark_theme_settings',
      )
  ));

  // LIGHT THEME FONT COLOR
  $wp_customize->add_setting('light_theme_font_color', array(
    'default'  => '#000000',
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'light_theme_font_color', array(
        'label'      => __( 'Light Theme Font Color', 'gesso' ),
        'section'    => 'prr_light_theme_settings',
      )
  ));

  // LIGHT THEME HEADER FONT COLOR
  $wp_customize->add_setting('light_theme_header_font_color', array(
    'default'  => '#000000',
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'light_theme_header_font_color', array(
        'label'      => __( 'Light Theme Header Font Color', 'gesso' ),
        'section'    => 'prr_light_theme_settings',
      )
  ));

  // LIGHT THEME BG COLOR
  $wp_customize->add_setting('light_theme_background_color', array(
    'default'  => '#ffffff',
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'light_theme_background_color', array(
        'label'      => __( 'Light Theme Background Color', 'gesso' ),
        'section'    => 'prr_light_theme_settings',
      )
  ));

  // DEFAULT THEME FONT COLOR
  $wp_customize->add_setting('default_theme_font_color', array(
    'default'  => '#000000',
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'default_theme_font_color', array(
        'label'      => __( 'Default Theme Font Color', 'gesso' ),
        'section'    => 'prr_default_theme_settings',
      )
  ));

  // DEFAULT THEME HEADER FONT COLOR
  $wp_customize->add_setting('default_theme_header_font_color', array(
    'default'  => '#000000',
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'default_theme_header_font_color', array(
        'label'      => __( 'Default Theme Header Font Color', 'gesso' ),
        'section'    => 'prr_default_theme_settings',
      )
  ));

  // DEFAULT THEME BG COLOR
  $wp_customize->add_setting('default_theme_background_color', array(
    'default'  => '#ffffff',
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'default_theme_background_color', array(
        'label'      => __( 'Default Theme Background Color', 'gesso' ),
        'section'    => 'prr_default_theme_settings',
      )
  ));

} // END CUSTOMIZER

add_action( 'customize_register', 'prr_custom_register' );

// PRR CUSTOMIZER CSS
function prr_custom_css()
{
    ?>
         <style type="text/css">
            .l-header { background-color: <?php echo get_theme_mod('header_color', '#000000'); ?>; }

            .theme--dark {
              color: <?php echo get_theme_mod('dark_theme_font_color', '#000000'); ?>;
              background-color: <?php echo get_theme_mod('dark_theme_background_color', '#000000'); ?>;
            }
            .theme--dark h1, h2, h3, h4, h5, h6 {
              color: <?php echo get_theme_mod('dark_theme_header_font_color', '#000000'); ?>;
            }

            .theme--light {
              color: <?php echo get_theme_mod('light_theme_font_color', '#000000'); ?>;
              background-color: <?php echo get_theme_mod('light_theme_background_color', '#000000'); ?>;
            }
            .theme--light h1, h2, h3, h4, h5, h6 {
              color: <?php echo get_theme_mod('light_theme_header_font_color', '#000000'); ?>;
            }

            .theme--default {
              color: <?php echo get_theme_mod('default_theme_font_color', '#000000'); ?>;
              background-color: <?php echo get_theme_mod('default_theme_background_color', '#000000'); ?>;
            }
            .theme--default h1, h2, h3, h4, h5, h6 {
              color: <?php echo get_theme_mod('default_theme_header_font_color', '#000000'); ?>;
            }

         </style>

    <?php
}
add_action( 'wp_head', 'prr_custom_css');

// Custom site image
// function echo_site_image() {
//   $id = get_theme_mod('site_image');
//   if ($id != 0) {
//       $url = wp_get_attachment_url($id);
//       echo '<img class="header__image" src="' . $url . '" alt="" />';
//   }
// }
