<?php
/**
 * WordPress.com-specific functions and definitions.
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package Fire_and_Ice
 */

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @global array $themecolors
 */
function fireandice_wpcom_setup() {
	global $themecolors;

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {
		$themecolors = array(
			'bg'     => '',
			'border' => '',
			'text'   => '',
			'link'   => '',
			'url'    => '',
		);
	}
}
add_action( 'after_setup_theme', 'fireandice_wpcom_setup' );

/*
 * De-queue Google fonts if custom fonts are being used instead
 */
function fireandice_dequeue_fonts() {
	if ( class_exists( 'TypekitData' ) && class_exists( 'CustomDesign' ) && CustomDesign::is_upgrade_active() ) {
		$customfonts = TypekitData::get( 'families' );
		if ( $customfonts && $customfonts['site-title']['id'] && $customfonts['headings']['id'] && $customfonts['body-text']['id'] ) {
			wp_dequeue_style( 'fireandice-' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'fireandice_dequeue_fonts' );
