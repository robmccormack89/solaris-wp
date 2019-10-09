<?php
/**
 * Template Name: Blank Wide Template
 *
 * @package RMcC_Uikit_Starter
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['options'] = get_fields('options');
Timber::render(  'blank-wide-template.twig' , $context );