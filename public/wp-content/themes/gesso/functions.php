<?php

/*------------------------------------------------------------------*
 * Helper Functions
/*------------------------------------------------------------------*/

require_once( get_template_directory() . '/inc/helpers.php' );

/*------------------------------------------------------------------*
 * Customizer Settings
/*------------------------------------------------------------------*/

require_once( get_template_directory() . '/inc/customizer.php' );

/*------------------------------------------------------------------*
 * Core Theme Features
/*------------------------------------------------------------------*/

// Setting main content width - update to match the width of your site's main content area.
if ( ! isset( $content_width ) ) {
  $content_width = 840;
}

if ( function_exists('add_theme_support') ) {
  // Adding theme support for HTML5
  add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', ) );

  // Adds site name to title tag
  add_theme_support( 'title-tag' );

  // Add support for automatic links for feeds.
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );

  # Define automatic thumbnail sizes
  add_image_size( 'large', 700, '', true ); // Large Thumbnail
  add_image_size( 'medium', 250, '', true ); // Medium Thumbnail
  add_image_size( 'small', 120, '', true ); // Small Thumbnail
  //add_image_size( 'custom-size', 700, 200, true ); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
}

function has_visible_widgets( $sidebar_id ) {
  if ( is_active_sidebar( $sidebar_id ) ) {
    ob_start();
    dynamic_sidebar( $sidebar_id );
    $sidebar = ob_get_contents();
    ob_end_clean();
    if ( $sidebar == "" ) {
      return false;
    }
  } else {
    return false;
  }
  return true;
}


function gesso_header_scripts() {

  $phpVars = array(

  );

  wp_deregister_script('jquery');
  wp_register_script('jquery', '//code.jquery.com/jquery-3.4.1.min.js', array() ); // Google CDN jQuery
  wp_enqueue_script('jquery');

  wp_register_script('gessomodernizr', get_template_directory_uri() . '/js/lib/modernizr.min.js', array('jquery') ); // Modernizr
  wp_enqueue_script('gessomodernizr');

  wp_register_script('siema', get_template_directory_uri() . '/js/lib/siema.min.js' , array('jquery') ); // Siema carousel scripts
  wp_enqueue_script('siema');

  wp_register_script('sticky', get_template_directory_uri() . '/js/lib/sticky-plugin.js' , array('jquery') );
  wp_enqueue_script('sticky');

  wp_register_script('lity-lightbox', get_template_directory_uri() . '/js/lib/lity/lity.min.js' , array('jquery') ); //adding lightbox for expanding images
  wp_enqueue_script('lity-lightbox');


  if ( is_singular() && comments_open() ) {
    wp_enqueue_script( "comment-reply" );
  }

  wp_register_script('gessomobilemenu', get_template_directory_uri() . '/js/mobile-menu.js', array('jquery','gessomodernizr') ); // Mobile menu
  wp_enqueue_script('gessomobilemenu');

  // ADD ALL JS WITHIN CUSTOM FOLDER
  foreach( glob( get_template_directory(). '/js/custom/*.js' ) as $file ) {
    // $file contains the name and extension of the file
    $filename = substr($file, strrpos($file, '/') + 1);
    wp_enqueue_script( $filename, get_template_directory_uri().'/js/custom/'.$filename);
  }

  // IF ADDING PHP VARS, USE THIS
  // wp_register_script('script_name', get_template_directory_uri() . '/js/script_name.js', array('jquery','gessomodernizr') ); // Custom scripts
  // wp_enqueue_script('script_name');

  // wp_localize_script( 'script_name', 'phpVars', $phpVars );

  wp_enqueue_style( 'slickstyle', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');

  wp_enqueue_style( 'slicktheme', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css');
  wp_enqueue_style( 'typekit', '//use.typekit.net/qvy8oio.css');
  wp_enqueue_style( 'lity-lightbox', get_stylesheet_directory_uri() . '/js/lib/lity/lity.min.css' );
  wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/css/styles.css', array(), null, 'all' );

}
add_action( 'wp_enqueue_scripts', 'gesso_header_scripts' );

function register_gesso_menu() {
  register_nav_menus( array(
    'primary' => __('Primary', 'gesso'),
    'secondary' => __('Secondary', 'gesso'),
  ));
}
add_action( 'init', 'register_gesso_menu' );


// Add page slug to body class. Credit: Starkers Wordpress Theme
function add_slug_to_body_class( $classes ) {
  global $post;
  if (is_home()) {
    $key = array_search( 'blog', $classes );
    if ( $key > -1 ) {
      unset( $classes[ $key ] );
    }
  } elseif ( is_page() ) {
    $classes[] = sanitize_html_class( $post->post_name );
  } elseif ( is_singular() ) {
    $classes[] = sanitize_html_class( $post->post_name );
  }

  return $classes;
}
add_filter( 'body_class', 'add_slug_to_body_class' );

// Initial Sidebar and Footer Widget Areas
add_action( 'widgets_init', 'gesso_widgets_init' );
function gesso_widgets_init() {
  register_sidebar(array(
    'name' => __('Widget Area 1', 'gesso'),
    'description' => __('Widget Area 1', 'gesso'),
    'id' => 'widget-area-1',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget__title">',
    'after_title' => '</h3>'
  ));

  register_sidebar(array(
    'name' => __('Footer Widgets', 'gesso'),
    'description' => __('Footer Widgets', 'gesso'),
    'id' => 'footer-widgets',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget__title">',
    'after_title' => '</h3>'
  ));
}

function gesso_pagination() {
  global $wp_query;
  $big = 999999999;
  echo paginate_links( array(
    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages,
  ) );
}
add_action('init', 'gesso_pagination');

//Adds proper markup to pages content
function gesso_link_pages() {
  $gesso_links = array(
    'before'    => '<nav role="navigation" aria-labelledby="pagination-heading"><h2 id="pagination-heading" class="visually-hidden">Pagination</h2><ul class="pager">',
    'after'     => '</ul></nav>',
    'link_before' => '<li class="pager__item>',
    'link_after'  => '</li>',
    );
  wp_link_pages( $gesso_links );
}

add_filter('acf/validate_value/name=custom_id', 'validate_acf_id', 10, 4);

function validate_acf_id( $valid, $value, $field, $input ){
	// bail early if value is already invalid
	if( !$valid ) {
		return $valid;
	}
	//  get field data
	$data = get_field( $value );
  
	if( preg_match("/[^a-zA-Z]/", $value) ) {
		$valid = 'The id value must contain at least one character, and must not contain whitespace (spaces, tabs, etc.).';
	}
	// return
	return $valid;
}


 // Remove thumbnail dimensions
function remove_thumbnail_dimensions( $html ) {
  $html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
  return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); // Remove width and height attributes from thumbnails
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 ); // Remove width and height attributes from post images

// Allowing styles for post editor to match how it will actually be visually represented
function gesso_add_editor_styles() {
  add_editor_style( 'css/custom-editor-styles.css' );
}
add_action( 'admin_init', 'gesso_add_editor_styles' );


//------------------------------------------------------
// Timber Support - Starter Theme Functions
//------------------------------------------------------
if ( ! class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
    echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
  } );
  return;
}

