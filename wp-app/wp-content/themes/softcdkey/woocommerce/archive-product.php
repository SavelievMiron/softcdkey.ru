<?php

/** Archive Product Page */

$limit = 12;

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

$products = wc_get_products( [
		'status'       => 'publish',
		'limit'        => $limit,
		'stock_status' => 'instock',
		'paginate'     => true
] );

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
					<button class="categories__heading<?= ( empty( $children ) ) ? ' no-categories' : ''; ?>" data-id="<?= $category->slug; ?>">
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
					$featured_products = wc_get_products( [
							'featured' => true,
							'limit'    => 3
					] );

					if ( ! empty( $featured_products ) ):
						foreach ( $featured_products as $product ):
							get_template_part( 'woocommerce/popular-product', 'item', [ 'product' => $product ] );
						endforeach;
					endif;
					?>
			</div>
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

			<div class="mobile-filters">
				<div class="categories">
					<?php
						foreach ( $filter_categories as $category ):
							if ( $category->parent === 0 ):
								$parent_id = $category->term_id;
								?>
					<button class="categories__heading">
						<?= $category->name; ?>
					</button>
					<div class="categories__box categories__box_windows">
						<?php
									$children = array_filter( $filter_categories, function ( $term ) use ( $parent_id ) {
										return $term->parent === $parent_id;
									} );
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
							<label class="custom-checkbox" for="mob_<?= $slug; ?>">
								<input type="checkbox" name="badges[]" value="<?= $slug; ?>" id="mob_<?= $slug; ?>">
								<span class="checkmark"></span>
								<?= $name; ?>
							</label>
							<?php
								endforeach;
								?>
						</div>
					</div>
				</div>
				<button class="mobile-filters__close btn btn-primary" title="Закрыть">
					Закрыть
				</button>
			</div>
			<?php
				if ( $products->total > $limit ):
					?>
			<script>
				let catalogQueryVars = <?= json_encode([
					'total'         => $products -> total,
						'page'          => 1,
							'per_page'      => $limit,
								'max_num_pages' => $products -> max_num_pages
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
