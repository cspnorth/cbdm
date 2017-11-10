<?php
/**
 * Template for single post view
 * @package themify
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

<?php 
/** Themify Default Variables
 *  @var object */
global $themify;
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php if(is_singular('portfolio')):?>
    <div class="featured-area fullcover">
         <?php get_template_part('includes/post-media', 'single'); ?>
          <?php if ($themify->hide_meta!='yes'): ?>
            <?php
            $post_id = get_the_id();
            $client = get_post_meta($post_id, 'project_client', true);
            $services = get_post_meta($post_id, 'project_services', true);
            $date = get_post_meta($post_id, 'project_date', true);
            $launch = get_post_meta($post_id, 'project_launch', true);
            if ($client || $services || $date || $launch) :
                ?>
                <div class="project-meta">
                    <?php if ($client) : ?>
                        <div class="project-client">
                            <strong><?php _e('Client', 'themify'); ?></strong>
                            <?php echo wp_kses_post($client); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($services) : ?>
                        <div class="project-services">
                            <strong><?php _e('Services', 'themify'); ?></strong>
                            <?php echo wp_kses_post($services); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($date && $themify->hide_date!='yes'): ?>
                        <div class="project-date">
                            <strong><?php _e('Date', 'themify'); ?></strong>
                            <?php echo wp_kses_post($date); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($launch) : ?>
                        <div class="project-view">
                            <strong><?php _e('View', 'themify'); ?></strong>
                            <a target="_blank" href="<?php echo esc_url($launch); ?>"><?php _e('Launch Project', 'themify'); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; // $client || $services || $date || $launch ?>
        <?php endif; ?>
    </div>
<?php endif;?>
<!-- layout-container -->
<div id="layout" class="pagewidth clearfix">

	<?php themify_content_before(); // hook ?>
	<!-- content -->
	<div id="content" class="list-post">
    	<?php themify_content_start(); // hook ?>
		
		<?php get_template_part( 'includes/loop' , 'single' ); ?>

		<?php wp_link_pages( array( 'before' => '<p class="post-pagination"><strong>' . __( 'Pages:', 'themify' ) . ' </strong>', 'after' => '</p>', 'next_or_number' => 'number', ) ); ?>
		
		<?php get_template_part( 'includes/author-box', 'single' ); ?>

		<?php get_template_part( 'includes/post-nav' ); ?>

		<?php if ( ! themify_check( 'setting-comments_posts' ) ) : ?>
			<?php comments_template(); ?>
		<?php endif; ?>
        
		<?php themify_content_end(); // hook ?>	
	</div>
	<!-- /content -->
    <?php themify_content_after(); // hook ?>

<?php endwhile; ?>

<?php 
/////////////////////////////////////////////
// Sidebar							
/////////////////////////////////////////////
if ( $themify->layout != 'sidebar-none' ) : get_sidebar(); endif; ?>

</div>
<!-- /layout-container -->
	
<?php get_footer(); ?>