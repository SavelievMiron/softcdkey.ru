<?php

/** Main Slider */

$mainSlider = cmb2_get_option('softcdkey_sliders', 'softcdkey_mainslider');

// dd($mainSlider);
?>
<div class="main-slider swiper">
    <div class="swiper-wrapper">
        <?php
        if (!empty($mainSlider)):
            foreach($mainSlider as $slide):
                $product = wc_get_product($slide['product_id']);
        ?>
            <div class="swiper-slide product">
                <div class="product__info">
                    <h1 class="product__title">
                        <?= $slide['title']; ?>
                    </h1>
                    <p class="product__subtitle">
                        <?= $slide['subtitle']; ?>
                    </p>
                    <a class="product__add-to-cart add_to_cart_button ajax_add_to_cart"
                        href="<?php echo $product->add_to_cart_url(); ?>"
                        value="<?php echo esc_attr( $product->get_id() ); ?>"
                        data-product_id="<?php echo $product->get_id(); ?>"
                        data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
                        title="Добавить в Корзину">
                        <span>Купить</span>
                    </a>
                </div>
                <div class="product__image">
                    <img src="<?= $slide['image']; ?>" alt="product image">
                </div>
            </div>
        <?php
            endforeach;
        endif;
        ?>
    </div>
    <div class="swiper-navigation">
        <div class="swiper-navigation--prev">
            <button class="swiper-nav-btn swiper-button-prev" title="Предыдущий"></button>
            <div class="slider-preview">
            <div class="slider-preview__image">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/windows-pack-mini-1.png" alt="">
            </div>
            <div class="slider-preview__info">
                <h4 class="slide-preview__title">Комплект из 3х товаров</h4>
                <p class="slide-preview__subtitle">Windows 7, 8, 10</p>
            </div>
            </div>
        </div>
        <div class="swiper-navigation--next">
            <div class="slider-preview">
            <div class="slider-preview__info">
                <h4 class="slide-preview__title">Комплект из 3х товаров</h4>
                <p class="slide-preview__subtitle">Windows 7, 8, 10</p>
            </div>
            <div class="slider-preview__image">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/windows-pack-mini-2.png" alt="">
            </div>
            </div>
            <button class="swiper-nav-btn swiper-button-next" title="Следующий"></button>
        </div>
    </div>
</div>