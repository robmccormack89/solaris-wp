<?php
/**
 * Block Functions
 *
 * @package Solaris_Theme
 */

/* register the blocks */
add_action( 'acf/init', 'my_acf_init' );

function my_acf_init() {
    // Bail out if function doesn’t exist.
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    // Register a new block.
    acf_register_block( array(
        'name'            => 'cover_block',
        'title'           => __( 'Cover Block', 'solaris-theme' ),
        'description'     => __( 'A Cover block for Blank Wide Template.', 'solaris-theme' ),
        'render_callback' => 'cover_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array( 'cover' ),
    ) );
    
    // Register a new block.
    acf_register_block( array(
        'name'            => 'content_block',
        'title'           => __( 'Content Block', 'solaris-theme' ),
        'description'     => __( 'A Content block for Blank Wide Template.', 'solaris-theme' ),
        'render_callback' => 'content_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array( 'content' ),
    ) );
    
    // Register a new block.
    acf_register_block( array(
        'name'            => 'colours_block',
        'title'           => __( 'Colours Block', 'solaris-theme' ),
        'description'     => __( 'A Colours block for Blank Wide Template.', 'solaris-theme' ),
        'render_callback' => 'colours_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array( 'colours' ),
    ) );
    
    // Register a new block.
    acf_register_block( array(
        'name'            => 'cta_block',
        'title'           => __( 'CTA Block', 'solaris-theme' ),
        'description'     => __( 'A CTA block for Blank Wide Template.', 'solaris-theme' ),
        'render_callback' => 'cta_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array( 'cta' ),
    ) );
}

function cover_block_render_callback( $block, $content = '', $is_preview = false ) {
    $context = Timber::context();
    $post = Timber::query_post();
    $context['post'] = $post;

    // Store block values.
    $context['block'] = $block;

    // Store field values.
    $context['fields'] = get_fields();

    // Store $is_preview value.
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render( 'cover-block.twig', $context );
}

function content_block_render_callback( $block, $content = '', $is_preview = false ) {

    // Store block values.
    $context['block'] = $block;

    // Store field values.
    $context['fields'] = get_fields();

    // Store $is_preview value.
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render( 'content-block.twig', $context );
}

function colours_block_render_callback( $block, $colours = '', $is_preview = false ) {

    // Store block values.
    $context['block'] = $block;

    // Store field values.
    $context['fields'] = get_fields();

    // Store $is_preview value.
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render( 'colours-block.twig', $context );
}

function cta_block_render_callback( $block, $cta = '', $is_preview = false ) {

    // Store block values.
    $context['block'] = $block;

    // Store field values.
    $context['fields'] = get_fields();

    // Store $is_preview value.
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render( 'cta-block.twig', $context );
}