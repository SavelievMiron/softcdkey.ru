<?php

/** Top Banner */

$topSlider = cmb2_get_option('softcdkey_sliders', 'softcdkey_topslider');

if ( empty( $topSlider ) ) {
	return;
}
?>
<div class="top-banner swiper">
    <div class="swiper-wrapper">
		<?php
		foreach ( $topSlider as $k => $slide ) :
			$product = wc_get_product( $slide['product'] );
			if ( empty( $product ) ) {
				continue;
			}
		?>
			<div class="swiper-slide">
				<a class="product-block" href="<?= $product->get_permalink(); ?>">
					<div class="product-block__text">
						<?php if ( ! empty( $slide['discount'] ) ) : ?>
						<h3>-<?= $slide['discount']; ?>%</h3>
							<?php if ( isset( $slide['best_discount'] ) && $slide['best_discount'] ) : ?>
							<span>Лучшая скидка</span>
							<?php endif; ?>
						<?php endif; ?>
						<p>
							<?= $slide['text']; ?>
						</p>
					</div>
					<div class="product-block__image">
						<img src="<?= $slide['image']; ?>" alt="<?= $product->get_title(); ?> image">
					</div>
					<div class="product-block__link">
						<?php
						$key = isset( $topSlider[$k + 1] ) ? $k + 1 : 0;
						?>
						<img src="<?= $topSlider[$key]['image']; ?>" alt="<?= get_the_title( $topSlider[$key]['product'] ); ?> image">
						<h4 title="<?= $topSlider[$key]['title']; ?>"><?= $topSlider[$key]['title']; ?></h4>
						<span>Следующее предложение</span>
					</div>
					<?php if ( ! empty( $slide['discount'] ) ) : ?>
					<img class="product-block__bg" src="<?= get_template_directory_uri(); ?>/assets/img/discount-<?= $slide['discount']; ?>.png" alt="">
					<?php endif; ?>
				</a>
			</div>
		<?php
		endforeach;
		?>
    </div>
    <div class="swiper-navigation">
        <div class="swiper-nav-btn swiper-button-prev"></div>
        <div class="swiper-nav-btn swiper-button-next"></div>
    </div>
    <div class="swiper-pagination"></div>
</div>
