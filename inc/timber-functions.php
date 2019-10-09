<?php
/**
 * Timber theme class & other functions for Twig.
 *
 * @package Solaris_Theme
 */

// Define paths to Twig templates
Timber::$dirname = array(
  'views/',
  'views/blocks',
  'views/footer',
  'views/head',
  'views/header',
  'views/page-templates',
  'views/partials',
  'views/sidebars',
);

// function timber_set_product( $post ) {
// 
//    global $product;
// 
//    if ( is_woocommerce() ) {
// 
//        $product = wc_get_product( $post->ID );
// 
//    }
// 
// }

// Define RMcC Site Child Class
class SolarisTheme extends TimberSite
{
    public function __construct()
    {
        // timber stuff
        add_filter('timber_context', array( $this, 'add_to_context' ));
        add_filter('get_twig', array( $this, 'add_to_twig' ));
        add_action('init', array( $this, 'register_post_types' ));
        add_action('init', array( $this, 'register_taxonomies' ));
        add_action('init', array( $this, 'register_widget_areas' ));
        add_action('init', array( $this, 'register_navigation_menus' ));

        parent::__construct();
    }

    public function register_post_types()
    {
  
        // Register Custom Post Type
        	$labels = array(
        		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
        		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'text_domain' ),
        		'menu_name'             => __( 'Testimonials', 'text_domain' ),
        		'name_admin_bar'        => __( 'Testimonial', 'text_domain' ),
        		'archives'              => __( 'Item Archives', 'text_domain' ),
        		'attributes'            => __( 'Item Attributes', 'text_domain' ),
        		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
        		'all_items'             => __( 'All Items', 'text_domain' ),
        		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
        		'add_new'               => __( 'Add New', 'text_domain' ),
        		'new_item'              => __( 'New Item', 'text_domain' ),
        		'edit_item'             => __( 'Edit Item', 'text_domain' ),
        		'update_item'           => __( 'Update Item', 'text_domain' ),
        		'view_item'             => __( 'View Item', 'text_domain' ),
        		'view_items'            => __( 'View Items', 'text_domain' ),
        		'search_items'          => __( 'Search Item', 'text_domain' ),
        		'not_found'             => __( 'Not found', 'text_domain' ),
        		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        		'featured_image'        => __( 'Featured Image', 'text_domain' ),
        		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        		'items_list'            => __( 'Items list', 'text_domain' ),
        		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
        	);
        	$args = array(
        		'label'                 => __( 'Testimonial', 'text_domain' ),
        		'description'           => __( 'Customer Testimonials & Reviews', 'text_domain' ),
        		'labels'                => $labels,
        		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
        		'hierarchical'          => false,
        		'public'                => true,
        		'show_ui'               => true,
        		'show_in_menu'          => true,
        		'menu_position'         => 5,
        		'show_in_admin_bar'     => true,
        		'show_in_nav_menus'     => true,
        		'can_export'            => true,
            'has_archive'           => false,
        		'exclude_from_search'   => true,
        		'publicly_queryable'    => true,
        		'capability_type'       => 'post',
        	);
        	register_post_type( 'testimonial', $args );
          
          
          $labels = array(
        		'name'                  => _x( 'Case Studies', 'Post Type General Name', 'text_domain' ),
        		'singular_name'         => _x( 'Case Study', 'Post Type Singular Name', 'text_domain' ),
        		'menu_name'             => __( 'Case Studies', 'text_domain' ),
        		'name_admin_bar'        => __( 'Case Study', 'text_domain' ),
        		'archives'              => __( 'Gallery', 'text_domain' ),
        		'attributes'            => __( 'Item Attributes', 'text_domain' ),
        		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
        		'all_items'             => __( 'All Items', 'text_domain' ),
        		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
        		'add_new'               => __( 'Add New', 'text_domain' ),
        		'new_item'              => __( 'New Item', 'text_domain' ),
        		'edit_item'             => __( 'Edit Item', 'text_domain' ),
        		'update_item'           => __( 'Update Item', 'text_domain' ),
        		'view_item'             => __( 'View Item', 'text_domain' ),
        		'view_items'            => __( 'View Items', 'text_domain' ),
        		'search_items'          => __( 'Search Item', 'text_domain' ),
        		'not_found'             => __( 'Not found', 'text_domain' ),
        		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        		'featured_image'        => __( 'Featured Image', 'text_domain' ),
        		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        		'items_list'            => __( 'Items list', 'text_domain' ),
        		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
        	);
        	$args = array(
        		'label'                 => __( 'Case Study', 'text_domain' ),
        		'description'           => __( 'The Case Studies', 'text_domain' ),
        		'labels'                => $labels,
        		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
        		'hierarchical'          => false,
        		'public'                => true,
        		'show_ui'               => true,
        		'show_in_menu'          => true,
        		'menu_position'         => 5,
        		'show_in_admin_bar'     => true,
        		'show_in_nav_menus'     => true,
        		'can_export'            => true,
        		'has_archive'           => 'gallery',
        		'exclude_from_search'   => false,
        		'publicly_queryable'    => true,
        		'capability_type'       => 'post',
        	);
        	register_post_type( 'case-study', $args );
    
    }

    public function register_taxonomies()
    {
      // Register Custom Taxonomy
      
      	$labels = array(
      		'name'                       => _x( 'Locations', 'Taxonomy General Name', 'text_domain' ),
      		'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'text_domain' ),
      		'menu_name'                  => __( 'Locations', 'text_domain' ),
      		'all_items'                  => __( 'All Items', 'text_domain' ),
      		'parent_item'                => __( 'Parent Item', 'text_domain' ),
      		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
      		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
      		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
      		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
      		'update_item'                => __( 'Update Item', 'text_domain' ),
      		'view_item'                  => __( 'View Item', 'text_domain' ),
      		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
      		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
      		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
      		'popular_items'              => __( 'Popular Items', 'text_domain' ),
      		'search_items'               => __( 'Search Items', 'text_domain' ),
      		'not_found'                  => __( 'Not Found', 'text_domain' ),
      		'no_terms'                   => __( 'No items', 'text_domain' ),
      		'items_list'                 => __( 'Items list', 'text_domain' ),
      		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
      	);
      	$args = array(
      		'labels'                     => $labels,
      		'hierarchical'               => true,
      		'public'                     => true,
      		'show_ui'                    => true,
      		'show_admin_column'          => true,
      		'show_in_nav_menus'          => true,
      		'show_tagcloud'              => false,
      	);
      	register_taxonomy( 'location', array( 'testimonials', 'case-study' ), $args );
      
    }

    public function register_widget_areas()
    {
        // Register widget areas
        if (function_exists('register_sidebar')) {
          register_sidebar(array(
              'name' => esc_html__('Left Sidebar Area', 'solaris-theme'),
              'id' => 'sidebar-left',
              'description' => esc_html__('Sidebar Area for Left Sidebar Templates, you can add multiple widgets here.', 'solaris-theme'),
              'before_widget' => '',
              'after_widget' => '',
              'before_title' => '<h3 class="uk-text-bold widget-title"><span>',
              'after_title' => '</span></h3>'
          ));
            register_sidebar(array(
                'name' => esc_html__('Right Sidebar Area', 'solaris-theme'),
                'id' => 'sidebar-right',
                'description' => esc_html__('Sidebar Area for Right Sidebar Templates, you can add multiple widgets here.', 'solaris-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h3 class="uk-text-bold widget-title"><span>',
                'after_title' => '</span></h3>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Top Bar Left', 'solaris-theme'),
                'id' => 'top-bar-left',
                'description' => esc_html__('Top Bar Left Sidebar Area; works best with the current widget only, with Social Media links.', 'solaris-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Top Bar Right', 'solaris-theme'),
                'id' => 'top-bar-right',
                'description' => esc_html__('Top Bar Right Sidebar Area; works best with the current widget only, with extra Navigation links.', 'solaris-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Main Footer Area 1', 'solaris-theme'),
                'id' => 'sidebar-footer1',
                'description' => esc_html__('Main Footer Widget Area 1; works best with the current widget only.', 'solaris-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Main Footer Area 2', 'solaris-theme'),
                'id' => 'sidebar-footer2',
                'description' => esc_html__('Main Footer Widget Area 2; works best with the current widget only', 'solaris-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Main Footer Area 3', 'solaris-theme'),
                'id' => 'sidebar-footer3',
                'description' => esc_html__('Main Footer Widget Area 3; works best with the current widget only', 'solaris-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Main Footer Area 4', 'solaris-theme'),
                'id' => 'sidebar-footer4',
                'description' => esc_html__('Main Footer Widget Area 4; works best with the current widget only', 'solaris-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Bottom Left', 'solaris-theme'),
                'id' => 'footer-bottom-left',
                'description' => esc_html__('Footer Bottom Left widget area; works best with the current widget only', 'solaris-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Bottom Right', 'solaris-theme'),
                'id' => 'footer-bottom-right',
                'description' => esc_html__('Footer Bottom Right widget area; works best with the current widget only', 'solaris-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
        }
    }

    public function register_navigation_menus()
    {
        // This theme uses wp_nav_menu() in one locations.
        register_nav_menus(array(
            'main' => __('Main Menu', 'solaris-theme'),
            'mobile' => __('Mobile Menu', 'solaris-theme'),
            'top' => __('Top Menu', 'solaris-theme'),
        ));
    }


    // register custom context variables
    public function add_to_context($context)
    {
      $theme_logo_id = get_theme_mod( 'custom_logo' );
      $theme_logo_url = wp_get_attachment_image_url( $theme_logo_id , 'full' );
      $main_menu_args = array(
          'depth' => 1,
      );
      $context['menu_main'] = new \Timber\Menu( 'main', $main_menu_args );
      $context['menu_mobile'] = new \Timber\Menu('mobile');
      $context['menu_top'] = new \Timber\Menu('top');
      $context['site']            = $this;
      $context['options'] = get_fields('option');
      $custom_logo_url = wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' );
      $context['custom_logo_url'] = $custom_logo_url;  
      $context['sidebar_left']  = Timber::get_widgets('Left Sidebar Area');
      $context['sidebar_right'] = Timber::get_widgets('Right Sidebar Area');
      $context['top_bar_left']  = Timber::get_widgets('Top Bar Left');
      $context['top_bar_right'] = Timber::get_widgets('Top Bar Right');
      $context['sidebar_footer1']   = Timber::get_widgets('Main Footer Area 1');
      $context['sidebar_footer2']   = Timber::get_widgets('Main Footer Area 2');
      $context['sidebar_footer3']   = Timber::get_widgets('Main Footer Area 3');
      $context['sidebar_footer4']   = Timber::get_widgets('Main Footer Area 4');
      $context['footer_bottom_left']   = Timber::get_widgets('Footer Bottom Left');
      $context['footer_bottom_right']   = Timber::get_widgets('Footer Bottom Right');
      $context['freenumber'] = '1800 111 2222';
      $context['email'] = 'info@solarisblinds.ie';
      $context['address1'] = 'Street / Road';
      $context['address2'] = 'City / Town';
      $context['address3'] = 'State / County';
      $context['logo'] = '/wp-content/themes/solaris-theme/assets/img/logo.png';
      $context['themelogo'] = $theme_logo_url;
      return $context;
    }

    public function add_to_twig($twig)
    {
        /* this is where you can add your own functions to twig */
        $twig->addExtension(new Twig_Extension_StringLoader());

        return $twig;
    }
}

new SolarisTheme();
