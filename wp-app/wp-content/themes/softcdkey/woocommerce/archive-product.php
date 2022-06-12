<?php

/** Archive Product Page */

$page_id = get_page_by_path( 'shop' )->ID;

// get setting for catalog page
$catalog_settings = cmb2_get_option( 'softcdkey_settings', 'catalog_settings' )[0];

$products_limit = $catalog_settings['products'] ?? 12;

$featured_products_page_limit    = $catalog_settings['featured_products_page'] ?? 4;
$featured_products_sidebar_limit = $catalog_settings['featured_products_sidebar'] ?? 3;

$search_categories = get_terms( 'product_cat', [
		'orderby'    => 'name',
		'order'      => 'asc',
		'fields'     => 'all',
		'slug'       => [ 'antivirus', 'office', 'windows' ],
		'hide_empty' => false
] );

$filter_categories = get_terms( 'product_cat', [
		'fields'     => 'all',
		'exclude'    => 15,
		'hide_empty' => false
] );

// query featured products
$is_manual_page = false;

$featured_products_page = carbon_get_post_meta( $page_id, 'popular_products_page' );
if ( empty( $featured_products_page ) ) {
	$fea_args = [
			'status'       => 'publish',
			'limit'        => $featured_products_page_limit,
			'featured'     => true,
			'stock_status' => 'instock',
			'orderby'      => [ 'meta_value_num' => 'ASC' ],
			'meta_key'     => 'total_sales'
	];
	if ( ! empty( $_GET['cat'] ) ) {
		$fea_args['category'] = [ $_GET['cat'] ];
	}
	$featured_products_page = wc_get_products( $fea_args );
} else {
	$is_manual_page = true;
}

// query products
$pro_args = [
		'status'                  => 'publish',
		'limit'                   => $products_limit - count( $featured_products_page ),
		'stock_status'            => 'instock',
		'orderby'                 => [ 'meta_value_num' => 'ASC' ],
		'meta_key'                => 'total_sales',
		'paginate'                => true,
		'exclude_with_tags'       => [ 'popular' ],
		'exclude_with_visibilities' => [ 'featured' ]
];
if ( ! empty( $_GET['cat'] ) ) {
	$pro_args['category'] = [ $_GET['cat'] ];
}
$products = wc_get_products( $pro_args );

get_header();
?>
	<div class="page-catalog">
		<div class="container d-flex justify-content-between">
			<aside class="catalog-sidebar">
				<div class="total-found">
                <span>
                    <?= $products->total; ?>
                </span>
					товаров
				</div>
				<div class="filters">
					<div class="categories">
						<?php
						foreach ( $filter_categories as $category ):
							if ( $category->parent === 0 ):
								$parent_id = $category->term_id;

								$children = array_filter( $filter_categories, function ( $term ) use ( $parent_id ) {
									return $term->parent === $parent_id;
								} );
								?>
								<button class="categories__heading<?= ( empty( $children ) ) ? ' no-categories' : ''; ?>"
										data-id="<?= $category->slug; ?>">
									<?= $category->name; ?>
								</button>
								<div class="categories__box categories__box_windows">
									<?php
									foreach ( $children as $sub_category ):
										?>
										<button class="categories__item" data-id="<?= $sub_category->slug; ?>">
											<?= $sub_category->name ?>
										</button>
									<?php
									endforeach;
									?>
								</div>
							<?php
							endif;
						endforeach;
						?>
					</div>
					<div class="filters__box">
						<div class="filters__tags">
							<div class="filters__tags-panel">
								<?php
								foreach ( ProductHelpers::getBadges() as $slug => $name ):
									?>
									<label class="custom-checkbox" for="<?= $slug; ?>">
										<input type="checkbox" name="badges[]" value="<?= $slug; ?>" id="<?= $slug; ?>">
										<span class="checkmark"></span>
										<?= $name; ?>
									</label>
								<?php
								endforeach;
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="popular-products">
					<h3 class="popular-products__heading">
						Популярные товары
					</h3>
					<?php
					$is_manual_sidebar = false;

					$featured_products = carbon_get_post_meta( $page_id, 'popular_products_sidebar' );
					if ( empty( $featured_products ) ) {
						$featured_products_sidebar = wc_get_products( [
								'featured' => true,
								'limit'    => $featured_products_sidebar_limit
						] );
					} else {
						$is_manual_sidebar = true;
					}

					if ( $is_manual_sidebar ) {
						foreach ( $featured_products as $item ) :
							get_template_part( 'woocommerce/popular-product', 'item', [ 'product' => wc_get_product( $item['id'] ) ] );
						endforeach;
					} else {
						if ( ! empty( $featured_products_sidebar ) ):
							foreach ( $featured_products_sidebar as $product ):
								get_template_part( 'woocommerce/popular-product', 'item', [ 'product' => $product ] );
							endforeach;
						endif;
					}
					?>
				</div>
				<button class="mobile-filters__close btn btn-primary mt-4" title="Закрыть">
					Закрыть
				</button>
			</aside>
			<div class="products">
				<form action="" class="search-form ">
					<div class="search__field">
						<input type="search" name="search" id="search" placeholder="Введите название товара...">
					</div>
				</form>

				<button type="button" class="btn btn-outlined btn-filters " title="Фильтры">
					<i class="fas fa-sliders-h"></i>
					Фильтры
				</button>

				<div id="data-container" class="products-grid">
					<?php
					// loop featured products
					if ( empty( $is_manual_page ) ) {
						if ( ! empty( $featured_products_page ) ) :
							foreach ( $featured_products_page as $product ) :
								get_template_part( 'woocommerce/product', 'card', [ 'product' => $product ] );
							endforeach;
						endif;
					} else {
						foreach ( $featured_products_page as $item ) :
							get_template_part( 'woocommerce/product', 'card', [ 'product' => wc_get_product( $item['id'] ) ] );
						endforeach;
					}

					// loop simple products
					if ( $products->total !== 0 ) :
						foreach ( $products->products as $product ) :
							get_template_part( 'woocommerce/product', 'card', [ 'product' => $product ] );
						endforeach;
					else :
						?>
						<p class="no-products">На данный момент товаров нету</p>
					<?php
					endif;
					?>
				</div>


				<?php
				if ( $products->max_num_pages >= 2 ):
					?>
					<script>
						let catalogQueryVars = <?= json_encode( [
								'total'         => $products->total,
								'page'          => 1,
								'per_page'      => $products_limit,
								'max_num_pages' => $products->max_num_pages
						] ); ?>;
					</script>
					<nav id="pagination" class="pagination" role="navigation" aria-label="testimonials pagination">
					</nav>
				<?php
				endif;
				?>
			</div>
		</div>
	</div>
<?php
get_footer();
