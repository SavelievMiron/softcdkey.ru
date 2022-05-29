<?php
/** Archive of Campaigns */

get_header();

?>
<div class="container">
    <div class="row">
        <h1 class="page-heading">
            Скидки и акции
        </h1>
        <div class="archive-campaign page-content">
            <div class="cards">
            <?
                if ( have_posts() ) :

                    while ( have_posts() ) :
                        the_post();

                        get_template_part( 'template-parts/campaign', 'card' );

                    endwhile;
            ?>
                <button id="loadmore" class="btn btn-primary" title="Показать больше">
                    Показать больше
                </button>
            <?
                else:
            ?>
                <p class="no-campaigns">На данный момент никаких акций и скидок нету.</p>
            <?
                endif;
            ?>
            </div>
        </div>
    </div>
</div>

<?

get_footer();
