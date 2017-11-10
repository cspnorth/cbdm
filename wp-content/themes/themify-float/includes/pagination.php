<?php
/**
 * Partial template for pagination.
 * Creates numbered pagination or displays button for infinite scroll based on user selection
 *
 * @since 1.0.0
 */
global $themify;
if($themify->more_posts==='disable'){
	return;
}
if (!empty($themify->infinity_count)  || 'infinite' === $themify->more_posts || 'button' === $themify->more_posts) {
    $class = 'load-more';
    if ($themify->infinity_count > 0) {
        $total_pages = $themify->infinity_count;
        $current_page = get_query_var('paging', 1);
        $class.=' load-more-show';
    } 
	else {
        global $wp_query;
        $total_pages = $wp_query->max_num_pages;
        $current_page = is_front_page() ? get_query_var('page', 1) : get_query_var('paged', 1);
		if('button' === $themify->more_posts){
			$class.=' load-more-show';
		}
    }
    if (!$current_page) {
        $current_page = 1;
    }
    if ($total_pages > $current_page) {
        $url = $themify->infinity_count > 0 ? add_query_arg(array('paging' => $current_page, 'query' => $themify->infinity_query, 'action' => 'themify_shortcode_infinity'), admin_url('admin-ajax.php')) : next_posts($total_pages, false);
        echo '<p data-max="' . $total_pages . '" class="'.$class.'"><a onclick="return false;" href="' . $url . '" class="load-more-button">' . __('LOAD MORE', 'themify') . '</a><span></span></p>';
    }
} else{
    if ('numbered' == themify_get('setting-entries_nav') || '' == themify_get('setting-entries_nav')) {
        echo themify_float_get_pagenav();
    } else {
        ?>
        <div class="post-nav">
            <span class="prev"><?php next_posts_link(__('&laquo; Older Entries', 'themify')) ?></span>
            <span class="next"><?php previous_posts_link(__('Newer Entries &raquo;', 'themify')) ?></span>
        </div>
        <?php
    }
} // infinite
?>