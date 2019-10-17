<?php
/**
 * Solaris Theme functions and definitions
 *
 * @package Solaris_Theme
 */

/**
* Theme functions
*/
require get_template_directory() . '/inc/theme-functions.php';

/**
* Timber class
*/
if( class_exists( 'Timber' ) ) {
	require get_template_directory() . '/inc/timber-functions.php';
}

/**
 * Custom Widget
 */
 require get_template_directory() . '/inc/blocks.php';


/**
* Custom Widget
*/
require get_template_directory() . '/widgets/uikit-html-widget.php';