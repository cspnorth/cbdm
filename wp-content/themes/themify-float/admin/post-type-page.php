<?php

/**
 * Appearance Tab for Themify Custom Panel
 *
 * @since 1.0.0
 *
 * @return array
 */
function themify_theme_page_appearance_meta_box() {
	return array(
		// Header Design
		array(
			'name'        => 'header_design',
			'title'       => __( 'Header Design', 'themify' ),
			'description' => '',
			'type'        => 'layout',
			'show_title'  => true,
			'meta'        => themify_theme_header_design_options(),
			'hide'		  => 'none header-leftpane header-minbar boxed-content header-rightpane',
		),
		
		// Menu Style
		array(
			'name' => 'menu_style',
			'title' => __( 'Menu Style', 'themify' ),
			'type' => 'dropdown',
			'class' => 'hide-if none',
			'meta' => array(
				array(
					'value' => '',
					'name'  => ''
				),
				array(
					'value' => 'overlay-menu',
					'name'  => __( 'Overlay Menu', 'themify' )
				),
				array(
					'value' => 'horizontal-menu',
					'name'  => __( 'Horizontal Menu', 'themify' )
				),
			),
		),
		// Header Elements
		array(
			'name' 	=> '_multi_header_elements',
			'title' => __('Header Elements', 'themify'),
			'description' => '',
			'type' 	=> 'multi',
			'class' => 'hide-if none',
			'meta'	=> array(
				'fields' => array(
					// Show Site Logo
					array(
						'name' 	=> 'exclude_site_logo',
						'description' => '',
						'title' => __( 'Site Logo', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png',
						) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show Site Tagline
					array(
						'name' 	=> 'exclude_site_tagline',
						'description' => '',
						'title' => __( 'Site Tagline', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png',
						) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show Search Form
					array(
						'name' 	=> 'exclude_search_form',
						'description' => '',
						'title' => __( 'Search Form', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png',
						) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show RSS Link
					array(
						'name' 	=> 'exclude_rss',
						'description' => '',
						'title' => __( 'RSS Link', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png',
						) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show Social Widget
					array(
						'name' 	=> 'exclude_social_widget',
						'description' => '',
						'title' => __( 'Social Widget', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png',
						) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
					// Show Menu Navigation
					array(
						'name' 	=> 'exclude_menu_navigation',
						'description' => '',
						'title' => __( 'Menu Navigation', 'themify' ),
						'type' 	=> 'dropdownbutton',
						'states' => themify_ternary_states( array(
							'icon_no' => THEMIFY_URI . '/img/ddbtn-check.png',
							'icon_yes' => THEMIFY_URI . '/img/ddbtn-cross.png',
						) ),
						'class' => 'hide-if none',
						'after' => '<div class="clear"></div>',
					),
				),
				'description' => '',
				'before' => '',
				'after' => '<div class="clear"></div>',
				'separator' => ''
			)
		),
		// Header Wrap
		array(
			'name'          => 'header_wrap',
			'title'         => __( 'Header Background', 'themify' ),
			'description'   => '',
			'type'          => 'radio',
			'show_title'    => true,
			'meta'          => array(
				array(
					'value'    => 'solid',
					'name'     => __( 'Solid Background', 'themify' ),
					'selected' => true
				),
				array(
					'value' => 'transparent',
					'name'  => __( 'Transparent Background', 'themify' )
				),
			),
			'enable_toggle' => true,
			'class'     => 'hide-if none',
			'default' => 'solid'
		),
		// Background Color
		array(
			'name'        => 'background_color',
			'title'       => '',
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'toggle'      => 'solid-toggle',
			'class'     => 'hide-if none',
		),
		// Background image
		array(
			'name'        => 'background_image',
			'title'       => '',
			'type'        => 'image',
			'description' => '',
			'meta'        => array(),
			'before'      => '',
			'after'       => '',
			'toggle'      => 'solid-toggle',
			'class'     => 'hide-if none',
		),
		// Background repeat
		array(
			'name'        => 'background_repeat',
			'title'       => '',
			'description' => __( 'Background Repeat', 'themify' ),
			'type'        => 'dropdown',
			'meta'        => array(
				array(
					'value' => 'fullcover',
					'name'  => __( 'Fullcover', 'themify' )
				),
				array(
					'value' => 'repeat',
					'name'  => __( 'Repeat', 'themify' )
				),
				array(
					'value' => 'repeat-x',
					'name'  => __( 'Repeat horizontally', 'themify' )
				),
				array(
					'value' => 'repeat-y',
					'name'  => __( 'Repeat vertically', 'themify' )
				),
			),
			'toggle'      => 'solid-toggle',
			'class'     => 'hide-if none',
			'default' => 'fullcover'
		),
		// Header wrap text color
		array(
			'name'        => 'headerwrap_text_color',
			'title'       => __( 'Header Text Color', 'themify' ),
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'class'     => 'hide-if none',
		),
		// Header wrap link color
		array(
			'name'        => 'headerwrap_link_color',
			'title'       => __( 'Header Link Color', 'themify' ),
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'class'     => 'hide-if none',
		),
		// Footer Separator
		array(
			'name' => 'footer_separator',
			'type' => 'separator',
			'meta' => array('html'=>'<hr />')
		),
		// Hide header and footer
		array(
			'name' 	=> '_multi_layout',
			'type' => 'multi',
			'title' => __('Footer', 'themify'),
			'meta' => array(
				'fields' => array(
					// Exclude Footer
					array(
						'name' 		=> 'hide_footer',
						'label' => __('Exclude Footer', 'themify'),
						'description' => '',
						'type' 		=> 'checkbox',
						'meta'		=> array('size'=>'small'),
						'before' => '<div>',
						'after' => '</div>',
					),
				),
				'description' => '',
				'before' => '',
				'after' => '',
				'separator' => ''
			)
		),
	);
}

/**
 * Query Portfolio Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.7
 */
function themify_theme_query_portfolio_meta_box($args = array()){
	extract( $args );
	return array(
		// Notice
		array(
			'name' => '_query_portfolio_notice',
			'title' => '',
			'description' => '',
			'type' => 'separator',
			'meta' => array(
				'html' => '<div class="themify-info-link">' . sprintf( __( '<a href="%s">Query Portfolios</a> allows you to query WordPress portfolios from any portfolio category. To use it, select a Portfolio Category.', 'themify' ), 'http://themify.me/docs/query-posts' ) . '</div>'
			),
		),
		// Query Category
		array(
			'name' 		=> 'portfolio_query_category',
			'title'		=> __('Portfolio Category', 'themify'),
			'description'	=> __('Select a portfolio category or enter multiple portfolio category IDs (eg. 2,5,6). Enter 0 to display all portfolio categories.', 'themify'),
			'type'		=> 'query_category',
			'meta'		=> array('taxonomy' => 'portfolio-category')
		),
		// Descending or Ascending Order for Portfolios
		array(
			'name' 		=> 'portfolio_order',
			'title'		=> __('Order', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Descending', 'themify'), 'value' => 'desc', 'selected' => true),
				array('name' => __('Ascending', 'themify'), 'value' => 'asc')
			),
			'default' => 'desc'
		),
		// Criteria to Order By
		array(
			'name' 		=> 'portfolio_orderby',
			'title'		=> __('Order By', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Date', 'themify'), 'value' => 'date', 'selected' => true),
				array('name' => __('Random', 'themify'), 'value' => 'rand'),
				array('name' => __('Author', 'themify'), 'value' => 'author'),
				array('name' => __('Post Title', 'themify'), 'value' => 'title'),
				array('name' => __('Comments Number', 'themify'), 'value' => 'comment_count'),
				array('name' => __('Modified Date', 'themify'), 'value' => 'modified'),
				array('name' => __('Post Slug', 'themify'), 'value' => 'name'),
				array('name' => __('Post ID', 'themify'), 'value' => 'ID')
			),
			'default' => 'date'
		),
		// Post Layout
		array(
			'name' 		=> 'portfolio_layout',
			'title'		=> __('Portfolio Layout', 'themify'),
			'description'	=> '',
			'type'		=> 'layout',
			'show_title' => true,
			'meta'		=> array(
				array(
					'value' => '',
					'img'   => 'images/layout-icons/default.png',
					'title' => __( 'Default', 'themify' ),
					'selected' => true
				),
				array(
					'value' => 'grid4',
					'img'   => 'images/layout-icons/grid4.png',
					'title' => __( 'Grid 4', 'themify' )
				),
				array(
					'value' => 'grid3',
					'img'   => 'images/layout-icons/grid3.png',
					'title' => __( 'Grid 3', 'themify' )
				),
				array(
					'value' => 'grid5',
					'img'   => 'images/layout-icons/grid5.png',
					'title' => __( 'Grid 5', 'themify' )
				)
			),
			'default' => ''
		),
		// Post Filter
		array(
			'name' 		=> 'portfolio_disable_filter',
			'title'		=> __( 'Portfolio Filter', 'themify' ),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array(
					'value' => '',
					'name' => '',
					'selected' => true,
				),
				array(
					'value' => 'yes',
					'name' => __( 'Enable', 'themify' ),
				),
				array(
					'value' => 'no',
					'name' => __( 'Disable', 'themify' ),
				)
			),
			'default' => ''
		),
		array(
			'name' 		=> 'portfolio_more_posts',
			'title'		=> __( 'Pagination Option', 'themify' ),
			'description'	=> __('Infinite scroll will auto load posts on scroll. Load more button will load posts when button is clicked. Number pagination will show a regular page navigation.','themify'),
			'type'		=> 'radio',
			'meta'		=> array(
				array(
					'value' => '',
					'name' =>  __( 'Default', 'themify' ),
					'selected' => true,
				),
				array(
					'value' => 'infinite',
					'name' => __( 'Infinite Scroll', 'themify' ),
				),
				array(
					'value' => 'button',
					'name' => __( 'Load More Button', 'themify' ),
				),
				array(
					'value' => 'pagination',
					'name' => __( 'Standard Pagination', 'themify' ),
				),
				array(
					'value' => 'disable',
					'name' => __( 'No Pagination', 'themify' ),
				)
			),
			'default' => ''
		),
		// Posts Per Page
		array(
			  'name' 		=> 'portfolio_posts_per_page',
			  'title'		=> __('Portfolios Per Page', 'themify'),
			  'description'	=> '',
			  'type'		=> 'textbox',
			  'meta'		=> array('size' => 'small')
			),

		// Display Content
		array(
			'name' 		=> 'portfolio_display_content',
			'title'		=> __('Display Content', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array( 'name' => __('Full Content', 'themify'), 'value' => 'content' ),
				array( 'name' => __('Excerpt', 'themify'), 'value' => 'excerpt', 'selected' => true ),
				array( 'name' => __('None', 'themify'), 'value' => 'none' )
			),
			'default' => 'excerpt',
		),
		// Featured Image Size
		array(
			'name'	=>	'portfolio_feature_size_page',
			'title'	=>	__('Image Size', 'themify'),
			'description' => __('Image sizes can be set at <a href="options-media.php">Media Settings</a> and <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerated</a>', 'themify'),
			'type'		 =>	'featimgdropdown',
			'display_callback' => 'themify_is_image_script_disabled'
			),
		
		// Multi field: Image Dimension
		themify_image_dimensions_field(array(),'portfolio_image'),
		
		// Hide Title
		array(
			'name' 		=> 'portfolio_hide_title',
			'title'		=> __('Hide Portfolio Title', 'themify'),
			'description'	=> '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default'
		),
		// Unlink Post Title
		array(
			'name' 		=> 'portfolio_unlink_title',
			'title' 	=> __('Unlink Portfolio Title', 'themify'),
			'description' => __('Unlink portfolio title (it will display the post title without link)', 'themify'),
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default'
		),
		// Hide Post Meta
		array(
			'name' 		=> 'portfolio_hide_meta_all',
			'title' 	=> __('Hide Portfolio Meta', 'themify'),
			'description' => '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default'
		),
		// Hide Post Image
		array(
			'name' 		=> 'portfolio_hide_image',
			'title' 	=> __('Hide Featured Image', 'themify'),
			'description' => '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default'
		),
		// Unlink Post Image
		array(
			'name' 		=> 'portfolio_unlink_image',
			'title' 		=> __('Unlink Featured Image', 'themify'),
			'description' => __('Display the Featured Image Without Link', 'themify'),
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default'
		)
	);
}

/**
 * Page Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.7
 */
function themify_theme_page_meta_box( $args = array() ) {
	return array(
	
		// Page Layout
		array(
			'name' 		=> 'page_layout',
			'title'		=> __('Sidebar Option', 'themify'),
			'description'	=> '',
			'type'		=> 'layout',
			'show_title' => true,
			'meta'		=> array(
				array('value' => 'default', 'img' => 'images/layout-icons/default.png', 'selected' => true, 'title' => __('Default', 'themify')),
				array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'title' => __('Sidebar Right', 'themify')),
				array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
				array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'title' => __('No Sidebar ', 'themify'))
			),
			'default' => 'default'
		),
		// Content Width
		array(
			'name'=> 'content_width',
			'title' => __('Content Width', 'themify'),
			'description' => '',
			'type' => 'layout',
			'show_title' => true,
			'meta' => array(
				array(
					'value' => 'default_width',
					'img' => 'themify/img/default.png',
					'selected' => true,
					'title' => __( 'Default', 'themify' )
				),
				array(
					'value' => 'full_width',
					'img' => 'themify/img/fullwidth.png',
					'title' => __( 'Fullwidth', 'themify' )
				)
			),
			'default' => 'default_width'
		),
		// Hide page title
		array(
			'name' 		=> 'hide_page_title',
			'title'		=> __('Hide Page Title', 'themify'),
			'description'	=> '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default'
		),
		// Custom menu for page
		array(
			'name' 		=> 'custom_menu',
			'title'		=> __('Custom Menu', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> $args['nav_menus'], // extracted from $args
		),
	);
}

/**
 * Query Posts Options
 * @param array $args
 * @return array
 * @since 1.0.7
 */
function themify_theme_query_post_meta_box( $args = array() ) {
	extract( $args );
	return array(
		// Notice
		array(
			'name' => '_query_posts_notice',
			'title' => '',
			'description' => '',
			'type' => 'separator',
			'meta' => array(
				'html' => '<div class="themify-info-link">' . sprintf( __( '<a href="%s">Query Posts</a> allows you to query WordPress posts from any category on the page. To use it, select a Query Category.', 'themify' ), 'http://themify.me/docs/query-posts' ) . '</div>'
			),
		),
		// Query Category
		array(
			'name' 		=> 'query_category',
			'title'		=> __('Query Category', 'themify'),
			'description'	=> __('Select a category or enter multiple category IDs (eg. 2,5,6). Enter 0 to display all category.', 'themify'),
			'type'		=> 'query_category',
			'meta'		=> array()
		),
		// Post Layout
		array(
			'name' 		=> 'layout',
			'title'		=> __('Query Post Layout', 'themify'),
			'description'	=> '',
			'type'		=> 'layout',
			'show_title' => true,
			'meta'		=> array(
				array(
					'value' => 'list-post',
					'img' => 'images/layout-icons/list-post.png'
				),
				array(
					'value' => 'grid4',
					'img'   => 'images/layout-icons/grid4.png',
					'title' => __( 'Grid 4', 'themify' )
				),
				array(
					'value' => 'grid3',
					'img'   => 'images/layout-icons/grid3.png',
					'title' => __( 'Grid 3', 'themify' )
				),
				array(
					'value' => 'grid2',
					'img'   => 'images/layout-icons/grid2.png',
					'title' => __( 'Grid 2', 'themify' )
				),
				array(
					'value' => 'zig-zag',
					'img'   => 'images/layout-icons/zig-zag.png',
					'title' => __( 'Zig-Zag', 'themify' ),
					'selected' => true
				),
			),
			'default' => 'zig-zag'
		),
		// Descending or Ascending Order for Posts
		array(
			'name' 		=> 'order',
			'title'		=> __('Order', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Descending', 'themify'), 'value' => 'desc', 'selected' => true),
				array('name' => __('Ascending', 'themify'), 'value' => 'asc')
			),
			'default' => 'desc'
		),
		// Criteria to Order By
		array(
			'name' 		=> 'orderby',
			'title'		=> __('Order By', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Date', 'themify'), 'value' => 'date', 'selected' => true),
				array('name' => __('Random', 'themify'), 'value' => 'rand'),
				array('name' => __('Author', 'themify'), 'value' => 'author'),
				array('name' => __('Post Title', 'themify'), 'value' => 'title'),
				array('name' => __('Comments Number', 'themify'), 'value' => 'comment_count'),
				array('name' => __('Modified Date', 'themify'), 'value' => 'modified'),
				array('name' => __('Post Slug', 'themify'), 'value' => 'name'),
				array('name' => __('Post ID', 'themify'), 'value' => 'ID')
			),
			'default' => 'date'
		),
		// Post Masonry
		array(
			'name' 		=> 'disable_masonry',
			'title'		=> __( 'Post Masonry', 'themify' ),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array(
					'value' => '',
					'name' => '',
					'selected' => true,
				),
				array(
					'value' => 'yes',
					'name' => __( 'Enable', 'themify' ),
				),
				array(
					'value' => 'no',
					'name' => __( 'Disable', 'themify' ),
				)
			),
			'default' => ''
		),
		// Post Gutter
		array(
			'name' 		=> 'post_gutter',
			'title'		=> __( 'Post Gutter', 'themify' ),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array(
					'value' => '',
					'name' => '',
					'selected' => true,
				),
				array(
					'value' => 'no-gutter',
					'name' => __( 'No gutter', 'themify' ),
				)
			),
			'default' => ''
		),
		// Infinite Scroll
		array(
			'name' 		=> 'more_posts',
			'title'		=> __( 'Pagination Option', 'themify' ),
			'description'	=> __('Infinite scroll will auto load posts on scroll. Load more button will load posts when button is clicked. Number pagination will show a regular page navigation.','themify'),
			'type'		=> 'radio',
			'meta'		=> array(
				array(
					'value' => '',
					'name' =>  __( 'Default', 'themify' ),
					'selected' => true,
				),
				array(
					'value' => 'infinite',
					'name' => __( 'Infinite Scroll', 'themify' ),
				),
				array(
					'value' => 'button',
					'name' => __( 'Load More Button', 'themify' ),
				),
				array(
					'value' => 'pagination',
					'name' => __( 'Standard Pagination', 'themify' ),
				),
				array(
					'value' => 'disable',
					'name' => __( 'No Pagination', 'themify' ),
				)
			),
			'default' => ''
		),
		// Posts Per Page
		array(
			'name' 		=> 'posts_per_page',
			'title'		=> __('Posts Per Page', 'themify'),
			'description'	=> '',
			'type'		=> 'textbox',
			'meta'		=> array('size' => 'small')
		),
		// Display Content
		array(
			'name' 		=> 'display_content',
			'title'		=> __('Display Content', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Full Content', 'themify'),'value'=>'content'),
				array('name' => __('Excerpt', 'themify'),'value'=>'excerpt','selected'=>true),
				array('name' => __('None', 'themify'),'value'=>'none')
			),
			'default' => 'excerpt'
		),
		// Featured Image Size
		array(
			'name'	=>	'feature_size_page',
			'title'	=>	__('Image Size', 'themify'),
			'description' => sprintf(__('Image sizes can be set at <a href="%s">Media Settings</a> and <a href="%s">Regenerated</a>', 'themify'), 'options-media.php', 'admin.php?page=regenerate-thumbnails'),
			'type'		 =>	'featimgdropdown',
			'display_callback' => 'themify_is_image_script_disabled'
		),
		// Multi field: Image Dimension
		themify_image_dimensions_field(),
		// Hide Title
		array(
			'name' 		=> 'hide_title',
			'title'		=> __('Hide Post Title', 'themify'),
			'description'	=> '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default'
		),
		// Unlink Post Title
		array(
			'name' 		=> 'unlink_title',
			'title' 		=> __('Unlink Post Title', 'themify'),
			'description' => __('Unlink post title (it will display the post title without link)', 'themify'),
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default'
		),
		// Hide Post Date
		array(
			'name' 		=> 'hide_date',
			'title'		=> __('Hide Post Date', 'themify'),
			'description'	=> '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default'
		),
		// Multi field: Hide Post Meta
		themify_multi_meta_field(),
		// Hide Post Image
		array(
			'name' 		=> 'hide_image',
			'title' 		=> __('Hide Featured Image', 'themify'),
			'description' => '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default'
		),
		// Unlink Post Image
		array(
			'name' 		=> 'unlink_image',
			'title' 		=> __('Unlink Featured Image', 'themify'),
			'description' => __('Display the Featured Image without link', 'themify'),
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			),
			'default' => 'default'
		)
	);
}

