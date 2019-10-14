<?php
/**
 * Theme functions & bits
 *
 * @package Solaris_Theme
 */
 
// function rmcc_paginate_class() {
//   $return = paginate_links( $arg );
//   echo str_replace( "<ul class='page-numbers'>", '<ul class="pagination">', $return );
// }

function the_breadcrumb() {	

  if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<p class="rmcc-breadcrumbs uk-breadcrumb">','</p>' );
  }

}

add_filter( 'wpseo_breadcrumb_separator', function( $separator ) {
     return '<span uk-icon="icon: chevron-right">' . $separator . '</span>';
} );

//  to include in functions.php
// function the_breadcrumb() {
//     $sep = ' <span uk-icon="icon: chevron-right"></span> ';
//     if (!is_front_page()) {
// 
// 	// Start the breadcrumb with a link to your homepage
//         echo '<ul class="uk-breadcrumb">';
//         echo '<li><a href="';
//         echo get_option('home');
//         echo '">Home</a>';
//         echo '</li>';
// 
// 	// Check if the current page is a category, an archive or a single page. If so show the category or archive name.
//         if (is_category() || is_single() ){
//             the_category('title_li=');
//         } elseif (is_archive() || is_single()){
//             if ( is_day() ) {
//                 printf( __( '%s', 'text_domain' ), get_the_date() );
//             } elseif ( is_month() ) {
//                 printf( __( '%s', 'text_domain' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'text_domain' ) ) );
//             } elseif ( is_year() ) {
//                 printf( __( '%s', 'text_domain' ), get_the_date( _x( 'Y', 'yearly archives date format', 'text_domain' ) ) );
//             } else {
//                 _e( 'Blog Archives', 'text_domain' );
//             }
//         }
// 
// 	// If the current page is a single post, show its title with the separator
//         if (is_single()) {
//             echo '<li>';
//             the_title();
//             echo '</li>';
//         }
// 
// 	// If the current page is a static page, show its title.
//         if (is_page()) {
//             echo '<li>';
//             echo the_title();
//             echo '</li>';
//         }
// 
// 	// if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
//         if (is_home()){
//             global $post;
//             $page_for_posts_id = get_option('page_for_posts');
//             if ( $page_for_posts_id ) { 
//                 $post = get_page($page_for_posts_id);
//                 setup_postdata($post);
//                 the_title();
//                 rewind_posts();
//             }
//         }
//         echo '</ul>';
//     }
// }

function solaris_theme_setup()
{
  // theme support for title tag
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('menus');
  add_theme_support('post-formats', array(
      'gallery',
      'quote',
      'video',
      'aside',
      'image',
      'link'
  ));
  add_theme_support('align-wide');
  add_theme_support('responsive-embeds');
  add_theme_support('woocommerce');

  // Switch default core markup for search form, comment form, and comments to output valid HTML5.
  add_theme_support('html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption'
  ));

  // Add support for core custom logo.
  add_theme_support('custom-logo', array(
      'height' => 79,
      'width' => 258,
      'flex-width' => true,
      'flex-height' => true
  ));

  // add custom thumbs sizes.
  add_image_size('solaris-theme-featured-image', 1920, 1200, true);
  add_image_size('solaris-theme-archive-featured-image-list', 1150, 400, true);
  add_image_size('solaris-theme-archive-featured-image-grid', 540, 0, true);
  add_image_size('solaris-theme-archive-featured-image-chess', 540, 0, true);
  add_image_size('solaris-theme-case-studies-image', 470, 200, true);
  add_image_size('solaris-theme-more-stories-image', 620, 350, true);
  add_image_size('solaris-theme-header-image', 1920, 400, true);
  add_image_size('solaris-theme-tiny-thumb', 80, 80, true);
  add_image_size('solaris-theme-block-image', 500, 500, true);

  // remove emjoi styles & scripts
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_head', 'wp_resource_hints', 2);

  // remove more stuff from head
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'rest_output_link_wp_head', 10);
  remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
  remove_action('template_redirect', 'rest_output_link_header', 11, 0);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'wp_shortlink_wp_head');
  add_filter('emoji_svg_url', '__return_false');

  // remove xml link from head
  add_filter('xmlrpc_enabled', '__return_false');
  remove_filter('the_content', 'wpautop', 10);
  remove_filter('the_content', 'wptexturize', 10);
  remove_filter('the_content', 'convert_smilies', 10);
  remove_filter('the_content', 'convert_chars', 10);
  remove_filter('the_content', 'shortcode_unautop', 10);
  remove_filter('the_content', 'prepend_attachment', 10);
  add_filter('woocommerce_enqueue_styles', '__return_false');
  
}
add_action('after_setup_theme', 'solaris_theme_setup');

