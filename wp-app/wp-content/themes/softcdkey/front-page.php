<?php

get_header();
?>
	<div class="page-main d-flex flex-column">
		<div class="order-1">
			<section id="main-slider">
				<div class="container">
					<?php get_template_part( 'template-parts/slider', 'main' ); ?>
				</div>
				<div class="main-slider-navigation__back">
				</div>
			</section>
		</div>
		<div class="order-2">
			<section id="categories">
				<div class="container">
					<div class="categories">
						<a class="categories__tab categories__tab-1" href="#" title="Windows">
							<img class="categories__tab-image"
								 src="<?= get_template_directory_uri(); ?>/assets/img/svg/microsoft.svg"
								 alt="windows icon">
							<h4 class="categories__title">
								Windows
							</h4>
							<img class="categories__tab-image_hover"
								 src="<?= get_template_directory_uri(); ?>/assets/img/svg/microsoft-color.svg"
								 alt="image hover">
						</a>
						<a class="categories__tab categories__tab-2" href="#" title="Office">
							<img class="categories__tab-image"
								 src="<?= get_template_directory_uri(); ?>/assets/img/svg/office.svg" alt="office icon">
							<h4 class="categories__title">
								Office
							</h4>
							<img class="categories__tab-image_hover"
								 src="<?= get_template_directory_uri(); ?>/assets/img/svg/office-color.svg"
								 alt="image hover">
						</a>
						<a class="categories__tab categories__tab-3" href="#" title="Windows+Office">
							<img class="categories__tab-image"
								 src="<?= get_template_directory_uri(); ?>/assets/img/svg/microsoft.svg"
								 alt="windows icon">
							<span class="categories__tab-3_plus">+</span>
							<img class="categories__tab-image"
								 src="<?= get_template_directory_uri(); ?>/assets/img/svg/office.svg" alt="office icon">
							<h4 class="categories__title">
							<span>
								Windows
								<br>
								Office
							</span>
							</h4>

							<div class="categories__tab-hover">
								<img class="categories__tab-image"
									 src="<?= get_template_directory_uri(); ?>/assets/img/svg/microsoft-color.svg"
									 alt="windows+office icon">
								<h4 class="categories__title">
								<span>
									Windows
									<br>
									+
									<br>
									Office
								</span>
								</h4>
								<img class="categories__tab-image"
									 src="<?= get_template_directory_uri(); ?>/assets/img/svg/office-color.svg"
									 alt="image hover">
							</div>
						</a>
						<a class="categories__tab categories__tab-4" href="#" title="Antiviruses">
							<img class="categories__tab-image"
								 src="<?= get_template_directory_uri(); ?>/assets/img/svg/antivirus.svg"
								 alt="antiviruses icon">
							<h4 class="categories__title">
								Антивирусы
							</h4>
							<img class="categories__tab-image_hover"
								 src="<?= get_template_directory_uri(); ?>/assets/img/svg/shield-color.svg"
								 alt="image hover">
						</a>
					</div>
				</div>
			</section>
		</div>
		<div class="order-8 d-none d-sm-block order-md-4">
			<section id="main-banner">
				<div class="container">
					<?php get_template_part( 'template-parts/banner', 'top' ); ?>
				</div>
			</section>
		</div>
		<div class="order-5">
			<section id="products">
				<div class="container">
					<div class="products-grid">
						<?php
						$featured_products = wc_get_products( [
							'status' => 'publish',
							'limit' => 8,
							'featured' => true,
							'stock_status' => 'instock'
						] );

						if ( ! empty( $featured_products ) ) :
							foreach ( $featured_products as $product ) :
								get_template_part( 'woocommerce/product', 'card', [ 'product' => $product ] );
							endforeach;
						endif;

						$products = wc_get_products( [
								'status'       => 'publish',
								'limit'        => 20 - count( $featured_products ),
								'stock_status' => 'instock'
						] );

						if ( ! empty( $products ) ) :
							foreach ( $products as $product ) :
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
					if ( ! empty( $products ) ):
						?>
						<div class="row justify-content-center">
							<a class="btn btn-large btn-primary btn-shadow" href="<?= home_url( '/shop/' ) ?>"
							   title="В каталог" rel="nofollow">
								В каталог
							</a>
						</div>
					<?php
					endif;
					?>
				</div>
			</section>
		</div>
		<div class="order-6">
			<section id="about-banner" class="about-banner">
				<div class="container">
					<div class="row position-relative">
						<?php get_template_part( 'template-parts/banner', 'about' ); ?>
					</div>
				</div>
			</section>
		</div>
		<div class="order-7">
			<div class="page-testimonials">
				<div class="container">
					<div class="row">
						<div class="page-content testimonials">
							<div class="testimonials__header">
								<div class="testimonials__header-left">
									<h3>
										Наши любимые покупатели
									</h3>
									<p>Что говорят о нас!</p>
								</div>
							</div>
							<div class="testimonials__content">
								<div class="testimonial">
									<div class="testimonial__number">
									<span>
										№ 121
									</span>
										<span class="testimonial__number-shadow">
										№ 121
									</span>
									</div>
									<div class="testimonial__user">
										<img src="<?= get_template_directory_uri(); ?>/assets/img/user.jpg"
											 class="testimonial__user-photo" alt="user profile">
										<img src="<?= get_template_directory_uri(); ?>/assets/img/comment-like.png"
											 class="testimonial__user-like" alt="">
									</div>
									<div class="testimonial__content">
										<div class="testimonial__info">
											<span class="testimonial__username">Alice Kuper</span>
											<span class="testimonial__datetime">12-10-13 12:43:48</span>
										</div>
										<p class="testimonial__message">
											Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
											temporibus a enim, dolor alias expedita voluptas assumenda molestiae
											nihil facilis delectus dolores in reiciendis. Consequuntur facilis,
											delectus vero rerum voluptate esse odit. Facere blanditiis distinctio
											expedita illo dolore quibusdam eaque at fuga quod, quasi architecto,
											nostrum mollitia velit earum atque.
										</p>
									</div>
								</div>
								<div class="testimonial">
									<div class="testimonial__number">
									<span>
										№ 121
									</span>
										<span class="testimonial__number-shadow">
										№ 121
									</span>
									</div>
									<div class="testimonial__user">
										<img src="<?= get_template_directory_uri(); ?>/assets/img/user.jpg"
											 class="testimonial__user-photo" alt="user profile">
										<img src="<?= get_template_directory_uri(); ?>/assets/img/comment-like.png"
											 class="testimonial__user-like" alt="">
									</div>
									<div class="testimonial__content">
										<div class="testimonial__info">
											<span class="testimonial__username">Alice Kuper</span>
											<span class="testimonial__datetime">12-10-13 12:43:48</span>
										</div>
										<p class="testimonial__message">
											Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur
											temporibus a enim, dolor alias expedita voluptas assumenda molestiae
											nihil facilis delectus dolores in reiciendis. Consequuntur facilis,
											delectus vero rerum voluptate esse odit. Facere blanditiis distinctio
											expedita illo dolore quibusdam eaque at fuga quod, quasi architecto,
											nostrum mollitia velit earum atque.
										</p>
									</div>
								</div>
								<div class="d-flex justify-content-center mt-5">
									<a href="<?= home_url( '/testimonials/' ) ?>"
									   class="btn btn-large btn-primary btn-shadow" rel="nofollow">К отзывам</a>
								</div>
							</div>
							</br>
						</div>
					</div>
				</div>
				<div class="container similar-reviews">
					<div class="page-content">
						<h3 class="similar-reviews__title">Наши любимые покупатели</h3>
						<span class="similar-reviews__subtitle">Что говорят о нас!</span>
						<div class="swiper similar-reviews-slider">
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<div class="similar-card">
										<div class="similar-card__user">
											<img src="<?= get_template_directory_uri(); ?>/assets/img/user.jpg"
												 class="similar-card__user-photo"
												 alt="user profile">
											<img src="<?= get_template_directory_uri(); ?>/assets/img/comment-like.png"
												 class="similar-card__user-like" alt="">
										</div>
										<div class="similar-card__name">
											<h4>Wade Warren</h4>
											<div class="similar-card__number">
												№ 121
											</div>
										</div>
										<div class="similar-card__text">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus varius
											eu sed varius eros pellentesque aliquam enim. Pulvinar dolor ultricies
											amet, in pulvinar rhoncus metus. Leo ac gravida blandit vitae
											pellentesque integer nec. Elit nibh sodales vitae est interdum.
										</div>
										<span class="similar-card__datetime">12-10-13 12:43:48</span>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="similar-card">
										<div class="similar-card__user">
											<img src="<?= get_template_directory_uri(); ?>/assets/img/user.jpg"
												 class="similar-card__user-photo"
												 alt="user profile">
											<img src="<?= get_template_directory_uri(); ?>/assets/img/comment-like.png"
												 class="similar-card__user-like" alt="">
										</div>
										<div class="similar-card__name">
											<h4>Wade Warren</h4>
											<div class="similar-card__number">
												№ 121
											</div>
										</div>
										<div class="similar-card__text">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus varius
											eu sed varius eros pellentesque aliquam enim. Pulvinar dolor ultricies
											amet, in pulvinar rhoncus metus. Leo ac gravida blandit vitae
											pellentesque integer nec. Elit nibh sodales vitae est interdum.
										</div>
										<span class="similar-card__datetime">12-10-13 12:43:48</span>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="similar-card">
										<div class="similar-card__user">
											<img src="<?= get_template_directory_uri(); ?>/assets/img/user.jpg"
												 class="similar-card__user-photo"
												 alt="user profile">
											<img src="<?= get_template_directory_uri(); ?>/assets/img/comment-like.png"
												 class="similar-card__user-like" alt="">
										</div>
										<div class="similar-card__name">
											<h4>Wade Warren</h4>
											<div class="similar-card__number">
												№ 121
											</div>
										</div>
										<div class="similar-card__text">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus varius
											eu sed varius eros pellentesque aliquam enim. Pulvinar dolor ultricies
											amet, in pulvinar rhoncus metus. Leo ac gravida blandit vitae
											pellentesque integer nec. Elit nibh sodales vitae est interdum.
										</div>
										<span class="similar-card__datetime">12-10-13 12:43:48</span>
									</div>
								</div>
							</div>
							<div class="swiper-pagination"></div>
						</div>
					</div>
					<a href="<?= home_url( '/testimonials/' ) ?>" class="btn btn-large btn-primary btn-shadow d-block"
					   rel="nofollow">К отзывам</a>
				</div>
			</div>
		</div>
	</div>
<?php
get_footer();
