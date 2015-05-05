<?php
/**
 * Plugin Name: Replace Header Right with Header Nav Menu
 * Description: Removes the Header Right widget area in a Genesis theme & replaces it with a nav menu location called "Header"
 * Version: 0.1
 * Author: cgrymala
 * License: GPL2
 */

if ( ! class_exists( 'UMW_Header_Right' ) ) {
	class UMW_Header_Right {
		function __construct() {
			add_action( 'after_setup_theme', array( $this, 'unregister_sidebars' ) );
			add_action( 'after_setup_theme', array( $this, 'register_nav_menus' ) );
			add_action( 'genesis_header_right', array( $this, 'do_header_right' ) );
			add_action( 'umw-header-right', array( $this, 'do_header_right' ) );
		}
		
		function unregister_sidebars() {
			unregister_sidebar( 'header-right' );
		}
		
		function register_nav_menus() {
			if ( ! function_exists( 'genesis' ) )
				return false;
			register_nav_menu( 'header-right', __( 'Header Menu' ) );
		}
		
		function do_header_right() {
			wp_nav_menu( array(
				'theme_location' => 'header-right', 
				'container'      => 'nav', 
				'fallback_cb'    => false,
			) );
		}
	}
	
	function inst_umw_header_right_obj() {
		global $umw_header_right_obj;
		$umw_header_right_obj = new UMW_Header_Right;
	}
	add_action( 'muplugins_loaded', 'inst_umw_header_right_obj' );
}