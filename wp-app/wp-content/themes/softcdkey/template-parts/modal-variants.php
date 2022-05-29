<?php

/** Choose Link on Product Distributor Modal */

$product = $args['product'];
?>
<div class="modal modal--distributors hide">
    <form class="modal__container">
        <div class="modal__header">
            <h2>Официальные дистрибутивы</h2>
        </div>
        <div class="modal__content">
            <?
            if ($product->is_type('bundle')):
            ?>
            <div class="product__distributions">
                <?
                foreach ($product->get_bundled_data_items() as $item):
                ?>
                    <a href="<?= get_post_meta($item->get_product_id(), 'distributor_link', true); ?>" class="product__distributions--link">
                        <?= get_the_title( $item->get_product_id() ); ?>
                    </a>
                <?
                endforeach;
                ?>
            </div>
            <?
            endif;
            ?>
        </div>
        <button type="button" class="modal__close">&times;</button>
    </form>
</div>
