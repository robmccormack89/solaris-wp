<?php
/**
 * Timber theme class & other functions for Twig.
 *
 * @package Solaris_Theme
 */

// Define paths to Twig templates
Timber::$dirname = array(
  'views/',
  'views/contact',
  'views/footer',
  'views/gallery',
  'views/head',
  'views/header',
  'views/page-templates',
  'views/parts',
  'views/product',
  'views/product/blinds',
  'views/product/blinds/conservatory',
  'views/product/blinds/electric',
  'views/product/curtains',
  'views/product/shutters',
  'views/product/blocks',
  'views/shop',
  'views/shop/archive',
  'views/shop/catalog',
  'views/shop/single',
  'views/shop/single/sections',
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
        //this is where you can register custom post types
    }

    public function register_taxonomies()
    {
        //this is where you can register custom taxonomies
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
      $context['menu'] = new \Timber\Menu('main');
      $context['site']            = $this;
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
      $context['email'] = '1info@solarisblinds.ie';
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
