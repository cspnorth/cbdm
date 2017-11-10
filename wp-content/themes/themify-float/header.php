<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<?php
/**
 * Document title is generated in theme-functions.php
 * Stylesheets and Javascript files are enqueued in theme-functions.php
 */
?>

<!-- wp_header -->
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php themify_body_start(); // hook ?>

	<div id="pagewrap" class="hfeed site">
		<?php if ( 'yes' != $themify->hide_header ) : ?>
		
		<div id="headerwrap">

			<?php themify_header_before(); // hook ?>

			<header id="header" class="pagewidth clearfix" itemscope="itemscope" itemtype="https://schema.org/WPHeader">

				<?php themify_header_start(); // hook ?>
				
				<div class="logo-desc-wrap">
					<?php if ( themify_theme_show_area( 'site_logo' ) ) : ?>
						<?php echo themify_logo_image(); ?>
					<?php endif; ?>
					
					<?php if ( themify_theme_show_area( 'site_tagline' ) ) : ?>
						<?php echo themify_site_description(); ?>
					<?php endif; ?>
				</div>
				
				<?php $show_menu = themify_theme_show_area( 'menu_navigation' );?>
				<?php if ( $show_menu ) : ?>
					<a id="menu-icon" href="#mobile-menu"></a>
				<?php endif; ?>
				
				<div id="mobile-menu" class="sidemenu sidemenu-off">
					<?php if ( themify_theme_show_area( 'social_widget' ) || themify_theme_show_area( 'rss' ) ) : ?>
						<div class="social-widget">
							<?php if ( themify_theme_show_area( 'social_widget' ) ) : ?>
								<?php dynamic_sidebar('social-widget'); ?>
							<?php endif; // exclude social widget ?>

							<?php if ( themify_theme_show_area( 'rss' ) && ! themify_check('setting-exclude_rss' ) ) : ?>
								<div class="rss"><a href="<?php themify_theme_feed_link(); ?>"></a></div>
							<?php endif; // exclude RSS ?>
						</div>
						<!-- /.social-widget -->
					<?php endif; // exclude social widget or RSS icon ?>
					
					<?php if ( ! themify_check( 'setting-exclude_search_form' ) &&  themify_theme_show_area( 'search_form' )) : ?>
						<div id="searchform-wrap">
							<?php get_search_form(); ?>
						</div>
						<!-- /#searchform-wrap -->
					<?php endif; ?>
					
					<?php if ( $show_menu ) : ?>
						<nav id="main-nav-wrap" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
							<?php themify_menu_nav(); ?>
							<!-- /#main-nav -->
						</nav>
					<?php endif; ?>					
					<a id="menu-icon-close" href="#mobile-menu"></a>

				</div>
				<!-- /#mobile-menu -->

				<?php themify_header_end(); // hook ?>

			</header>
			<!-- /#header -->

			<?php themify_header_after(); // hook ?>

		</div>
		<!-- /#headerwrap -->
		
		<?php endif; // exclude header ?>
		<?php if($themify->query_post_type!=='portfolio' && !is_tax('portfolio')):?>
			<svg class="clip-svg">
			  <defs>
				<clipPath id="themifyClip" clipPathUnits="objectBoundingBox" >
				  <polygon points="0 0.16, 1 0, 1 0.84, 0 1" />
				</clipPath>
				<clipPath id="themifyClipReverse" clipPathUnits="objectBoundingBox" >
				  <polygon points="0 0, 1 0.16, 1 1, 0 0.84" />
				</clipPath>
			  </defs>
			</svg>
		<?php endif;?>
		<div id="body" class="clearfix">

			<?php themify_layout_before(); //hook ?>
