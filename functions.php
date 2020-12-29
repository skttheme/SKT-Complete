<?php 
/**
 * SKT Complete functions and definitions
 *
 * @package SKT Complete
 */
 global $content_width;
 if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */ 
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! function_exists( 'skt_complete_setup' ) ) : 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function skt_complete_setup() {
	load_theme_textdomain( 'skt-complete', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_post_type_support( 'page', 'excerpt' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'custom-logo', array(
		'height'      => 42,
		'width'       => 205,
		'flex-height' => true,
	) );	
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'skt-complete' )			
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
} 
endif; // skt_complete_setup
add_action( 'after_setup_theme', 'skt_complete_setup' );
function skt_complete_widgets_init() { 	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'skt-complete' ),
		'description'   => esc_html__( 'Appears on sidebar', 'skt-complete' ),
		'id'            => 'sidebar-1',
		'before_widget' => '',		
		'before_title'  => '<h3 class="widget-title titleborder"><span>',
		'after_title'   => '</span></h3><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) ); 	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'skt-complete' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-complete' ),
		'id'            => 'fc-1',
		'before_widget' => '',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'skt-complete' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-complete' ),
		'id'            => 'fc-2',
		'before_widget' => '',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'skt-complete' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-complete' ),
		'id'            => 'fc-3',
		'before_widget' => '',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );		
		
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'skt-complete' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-complete' ),
		'id'            => 'fc-4',
		'before_widget' => '',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );	
	
}
add_action( 'widgets_init', 'skt_complete_widgets_init' );
function skt_complete_font_url(){
		$font_url = '';		
		/* Translators: If there are any character that are not
		* supported by Roboto Condensed, trsnalate this to off, do not
		* translate into your own language.
		*/
		$robotocondensed = _x('on','Roboto Condensed:on or off','skt-complete');		
		/* Translators: If there has any character that are not supported 
		*  by Scada, translate this to off, do not translate
		*  into your own language.
		*/	
		$roboto = _x('on','Roboto:on or off','skt-complete');
		$assistant = _x('on','Assistant:on or off','skt-complete');
		$playfairdisplay = _x('on','Playfair Display:on or off','skt-complete');
		
		if('off' !== $robotocondensed ){
			$font_family = array();
			if('off' !== $robotocondensed){
				$font_family[] = 'Roboto Condensed:300,400,600,700,800,900';
			}
			if('off' !== $roboto){
				$font_family[] = 'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i';
			}	
			if('off' !== $assistant){
				$font_family[] = 'Assistant:200,300,400,600,700,800';
			}		
			if('off' !== $playfairdisplay){
				$font_family[] = 'Playfair Display:400,400i,700,700i,900,900i';
			}	
									
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
	return $font_url;
	}
function skt_complete_scripts() {
	if ( !is_rtl() ) {
		wp_enqueue_style( 'skt-complete-basic-style', get_stylesheet_uri() );
		wp_enqueue_style( 'skt-complete-main-style', get_template_directory_uri()."/css/responsive.css" );		
	}
	if ( is_rtl() ) {
		wp_enqueue_style( 'skt-complete-rtl', get_template_directory_uri() . "/rtl.css");
	}	
	wp_enqueue_style( 'skt-complete-editor-style', get_template_directory_uri()."/editor-style.css" );
	wp_enqueue_style( 'nivo-slider', get_template_directory_uri()."/css/nivo-slider.css" );
	wp_enqueue_style( 'skt-complete-base-style', get_template_directory_uri()."/css/style_base.css" );
	wp_enqueue_script( 'jquery-nivo', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'skt-complete-custom-js', get_template_directory_uri() . '/js/custom.js' );	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skt_complete_scripts' );

define('SKT_COMPLETE_SKTTHEMES_URL','https://www.sktthemes.org');
define('SKT_COMPLETE_SKTTHEMES_PRO_THEME_URL','https://www.sktthemes.org/shop/complete-wordpress-theme');
define('SKT_COMPLETE_SKTTHEMES_FREE_THEME_URL','https://www.sktthemes.org/shop/free-modern-wordpress-theme');
define('SKT_COMPLETE_SKTTHEMES_THEME_DOC','http://sktthemesdemo.net/documentation/complete-documentation');
define('SKT_COMPLETE_SKTTHEMES_LIVE_DEMO','https://sktthemesdemo.net/complete');
define('SKT_COMPLETE_SKTTHEMES_THEMES','https://www.sktthemes.org/themes');

/**
 * Custom template for about theme.
 */
require get_template_directory() . '/inc/about-themes.php';
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
// get slug by id
function skt_complete_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}
if ( ! function_exists( 'skt_complete_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function skt_complete_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;
require_once get_template_directory() . '/customize-pro/example-1/class-customize.php';
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function skt_complete_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_html(get_bloginfo( 'pingback_url' ) ));
	}
}
add_action( 'wp_head', 'skt_complete_pingback_header' );
add_filter( 'body_class','skt_complete_body_class' );
function skt_complete_body_class( $classes ) {
 	$hideslide = get_theme_mod('hide_slides', 1);
	if (!is_home() && is_front_page()) {
		if( $hideslide == '') {
			$classes[] = 'enableslide';
		}
	}
	
	if ( skt_complete_is_woocommerce_activated() ) {
		$classes[] = 'woocommerce';
	}
	
    return $classes;
}
/**
 * Filter the except length to 21 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function skt_complete_custom_excerpt_length( $excerpt_length ) {
    return 15;
}
add_filter( 'excerpt_length', 'skt_complete_custom_excerpt_length', 999 );

/**
 * Dashboard info
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/dashboard.php' );

if ( !function_exists( 'skt_complete_is_extra_activated' ) ) {
	/**
	 * Query SKT Complete extra activation
	 */
	function skt_complete_is_extra_activated() {
		return defined( 'SKT_COMPLETE_EXTRA_CURRENT_VERSION' ) ? true : false;
	}

}
/**
 * Register TGM Plugin Activation
 */
