<?php
/**
 * The main template file
 *
 * @package Solaris_Theme
 */

$context = Timber::get_context();

$context['posts'] = Timber::get_posts();
$post = new TimberPost();
$context['title'] =  get_the_title( $post->ID );
$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;
$context['what_post_type'] = get_post_type( get_the_ID() );

$templates = array( 'index.twig' );
if ( is_home() ) {
	array_unshift( $templates, 'home.twig' );
}
Timber::render( $templates, $context );