<?php
/**
 * Partial template that displays an entry filter.
 *
 * Created by themify
 * @since 1.0.0
 */

if (!(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    global $themify;
    $taxo = false;
    if (!empty($themify->is_shortcode)) {
        $cats = !empty($themify->shortcode_query_category)?$themify->shortcode_query_category:'';
        $taxo =  !empty($themify->shortcode_query_taxonomy)?$themify->shortcode_query_taxonomy:'';
    } elseif ($themify->is_isotop) {
        $cats = is_array($themify->query_category) ? join(',', $themify->query_category) : $themify->query_category;
        $taxo = $themify->query_taxonomy;
    }

    ?>
    <?php if ($taxo): ?>
            <article class="post filter-wrapper clearfix portfolio-post portfolio type-portfolio">
                    <div class="portfolio-filter-wrap">
                        <ul class="post-filter">
                            <?php wp_list_categories("hierarchical=0&show_count=0&title_li=&include=$cats&taxonomy=$taxo"); ?>
                        </ul>
                        <span class="post-filter-title"></span>
                    </div>
            </article>
            <!-- /post-filter -->
    <?php endif; ?>
	
<?php } ?>
