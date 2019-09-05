<?php
/**
 * Template Name: Right Sidebar Template
 *
 * @package RMcC_Uikit_Starter
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render(  'right-sidebar-template.twig' , $context );