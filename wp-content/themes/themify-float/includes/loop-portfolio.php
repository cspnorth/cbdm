<?php
/**
 * Template for generic post display.
 * @package themify
 * @since 1.0.0
 */
?>


<?php
/** Themify Default Variables
 *  @var object */
global $themify;
 ?>

<?php themify_post_before(); // hook ?>
<article id="post-<?php the_id(); ?>" <?php post_class( 'portfolio-post post clearfix' ); ?>>
	<?php themify_post_start(); // hook ?>
	<?php if('below' != $themify->media_position) get_template_part( 'includes/post-media', 'loop'); ?>
	<div class="post-content">
                <div class="post-content-inner-wrapper">
                    <div class="post-content-inner">
                        <a href="<?php the_permalink()?>" class="themify_link_to"></a>
                        <?php if($themify->hide_meta !== 'yes'): ?>
                                <div class="post-meta entry-meta">

                                        <?php if($themify->hide_meta_category !== 'yes' || $themify->hide_meta_tag !== 'yes'): ?>
                                                <div class="post-cattag-wrapper">
                                                    <?php if($themify->hide_meta_category !== 'yes'):?>
                                                        <?php the_terms( get_the_ID(), 'portfolio-category', ' <span class="post-category">', ', ', '</span>' ); ?>
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
                        <?php if ( $themify->hide_title !== 'yes' ): ?>
                            <?php themify_post_title( array( 'tag' => 'h2' ) ); ?>
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
                </div>
            </div>
	</div>
	<!-- /.post-content -->
	<?php themify_post_end(); // hook ?>

</article>
<!-- /.post -->
<?php themify_post_after(); // hook ?>
