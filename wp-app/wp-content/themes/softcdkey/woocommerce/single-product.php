<?php

/** Single Product */

get_header();

/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action( 'woocommerce_before_main_content' );

$product = wc_get_product( get_the_ID() );
$stock   = $product->is_in_stock() ? 'in' : 'out';
$info    = get_post_meta( get_the_ID(), 'product_characteristics', true )[0];
$media_files = get_post_meta( get_the_ID(), 'media_files', true );

?>
	<div class="single-product">
		<section id="product-info">
			<div class="desktop-product container">
				<div class="product__header row">
					<div class="row">
						<div class="product__title">
							<h1 title="<?= $product->get_title(); ?>"><?= $product->get_title(); ?></h1>
							<? if ( ! empty( $info['version'] ) ) : ?>
							<p>
								<?= $info['version'] ?>
							</p>
							<? endif; ?>
						</div>
						<div class="product__metrics">
							<div class="product__metrics--purchases">
								<i class="fa-solid fa-bag-shopping"></i>
								<?= $product->get_total_sales(); ?>
							</div>
							<div class="product__metrics--views">
								<i class="fa-solid fa-eye"></i>
								<?= get_product_total_views( $product ); ?>
							</div>
						</div>
						<div class="product__customers">
							<div class="product__rating">
								<?php
								$rating = $product->get_average_rating();
								for ( $i = 5; $i > 0; $i -- ):
									?>
									<i class="icon <?= ( ( $rating - 1 ) > 0 ) ? 'icon-star' : 'icon-star-empty'; ?>"></i>
								<?php
								endfor;
								?>
								<span class="product__rating-users">
									<?= $product->get_review_count(); ?>
								</span>
							</div>
							<?php
							if ( is_user_logged_in() ):
								?>
								<div class="product__reviews">
									<div class="product__reviews-good">
										<i class="far fa-thumbs-up"></i>
										140
									</div>
									<div class="product__reviews-bad">
										<i class="far fa-thumbs-down"></i>
										10
									</div>
								</div>
							<?php
							endif;
							?>
						</div>
					</div>
					<div class="row mt-4">
						<?php
						if ( $product->is_type( 'bundle' ) ):
							?>
							<div class="product__bundle">
								<?php
								$data_items = $product->get_bundled_data_items();
								foreach ( $data_items as $k => $item ):
									?>
									<button class="product__bundle--item <?php if ( $k === 0 ): echo 'is-active'; endif; ?>"
											data-product_id="<?= $item->get_product_id(); ?>">
										<?= get_the_title( $item->get_product_id() ); ?>
									</button>
								<?php
								endforeach;
								?>
							</div>
							<?php
							$info = get_post_meta( ( $data_items[0] )->get_product_id(), 'product_characteristics', true )[0];
						endif;
						?>
					</div>
				</div>
				<div class="product-block">
					<div class="product__slider">
						<?php
						$productGallery = $product->get_gallery_image_ids();

						if ( ! empty( $productGallery ) ):
							?>
							<div class="product__slider--2__wrapper">
								<div class="product__slider--2 swiper">
									<div class="swiper-wrapper">
										<div class="swiper-slide">
											<img src="<?= wp_get_attachment_image_url( $product->get_image_id(), 'full' ); ?>" alt="product thumb"/>
										</div>
										<?php
										foreach ( $productGallery as $slideId ):
											?>
											<div class="swiper-slide">
												<img src="<?= wp_get_attachment_image_url( $slideId, 'full' ); ?>"
													 alt="product thumb"/>
											</div>
										<?php
										endforeach;
										?>
									</div>
								</div>
								<div class="swiper-pagination"></div>
								<div class="swiper-button-prev"></div>
								<div class="swiper-button-next"></div>
							</div>
							<div class="product__slider--1 swiper">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="product__slider--1_slide">
											<img src="<?= wp_get_attachment_image_url( $product->get_image_id(), 'full' ); ?>" alt="product thumb"/>
										</div>
									</div>
									<?php
									foreach ( $productGallery as $slideId ):
										?>
										<div class="swiper-slide">
											<div class="product__slider--1_slide">
												<img src="<?= wp_get_attachment_image_url( $slideId, 'full' ); ?>" alt="product thumb"/>
											</div>
										</div>
									<?php
									endforeach;
									?>
								</div>
							</div>
						<?php
						endif;
						?>
					</div>
					<div class="product__info">
						<div class="product__tags">
							<div class="product__tags-item">
								<i class="icon icon-clock"></i>
								Мгновенное получение
							</div>
							<div class="product__tags-item">
								<i class="icon icon-warranty"></i>
								Гарантия 12 месяцев
							</div>
							<div class="product__tags-item">
								<i class="icon icon-surprise"></i>
								-10% на следующую покупку
							</div>
						</div>
						<div class="product__info_rating">
							<div class="product__metrics">
								<div class="product__metrics--purchases">
									<i class="fa-solid fa-bag-shopping"></i>
									<?= $product->get_total_sales(); ?>
								</div>
								<div class="product__metrics--views">
									<i class="fa-solid fa-eye"></i>
									<?= get_product_total_views( $product ); ?>
								</div>
							</div>
							<div class="product__customers">
								<div class="product__rating">
									<i class="icon icon-star"></i>
									<i class="icon icon-star"></i>
									<i class="icon icon-star"></i>
									<i class="icon icon-star"></i>
									<i class="icon icon-star-empty"></i>
									<span class="product__rating-users">
									99
								</span>
								</div>
								<div class="product__reviews">
									<div class="product__reviews-good">
										<i class="far fa-thumbs-up"></i>
										140
									</div>
									<div class="product__reviews-bad">
										<i class="far fa-thumbs-down"></i>
										10
									</div>
								</div>
							</div>
						</div>
						<div class="product__content">
							<div class="product__content--1">
								<ul class="product__feature-list">
									<?php
									if ( ! empty( $info['production'] ) ):
										?>
										<li class="list-item" data-id="production">
									<span class="list-item__title">
										Производитель
									</span>
											<span class="list-item__content">
										<?= $info['production']; ?>
									</span>
										</li>
									<?php
									endif;

									if ( ! empty( $info['capacity'] ) ):
										?>
										<li class="list-item" data-id="capacity">
									<span class="list-item__title">
										Разрядность
									</span>
											<span class="list-item__content">
										<?= $info['capacity']; ?>
									</span>
										</li>
									<?php
									endif;

									if ( ! empty( $info['storage_type'] ) ):
										?>
										<li class="list-item" data-id="storage_type">
									<span class="list-item__title">
										Тип носителя
									</span>
											<span class="list-item__content">
										<?= $info['storage_type']; ?>
									</span>
										</li>
									<?php
									endif;

									if ( ! empty( $info['expiration_time'] ) ):
										?>
										<li class="list-item" data-id="expiration_time">
									<span class="list-item__title">
										Срок действия
									</span>
											<span class="list-item__content">
										<?= $info['expiration_time']; ?>
									</span>
										</li>
									<?php
									endif;

									if ( ! empty( $info['device_numbers'] ) ):
										?>
										<li class="list-item" data-id="device_numbers">
									<span class="list-item__title">
										К-во устройств
									</span>
											<span class="list-item__content">
										<?= $info['device_numbers']; ?>
									</span>
										</li>
									<?php
									endif;

									if ( ! empty( $info['purpose'] ) ):
										?>
										<li class="list-item" data-id="purpose">
									<span class="list-item__title">
										Назначение
									</span>
											<span class="list-item__content">
										<?= $info['purpose']; ?>
									</span>
										</li>
									<?php
									endif;

									if ( ! empty( $info['language'] ) ):
										?>
										<li class="list-item" data-id="language">
									<span class="list-item__title">
										Язык
									</span>
											<span class="list-item__content">
										<?= $info['language']; ?>
									</span>
										</li>
									<?php
									endif;
									?>
								</ul>
							</div>
							<div class="product__content--2">
								<ul class="product__feature-list">
									<?php
									if ( ! empty( $info['delivery_type'] ) ):
										?>
										<li class="list-item" data-id="delivery_type">
											<span class="list-item__title">
												Тип поставки
											</span>
													<span class="list-item__content">
												<?= $info['delivery_type']; ?>
											</span>
										</li>
									<?php
									endif;

									if ( ! empty( $info['region'] ) ):
										?>
										<li class="list-item" data-id="region">
											<span class="list-item__title">
												Регион
											</span>
													<span class="list-item__content">
												<?= $info['region']; ?>
											</span>
										</li>
									<?php
									endif;

									if ( ! empty( $info['version'] ) ):
										?>
										<li class="list-item" data-id="version">
											<span class="list-item__title">
												Версия
											</span>
													<span class="list-item__content">
												<?= $info['version']; ?>
											</span>
										</li>
									<?php
									endif;

									// if (!empty($info['edition'])):
									?>
										<li class="list-item" data-id="edition">
											<span class="list-item__title">
												Редакция
											</span>
												<span class="list-item__content">
												Home
											</span>
										</li>
									<?php
									// endif;
									?>
								</ul>
								<div class="product__cart">
									<div class="product__cart-info">
									<span class="product__stock product__stock--<?= $stock; ?>">
										<?= ( $stock === 'in' ) ? 'В наличии' : 'Нет в наличии'; ?>
									</span>
										<div class="product__price">
											<?php
											if ( $product->is_on_sale() ) :
												?>
												<span class="product__price--sale">
												<?= wc_price( $product->get_sale_price() ); ?>
											</span>
												<del class="product__price--original">
													<?= wc_price( $product->get_regular_price() ); ?>
												</del>
											<?php
											else :
												?>
												<span class="product__price--original">
												<?= wc_price( $product->get_regular_price() ); ?>
											</span>
											<?php
											endif;
											?>
										</div>
									</div>
									<div class="product__add-to-cart">
										<div class="product__add-to-cart--quantity">
											<button id="minus" title="Удалить">-</button>
											<input id="quantity" type="number" name="quantity" value="1" min="1"
												   max="100">
											<button id="plus" title="Добавить">+</button>
										</div>
										<button class="product__add-to-cart--btn single-add_to_cart"
												data-product_id="<?= $product->get_id(); ?>"
												data-quantity="1"
												title="Добавить в корзину">
											<span>В корзину</span>
										</button>
									</div>
									<a class="product__quick-purchase" href="<?= get_quick_purchase_url( $product ); ?>"
									   title="Купить в 1 клик">
										Купить в 1 клик
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="product__footer">
				<div class="container">
					<div class="row flex-nowrap">
						<div class="product__ticker">
							<div class="product__ticker--wrapper">
								<?= get_post_meta( get_the_ID(), 'ticker', true ); ?>
							</div>
						</div>
						<div class="product__assets">
							<?php
							if ( ! wp_is_mobile() ):
								if ( $product->is_type( 'bundle' ) ):
									?>
									<button id="official-distributor" title="Скачать програму">
										<i class="icon icon-download"></i>
										Скачать програму
									</button>
								<?php
								else:
									?>
									<a href="<?= get_post_meta( get_the_ID(), 'distributor_link', true ); ?>"
									   download="distribution.exe" title="Скачать програму" rel="nofollow">
										<i class="icon icon-download"></i>
										Скачать програму
									</a>
								<?php
								endif;
							endif;
							?>
							<button title="Инструкция">
								<i class="icon icon-document"></i>
								Инструкция
							</button>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="product-description">
			<?php
			$faq = get_post_meta( get_the_ID(), 'product_faq', true );
			?>
			<div class="product-desc__tabs">
				<div class="container">
					<div class="row product-desc__row">
						<button class="product-desc__tab is-active" data-id="description" title="Описание">
							Описание
						</button>
						<button class="product-desc__tab mobile-tab" data-id="characteristics"
								title="Характеристики">
							Характеристики
						</button>
						<button class="product-desc__tab testimonials-disable" data-id="warranty" title="Гарантии">
							Гарантии
						</button>
						<button class="product-desc__tab testimonials-disable" data-id="payment" title="Доставка">
							Оплата и доставка
						</button>
						<button class="product-desc__tab testimonials-disable" data-id="reviews"
								title="Отзывы">
							Отзывы
						</button>
						<?php
						if ( ! empty( $faq ) ):
							?>
							<button class="product-desc__tab" data-id="faq" title="F.A.Q">
								F.A.Q
							</button>
						<?php
						endif;
						?>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="product-desc__content">
						<div id="description" class="product-desc__tab-content is-active description">
							<div class="page-content">
								<h2 class="heading">
									Описание
								</h2>
								<div class="description__content">
									<?php
									$content = get_the_content( null, false, get_the_ID() );
									if ( ! empty( $content ) ) :
										echo $content;
									else:
										_e( 'К данному товару ещё нету описания', 'softcdkey' );
									endif;
									?>
								</div>
								<? if ( ! empty( $media_files ) && count( $media_files ) > 1 ) : ?>
								<div class="description__slider container">
									<div class="swiper description__slider--1">
										<div class="swiper-wrapper">
											<?
											foreach ( $media_files as $id => $url ) :
											?>
												<div class="swiper-slide">
													<img src="<?= $url; ?>"/>
												</div>
											<?
											endforeach;
											?>
										</div>
									</div>
									<div thumbsSlider="" class="swiper description__slider--2">
										<div class="swiper-wrapper">
											<?
											foreach ( $media_files as $id => $url ) :
											?>
												<div class="swiper-slide">
													<img src="<?= $url; ?>"/>
												</div>
											<?
											endforeach;
											?>
										</div>

									</div>
									<div class="swiper-pagination"></div>
								</div>
								<? endif; ?>
							</div>
						</div>
						<div id="characteristics" class="product-desc__tab-content mobile-tab">
							<div class="page-content">
								<h2 class="heading">
									Характеристики
								</h2>
								<?php
								$excerpt = get_the_excerpt( get_the_ID() );
								if ( ! empty( $excerpt ) ) :
								?>
								<p>
									<?= $excerpt; ?>
								</p>
								<?php
								endif;
								?>
								<table class="list">
									<tbody>
									<?php
									if ( ! empty( $info['production'] ) ):
										?>
										<tr class="list__item" data-id="production">
											<td class="list__item--title">Производитель</td>
											<td class="list__item--content"><?= $info['production']; ?></td>
										</tr>
									<?php
									endif;

									if ( ! empty( $info['capacity'] ) ):
										?>
										<tr class="list__item" data-id="capacity">
											<td class="list__item--title">Разрядность</td>
											<td class="list__item--content"><?= $info['capacity']; ?></td>
										</tr>
									<?php
									endif;

									if ( ! empty( $info['storage_type'] ) ):
										?>
										<tr class="list__item" data-id="storage_type">
											<td class="list__item--title">Тип носителя</td>
											<td class="list__item--content"><?= $info['storage_type']; ?></td>
										</tr>
									<?php
									endif;

									if ( ! empty( $info['expiration_time'] ) ):
										?>
										<tr class="list__item" data-id="expiration_time">
											<td class="list__item--title">Срок действия</td>
											<td class="list__item--content"><?= $info['expiration_time']; ?></td>
										</tr>
									<?php
									endif;

									if ( ! empty( $info['device_numbers'] ) ):
										?>
										<tr class="list__item" data-id="device_numbers">
											<td class="list__item--title">К-во устройств</td>
											<td class="list__item--content"><?= $info['device_numbers']; ?></td>
										</tr>
									<?php
									endif;

									if ( ! empty( $info['purpose'] ) ):
										?>
										<tr class="list__item" data-id="purpose">
											<td class="list__item--title">Назначение</td>
											<td class="list__item--content"><?= $info['purpose']; ?></td>
										</tr>
									<?php
									endif;

									if ( ! empty( $info['region'] ) ):
										?>
										<tr class="list__item" data-id="region">
											<td class="list__item--title">Региональная привязка</td>
											<td class="list__item--content"><?= $info['region']; ?></td>
										</tr>
									<?php
									endif;

									if ( ! empty( $info['language'] ) ):
										?>
										<tr class="list__item" data-id="language">
											<td class="list__item--title">Язык</td>
											<td class="list__item--content"><?= $info['language']; ?></td>
										</tr>
									<?php
									endif;

									if ( ! empty( $info['delivery_type'] ) ):
										?>
										<tr class="list__item" data-id="delivery_type">
											<td class="list__item--title">Тип поставки</td>
											<td class="list__item--content"><?= $info['delivery_type']; ?></td>
										</tr>
									<?php
									endif;

									if ( ! empty( $info['version'] ) ):
										?>
										<tr class="list__item" data-id="version">
											<td class="list__item--title">Версия</td>
											<td class="list__item--content"><?= $info['version']; ?></td>
										</tr>
									<?php
									endif;
									?>
									</tbody>
								</table>
							</div>
						</div>
						<div id="reviews" class="product-desc__tab-content product-testimonials woocommerce-Reviews">
							<div class="page-content">
								<?php get_template_part( 'woocommerce/templates/single-product-reviews' ); ?>
							</div>
						</div>
						<?php
						if ( ! empty( $faq ) ):
							?>
							<div id="faq" class="product-desc__tab-content faq">
								<div class="page-content">
									<h2 class="heading">
										Часто задаваемые вопросы
									</h2>
									<div class="faq__questions">
										<?php
										foreach ( $faq as $item ):
											?>
											<button class="faq__question">
												<i class="fas fa-angle-down"></i>
												<span>
											<?= $item['question']; ?>
										</span>
											</button>
											<div class="faq__answer">
												<p>
													<?= $item['answer']; ?>
												</p>
											</div>
										<?php
										endforeach;
										?>
									</div>
									<a class="faq__link" href="<?= home_url( '/faq/' ); ?>" title="FAQ" rel="nofollow">FAQ</a>
								</div>
							</div>
						<?php
						endif;
						?>
						<div id="warranty" class="product-desc__tab-content warranty">
							<div class="warranty">
								<div class="page-content">
									<h2>
										Безопасные сделки
									</h2>
									<p>
										Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores
										reiciendis quo magni iure velit necessitatibus ipsa a facilis quisquam?
										Nobis, adipisci maiores. Consequuntur quod provident pariatur quam officiis
										optio, totam suscipit dolorem distinctio? Laborum placeat a suscipit? Optio
										alias possimus minima est nobis iure veritatis iusto obcaecati dolorem
										mollitia. Eum!
									</p>
									<h2>
										Мгновенная доставка
									</h2>
									<p>
										Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores
										reiciendis quo magni iure velit necessitatibus ipsa a facilis quisquam?
										Nobis, adipisci maiores. Consequuntur quod provident pariatur quam officiis
										optio, totam suscipit dolorem distinctio? Laborum placeat a suscipit? Optio
										alias possimus minima est nobis iure veritatis iusto obcaecati dolorem
										mollitia. Eum!
									</p>
									<h2>
										Компетентная поддержка
									</h2>
									<p>
										Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores
										reiciendis quo magni iure velit necessitatibus ipsa a facilis quisquam?
										Nobis, adipisci maiores. Consequuntur quod provident pariatur quam officiis
										optio, totam suscipit dolorem distinctio? Laborum placeat a suscipit? Optio
										alias possimus minima est nobis iure veritatis iusto obcaecati dolorem
										mollitia. Eum!
									</p>
									<h2>
										Положительные отзывы
									</h2>
									<p>
										Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores
										reiciendis quo magni iure velit necessitatibus ipsa a facilis quisquam?
										Nobis, adipisci maiores. Consequuntur quod provident pariatur quam officiis
										optio, totam suscipit dolorem distinctio? Laborum placeat a suscipit? Optio
										alias possimus minima est nobis iure veritatis iusto obcaecati dolorem
										mollitia. Eum!
									</p>
								</div>
							</div>
						</div>
						<div id="payment" class="product-desc__tab-content payment">
							<div class="page-payment">
								<div class="page-content">
									<div class="payment__description">
										<h2 class="h-2">
											Платежная система
										</h2>
										<p>
											Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet dicta
											culpa fugit natus voluptatem numquam, itaque iusto nisi assumenda
											mollitia at dolorem cum asperiores expedita corrupti perspiciatis
											architecto, distinctio, consequatur maiores? Harum consectetur saepe
											eveniet eligendi doloribus incidunt reiciendis odio quasi, soluta nam
											delectus impedit accusamus rerum voluptatem, exercitationem ad?
										</p>
									</div>
									<div class="payment__methods">
										<h2 class="h-2">
											Способы оплаты
										</h2>
										<ul>
											<li>
												<img src="https://via.placeholder.com/90x60" alt="payment method">
											</li>
											<li>
												<img src="https://via.placeholder.com/90x60" alt="payment method">
											</li>
											<li>
												<img src="https://via.placeholder.com/90x60" alt="payment method">
											</li>
											<li>
												<img src="https://via.placeholder.com/90x60" alt="payment method">
											</li>
											<li>
												<img src="https://via.placeholder.com/90x60" alt="payment method">
											</li>
											<li>
												<img src="https://via.placeholder.com/90x60" alt="payment method">
											</li>
											<li>
												<img src="https://via.placeholder.com/90x60" alt="payment method">
											</li>
											<li>
												<img src="https://via.placeholder.com/90x60" alt="payment method">
											</li>
											<li>
												<img src="https://via.placeholder.com/90x60" alt="payment method">
											</li>
											<li>
												<img src="https://via.placeholder.com/90x60" alt="payment method">
											</li>
											<li>
												<img src="https://via.placeholder.com/90x60" alt="payment method">
											</li>
											<li>
												<img src="https://via.placeholder.com/90x60" alt="payment method">
											</li>
										</ul>
									</div>
									<div class="payment__steps">
										<h2 class="h-2">
											Несколько шагов для получения продукта
										</h2>
										<div class="payment__steps-content">
											<div class="payment__step-wrapper">
												<div class="payment__step">
													<div class="payment__step-number">1</div>
													<div class="payment__step-content">
														<span>Выберите товар или услугу</span>
														<button class="btn" title="В каталог">В каталог</button>
													</div>
												</div>
												<span class="payment__step-back">1</span>
											</div>
											<div class="payment__step-wrapper">
												<div class="payment__step">
													<div class="payment__step-number">2</div>
													<div class="payment__step-content">
														<span>Войдите в личный кабинет или зарегистрируйтесь</span>
														<!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, alias.</p> -->
													</div>
												</div>
												<span class="payment__step-back">2</span>
											</div>
											<div class="payment__step-wrapper">
												<div class="payment__step">
													<div class="payment__step-number">3</div>
													<div class="payment__step-content">
														<span>Оплатите выбранные вами товары</span>
														<!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime doloremque nam sapiente totam quo. Voluptatibus!</p> -->
													</div>
												</div>
												<span class="payment__step-back">3</span>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<hr class="section-break">
		<section id="similar-products">
			<div class="container">
				<div class="row">
					<?php
					get_template_part( 'template-parts/similar-reviews' );
					get_template_part( 'woocommerce/product', 'featured', [ 'product' => $product ] );
					?>
				</div>
			</div>
		</section>
	</div>
<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

if ( $product->is_type( 'bundle' ) ) {
	get_template_part( 'template-parts/modal-variants', null, [ 'product' => $product ] );
}

get_footer();
