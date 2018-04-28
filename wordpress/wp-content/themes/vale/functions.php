<?php

/*-----------------------------------------------------------------------------------*/
/* STYLES AND SCRIPTS */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('vale_enqueue_scripts')) {

	function vale_enqueue_scripts() {

		wp_deregister_style ( 'suevafree-style' );
		wp_deregister_style ( 'suevafree-header_layout_1');

		if ( !suevafree_setting( 'vale_header_layout') || suevafree_setting( 'vale_header_layout') == 'vale_header_layout' ) {
		
			wp_enqueue_style( 'vale-header_layout', get_stylesheet_directory_uri() . '/assets/css/header-layout.css' );
			wp_enqueue_script( 'vale_template', get_stylesheet_directory_uri() . '/assets/js/jquery.functions.js' , array('jquery'), FALSE, TRUE );

		} else {
		
			$header_layout = str_replace('suevafree_', '', suevafree_setting( 'vale_header_layout'));
			wp_enqueue_style( 'suevafree-' . $header_layout , get_template_directory_uri() . '/assets/css/header/' . $header_layout . '.css' );
		
		}

		if ( !get_theme_mod('suevafree_skin') ) {

			wp_enqueue_style( 'vale-orange' , get_template_directory_uri() . '/assets/skins/orange.css' ); 

		} else if ( get_theme_mod('suevafree_skin') ) {

			wp_deregister_style( 'suevafree-' . get_theme_mod('suevafree_skin')); 
			wp_enqueue_style( 'vale-' . get_theme_mod('suevafree_skin') , get_template_directory_uri() . '/assets/skins/' . get_theme_mod('suevafree_skin') . '.css' ); 

		}

		wp_deregister_style( 'suevafree_google_fonts' );
		
		$fonts_args = array(
			'family' =>	str_replace('|', '%7C','Libre+Franklin:300,300i,400,400i,500,500i,600,600i,700,700i|Dr+Sugiyama'),
			'subset' =>	'latin,greek,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic'
		);
		
		wp_enqueue_style( 'vale_google_fonts', add_query_arg ($fonts_args, "https://fonts.googleapis.com/css" ), array(), null);
		wp_enqueue_style( 'vale_template' , get_stylesheet_directory_uri() . '/assets/css/template.css' ); 
	
	}
	
	add_action( 'wp_enqueue_scripts', 'vale_enqueue_scripts', 99 );

}

/*-----------------------------------------------------------------------------------*/
/* SETUP */
/*-----------------------------------------------------------------------------------*/ 

if (!function_exists('vale_theme_setup')) {

	function vale_theme_setup() {

		load_child_theme_textdomain( 'vale', get_stylesheet_directory() . '/languages' );
		require_once( trailingslashit( get_stylesheet_directory() ) . 'template-part/header-layout.php' );

	}

	add_action( 'after_setup_theme', 'vale_theme_setup', 11 );

}

/*-----------------------------------------------------------------------------------*/
/* CUSTOMIZE */
/*-----------------------------------------------------------------------------------*/   

if (!function_exists('vale_customize_register')) {

	function vale_customize_register( $wp_customize ) {

		$wp_customize->remove_setting( 'suevafree_header_layout');
		$wp_customize->remove_control( 'suevafree_header_layout');

		$wp_customize->add_setting( 'vale_header_layout', array(
			'default' => 'vale_header_layout',
			'sanitize_callback' => 'vale_select_sanitize',
		));

		$wp_customize->add_control( 'vale_header_layout' , array(
									
			'type' => 'select',
			'section' => 'layouts_section',
			'priority' => 1,
			'label' => esc_html__('Header Layout','vale'),
			'description' => esc_html__('Header Layout','vale'),
			'choices'  => array (
				'vale_header_layout' => esc_html__( 'Vale Header Layout',   'vale'),
				'suevafree_header_layout_1' => esc_html__( 'SuevaFree Header Layout 1', 'vale'),
				'suevafree_header_layout_2' => esc_html__( 'SuevaFree Header Layout 2', 'vale'),
				'suevafree_header_layout_3' => esc_html__( 'SuevaFree Header Layout 3', 'vale'),
				'suevafree_header_layout_4' => esc_html__( 'SuevaFree Header Layout 4', 'vale'),
				'suevafree_header_layout_5' => esc_html__( 'SuevaFree Header Layout 5', 'vale'),
			),
												
		));

		function vale_select_sanitize ($value, $setting) {
		
			global $wp_customize;
					
			$control = $wp_customize->get_control( $setting->id );
				 
			if ( array_key_exists( $value, $control->choices ) ) {
					
				return $value;
					
			} else {
					
				return $setting->default;
					
			}
			
		}

	}
	
	add_action( 'customize_register', 'vale_customize_register', 11 );

}

/*-----------------------------------------------------------------------------------*/
/* VALE THEME DEFAULT VALUES */
/*-----------------------------------------------------------------------------------*/   

if (!function_exists('vale_setup')) {

	function vale_setup() {

		if ( !suevafree_setting('suevafree_thumb_triangle') )
			set_theme_mod( 'suevafree_thumb_triangle', 'on' );
			
		if ( !suevafree_setting('suevafree_thumb_hover') )
			set_theme_mod( 'suevafree_thumb_hover', 'on' );
			
		if ( !suevafree_setting('suevafree_disable_box_shadow') )
			set_theme_mod( 'suevafree_disable_box_shadow', 'on' );

		if ( !suevafree_setting('suevafree_post_format_layout') )
			set_theme_mod( 'suevafree_post_format_layout', 'on' );

		if ( !suevafree_setting('suevafree_post_details_layout') )
			set_theme_mod( 'suevafree_post_details_layout', 'suevafree_before_content_2' );

		if ( !suevafree_setting('suevafree_page_details_layout') )
			set_theme_mod( 'suevafree_page_details_layout', 'suevafree_before_content_3' );

		if ( !suevafree_setting('suevafree_sidebar_layout') )
			set_theme_mod( 'suevafree_sidebar_layout', 'sneak' );

		if ( !suevafree_setting('suevafree_footer_layout') )
			set_theme_mod( 'suevafree_footer_layout', 'footer_layout_3' );

		if ( !suevafree_setting('suevafree_menu_font_size') )
			set_theme_mod( 'suevafree_menu_font_size', '12px' );

		if ( !suevafree_setting('suevafree_menu_font_weight') )
			set_theme_mod( 'suevafree_menu_font_weight', '600' );


	}

	add_action( 'after_setup_theme', 'vale_setup' );

}

?>