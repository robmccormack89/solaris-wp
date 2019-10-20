<?php
/**
 * The default template for displaying all single posts
 *
 */

$context = Timber::get_context();

$context['pages'] = Timber::get_posts( array(
    'posts_per_page' => 6,
    'post_type' => 'page',
    'post_status' => 'publish',
    'post__not_in' => array(121,289,617),
) );
$context['studies'] = Timber::get_posts( array(
    'posts_per_page' => 4,
    'post_type' => 'case-study',
    'post_status' => 'publish',
) );
$context['posts'] = Timber::get_posts( array(
    'posts_per_page' => 3,
    'post_type' => 'post',
    'post_status' => 'publish',
) );

Timber::render(  'page-testing.twig' , $context );