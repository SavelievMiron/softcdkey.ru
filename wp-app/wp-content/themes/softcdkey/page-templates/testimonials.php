<?php

/** Template Name: Testimonials  */

get_header();
?>
<div class="page-testimonials">
    <div class="container">
        <div class="row">
            <?
            /*Set how many comments per page*/
            $comments_per_page = 5;

            /*Count comments and count only approved*/
            $all_comments = wp_count_comments();
            $all_comments_approved = $all_comments->approved;

            /*Get Current Page Var*/
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            /*How many comments offset*/
            $offset = (($paged - 1) * $comments_per_page) ;
            /*Max number of pages*/
            $max_num_pages = ceil( $all_comments_approved / $comments_per_page );

            /*Get Comments*/
            /*If you are going to get comments from a post you need to add 'post_id' => $post->ID, to the array*/
            $comments = get_comments([
                'status' => 'approve',
                'number' => $comments_per_page,
                'offset' => $offset,
                'post_type' => 'product'
            ]);

            /*Set current page for pagination*/
            $current_page = max(1, get_query_var('paged'));
            ?>
            <h1 class="page-heading">
                Отзывы
                <!-- <span class="page-heading__shadow">Отзывы</span> -->
            </h1>
            <div class="page-content testimonials">
                <div class="testimonials__header">
                    <div class="testimonials__header-left">
                        <h3>
                            Всего &mdash; <?= get_comments(['post_type' => 'product', 'count' => true]); ?>
                        </h3>
                    </div>
                    <div class="testimonials__header-right">
                        <h3>
                            На других сервисах
                        </h3>

                        <a class="testimonials__service" href="#" title="Отзовник">
                            Отзовник
                        </a>
                        <a class="testimonials__service" href="#" title="Яндекс.Маркет">
                            Яндекс.Маркет
                        </a>
                    </div>
                </div>
                <hr class="section-break">
                <?
                if (!empty($comments)):
                ?>
                <div class="testimonials__content">
                    <?
                        foreach ($comments as $comment): $comment_id = $comment->comment_ID;
                    ?>
                            <div class="testimonial">
                                <div class="testimonial__number">
                                    <span>
                                        <? printf('№ %d', [$comment_id]) ?>
                                    </span>
                                    <span class="testimonial__number-shadow">
                                        <? printf('№ %d', [$comment_id]) ?>
                                    </span>
                                </div>
                                <div class="testimonial__user">
                                    <img src="<?= get_avatar_url(get_comment_author_email($comment_id), ['size' => 75]); ?>" class="testimonial__user-photo" alt="user profile">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/comment-like.png" class="testimonial__user-like" alt="">
                                </div>
                                <div class="testimonial__content">
                                    <div class="testimonial__info">
                                        <span class="testimonial__username"><? comment_author_email($comment_id); ?></span>
                                        <span class="testimonial__datetime"><? comment_date('', $comment_id); ?></span>
                                    </div>
                                    <p class="testimonial__message">
                                        <?= get_comment_text($comment_id); ?>
                                    </p>
                                </div>
                            </div>
                    <?
                        endforeach;

                        /*Echo paginate links*/
                        echo paginate_links(array(
                            'base' => get_pagenum_link(1) . '%_%',
                            'current' => $current_page,
                            'total' => $max_num_pages,
                            'prev_text' => __('&laquo; Previous'),
                            'next_text' => __('Next &raquo;'),
                            'end_size' => 2,
                            'mid-size' => 3
                        ));
                    ?>
                </div>
                <?
                else:
                ?>
                <div class="testimonials__not-found">
                    <? _e('There are no reviews yet.', 'woocommerce'); ?>
                </div>
                <?
                endif;
                ?>

                <nav id="pagination" class="pagination" role="navigation" aria-label="testimonials pagination">
                </nav>
            </div>
        </div>
    </div>
</div>
<?
get_footer();
