<?php
$product = $args['product'];
$title   = $product->get_title();

$badges = get_the_terms( $product->get_id(), 'product_tag' );
?>
<div class="product-card">
	<div class="product-card__top">
		<div class="product-card__content">
			<a href="<?= $product->get_permalink(); ?>" title="<?= $title; ?>">
				<img src="<?= wp_get_attachment_image_url( $product->get_image_id(), 'full' ); ?>"
					 alt="product thumbnail">
				<span class="product-card__title" title="<?= $title; ?>">
                    <span><?= $title; ?></span>
                    <span class="product-card__subtitle">Proffesional</span>
                </span>
			</a>
		</div>
		<?php
		if ( ! empty( $badges ) ):
			foreach ( $badges as $badge ) :
				?>
				<div class="product-card__badge product-card__badge_<?= $badge->slug; ?>">
					<?= $badge->name; ?>
				</div>
			<?php
			endforeach;
		endif;

		if ( $product->is_on_sale() ):
			?>
			<div class="product-card__discount">
				<?= '-' . get_product_discount( $product ) . '%'; ?>
			</div>
		<?php
		endif;
		?>
		<!--		<button class="favourites favourites__add" title="Добавить в Избранное">-->
		<!--		</button>-->
	</div>

	<div class="product-card__bottom">
		<div class="product-card__cart">
			<a class="product-card__cart-laptop btn btn-outlined add-to-cart add_to_cart_button ajax_add_to_cart"
			   href="<?= $product->add_to_cart_url(); ?>" value="<?= esc_attr( $product->get_id() ); ?>"
			   data-product_id="<?= $product->get_id(); ?>" data-product_sku="<?= esc_attr( $product->get_sku() ); ?>"
			   title="Добавить в Корзину" rel="nofollow">
				<span>Купить</span>
			</a>
			<a href="<?= get_quick_purchase_url( $product ); ?>" class="quick-purchase" title="Быстрая покупка"
			   rel="nofollow">
				Быстрая покупка
			</a>
			<a class="product-card__cart-mobile btn btn-outlined add-to-cart add_to_cart_button ajax_add_to_cart"
			   href="<?= $product->add_to_cart_url(); ?>" value="<?= esc_attr( $product->get_id() ); ?>"
			   data-product_id="<?= $product->get_id(); ?>" title="Добавить в Корзину" rel="nofollow"></a>
			<div class="product-card__cart_tap">
				<a class="product-card__cart_tap-1 add_to_cart_button ajax_add_to_cart"
				   href="<?= $product->add_to_cart_url(); ?>" value="<?= esc_attr( $product->get_id() ); ?>"
				   data-product_id="<?= $product->get_id(); ?>" rel="nofollow">В Корзину</a>
				<a href="<?= get_quick_purchase_url( $product ); ?>" rel="nofollow">Купить сразу</a>
			</div>
		</div>
		<div class="product-card__price">
			<?php
			if ( $product->is_on_sale() ):
				?>
				<span class="product-card__sale-price">
                <?= wc_price( $product->get_sale_price() ); ?>
            </span>
				<del class="product-card__original-price">
					<?= wc_price( $product->get_regular_price() ); ?>
				</del>
			<?php
			else:
				?>
				<span class="product-card__original-price">
                <?= wc_price( $product->get_regular_price() ); ?> Р
            </span>
			<?php
			endif;
			?>
		</div>
	</div>
</div>
