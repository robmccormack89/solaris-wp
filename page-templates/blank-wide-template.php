<?php
/**
 * Template Name: Blank Wide Template
 *
 * @package RMcC_Uikit_Starter
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render(  'blank-wide-template.twig' , $context );