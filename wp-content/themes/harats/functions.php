<?php
/**
 * harats functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package harats
 */

if ( ! function_exists( 'harats_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function harats_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on harats, use a find and replace
	 * to change 'harats' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'harats', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'harats' ),
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
	add_theme_support( 'custom-background', apply_filters( 'harats_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'harats_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function harats_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'harats_content_width', 640 );
}
add_action( 'after_setup_theme', 'harats_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function harats_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'harats' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'harats' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'harats_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function harats_scripts() {
	wp_enqueue_style( 'harats-style', get_stylesheet_uri() );

	wp_enqueue_script( 'harats-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'harats-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'harats_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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

//Gets post cat slug and looks for single-[cat slug].php and applies it
add_filter('single_template', create_function(
		'$the_template',
		'foreach( (array) get_the_category() as $cat ) {
			if (strpos($cat->slug, \'-\') !== false) {
				$arraySlug = explode(\'-\', $cat->slug);
				$catSlug = $arraySlug[0];
			} else {
				$catSlug = $cat->slug;
			}
		if ( file_exists(TEMPLATEPATH . "/single-{$catSlug}.php") )
		return TEMPLATEPATH . "/single-{$catSlug}.php"; }
	return $the_template;' )
);

//Gets post cat slug and looks for single-[cat slug].php and applies it
add_filter('archive_template', create_function(
		'$the_template',
		'$cat = get_queried_object();
		if (strpos($cat->slug, \'-\') !== false) {
				$arraySlug = explode(\'-\', $cat->slug);
				$catSlug = $arraySlug[0];
			} else {
				$catSlug = $cat->slug;
			}
		if ( file_exists(TEMPLATEPATH . "/archive-{$catSlug}.php") )
		return TEMPLATEPATH . "/archive-{$catSlug}.php";
	return $the_template;' )
);

function yourprefix_get_menu_items($menu_name){
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		return wp_get_nav_menu_items($menu->term_id);
	}
};

add_filter( 'category_rewrite_rules', 'vipx_filter_category_rewrite_rules' );
function vipx_filter_category_rewrite_rules( $rules ) {
	$categories = get_categories( array( 'hide_empty' => false ) );

	if ( is_array( $categories ) && ! empty( $categories ) ) {
		$slugs = array();
		foreach ( $categories as $category ) {
			if ( is_object( $category ) && ! is_wp_error( $category ) ) {
				if ( 0 == $category->category_parent ) {
					$slugs[] = $category->slug;
				} else {
					$slugs[] = trim( get_category_parents( $category->term_id, false, '/', true ), '/' );
				}
			}
		}

		if ( ! empty( $slugs ) ) {
			$rules = array();

			foreach ( $slugs as $slug ) {
				$rules[ '(' . $slug . ')/feed/(feed|rdf|rss|rss2|atom)?/?$' ] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
				$rules[ '(' . $slug . ')/(feed|rdf|rss|rss2|atom)/?$' ] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
				$rules[ '(' . $slug . ')(/page/(\d)+/?)?$' ] = 'index.php?category_name=$matches[1]&paged=$matches[3]';
			}
		}
	}
	return $rules;
};