if ( is_admin() ) {

	require_once( trailingslashit( get_template_directory() ) . 'lib/skt-complete-plugin-install.php' );
}

/**
 *
 * Style For About Theme Page
 *
 */
function skt_complete_admin_about_page_css_enqueue($hook) {
   if ( 'appearance_page_skt_complete_guide' != $hook ) {
        return;
    }
    wp_enqueue_style( 'skt-complete-about-page-style', get_template_directory_uri() . '/css/skt-complete-about-page-style.css' );
}
add_action( 'admin_enqueue_scripts', 'skt_complete_admin_about_page_css_enqueue' );

/**
 * Check if WooCommerce is activated
 */
if ( ! function_exists( 'skt_complete_is_woocommerce_activated' ) ) {
	function skt_complete_is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

/**
 * Import Demo Data
 */

function skt_complete_import_files() {
	return array(
		array(
			'import_file_name'             => 'Import SKT Complete Demo',
			'import_file_url'            => 'https://demosktthemes.com/complete/demo-content/demo-content.xml',
			'import_widget_file_url'     => 'https://demosktthemes.com/complete/demo-content/demo-content-widgets.wie',
			'import_customizer_file_url' => 'https://demosktthemes.com/complete/demo-content/demo-content-customizer.dat',
		),
	);
}
add_filter( 'theme-demo-import/import_files', 'skt_complete_import_files' );

/**
 * Assign menu and front page
 */

function skt_complete_after_import_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Header', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary' => $main_menu->term_id,
		)
	);
	
	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'theme-demo-import/after_import', 'skt_complete_after_import_setup' );

function skt_complete_import_content_intro_text( $default_text ) {
	$default_text .= '<div class="import-intro-text">Kindly click on below button to setup pages and navigation.</div>';

	return $default_text;
}
add_filter( 'theme-demo-import/plugin_intro_text', 'skt_complete_import_content_intro_text' );

// WordPress wp_body_open backward compatibility
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * Include the Plugin_Activation class.
 */

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'skt_complete_register_required_plugins' );
 
function skt_complete_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'SKT Templates',
			'slug'      => 'skt-templates',
			'required'  => false,
		) 				
	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'skt-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}