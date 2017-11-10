<?php
/**
 * Main Themify class
 * @package themify
 * @since 1.0.0
 */

class Themify {
	/** Default sidebar layout
	 *
	 * @var string
	 */
	public $layout;
	/** Default posts layout
	 *
	 * @var string
	 */
	public $post_layout;
	
	public $hide_title;
	public $hide_meta;
	public $hide_meta_author;
	public $hide_meta_category;
	public $hide_meta_comment;
	public $hide_meta_tag;
	public $hide_date;
	public $hide_image;
	public $media_position;
	
	public $unlink_title;
	public $unlink_image;
	
	public $display_content = '';
	public $auto_featured_image;
	
	public $width = '';
	public $height = '';
	
	public $avatar_size = 96;
	public $page_navigation;
	public $posts_per_page;
	
	public $image_setting = '';
	
	public $page_id = '';
	public $page_image_width = 1160;
	public $query_category = '';
	public $query_post_type = '';
	public $paged = '';
	public $is_isotop = false;
	public $more_posts = false;
	public $is_shortcode = false;
	// Exclude header and footer
	public $hide_header = 'no';
	public $hide_footer = 'no';
	
	/////////////////////////////////////////////
	// Set Default Image Sizes 					
	/////////////////////////////////////////////
	
	// Default Index Layout
	static $content_width = 1160;
	static $sidebar1_content_width = 790;
	
	// Default Single Post Layout
	static $single_content_width = 1160;
	static $single_sidebar1_content_width = 790;
	
	// Default Single Image Size
	static $single_image_width = 350;
	static $single_image_height = 200;
	
	// Grid4
	static $grid4_width = 260;
	static $grid4_height = 160;
	
	// Grid3
	static $grid3_width = 360;
	static $grid3_height = 225;
	
	// Grid2
	static $grid2_width = 560;
	static $grid2_height = 350;
	
	// List Large
	static $list_large_image_width = 350;
	static $list_large_image_height = 200;
	 
	// List Thumb
	static $list_thumb_image_width = 350;
	static $list_thumb_image_height = 200;
	
	// List Grid2 Thumb
	static $grid2_thumb_width = 120;
	static $grid2_thumb_height = 100;
	
	// List Post
	static $list_post_width = 1160;
	static $list_post_height = 870;
	
	// Sorting Parameters
	public $order = 'DESC';
	public $orderby = 'date';
        
	// Index Portfolio
	static $index_portfolio_image_width = 390;
	static $index_portfolio_image_height = 390;
	 // Single Portfolio
	static $single_portfolio_image_width = 1400;
	static $single_portfolio_image_height = 700;
	
	var $infinity_count;
	

	function __construct() {
		
		///////////////////////////////////////////
		//Global options setup
		///////////////////////////////////////////
		$this->layout = themify_get('setting-default_layout');
		if($this->layout == '' ) $this->layout = 'sidebar1'; 
		
		$this->post_layout = themify_get('setting-default_post_layout', 'zig-zag');
		
		$this->page_title = themify_get('setting-hide_page_title');
		$this->hide_title = themify_get('setting-default_post_title');
		$this->unlink_title = themify_get('setting-default_unlink_post_title');
		$this->media_position = themify_check('setting-default_media_position')? themify_get('setting-default_media_position') : 'above';
		$this->hide_image = themify_get('setting-default_post_image');
		$this->unlink_image = themify_get('setting-default_unlink_post_image');
		$this->auto_featured_image = !themify_check('setting-auto_featured_image')? 'field_name=post_image, image, wp_thumb&' : '';
		$this->hide_page_image = themify_get( 'setting-hide_page_image' ) == 'yes' ? 'yes' : 'no';
		$this->image_page_single_width = themify_check( 'setting-page_featured_image_width' ) ? themify_get( 'setting-page_featured_image_width' ) : $this->page_image_width;
		$this->image_page_single_height = themify_check( 'setting-page_featured_image_height' ) ? themify_get( 'setting-page_featured_image_height' ) : 0;
		
		$this->hide_meta = themify_get('setting-default_post_meta');
		$this->hide_meta_author = themify_get('setting-default_post_meta_author');
		$this->hide_meta_category = themify_get('setting-default_post_meta_category');
		$this->hide_meta_comment = themify_get('setting-default_post_meta_comment');
		$this->hide_meta_tag = themify_get('setting-default_post_meta_tag');

		$this->hide_date = themify_get('setting-default_post_date');
		
		$this->more_posts = themify_get('setting-more_posts' );
		
		// Set Order & Order By parameters for post sorting
		$this->order = themify_check('setting-index_order')? themify_get('setting-index_order'): 'DESC';
		$this->orderby = themify_check('setting-index_orderby')? themify_get('setting-index_orderby'): 'date';

		$this->display_content = themify_get('setting-default_layout_display');
		$this->avatar_size = apply_filters('themify_author_box_avatar_size', 96);
		
		add_action('template_redirect', array(&$this, 'template_redirect'));
	}

