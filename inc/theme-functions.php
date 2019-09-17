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

  // add custom thumbs sizes
  add_image_size('solaris-theme-featured-image', 2000, 1200, true);
  add_image_size('solaris-theme-archive-featured-image', 800, 300, true);
  add_image_size('solaris-theme-more-stories-image', 620, 350, true);
  add_image_size('solaris-theme-home-hero-image', 1300, 500, true);
  add_image_size('solaris-theme-home-slider', 500, 500, true);
  add_image_size('solaris-theme-thumbnail-avatar', 100, 100, true);
  add_image_size('solaris-theme-header-image', 1920, 800, true);
  add_image_size('solaris-theme-tiny-thumb', 80, 80, true);
  add_image_size('solaris-theme-block-image', 500, 500, true);
  add_image_size('solaris-theme-portfolio-block-thumb-2cols', 560);
  add_image_size('solaris-theme-portfolio-block-thumb-3cols', 370);

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
  
  if ( is_home() || is_front_page() ) {
    
    wp_enqueue_style('uikit', '/wp-content/themes/solaris-theme/assets/css/base.css');
    wp_enqueue_style('solaris-theme', get_stylesheet_uri());
    wp_enqueue_script('solaris-theme-js', '/wp-content/themes/solaris-theme/assets/js/bundles/bundle.js', '', '3.1.5', false);
    
  } else {
    
    wp_enqueue_style('uikit', '/wp-content/themes/solaris-theme/assets/css/base_lg.css');
    wp_enqueue_style('solaris-theme', get_stylesheet_uri());
    wp_enqueue_script('solaris-theme-js', '/wp-content/themes/solaris-theme/assets/js/bundles/bundle_lg.js', '', '3.1.5', false);
    
  }
  
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
function remove_dashboard_widgets() {
  global $wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

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
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}


add_action( 'acf/init', 'my_acf_init' );

function my_acf_init() {
    // Bail out if function doesn’t exist.
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    // Register a new block.
    acf_register_block( array(
        'name'            => 'cover_block',
        'title'           => __( 'Cover Block', 'solaris-theme' ),
        'description'     => __( 'A Cover block for Blank Wide Template.', 'solaris-theme' ),
        'render_callback' => 'my_acf_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array( 'cover' ),
    ) );
}

/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function my_acf_block_render_callback( $block, $content = '', $is_preview = false ) {
    $context = Timber::context();

    // Store block values.
    $context['block'] = $block;

    // Store field values.
    $context['fields'] = get_fields();

    // Store $is_preview value.
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render( 'cover-block.twig', $context );
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