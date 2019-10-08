<?php
/**
 * The default template for displaying all single posts
 *
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;

$currentID = get_the_ID();
$more_stories_args = array(
   'post_type' => 'post',
   'posts_per_page'=>  7,
   'post__not_in' => array($currentID)
);
$context['more_stories'] = Timber::get_posts( $more_stories_args );

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}