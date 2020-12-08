<?php
declare(strict_types=1);

/**
 * Composer
 */
if ( !file_exists($composer = __DIR__ . '/vendor/autoload.php') ) {
    wp_die( __( 'Error locating autoloader. Please run <code>composer install</code>.', 'spacepress' ) );
}

require $composer;

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once __DIR__ . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

require_once __DIR__ . '/inc/admin.php';
require_once __DIR__ . '/inc/default.php';
require_once __DIR__ . '/inc/functions.php';

/**
 * Setup Carbon Fields
 */
add_action( 'carbon_fields_register_fields', 'spacepress_carbon_attach_theme_options' );
add_action( 'carbon_fields_register_fields', 'spacepress_carbon_attach_user_meta' );
add_action( 'after_setup_theme', 'spacepress_carbon_load' );

/**
 * SpacePress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SpacePress
 */

if ( ! defined( 'SPACEPRESS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'SPACEPRESS_VERSION', wp_get_theme()->get( 'Version' ) );
}

if ( ! function_exists( 'spacepress_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function spacepress_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on SpacePress, use a find and replace
		 * to change 'spacepress' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'spacepress', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'spacepress' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'spacepress_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'spacepress_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function spacepress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'spacepress_content_width', 640 );
}
add_action( 'after_setup_theme', 'spacepress_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function spacepress_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'spacepress' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'spacepress' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'spacepress_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function spacepress_scripts() {
	// bootstrap
	if ( carbon_get_theme_option( 'cdn_bootstrap' ) ){
		$bootstrap_url = 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist';

	} else {
		$bootstrap_url = get_template_directory_uri() . '/js/bootstrap-5.0.0-alpha3';

	}
 
	wp_enqueue_style( 'bootstrap-style', $bootstrap_url . '/css/bootstrap.min.css', [], '5.0.0-alpha3' );
	wp_enqueue_script( 'bootstrap-script', $bootstrap_url . '/js/bootstrap.bundle.min.js', [], '5.0.0-alpha3', true );

	// theme
	wp_enqueue_style( 'spacepress-style', get_stylesheet_uri(), [], SPACEPRESS_VERSION );
	wp_style_add_data( 'spacepress-style', 'rtl', 'replace' );

	// custom theme
	if ( $style = carbon_get_theme_option( 'theme' ) ){
		$file = get_stylesheet_directory_uri() . '/styles/' . $style . '.css';
		wp_enqueue_style( 'spacepress-custom-style', $file, [], SPACEPRESS_VERSION );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'spacepress_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