/**
 * Default Page Layout Module
 * @param array $data Theme settings data
 * @return string Markup for module.
 * @since 1.0.0
 */
function themify_default_page_layout($data = array()){
	$data = themify_get_data();

	/**
	 * Theme Settings Option Key Prefix
	 * @var string
	 */
	$prefix = 'setting-default_page_';

	/**
	 * Sidebar placement options
	 * @var array
	 */
	$sidebar_location_options = array(
		array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'selected' => true, 'title' => __('Sidebar Right', 'themify')),
		array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
		array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'title' => __('No Sidebar', 'themify'))
	);

	/**
	 * Tertiary options <blank>|yes|no
	 * @var array
	 */
	$default_options = array(
		array('name' => '', 'value' => ''),
		array('name' => __('Yes', 'themify'), 'value' => 'yes'),
		array('name' => __('No', 'themify'), 'value' => 'no')
	);

	/**
	 * Module markup
	 * @var string
	 */
	$output = '';

	/**
	 * Page sidebar placement
	 */
	$output .= '<p>
					<span class="label">' . __('Page Sidebar Option', 'themify') . '</span>';
	$val = themify_get( $prefix.'layout' );
	foreach ( $sidebar_location_options as $option ) {
		if ( ( '' == $val || ! $val || ! isset( $val ) ) && ( isset( $option['selected'] ) && $option['selected'] ) ) {
			$val = $option['value'];
		}
		if ( $val == $option['value'] ) {
			$class = 'selected';
		} else {
			$class = '';
		}
		$output .= '<a href="#" class="preview-icon '.$class.'" title="'.$option['title'].'"><img src="'.THEME_URI.'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';
	}
	$output .= '<input type="hidden" name="'.$prefix.'layout" class="val" value="'.$val.'" /></p>';

	/**
	 * Hide Title in All Pages
	 */
	$output .= '<p>
					<span class="label">' . __('Hide Title in All Pages', 'themify') . '</span>
					<select name="setting-hide_page_title">'.
						themify_options_module($default_options, 'setting-hide_page_title') . '
					</select>
				</p>';

	/**
	 * Featured Image dimensions
	 */
	$output .= '<p>
				<span class="label">' . __('Image Size', 'themify') . '</span>
				<input type="text" class="width2" name="setting-page_featured_image_width" value="' . themify_get( 'setting-page_featured_image_width' ) . '" /> ' . __('width', 'themify') . ' <small>(px)</small>
				<input type="text" class="width2 show_if_enabled_img_php" name="setting-page_featured_image_height" value="' . themify_get( 'setting-page_featured_image_height' ) . '" /> <span class="show_if_enabled_img_php">' . __('height', 'themify') . ' <small>(px)</small></span>
				<br /><span class="pushlabel show_if_enabled_img_php"><small>' . __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify') . '</small></span>
			</p>';

	/**
	 * Page Comments
	 */
	$pre = 'setting-comments_pages';
	$pages_checked = themify_check( $pre ) ? 'checked="checked"': '';

	$output .= '<p><span class="label">' . __('Page Comments', 'themify') . '</span><label for="'.$pre.'"><input type="checkbox" id="'.$pre.'" name="'.$pre.'" '.$pages_checked.' /> ' . __('Disable comments in all Pages', 'themify') . '</label></p>';

	return $output;
}