Timber::$dirname = array('templates');

class StarterSite extends TimberSite {

  function __construct() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
    parent::__construct();
  }

  function add_to_context( $context ) {
    $context['foo'] = 'bar';
    $context['stuff'] = 'I am a value set in your functions.php file';
    $context['notes'] = 'These values are available everytime you call Timber::get_context();';
    $context['primary_menu'] = new Timber\Menu('primary');
    $context['secondary_menu'] = new Timber\Menu('secondary');
    $context['menu'] = new Timber\Menu();
    $context['current_year'] = date('Y');
    $context['site'] = $this;
    return $context;
  }

  function add_to_twig( \Twig_Environment $twig ) {
    // This is where you can add your own fuctions to twig
    // https://timber.github.io/docs/guides/extending-timber/#adding-to-twig
    $twig->addExtension( new \Twig_Extension_StringLoader() );
    $twig->addFilter( new \Twig_SimpleFilter( 'myfoo', 'my_foo' ) );
    return $twig;
  }

}

new StarterSite();

/**
 * Add quick-collapse feature to ACF Flexible Content fields
 */
add_action('acf/input/admin_head', function() { ?>
    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                var collapseButtonClass = 'collapse-all';

                // Add a clickable link to the label line of flexible content fields
                $('.acf-field-flexible-content > .acf-label')
                    .append('<a class="' + collapseButtonClass + '" style="position: absolute; top: 0; right: 0; cursor: pointer;">Collapse All</a>');

                // Simulate a click on each flexible content item's "collapse" button when clicking the new link
                $('.' + collapseButtonClass).on('click', function() {
                    $('.acf-flexible-content .layout:not(.-collapsed) .acf-fc-layout-controls .-collapse').click();
                });
            });
        })(jQuery);
    </script><?php
});

/**
 * Override default WordPress gallery markup, outputs in BEM format.
 * @param string $gallery
 * @param array $attr
 * @return string
 */
function gesso_bem_gallery( $gallery, $attr ) {

  // [ thumbnail | medium | large | full ]
  $size   = 'thumbnail';
  $output = '<div class="gallery">';
  $posts  = get_posts( array( 'include' => $attr['ids'], 'post_type' => 'attachment' ) );

  foreach ( $posts as $image_post ) {
    $src      = wp_get_attachment_image_src( $image_post->ID, $size );
    $alt_text = get_post_meta( $image_post->ID, '_wp_attachment_image_alt', true );
    $output .= '<div class="gallery__item"><a href="' . $src[0] . '"><img alt="' . $alt_text . '" class="gallery__item-image" src="' . $src[0] . '"></a>';
    $output .= '<div class="galler__item-caption">' . $image_post->post_excerpt . '</div></div>';
  }

  $output .= '</div>';

  return $output;
}
add_filter( 'post_gallery', 'gesso_bem_gallery', 10, 2 );

add_filter('timber/loader/loader', function($loader){
	$loader->addPath(__DIR__ . "/pattern-lab/source/_patterns/01-base", "base");
	$loader->addPath(__DIR__ . "/pattern-lab/source/_patterns/02-layouts", "layouts");
	$loader->addPath(__DIR__ . "/pattern-lab/source/_patterns/03-components", "components");
	$loader->addPath(__DIR__ . "/pattern-lab/source/_patterns/04-templates", "templates");
	$loader->addPath(__DIR__ . "/pattern-lab/source/_patterns/05-pages", "pages");
	return $loader;
});
