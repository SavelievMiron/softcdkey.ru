<?php

$product = $args['product'];
?>
<div class="popular-products__item">
    <a class="popular-products__item-image" href="<?= $product->get_permalink(); ?>">
        <img src="<?= wp_get_attachment_image_url($product->get_image_id(), 'full'); ?>" title="product thumbnail">
    </a>
    <div class="popular-products__item-info">
        <span class="popular-products__item-price">
            <?php
			if ($product->is_on_sale()):
			?>
				<span class="product-card__sale-price">
					<?= wc_price($product->get_sale_price()); ?>
				</span>
				<del class="product-card__original-price">
					<?= wc_price($product->get_regular_price()); ?>
				</del>
			<?php
			else:
			?>
				<span class="product-card__original-price">
					<?= wc_price($product->get_regular_price()); ?> Р
				</span>
			<?php
			endif;
			?>
        </span>
        <h4 class="popular-products__item-title" title="<?= $product->get_title(); ?>">
            <a href="<?= $product->get_permalink(); ?>"><?= $product->get_title(); ?></a>
        </h4>
        <p class="popular-products__item-subtitle">
            Proffesional
        </p>
    </div>
</div>