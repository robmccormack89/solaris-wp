<?php
/**
 * Theme functions & bits
 *
 * @package Solaris_Theme
 */

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
  add_image_size('solaris-theme-lg-thumb', 96, 76, true); // lightgallery thumb
  add_image_size('solaris-theme-lg-img', 800, 0, true); // lightgallery main image
  add_image_size('solaris-theme-tiny-thumb', 80, 80, true); // gravatar type thing
  add_image_size('solaris-theme-tiny-tiny-thumb', 45, 45, true); // smaller gravatar type thing
  add_image_size('solaris-theme-featured-image', 1920, 1200, true);
  add_image_size('solaris-theme-header-image', 1920, 400, true); //  hero block, cta block, 
  add_image_size('solaris-theme-content-block', 716, 450, true); // content block image
  add_image_size('solaris-theme-content-block-gallery-image', 378, 450, true); // content block slider gallery image
  add_image_size('solaris-theme-case-studies-image', 470, 200, true); // case studies block image
  add_image_size('solaris-theme-quotations-block-image', 952, 634, true); // quotations block image
  add_image_size('solaris-theme-quotations-block-half-image', 960, 975, true); // quotations block modal image
  add_image_size('solaris-theme-reviews-block-image', 60, 60, true); // reviews block image
  add_image_size('solaris-theme-archive-featured-image-grid', 540, 0, true); // blog archive image
  add_image_size('solaris-theme-archive-featured-image-list', 1150, 400, true);
  add_image_size('solaris-theme-archive-featured-image-chess', 540, 0, true);
  add_image_size('solaris-theme-more-stories-image', 620, 350, true);
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
  remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
  remove_action( 'wp_head', 'feed_links', 2 );
  add_filter('emoji_svg_url', '__return_false');

  // remove xml link from head
  add_filter('xmlrpc_enabled', '__return_false');
  remove_filter('the_content', 'wpautop', 10);
  remove_filter('the_content', 'wptexturize', 10);
  remove_filter('the_content', 'convert_smilies', 10);
  remove_filter('the_content', 'convert_chars', 10);
  remove_filter('the_content', 'shortcode_unautop', 10);
  remove_filter('the_content', 'prepend_attachment', 10);
  
}
add_action('after_setup_theme', 'solaris_theme_setup');

function solaris_theme_enqueue_assets() {
  
  if ( is_page_template('page-templates/blank-wide-template.php') ) {
  
    wp_enqueue_style('uikit', '/wp-content/themes/solaris-theme/assets/css/base_lg.css');
    // wp_enqueue_style('solaris-theme', get_stylesheet_uri() );
    wp_enqueue_script('solaris-theme-js', '/wp-content/themes/solaris-theme/assets/js/globals/global_lg.js', '', '3.1.5', true);
  
  }
  
  elseif ( is_post_type_archive( 'case-study' ) ) {
  
    wp_enqueue_style('uikit', '/wp-content/themes/solaris-theme/assets/css/base_lg.css');
    // wp_enqueue_style('solaris-theme', get_stylesheet_uri() );
    wp_enqueue_script('solaris-theme-js', '/wp-content/themes/solaris-theme/assets/js/globals/global_lg_scroll.js', '', '3.1.5', true);
  
  }
  
  elseif ( is_home() || is_archive() || is_search() ) {
  
    wp_enqueue_style('uikit', '/wp-content/themes/solaris-theme/assets/css/base_lg.css');
    // wp_enqueue_style('solaris-theme', get_stylesheet_uri() );
    wp_enqueue_script('solaris-theme-js', '/wp-content/themes/solaris-theme/assets/js/globals/global_scroll.js', '', '3.1.5', true);
  
  }
  
  else {
  
    wp_enqueue_style('uikit', '/wp-content/themes/solaris-theme/assets/css/base.css');
    // wp_enqueue_style('solaris-theme', get_stylesheet_uri());
    wp_enqueue_script('solaris-theme-js', '/wp-content/themes/solaris-theme/assets/js/globals/global.js', '', '3.1.5', true);
    
  }
  
}
add_action('wp_enqueue_scripts', 'solaris_theme_enqueue_assets');

/* add options page in backend via acf */;
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}
function the_breadcrumb() {	

  if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<p class="rmcc-breadcrumbs uk-breadcrumb">','</p>' );
  }

}
add_filter( 'wpseo_breadcrumb_separator', function( $separator ) {
     return '<span uk-icon="icon: chevron-right">' . $separator . '</span>';
} );

// regisers custom widget
add_action("widgets_init", "rmcc_custom_uikit_widgets_init");
function rmcc_custom_uikit_widgets_init() {
  register_widget("RMcC_Custom_UIKIT_Widget_Class");
}

// posts per page based on CPT. blog obeys wp settings
function solaris_posts_per_page($query)
{
    switch ( $query->query_vars['post_type'] )
    {
        case 'case-study':
            $query->query_vars['posts_per_page'] = 8;
            break;

        default:
            break;
    }
    return $query;
}

if( !is_admin() )
{
    add_filter( 'pre_get_posts', 'solaris_posts_per_page' );
}

/**
 * Limit max menu depth in admin panel to 1 on certain menus on edit menu screen using js
 */
function main_menu_limit_depth( $hook ) {

  if ( $hook != 'nav-menus.php' ) return;

  wp_add_inline_script( 'nav-menu', 'jQuery(document).ready(function(){ var selected_menu_id = jQuery("#select-menu-to-edit option:selected").prop("value"); if ("2" === selected_menu_id || "5" === selected_menu_id) { wpNavMenu.options.globalMaxDepth = 0; } });', 'after' );

}
add_action( 'admin_enqueue_scripts', 'main_menu_limit_depth' );


// Exclude specific posts/pages from search
function exclude_pages_from_search($query) {
	if ( $query->is_main_query() && is_search() ) {
		$include_ids = array( 208, 832, 838, 835, 841, 840, 839, 1170, 1175, 465, 467 ); // Array of the ID's to exclude
		$query->set( 'post__in', $include_ids );
	}
	return $query;
}
add_filter( 'pre_get_posts','exclude_pages_from_search' );


function wpassist_remove_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
} 
add_action( 'wp_enqueue_scripts', 'wpassist_remove_block_library_css' );

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



add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
function wps_deregister_styles() {
    wp_deregister_style( 'contact-form-7' );
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
