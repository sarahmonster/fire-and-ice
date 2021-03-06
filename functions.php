<?php
/**
 * Fire and Ice functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fire_and_Ice
 */

if ( ! function_exists( 'fireandice_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fireandice_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'fireandice' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'fireandice', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'fireandice-featured-image', 640, 9999 );
	add_image_size( 'fireandice-thumbnail', 960, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Top', 'fireandice' ),
	) );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 200,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'fireandice_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'fireandice_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fireandice_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fireandice_content_width', 640 );
}
add_action( 'after_setup_theme', 'fireandice_content_width', 0 );

/**
 * Return early if Custom Logos are not available.
 *
 * @todo Remove after WP 4.7
 */
function fireandice_the_custom_logo() {
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	} else {
		the_custom_logo();
	}
}

/**
 * Register Google Fonts
 */
function fireandice_fonts_url() {
	$fonts_url = '';

    /* Translators: If there are characters in your language that are not
	 * supported by Vidaloka, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$vidaloka = esc_html_x( 'on', 'Vidaloka font: on or off', 'fireandice' );

	/* Translators: If there are characters in your language that are not
	 * supported by Karla, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$karla = esc_html_x( 'on', 'Karla font: on or off', 'fireandice' );

	$font_families = array();

	if ( 'off' !== $vidaloka ) {
		$font_families[] = 'Vidaloka';
	}

	if ( 'off' !== $karla ) {
		$font_families[] = 'Karla:400,400i,700,700i';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

	return $fonts_url;

}

/**
 * Enqueue Google Fonts for Editor Styles
 */
function fireandice_editor_styles() {
    add_editor_style( array( 'editor-style.css', fireandice_fonts_url() ) );
}
add_action( 'after_setup_theme', 'fireandice_editor_styles' );

/**
 * Enqueue Google Fonts for custom headers
 */
function fireandice_admin_scripts( $hook_suffix ) {

	wp_enqueue_style( 'fireandice-fonts', fireandice_fonts_url(), array(), null );

}
add_action( 'admin_print_styles-appearance_page_custom-header', 'fireandice_admin_scripts' );

/**
 * Enqueue scripts and styles.
 */
function fireandice_scripts() {
	wp_enqueue_style( 'fireandice-style', get_stylesheet_uri() );
	wp_enqueue_style( 'fireandice-fonts', fireandice_fonts_url(), array(), null );

	wp_enqueue_script( 'fireandice-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'fireandice-duotone', get_template_directory_uri() . '/assets/js/duotone.js', array(), '20161113', true );

	wp_enqueue_script( 'fireandice-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fireandice_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
