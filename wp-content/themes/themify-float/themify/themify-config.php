<?php
/***************************************************************************
 *
 * 	----------------------------------------------------------------------
 * 							DO NOT EDIT THIS FILE
 *	----------------------------------------------------------------------
 *
 * 						Copyright (C) Themify
 *
 *	----------------------------------------------------------------------
 *
 ***************************************************************************/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Theme and Themify Framework Path and URI
 * @since 1.2.2 
 */
defined( 'THEME_DIR' ) || define( 'THEME_DIR', get_template_directory() );
defined( 'THEME_URI' ) || define( 'THEME_URI', get_template_directory_uri() );
defined( 'THEMIFY_DIR' ) || define( 'THEMIFY_DIR', THEME_DIR . '/themify' );
defined( 'THEMIFY_URI' ) || define( 'THEMIFY_URI', THEME_URI . '/themify' );
defined( 'THEMIFYMIN' ) || define( 'THEMIFYMIN', defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min' );

function themify_config_init() {

	/* 	Global Vars
 	***************************************************************************/
	global $pagenow, $ThemifyConfig, $content_width;

	if ( ! isset( $content_width ) ) {
		$content_width = 1165;
	}

	/*	Activate Theme
 	***************************************************************************/
	if ( isset( $_GET['activated'] ) && 'themes.php' == $pagenow ) {
		themify_maybe_clear_legacy();
		add_action( 'init', 'themify_theme_first_run', 20 );

		include_once( trailingslashit( THEMIFY_DIR ) . 'themify-builder/first-run.php' );

		/* on new installations, set a flag to prevent shortcodes from loading */
		if( false == get_option( 'themify_data' ) ) {
			themify_set_flag( 'deprecate_shortcodes' );
		}
	}


	/* 	Theme Config
 	***************************************************************************/
	define( 'THEMIFY_VERSION', '3.2.6' ); 

	/* 	Run after update
 	***************************************************************************/
	if ( is_admin() && 'update_ok' === get_option( 'themify_update_ok_flag' ) ) {
		/**
		 * Fires after the updater finished the updating process.
		 *
		 * @since 1.8.3
		 */
		do_action( 'themify_updater_post_install' );
	}

	/* 	Woocommerce
	 ***************************************************************************/
	if( themify_is_woocommerce_active() ) {
		add_theme_support('woocommerce');
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	/**
	 * Editor Style
	 * @since 2.0.2
	 */
	add_editor_style();
	add_theme_support( 'title-tag' );

}
add_action( 'after_setup_theme', 'themify_config_init' );

function themify_theme_first_run() {
	flush_rewrite_rules();
	header( 'Location: ' . admin_url() . 'admin.php?page=themify&firsttime=true' );
}

///////////////////////////////////////
// Load theme languages
///////////////////////////////////////

load_theme_textdomain( 'themify', THEME_DIR.'/languages' );

require_once( THEME_DIR . '/themify/themify-icon-picker/themify-icon-picker.php' );
Themify_Icon_Picker::get_instance( THEMIFY_URI . '/themify-icon-picker' );
Themify_Icon_Picker::get_instance()->register( 'Themify_Icon_Picker_FontAwesome' );
Themify_Icon_Picker::get_instance()->register( 'Themify_Icon_Picker_Themify' );
include( THEMIFY_DIR . '/themify-fontello.php' );

require_once THEMIFY_DIR . '/img.php';

/**
 * Load Filesystem Class
 * @since 2.5.8
 */
require_once( THEME_DIR . '/themify/class-themify-filesystem.php' );

/**
 * Load Cache
 */
require_once(THEME_DIR . '/themify/class-themify-cache.php');

/**
 * Load Page Builder
 * @since 1.1.3
 */
require_once( THEMIFY_DIR . '/themify-builder/themify-builder.php' );

/**
 * Load Customizer
 * @since 1.8.2
 */
require_once THEMIFY_DIR . '/customizer/class-themify-customizer.php';

/**
 * Load Schema.org Microdata
 * @since 2.6.5
 */
require_once THEMIFY_DIR . '/themify-microdata.php';

require_once THEMIFY_DIR . '/themify-wp-filters.php';
require_once THEMIFY_DIR . '/themify-plugin-compatibility.php';
require_once THEMIFY_DIR . '/themify-template-tags.php';
require_once THEMIFY_DIR . '/class-themify-menu-icons.php';

if( is_admin() )
	require_once THEMIFY_DIR . '/themify-admin.php';

/**
 * Enqueue framework CSS Stylesheets:
 * 1. themify-skin
 * 2. custom-style
 * 3. fontawesome - added 1.7.8
 *
 * @since 1.7.4
 */
add_action( 'wp_enqueue_scripts', 'themify_enqueue_framework_assets', 12 );

/**
 * Sets the WP Featured Image size selected for Query Category pages
 */
add_action( 'template_redirect', 'themify_feature_size_page' );

/**
 * Outputs html to display alert messages in post edit/new screens. Excludes pages.
 */
add_action( 'admin_notices', 'themify_prompt_message' );

/**
 * Load Google fonts library
 */
add_filter( 'themify_google_fonts', 'themify_enqueue_gfonts' );

/**
 * Add "js" classname to html element when JavaScript is enabled
 */
add_action( 'wp_head', 'themify_html_js_class', 0 );

add_action( 'wp_enqueue_scripts', 'themify_enqueue_common_css', 7 );

/**
 * Display sticky posts in the loops
 */
add_filter( 'the_posts', 'themify_sticky_post_helper' );

/**
 * Allows to query by category slug or id
 */
add_filter( 'themify_query_posts_page_args', 'themify_framework_query_posts_page_args' );

/**
 * Add support for feeds on the site
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Load Themify Hooks
 * @since 1.2.2
 */
require_once(THEMIFY_DIR . '/themify-hooks.php' );
require_once(THEMIFY_DIR . '/class-hook-contents.php' );

/**
 * Load Themify Role Access Control
 * @since 2.6.2
 */
require_once( THEMIFY_DIR . '/class-themify-access-role.php' );

defined( 'THEMIFY_METABOX_URI' ) || define( 'THEMIFY_METABOX_URI', THEMIFY_URI . '/themify-metabox/' );
defined( 'THEMIFY_METABOX_DIR' ) || define( 'THEMIFY_METABOX_DIR', THEMIFY_DIR . '/themify-metabox/' );
require_once( THEMIFY_DIR . '/themify-metabox/themify-metabox.php' );

// register custom field types only available in the framework
add_action( 'themify_metabox/field/fontawesome', 'themify_meta_field_fontawesome', 10, 1 );
add_action( 'themify_metabox/field/sidebar_visibility', 'themify_meta_field_sidebar_visibility', 10, 1 );
add_action( 'themify_metabox/field/featimgdropdown', 'themify_meta_field_featimgdropdown', 10, 1 );
add_action( 'themify_metabox/field/page_builder', 'themify_meta_field_page_builder', 10, 1 );

require_once( THEMIFY_DIR . '/google-fonts/functions.php' );

// Page Options, disabled at the moment
// require_once( THEMIFY_DIR . '/page-options/themify-pageoptions.php' );

/**
 * Show recommended or full Google fonts list
 *
 * @since 2.8.9
 */
function themify_google_fonts_show_full() {
	return 'full' == themify_get( 'setting-webfonts_list' );
}
add_filter( 'themify_google_fonts_full_list', 'themify_google_fonts_show_full' );

/**
 * Filter Google web fonts list based on subset selection from user
 *
 * @since 2.8.9
 */
function themify_filter_google_fonts_subsets( $subsets ) {
	$setting_webfonts_subsets = sanitize_text_field( themify_get( 'setting-webfonts_subsets' ) );
	if ( themify_check( 'setting-webfonts_subsets' ) && '' != $setting_webfonts_subsets ) {
		$user_subsets = explode( ',', str_replace( ' ', '', $setting_webfonts_subsets ) );
	} else {
		$user_subsets = array();
	}

	return array_merge( $subsets, $user_subsets );
}
add_filter( 'themify_google_fonts_subsets', 'themify_filter_google_fonts_subsets' );

/**
 * Admin Only code follows
 ******************************************************/
if( is_admin() ){

	/**
	 * Initialize settings page and update permissions.
	 * @since 2.1.8
	 */
	add_action( 'init', 'themify_after_user_is_authenticated' );

	/**
 	* Enqueue jQuery and other scripts
 	*******************************************************/
	add_action( 'admin_enqueue_scripts', 'themify_enqueue_scripts', 12 );

	/**
 	* Ajaxify admin
 	*******************************************************/
	require_once(THEMIFY_DIR . '/themify-wpajax.php');
}

/**
 * In this hook current user is authenticated so we can check for capabilities.
 *
 * @since 2.1.8
 */
function themify_after_user_is_authenticated() {
	if ( current_user_can( 'manage_options' ) ) {

		/**
	 	 * Themify - Admin Menu
	 	 *******************************************************/
		add_action( 'admin_menu', 'themify_admin_nav' );

		/**
		 * Themify Updater - In multisite, it's only available to super admins.
		 **********************************************************************/
		if ( themify_allow_update() ) {
			require_once THEMIFY_DIR . '/themify-updater.php';
		}
	}
}

/**
 * Clear legacy themify-ajax.php and strange files that might have been uploaded to or directories created in the uploads folder within the theme.
 * @since 1.6.3
 */
function themify_maybe_clear_legacy() {
	if ( ! function_exists( 'WP_Filesystem' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
	}

	WP_Filesystem();
	global $wp_filesystem;

	$flag = 'themify_clear_legacy';
	$clear = get_option( $flag );
	if ( ! isset( $clear ) || ! $clear ) {
		$legacy = THEMIFY_DIR . '/themify-ajax.php';
		if ( $exists = $wp_filesystem->exists( $legacy ) ) {
			$wp_filesystem->delete( $legacy );
		}
		$list = $wp_filesystem->dirlist( THEME_DIR . '/uploads/', true, true );
		if ( is_array( $list ) ) {
			foreach ( $list as $item ) {
				if ( 'd' == $item['type'] ) {
					foreach ( $item['files'] as $subitem ) {
						if ( 'd' == $subitem['type'] ) {
							// There shouldn't be a directory here, let's delete it
							$del_dir = THEME_DIR . '/uploads/' . $item['name'] . '/' . $subitem['name'];
							$wp_filesystem->delete( $del_dir, true );
						} else {
							$extension = pathinfo( $subitem['name'], PATHINFO_EXTENSION );
							if ( ! in_array( $extension, array( 'jpg', 'gif', 'png', 'jpeg', 'bmp' ) ) ) {
								$del_file = THEME_DIR . '/uploads/' . $item['name'] . '/' . $subitem['name'];
								$wp_filesystem->delete( $del_file );
							}
						}
					}
				} else {
					$extension = pathinfo( $item['name'], PATHINFO_EXTENSION );
					if ( ! in_array( $extension, array( 'jpg', 'gif', 'png', 'jpeg', 'bmp' ) ) ) {
						$del_file = THEME_DIR . '/uploads/' . $item['name'];
						$wp_filesystem->delete( $del_file );
					}
				}
			}
		}
		update_option( $flag, true );
	}
}
add_action( 'init', 'themify_maybe_clear_legacy', 9 );

/**
 * Change setting name where theme settings are stored.
 * Runs after updater succeeded.
 * @since 1.7.6
 */
function themify_migrate_settings_name() {
	$flag = 'themify_migrate_settings_name';
	$change = get_option( $flag );
	if ( ! isset( $change ) || ! $change ) {
		if ( $themify_data = get_option( wp_get_theme()->display('Name') . '_themify_data' ) ) {
			themify_set_data( $themify_data );
		}
		update_option( $flag, true );
	}
}
add_action( 'after_setup_theme', 'themify_migrate_settings_name', 1 );

/**
 * Function called after a successful update through WP Admin.
 * Code to run ONLY ONCE after update must be added here.
 *
 * @since 1.8.3
 */
function themify_theme_updater_post_install() {
	// Delete option to reset styling behaviour
	delete_option( 'themify_has_styling_data' );

	// Once all tasks have been executed, delete the flag.
	delete_option( 'themify_update_ok_flag' );
}
add_action( 'themify_updater_post_install', 'themify_theme_updater_post_install' );

/**
 * Refresh permalinks to avoid 404 on custom post type fetching.
 * @since 1.9.3
 */
function themify_flush_rewrite_rules_after_manual_update() {
	$flag = 'themify_flush_rewrite_rules_after_manual_update';
	$change = get_option( $flag );
	if ( ! isset( $change ) || ! $change ) {
		flush_rewrite_rules();
		update_option( $flag, true );
	}
}
add_action( 'init', 'themify_flush_rewrite_rules_after_manual_update', 99 );

/**
 * After a Builder layout is loaded, adjust some page settings for better page display
 *
 * @since 2.8.9
 */
function themify_adjust_page_settings_for_layouts( $args ) {
	if( 'custom' == $args['layout_group'] )
		return;
	$post_id = $args['current_builder_id'];
	$post = get_post( $post_id );
	update_post_meta( $post_id, 'content_width', 'full_width' );
	if( $post->post_type == 'page' ) {
		update_post_meta( $post_id, 'page_layout', 'sidebar-none' );
		update_post_meta( $post_id, 'hide_page_title', 'yes' );
	} else {
		update_post_meta( $post_id, 'layout', 'sidebar-none' );
		update_post_meta( $post_id, 'hide_post_title', 'yes' );
	}
}
add_action( 'themify_builder_layout_loaded', 'themify_adjust_page_settings_for_layouts' );
add_action( 'themify_builder_layout_appended', 'themify_adjust_page_settings_for_layouts' );

/**
 * Load themeforest-functions.php file if available
 * Additional functions for the theme from ThemeForest store.
 */
if( file_exists( trailingslashit( get_template_directory() ) . 'themeforest-functions.php' ) ) {
	include( trailingslashit( get_template_directory() ) . 'themeforest-functions.php' );
}

/**
 * Themify Shortcodes
 *
 * @deprecated since 3.1.3
 *
 * These shortcodes are only loaded if the theme was installed before the 3.1.3 update,
 * to provide backward compatibility.
 */
function themify_deprecated_shortcodes_init() {
	if( themify_get_flag( 'deprecate_shortcodes' ) ) {
		return;
	}

	require_once THEMIFY_DIR . '/themify-shortcodes.php';
	require_once THEMIFY_DIR . '/tinymce/class-themify-tinymce.php';

	/**
	 * Flush twitter transient data
	 */
	add_action( 'save_post', 'themify_twitter_flush_transient' );
	/**
	 * Fix empty auto paragraph in shortcodes
	 */
	add_filter( 'the_content', 'themify_fix_shortcode_empty_paragraph' );
	add_filter( 'themify_builder_module_content', 'themify_fix_shortcode_empty_paragraph' );

	/**
	 * Assets required for the Themify shortcodes
	 *
	 * @since 3.1.3 
	 */	
	function themify_shortcodes_js_css() {
		wp_enqueue_style( 'themify-framework', themify_enque( THEMIFY_URI . '/css/themify.framework.css' ) );
	}
	add_action( 'wp_enqueue_scripts', 'themify_shortcodes_js_css', 8 );

	/**
	 * Prevent framework.css stylesheet from loading in the page, the stylesheet is loaded in main.js
	 *
	 * @return html
	 */
	function themify_framework_stylesheet_style_tag( $tag, $handle, $href, $media ) {
		if( 'themify-framework' == $handle ) {
			$tag = '<meta name="themify-framework-css" content="themify-framework-css" id="themify-framework-css">' . "\n";
		}

		return $tag;
	}
	add_filter( 'style_loader_tag', 'themify_framework_stylesheet_style_tag', 10, 4 );

	if ( ! function_exists( 'themify_shortcode_list' ) ) :
	/**
	 * Return list of Themify shortcodes.
	 *
	 * @since 1.9.4
	 *
	 * @return array Collection of shortcodes as keys and callbacks as values.
	 */
	function themify_shortcode_list() {
		return array(
			'is_logged_in' => 'themify_shortcode',
			'is_guest'     => 'themify_shortcode',
			'button'       => 'themify_shortcode',
			'quote'        => 'themify_shortcode',
			'col'          => 'themify_shortcode',
			'sub_col'      => 'themify_shortcode',
			'img'          => 'themify_shortcode',
			'hr'           => 'themify_shortcode',
			'map'          => 'themify_shortcode',
			'list_posts'   => 'themify_shortcode_list_posts',
			'flickr'       => 'themify_shortcode_flickr',
			'twitter'      => 'themify_shortcode_twitter',
			'box'          => 'themify_shortcode_box',
			'post_slider'  => 'themify_shortcode_post_slider',
			'slider'       => 'themify_shortcode_slider',
			'slide'        => 'themify_shortcode_slide',
			'author_box'   => 'themify_shortcode_author_box',
			'icon'         => 'themify_shortcode_icon',
			'list'         => 'themify_shortcode_icon_list',
		);
	}
	endif;

	/**
	 * Add Themify Shortcodes, an unprefixed version and a prefixed version.
	 */
	foreach( themify_shortcode_list() as $themify_sc => $themify_sc_callback) {
		add_shortcode( $themify_sc, $themify_sc_callback );
		add_shortcode( 'themify_' . $themify_sc, $themify_sc_callback );
	}
	// Backwards compatibility
	add_shortcode( 'themify_video', 'wp_video_shortcode' );
}
add_action( 'after_setup_theme', 'themify_deprecated_shortcodes_init' );

/**
 * Setup procedure to load theme features packed in Themify framework
 *
 * @since 3.2.0
 */
function themify_load_theme_features() {
	/* load megamenu feature */
	if( current_theme_supports( 'themify-mega-menu' ) ) {
		include( THEMIFY_DIR . '/megamenu/class-mega-menu.php' );
	}
}
add_action( 'after_setup_theme', 'themify_load_theme_features', 11 );