// regisers custom widget
add_action("widgets_init", "rmcc_custom_uikit_widgets_init");
function rmcc_custom_uikit_widgets_init() {
  register_widget("RMcC_Custom_UIKIT_Widget_Class");
}

// enqueue styles and scripts */
function solaris_theme_enqueue_assets() {
  
  // if ( is_home() || is_front_page() ) {
  // 
  //   wp_enqueue_style('uikit', '/wp-content/themes/solaris-theme/assets/css/base.css');
  //   wp_enqueue_style('solaris-theme', get_stylesheet_uri());
  //   wp_enqueue_script('solaris-theme-js', '/wp-content/themes/solaris-theme/assets/js/bundles/bundle.js', '', '3.1.5', false);
  // 
  // } else {
    
    wp_enqueue_style('uikit', '/wp-content/themes/solaris-theme/assets/css/base_lg.css');
    wp_enqueue_style('solaris-theme', get_stylesheet_uri());
    wp_enqueue_script('solaris-theme-js', '/wp-content/themes/solaris-theme/assets/js/bundles/bundle_lg.js', '', '3.1.5', false);
  // 
  // }
  
}
add_action('wp_enqueue_scripts', 'solaris_theme_enqueue_assets'); 


//* Adding DNS Prefetching
function stb_dns_prefetch(){
echo '<meta http-equiv="x-dns-prefetch-control" content="on" />
';
echo '<link rel="dns-prefetch" href="//cdnjs.cloudflare.com" />
';
}
add_action('wp_head', 'stb_dns_prefetch', 0);
// remove more stuff from head
add_action('init', function() {
  remove_action('rest_api_init', 'wp_oembed_register_route');
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  remove_action('wp_head', 'wp_oembed_add_host_js');
}, PHP_INT_MAX - 1);
// remove_action( 'wp_head', 'wp_resource_hints', 2 );
function solaris_theme_cleanup_query_string($src) {
  $parts = explode('?', $src);
  return $parts[0];
}
add_filter('script_loader_src', 'solaris_theme_cleanup_query_string', 15, 1);
add_filter('style_loader_src', 'solaris_theme_cleanup_query_string', 15, 1);
// clean up dashboard
// function remove_dashboard_widgets() {
//   global $wp_meta_boxes;
//   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
//   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
//   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
//   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
//   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
//   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
//   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
//   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
//   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
// }
// add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

// custom admin css
// add_action('admin_head', 'rmcc_custom_admin_styles');
// function rmcc_custom_admin_styles() {
//   echo '<style> .edit-post-layout__metaboxes:not(:empty) { border-top: 1px solid #e2e4e7; bottom: 0; position: fixed; width: calc(100vw - 280px - 180px); padding: 10px 0; clear: both; } .block-editor-block-list__layout { padding-bottom: 100px; } </style>';
// }


/**
 * Limit max menu depth in admin panel to 1 on certain menus on edit menu screen using js
 */
function main_menu_limit_depth( $hook ) {

  if ( $hook != 'nav-menus.php' ) return;

  wp_add_inline_script( 'nav-menu', 'jQuery(document).ready(function(){ var selected_menu_id = jQuery("#select-menu-to-edit option:selected").prop("value"); if ("2" === selected_menu_id || "5" === selected_menu_id) { wpNavMenu.options.globalMaxDepth = 0; } });', 'after' );

}
add_action( 'admin_enqueue_scripts', 'main_menu_limit_depth' );


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}



// stuff to say we need timber activated!! see TGM Plugin activation library for php
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'solaris_theme_register_required_plugins');

function solaris_theme_register_required_plugins()
{
    $plugins = array(
        array(
            'name' => 'Timber',
            'slug' => 'timber-library',
            'required' => true
        )
    );
    $config  = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '' // Message to output right before the plugins table.
    );
    tgmpa($plugins, $config);
}




function ajax_search_enqueues() {

    	wp_enqueue_script( 'ajax-search', get_stylesheet_directory_uri() . '/assets/js/ajax-search.js', '', '1.0.0', true );
        wp_localize_script( 'ajax-search', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

    	wp_enqueue_style( 'ajax-search', get_stylesheet_directory_uri() . '/assets/css/ajax-search.css' );

}

add_action( 'wp_enqueue_scripts', 'ajax_search_enqueues' );




add_action( 'wp_ajax_load_search_results', 'load_search_results' );
add_action( 'wp_ajax_nopriv_load_search_results', 'load_search_results' );

function load_search_results() {
    
    $query = $_POST['query'];
    $context['posts'] = Timber::get_posts( array(
        'posts_per_page' => 5,
        'post_status' => 'publish',
        's' => $query
  	) );
    
    $template = 'query.twig';
    
    $context['site'] = new Timber\Site();
    
    $context['query_string'] = $query;
    
    Timber::render( $template, $context );
	   
    die();
		
}