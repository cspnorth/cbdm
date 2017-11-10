<?php
/**
 * Template for site footer
 * @package themify
 * @since 1.0.0
 */

/** Themify Default Variables
 *  @var object */
	global $themify; 
	themify_layout_after(); // hook ?>

		</div>
		<!-- /body -->
		<?php if ( 'yes' != $themify->hide_footer ) : ?>
			<div id="footerwrap">

				<?php themify_footer_before(); // hook ?>

				<footer id="footer" class="pagewidth clearfix" itemscope="itemscope" itemtype="https://schema.org/WPFooter">

					<?php themify_footer_start(); // hook ?>

					<?php if ( themify_theme_show_area( 'footer_menu_navigation' ) ) : ?>
						<div class="footer-nav-wrap">
							<?php wp_nav_menu( array(
								'theme_location' => 'footer-nav',
								'fallback_cb' => '',
								'container'  => '',
								'menu_id' => 'footer-nav',
								'menu_class' => 'footer-nav',
							)); ?>
						</div>
						<!-- /.footer-nav-wrap -->
					<?php endif; // exclude menu navigation ?>

					<?php if ( themify_theme_show_area( 'footer_widgets' ) ) {
						get_template_part( 'includes/footer-widgets' );
					} ?>

					<?php if ( themify_theme_show_area( 'footer_back' ) ) : ?>
						<p class="back-top"><a href="#header"></a></p>
					<?php endif; ?>

					<?php if ( themify_theme_show_area( 'footer_site_logo' ) ) : ?>
						<div class="footer-logo-wrapper clearfix"> 
							<?php echo themify_logo_image( 'footer_logo', 'footer-logo' ); ?>
							<!-- /footer-logo -->
						</div>
					<?php endif; ?>

					<?php if ( themify_theme_show_area( 'footer_texts' ) ) : ?>
						<div class="footer-text clearfix">
							<?php themify_the_footer_text(); ?>
							<?php themify_the_footer_text('right'); ?>
						</div>
						<!-- /footer-text -->
					<?php endif; ?>

					<?php themify_footer_end(); // hook ?>

				</footer>
				<!-- /#footer -->

				<?php themify_footer_after(); // hook ?>

			</div>
			<!-- /#footerwrap -->
			
		<?php endif; // exclude footer ?>
		
		</div>
		<!-- /#pagewrap -->

		<?php
		/**
		 *  Stylesheets and Javascript files are enqueued in theme-functions.php
		 */
		?>

		<!-- wp_footer -->
		<?php wp_footer(); themify_body_end(); // hook ?>
	</body>
</html>