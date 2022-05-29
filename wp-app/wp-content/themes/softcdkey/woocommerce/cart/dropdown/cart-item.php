<?php
$item    = $args['item'];
$wc_cart = WC()->cart;
$product = wc_get_product( $item['data']->get_id() );

?>
<li class="dropdown-product" data-id="<?= $product->get_id(); ?>" data-quantity="<?= $item['quantity']; ?>">
	<div class="dropdown-product__image">
		<img src="<?= wp_get_attachment_image_url( $product->get_image_id() ); ?>" alt="product image">
	</div>
	<div class="dropdown-product__desc">
		<h4 class="dropdown-product__desc-title">
			<a href="#" target="_blank"><?= $product->get_title(); ?></a>
		</h4>
		<span class="dropdown-product__desc-subtitle">Ключ активации</span>
	</div>
	<div class="dropdown-product__cost">
		<span class="dropdown-product__quantity"><? printf( 'x%d', $item['quantity'] ); ?></span>
		<span class="dropdown-product__price"><?= $wc_cart->get_product_subtotal( $product, $item['quantity'] ); ?></span>
	</div>
	<button class="dropdown-product__remove" title="Удалить из Корзины">
		<i class="fas fa-times"></i>
	</button>
</li>