	function template_redirect() {
		
		$post_image_width = $post_image_height = '';
		if (is_page()) {
			if(post_password_required()){
				return;
			}
			$this->page_id = get_the_ID();
			$this->post_layout = themify_get( 'layout', 'list-post' );
			// set default post layout
			if($this->post_layout == ''){
                            $this->post_layout = 'zig-zag';
			}
			$post_image_width = themify_get('image_width');
			$post_image_height = themify_get('image_height');
		}
		if(!isset($post_image_width) || $post_image_width===''){
				$post_image_width = themify_get('setting-image_post_width');
				if(!$post_image_width){
					$post_image_width = '';
				}
		}
		if(!isset($post_image_height) || $post_image_height===''){
				$post_image_height = themify_get('setting-image_post_height');
				if(!$post_image_height){
					$post_image_height = '';
				}
		}


		if( is_singular() ) {
			$this->display_content = 'content';
		}
		
		if( empty( $post_image_width ) || empty( $post_image_height ) ) {
			///////////////////////////////////////////
			// Setting image width, height
			///////////////////////////////////////////
			switch ($this->post_layout){
				case 'grid4':
					$this->width = self::$grid4_width;
					$this->height = self::$grid4_height;
				break;
				case 'grid3':
					$this->width = self::$grid3_width;
					$this->height = self::$grid3_height;
				break;
				case 'grid2':
					$this->width = self::$grid2_width;
					$this->height = self::$grid2_height;
				break;
				case 'list-large-image':
					$this->width = self::$list_large_image_width;
					$this->height = self::$list_large_image_height;
				break;
				case 'list-thumb-image':
					$this->width = self::$list_thumb_image_width;
					$this->height = self::$list_thumb_image_height;
				break;
				case 'grid2-thumb':
					$this->width = self::$grid2_thumb_width;
					$this->height = self::$grid2_thumb_height;
				break;
				default :
					$this->width = self::$list_post_width;
					$this->height = self::$list_post_height;
				break;
			}
		}
		if (is_numeric($post_image_width) && $post_image_width>=0) {
				$this->width = $post_image_width;
		}
		if(is_numeric($post_image_height) && $post_image_height>=0){
				$this->height = $post_image_height;
		}
		
		if ( is_page() || themify_is_shop() ) {
			if ( get_query_var( 'paged' ) ) {
				$this->paged = get_query_var('paged');
			} elseif ( get_query_var( 'page' ) ) {
				$this->paged = get_query_var( 'page' );
			} else {
				$this->paged = 1;
			}
                      
			
			$this->layout = (themify_get('page_layout') != 'default' && themify_check('page_layout')) ? themify_get('page_layout') : themify_get('setting-default_page_layout');
			if($this->layout == ''){
				$this->layout = 'sidebar1'; 
                        }
			
			$this->post_layout = themify_get( 'layout', 'zig-zag' );
			
			$this->page_title = (themify_get('hide_page_title') != 'default' && themify_check('hide_page_title')) ? themify_get('hide_page_title') : themify_get('setting-hide_page_title'); 
			$this->hide_title = themify_get('hide_title'); 
			$this->unlink_title = themify_get('unlink_title');
			$this->media_position = themify_check('media_position')? themify_get('media_position') : 'above'; 
			$this->hide_image = themify_get('hide_image'); 
			$this->unlink_image = themify_get('unlink_image'); 

			// Post Meta Values ///////////////////////
			$post_meta_keys = array(
				'_author' 	=> 'post_meta_author',
				'_category' => 'post_meta_category',
				'_comment'  => 'post_meta_comment',
				'_tag' 	 	=> 'post_meta_tag'
			);
			$post_meta_key = 'setting-default_';
			$this->hide_meta = themify_check('hide_meta_all')?
								themify_get('hide_meta_all') : themify_get($post_meta_key . 'post_meta');
			foreach($post_meta_keys as $k => $v){
				$this->{'hide_meta'.$k} = themify_check('hide_meta'.$k)? themify_get('hide_meta'.$k) : themify_get($post_meta_key . $v);
			}
	
			
			$portfolio_query_category = themify_get('portfolio_query_category');
			if ('' != $portfolio_query_category ) {
				$this->query_category = $portfolio_query_category;
				$this->query_post_type = 'portfolio';
				$this->query_taxonomy = $this->query_post_type . '-category';
				$this->post_layout = themify_get( $this->query_post_type . '_layout' );
				if(!$this->post_layout){
					$this->post_layout = themify_get('setting-default_portfolio_index_post_layout' );
				}
				if(!$this->post_layout){
					$this->post_layout = 'grid4';
				}
				$this->hide_title = 'default' != themify_get( $this->query_post_type . '_hide_title' ) ? themify_get( $this->query_post_type . '_hide_title' ) : 'no';

				$this->unlink_title = 'default' != themify_get( $this->query_post_type . '_unlink_title' ) ? themify_get( $this->query_post_type . '_unlink_title' ) : 'no';

				$this->hide_image = 'default' != themify_get( $this->query_post_type . '_hide_image' ) ? themify_get( $this->query_post_type . '_hide_image' ) : 'no';

				$this->hide_meta = 'default' != themify_get( $this->query_post_type . '_hide_meta_all' ) ? themify_get( $this->query_post_type . '_hide_meta_all' ) : 'no';

				$this->hide_date = 'default' != themify_get( $this->query_post_type . '_hide_date' ) ? themify_get( $this->query_post_type . '_hide_date' ) : 'no';

				$this->unlink_image = 'default' != themify_get( $this->query_post_type . '_unlink_image' ) ? themify_get( $this->query_post_type . '_unlink_image' ) : 'no';

				$this->page_navigation = 'default' != themify_get( $this->query_post_type . '_hide_navigation' ) ? themify_get( $this->query_post_type . '_hide_navigation' ) : 'no';



				$this->display_content = themify_get( $this->query_post_type . '_display_content', 'excerpt' );
				$this->posts_per_page = themify_get( $this->query_post_type . '_posts_per_page' );
				$this->order = themify_get( $this->query_post_type . '_order' );
				$this->orderby = themify_get( $this->query_post_type . '_orderby' );
				$this->use_original_dimensions = 'no';

				
				if('' != themify_get('portfolio_image_width')){
						$this->width = themify_get('portfolio_image_width');
				} else {
						$this->width = themify_check('setting-default_portfolio_index_image_post_width') ?
								themify_get('setting-default_portfolio_index_image_post_width'):
								self::$index_portfolio_image_width;
				}
				if('' != themify_get('portfolio_image_height')){
						$this->height = themify_get('portfolio_image_height');
				} else {
						$this->height = themify_check('setting-default_portfolio_index_image_post_height') ?
								themify_get('setting-default_portfolio_index_image_post_height'):
								self::$index_portfolio_image_height;
				}
				$this->is_isotop = themify_get($this->query_post_type . '_disable_filter');
				$this->more_posts = themify_get($this->query_post_type . '_more_posts');
			   
			}
			else{
				$this->query_category = themify_get('query_category');
				$this->query_taxonomy = 'category';
				$this->query_post_type = 'post';
				$this->hide_date = themify_get('hide_date'); 
				$this->display_content = themify_get( 'display_content', 'excerpt' );
				$this->post_image_width = themify_get('image_width'); 
				$this->post_image_height = themify_get('image_height'); 
				$this->page_navigation = themify_get('hide_navigation'); 
				$this->posts_per_page = themify_get('posts_per_page');
				$this->order = themify_get('order');
				$this->orderby = themify_get('orderby');
				$this->is_isotop = themify_get('disable_filter');
				$this->more_posts = themify_get('more_posts');
			}
			$this->is_isotop = $this->is_isotop === 'yes';
			if(!$this->more_posts){
				$this->more_posts = themify_get('setting-more_posts' );
			}
		
		}
		elseif (is_tax('portfolio-category')) {
			$this->post_layout = themify_get('setting-default_portfolio_index_post_layout' );
			if(!$this->post_layout){
				$this->post_layout = 'grid4';
			}

			$this->layout = themify_check('setting-default_portfolio_index_layout')? themify_get('setting-default_portfolio_index_layout') : 'sidebar-none';

			$this->display_content = themify_check('setting-default_portfolio_index_display') ?
										themify_get('setting-default_portfolio_index_display'): 'none';

			$this->hide_title = themify_check('setting-default_portfolio_index_title')? themify_get('setting-default_portfolio_index_title'): 'no';

			$this->unlink_title = themify_check('setting-default_portfolio_index_unlink_post_title')? themify_get('setting-default_portfolio_index_unlink_post_title'): 'no';

			$this->hide_meta = themify_check('setting-default_portfolio_index_post_meta_category')?
					themify_get('setting-default_portfolio_index_post_meta_category') : 'yes';

			$this->hide_date = themify_check('setting-default_portfolio_index_post_date')?
					themify_get('setting-default_portfolio_index_post_date') : 'yes';

			$this->width = themify_check('setting-default_portfolio_index_image_post_width') ?
								themify_get('setting-default_portfolio_index_image_post_width'):
								self::$index_portfolio_image_width;

			$this->height = themify_get('setting-default_portfolio_index_image_post_height') ?
								themify_get('setting-default_portfolio_index_image_post_height'):
								self::$index_portfolio_image_height;
			$this->is_isotop = true;
			
			
                                                       
		}
		elseif( is_single() ) {
			$this->hide_title = (themify_get('hide_post_title') != 'default' && themify_check('hide_post_title')) ? themify_get('hide_post_title') : themify_get('setting-default_page_post_title');
			$this->unlink_title = (themify_get('unlink_post_title') != 'default' && themify_check('unlink_post_title')) ? themify_get('unlink_post_title') : themify_get('setting-default_page_unlink_post_title');
			$this->hide_date = (themify_get('hide_post_date') != 'default' && themify_check('hide_post_date')) ? themify_get('hide_post_date') : themify_get('setting-default_page_post_date');
			$this->hide_image = (themify_get('hide_post_image') != 'default' && themify_check('hide_post_image')) ? themify_get('hide_post_image') : themify_get('setting-default_page_post_image');
			$this->unlink_image = (themify_get('unlink_post_image') != 'default' && themify_check('unlink_post_image')) ? themify_get('unlink_post_image') : themify_get('setting-default_page_unlink_post_image');
			$this->media_position = 'above';

			// Post Meta Values ///////////////////////
			$post_meta_keys = array(
				'_author' 	=> 'post_meta_author',
				'_category' => 'post_meta_category',
				'_comment'  => 'post_meta_comment',
				'_tag' 	 	=> 'post_meta_tag'
			);

			$post_meta_key = 'setting-default_page_';
			$this->hide_meta = themify_check('hide_meta_all')?
								themify_get('hide_meta_all') : themify_get($post_meta_key . 'post_meta');
			foreach($post_meta_keys as $k => $v){
				$this->{'hide_meta'.$k} = themify_check('hide_meta'.$k)? themify_get('hide_meta'.$k) : themify_get($post_meta_key . $v);
			}
			
			$this->layout = (themify_get('layout') == 'sidebar-none'
							|| themify_get('layout') == 'sidebar1'
							|| themify_get('layout') == 'sidebar1 sidebar-left'
							|| themify_get('layout') == 'sidebar2') ?
								themify_get('layout') : themify_get('setting-default_page_post_layout');
			 // set default layout
			if($this->layout == ''){
			 	$this->layout = 'sidebar1';
			}
			
			$this->display_content = '';
			if ( is_singular( 'portfolio' ) ) {
				if ( themify_check( 'hide_post_meta' ) && 'default' != themify_get( 'hide_post_meta' ) ) {
					$this->hide_meta = themify_get( 'hide_post_meta' );
				} else {
					$this->hide_meta = themify_check( 'setting-default_portfolio_single_post_meta_category' ) ? themify_get( 'setting-default_portfolio_single_post_meta_category' ) : 'no';
				}

				if ( themify_get('layout') != 'default' && themify_get('layout') != '' ) {
					$this->layout = themify_get('layout');
				} elseif( themify_check('setting-default_portfolio_single_layout') ) {
					$this->layout = themify_get('setting-default_portfolio_single_layout');
				} else {
					$this->layout = 'sidebar-none';
				}

				$this->hide_title = (themify_get('hide_post_title') != 'default' && themify_check('hide_post_title')) ? themify_get('hide_post_title') : themify_get('setting-default_portfolio_single_title');
				$this->unlink_title = (themify_get('unlink_post_title') != 'default' && themify_check('unlink_post_title')) ? themify_get('unlink_post_title') : themify_get('setting-default_portfolio_single_unlink_post_title');
				$this->hide_date = (themify_get('hide_post_date') != 'default' && themify_check('hide_post_date')) ? themify_get('hide_post_date') : themify_get('setting-default_portfolio_single_post_date');
                                
				$post_image_width = themify_get('setting-default_portfolio_single_image_post_width');
				$post_image_height = themify_get('setting-default_portfolio_single_image_post_height');
				$default_width = self::$single_portfolio_image_width;
				$default_height = self::$single_portfolio_image_height;

}
			else{
				$post_image_width = themify_get('setting-image_post_single_width');
				$post_image_height = themify_get('setting-image_post_single_height');
				$default_width = self::$single_image_width;
				$default_height = self::$single_image_height;
			}
                        
			self::$content_width = self::$single_content_width;
			self::$sidebar1_content_width = self::$single_sidebar1_content_width;
                        
                        // Set Default Image Sizes for Single
			$this->width = isset($post_image_width) && $post_image_width>=0?$post_image_width:$default_width;
			$this->height = isset($post_image_height) && $post_image_height>=0?$post_image_height:$default_height;
			
		}
                
		if(is_single() && $this->hide_image != 'yes') {
			$this->image_setting = 'setting=image_post_single&';
		} elseif($this->query_category != '' && $this->hide_image != 'yes') {
			$this->image_setting = '';
		} else {
			$this->image_setting = 'setting=image_post&';
		}
		if( is_single() || is_page() || themify_is_shop() ){
			$this->hide_footer = themify_check('hide_footer');
                        $this->hide_header = themify_get('header_design');
			if($this->hide_header==='default'){
				$this->hide_header =  themify_get( 'setting-header_design' );
			}
			$this->hide_header = $this->hide_header==='none'?'yes':false;
		}
	}
}

/**
 * Initializes Themify class
 * @since 1.0.0
 */
function themify_global_options(){
	global $themify;
	$themify = new Themify();
}
add_action( 'after_setup_theme','themify_global_options', 12 );