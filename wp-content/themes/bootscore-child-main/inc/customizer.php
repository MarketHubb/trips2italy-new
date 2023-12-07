<?php
/**
 * Trips2Italy 2018 Theme Customizer
 *
 * @package Trips2Italy_2018
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function trips2italy_twentyeighteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'trips2italy_twentyeighteen_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'trips2italy_twentyeighteen_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'trips2italy_twentyeighteen_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function trips2italy_twentyeighteen_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function trips2italy_twentyeighteen_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function trips2italy_twentyeighteen_customize_preview_js() {
	wp_enqueue_script( 'trips2italy_twentyeighteen-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'trips2italy_twentyeighteen_customize_preview_js' );
