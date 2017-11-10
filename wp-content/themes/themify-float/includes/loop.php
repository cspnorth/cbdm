<?php
/**
 * Template for generic post display.
 * @package themify
 * @since 1.0.0
 */
?>
<?php if(!is_single()){ global $more; $more = 0; } //enable more link ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify; 
$is_portfolio = is_singular('portfolio');
if($is_portfolio){
    $themify->hide_image = 'yes';
}

?>

<?php themify_post_before(); // hook ?>
<article id="post-<?php the_id(); ?>" <?php post_class( 'post clearfix' ); ?>>
	<?php themify_post_start(); // hook ?>

	<div class="post-image-wrap" data-parallax-element-speed="2">
		<?php if('below' != $themify->media_position) get_template_part( 'includes/post-media', 'loop'); ?>

		<?php if(!$is_portfolio && $themify->hide_meta !== 'yes'): ?>
			<div class="post-meta entry-meta">
				<?php if($themify->hide_date !== 'yes'): ?>
					<time class="post-date entry-date updated" itemprop="datePublished" datetime="<?php echo esc_attr( the_time( 'o-m-d' ) ); ?>">
						<span class="day"><?php the_time( 'j' ); ?></span>
						<span class="month"><?php the_time( 'M' ); ?></span>
						<span class="year"><?php the_time( 'Y' ); ?></span>
					</time>
				<?php endif; //post date ?>
				<?php if($themify->hide_meta_author !== 'yes'): ?>
						<span class="post-author"><?php echo themify_get_author_link(); ?></span>
				<?php endif; ?>

				<?php if($themify->hide_meta_category !== 'yes' || $themify->hide_meta_tag !== 'yes'): ?>
						<div class="post-cattag-wrapper">
							<?php if($themify->hide_meta_category !== 'yes'):?>
								<?php the_terms( get_the_ID(), 'category', ' <span class="post-category">', ', ', '</span>' ); ?>
							<?php endif;?>
							<?php if($themify->hide_meta_tag !== 'yes'): ?>
									<?php the_terms( get_the_ID(), 'post_tag', ' <span class="post-tag">', ', ', '</span>' ); ?>
							<?php endif; ?>
						</div>
				<?php endif; ?>
				<?php  if( !themify_get('setting-comments_posts') && comments_open() && $themify->hide_meta_comment != 'yes' ) : ?>
						<span class="post-comment"><?php comments_popup_link( __( '0', 'themify' ), __( '1', 'themify' ), __( '%', 'themify' ) ); ?></span>
				<?php endif; ?>
			</div>
		<?php endif; //post meta ?>
	</div>
	
	<?php if(!$is_portfolio):?><div class="post-content"><?php endif;?>
                    <?php if(is_singular() && empty($themify->is_shortcode)):?>
                        <?php  get_template_part( 'includes/social-share', 'loop')?>
                    <?php endif;?>
                    <?php if ( $themify->hide_title !== 'yes' ): ?>
                        <?php themify_post_title(); ?>
                    <?php endif; //post title ?>

		<?php if('below' === $themify->media_position) get_template_part( 'includes/post-media', 'loop'); ?>
                <div class="entry-content" itemprop="articleBody">
                    <?php if ( 'excerpt' === $themify->display_content && ! is_attachment() ) : ?>

                            <?php the_excerpt(); ?>

                            <?php if( themify_check('setting-excerpt_more') ) : ?>
                                    <p><a href="<?php the_permalink(); ?>" class="more-link"><?php echo themify_check('setting-default_more_text')? themify_get('setting-default_more_text') : __('More &rarr;', 'themify') ?></a><p>
                            <?php endif; ?>

                    <?php elseif($themify->display_content !== 'none'): ?>
                            <?php the_content(themify_check('setting-default_more_text')? themify_get('setting-default_more_text') : __('More &rarr;', 'themify')); ?>

                    <?php endif; //display content ?>
                </div>
		<?php edit_post_link(__('Edit', 'themify'), '<span class="edit-button">[', ']</span>'); ?>
	<?php if(!$is_portfolio):?></div><?php endif;?>
	<!-- /.post-content -->
	<?php themify_post_end(); // hook ?>

</article>
<!-- /.post -->
<?php themify_post_after(); // hook ?>
