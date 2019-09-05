<?php
/**
 * Template Name: Left Sidebar Template
 *
 * @package RMcC_Uikit_Starter
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render(  'left-sidebar-template.twig' , $context );