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
                'name' => esc_html__('Right Sidebar', 'solaris-theme'),
                'id' => 'sidebar-right',
                'description' => esc_html__('Add widgets here.', 'solaris-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h3 class="uk-heading-line uk-text-bold widget-title"><span>',
                'after_title' => '</span></h3>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Left Sidebar', 'solaris-theme'),
                'id' => 'sidebar-left',
                'description' => esc_html__('Add widgets here.', 'solaris-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h3 class="uk-heading-line uk-text-bold widget-title"><span>',
                'after_title' => '</span></h3>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer', 'solaris-theme'),
                'id' => 'sidebar-footer',
                'description' => esc_html__('Add widgets here.', 'solaris-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>'
            ));
        }
    }

    public function register_navigation_menus()
    {
        // This theme uses wp_nav_menu() in one locations.
        register_nav_menus(array(
            'main' => __('Main Menu', 'solaris-theme'),
        ));
    }


    // register custom context variables
    public function add_to_context($context)
    {
        $context['menu'] = new \Timber\Menu('main');
        $context['site']            = $this;
        $context['sidebar_right'] = Timber::get_widgets('Right Sidebar');
        $context['sidebar_left']  = Timber::get_widgets('Left Sidebar');
        $context['sidebar_footer']   = Timber::get_widgets('Footer');
        $context['freenumber'] = '1800 111 2222';
        $context['email'] = '1info@solarisblinds.ie';
        $context['address1'] = 'Street / Road';
        $context['address2'] = 'City / Town';
        $context['address3'] = 'State / County';
        $context['logo'] = '/wp-content/themes/solaris-theme/assets/img/logo.png';
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
