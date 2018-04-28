<?php
/**
 * Speedster Theme Customizer
 *
 * @package Speedster
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function speedster_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	// Load Upgrade to Pro control.
	require_once trailingslashit( get_template_directory() ) . '/inc/pro/pro.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'speedster_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new speedster_Customize_Section_Upsell(
			$wp_customize,
			'speedster_upsell',
			array(
				'title'    => esc_html__( 'Upgrade to Pro', 'ithemer' ),
				'pro_text' => esc_html__( 'Buy Speedster Pro', 'ithemer' ),
				'pro_url'  => 'https://scorpionthemes.com/downloads/speedster-pro-wordpress-theme/',
				'priority' => 1,
			)
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'speedster_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'speedster_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'speedster_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function speedster_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function speedster_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function speedster_customize_preview_js() {
	wp_enqueue_script( 'speedster-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'speedster_customize_preview_js' );

function speedster_customizer_control_scripts() {

	wp_enqueue_script( 'speedster-pro', get_template_directory_uri() . '/inc/pro/pro.js', array('costomize-controls') );

	wp_enqueue_style( 'speedster-pro', get_template_directory_uri() . '/inc/pro/pro.css' );

}

add_action( 'customize_controls_enqueue_scripts', 'speedster_customizer_control_scripts', 0 );
