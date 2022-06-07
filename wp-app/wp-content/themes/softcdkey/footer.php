<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SoftCDKey
 */

$social_icons = [
		'vkontakte' => 'fab fa-vk',
		'facebook'  => 'fab fa-facebook-f',
		'instagram' => 'fab fa-instagram',
		'twitter'   => 'fab fa-twitter',
		'skype'     => 'fab fa-skype',
		'telegram'  => 'fab fa-telegram-plane'
];

$payment_methods = cmb2_get_option( 'softcdkey_settings', 'softcdkey_payment_methods' );

?>
</main>
<?php
//get_template_part( 'template-parts/modal', 'authorization' );
//get_template_part( 'template-parts/modal', 'registration' );
get_template_part( 'template-parts/modal', 'search' );
?>
<footer class="footer">
    <div class="footer__top">
        <div class="container">
            <div class="footer__block">
                <div class="footer__logo">
                    <div class="logo">
                        <a class="logo__text" href="#" title="SoftCDKey">
                            <img class="logo__img" src="<?= get_template_directory_uri() ?>/assets/img/logo.svg" alt="Logo">
                        </a>
                        <div class="mobile-menu">
                            <div class="mobile-menu-block hamburger">
                                <span class="line"></span>
                                <span class="line"></span>
                                <span class="line"></span>
                            </div>
                        </div>
                    </div>
                    <?php
					$company_info = cmb2_get_option( 'softcdkey_settings', 'softcdkey_company_info' )[0];
					?>
                    <ul class="company-info">
                        <?php
						if ( ! empty( $company_info['worktime'] ) ) :
							?>
                        <li class="company-info__item">
                            <i class="far fa-clock"></i>&nbsp;<?= $company_info['worktime']; ?>
                        </li>
                        <?php
						endif;
						?>

                        <?php
						if ( ! empty( $company_info['phone'] ) ) :
							?>
                        <li class="company-info__item">
                            <a href="tel:<?= $company_info['phone']; ?>" title="Номер телефона">
                                <i class="fas fa-phone"></i>&nbsp;<?= $company_info['phone']; ?>
                            </a>
                        </li>
                        <?php
						endif;
						?>

                        <?php
						if ( ! empty( $company_info['email'] ) ) :
							?>
                        <li class="company-info__item">
                            <a href="mailto:<?= $company_info['email']; ?>" title="Электронная почта">
                                <i class="far fa-envelope"></i>&nbsp;<?= $company_info['email']; ?>
                            </a>
                        </li>
                        <?php
						endif;
						?>
                        <li class="company-info__item copyright">
                            Все права защищены 2021
                        </li>
                    </ul>
                </div>
                <div class="footer__menu">
                    <div class="footer__menu_1">
                        <h3 class="heading">
                            Меню
                        </h3>
                        <?php
						wp_nav_menu( [
								'menu'              => 'Footer Menu 1',
								'container'         => false,
								'menu_class'        => 'links',
								'custom_li_classes' => 'links__item'
						] );
						?>
                    </div>
                    <div class="footer__menu_2">
                        <h3 class="heading">
                            Информация
                        </h3>
                        <?php
						wp_nav_menu( [
								'menu'              => 'Footer Menu 2',
								'container'         => false,
								'menu_class'        => 'links',
								'custom_li_classes' => 'links__item'
						] );
						?>
                    </div>
                </div>
                <div class="footer__payment">
                    <h3 class="heading">
                        Способы оплаты
                    </h3>
                    <ul class="payment-methods">
                        <?php
						if ( ! empty( $payment_methods ) ) :
							foreach ( $payment_methods as $method ) :
						?>
                        <li class="payment-methods__item">
                            <img src="<?= $method['logo']; ?>" alt="<?= $method['name']; ?> logo">
                        </li>
                        <?php
							endforeach;
						endif;
						?>
                    </ul>
                    <a class="d-block underline mt-auto" href="#" title="#">Нет нужной платёжной системы?</a>
                </div>
                <div class="footer__rating">
                    <h3 class="heading">
                        Рейтинг SoftCDKey
                    </h3>
                    <a href="#" class="rating-box rating-box__yandex">
                        <div class="rating-box__wrapper">
                            <div class="rating-box__icon">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/svg/yandex_icon.svg" alt="yandex logo">
                            </div>
                            <div class="rating-box__content">
                                <h5 class="rating-box__title">Яндекс Маркет</h5>
                                <span class="rating-box__subtitle">Рейтинг магазина</span>
                            </div>
                        </div>
                        <div class="rating-box__score">
                            589
                        </div>
                    </a>

                    <a href="#" class="rating-box rating-box__otzovik rating-box__yandex">
                        <div class="rating-box__wrapper">
                            <div class="rating-box__icon">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/logo_otzovik.svg" alt="Otzovik logo">
                            </div>
                        </div>
                        <div class="rating-box__score">
                            100
                        </div>
                    </a>

                    <!-- Отзовник widget -->

                    <a class="btn-all-reviews" href="<?= home_url( '/testimonials/' ); ?>" title="#">Все отзывы и рейтинги</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <div class="footer__bottom_block">
                <div class="social-info">
                    <h3 class="heading">Мы в социальных сетях:</h3>

                    <ul class="social-links">
                        <?php
						$social_links = cmb2_get_option( 'softcdkey_settings', 'softcdkey_socials' )[0];

						if ( ! empty( $social_links ) ) :
							foreach ( $social_links as $key => $url ) :
								?>
                        <li class="social-links__item">
                            <a class="social-links__link" href="<?= $url ?>" title="<?= ucfirst( $key ); ?>">
                                <i class="<?= $social_icons[ $key ]; ?>"></i>
                            </a>
                        </li>
                        <?php
							endforeach;
						endif;
						?>
                    </ul>
                </div>
                <div class="info-links">
                    <a href="#" title="#" rel="nofollow">Договор-оферта</a>
                    <a href="#" title="#" rel="nofollow">Политика конфиденциальности</a>
                    <a href="#" title="#" rel="nofollow">Согласие на обработку персональных данных</a>
                </div>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>