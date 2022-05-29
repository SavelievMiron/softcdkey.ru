<?

/** Similar Products */

$args = array(
		'featured' => true,
		'limit'    => 4
);

if ( isset( $args['product'] ) ) {
	$args['exclude'] = [ $args['product']->get_id() ];
}

$featured_products = wc_get_products( $args );

if ( ! empty( $featured_products ) ):
	?>
	<div class="similar-products">
		<h2 class="similar-products__heading">
			Популярный товар
		</h2>
		<div class="similar-products__wrapper">
			<?php
			foreach ( $featured_products as $product ) :
				get_template_part( 'woocommerce/product', 'card', [ 'product' => $product ] );
			endforeach;
			?>
		</div>
	</div>
<?php
endif;
