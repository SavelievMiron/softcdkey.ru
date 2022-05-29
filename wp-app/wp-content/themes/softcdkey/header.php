<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SoftCDKey
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="theme-color" content="#fff">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="header-top">
	<div class="container">
		<div class="header-top__block">
			<?php $company_info = cmb2_get_option( 'softcdkey_settings', 'softcdkey_company_info' )[0]; ?>
			<div class="header-top__info">
                    <span>
                        <i class="far fa-clock"></i>
                        <?= $company_info['worktime'] ?>
                    </span>
			</div>
			<div class="header-top__contacts">
				<a href="tel:<?= $company_info['phone']; ?>" title="Номер телефона">
					<i class="fas fa-phone"></i>
					<span><?= $company_info['phone']; ?></span>
				</a>
				<a href="mailto:<?= $company_info['email'] ?>" title="Электронная почта">
					<i class="far fa-envelope"></i>
					<span><?= $company_info['email'] ?></span>
				</a>
			</div>
		</div>
	</div>
</div>
<header class="header-fixed">
	<div class="header container align-items-center">
		<div class="row flex-nowrap justify-content-between align-items-center">
			<div class="mobile-menu">
				<div class="mobile-menu-block hamburger">
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
				</div>
			</div>
			<div class="logo d-flex align-items-center">
				<?php
				if ( false === is_front_page() ) :
					?>
					<a href="/" title="<?= get_bloginfo( 'name' ); ?>">
						softcdkey
					</a>
				<?php
				else:
					?>
					<span title="<?= get_bloginfo( 'name' ); ?>">
						softcdkey
					</span>
				<?php
				endif;
				?>
			</div>
			<div class="info-menu">
				<div class="hamburger">
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
				</div>
				<div class="info-menu__content">
					<h4 class="info-menu__heading">
						Информация
					</h4>
					<?php
					wp_nav_menu( [
							'menu'                => 'Info Menu',
							'container'           => '',
							'menu_class'          => 'info-menu__list',
							'custom_li_classes'   => 'info-menu__item',
							'custom_link_classes' => ''
					] );
					?>
				</div>
			</div>
			<nav class="nav" role="navigation">
				<?php
				wp_nav_menu( [
						'menu'                => 17,
						'container'           => '',
						'menu_class'          => 'nav__items',
						'custom_li_classes'   => 'nav__item',
						'custom_link_classes' => 'nav__link'
				] );
				?>
			</nav>
			<div class="header-widgets">
				<button id="search" class="btn btn-search">
					<i class="fas fa-search"></i>
				</button>
				<? if ( ! is_user_logged_in() ): ?>
					<a class="btn btn-user" href="/login" title="Авторизация">
						Авторизация
					</a>
				<? else: ?>
					<a href="/profile" class="btn btn-user user-profile">
						<img class="avatar" src="<?= get_template_directory_uri() ?>/assets/img/user.jpg"
							 alt="user profile image">
						Профиль
					</a>
				<? endif; ?>

				<?
				if ( ! is_cart() && ! is_checkout() ):
					echo do_shortcode( '[woocommerce_cart_widget]' );
				endif;
				?>
			</div>
		</div>
	</div>

	<div class="mobile-sidebar">
		<?php
		wp_nav_menu( [
				'menu'                => 'Sidebar Menu',
				'container'           => '',
				'menu_class'          => 'mobile-nav',
				'custom_li_classes'   => 'mobile-nav__item',
				'custom_link_classes' => 'mobile-nav__link',
		] );
		?>

		<? if ( ! is_user_logged_in() ): ?>
			<button class="btn user-auth" title="Авторизация">
				Авторизация
			</button>
		<? else: ?>
			<a href="/profile" class="btn user-auth">
				<img src="<? get_template_directory_uri() ?>/assets/img/user.png" alt="user profile image">
				Профиль
			</a>
		<? endif; ?>
	</div>
</header>
<main>
