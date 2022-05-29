<?php

namespace SoftCDKey\Custom;

/**
 * Shortcodes
 */
class Shortcodes {
	public function register() {
		add_action( 'init', [ $this, 'register_shortcodes' ] );
	}

	public function register_shortcodes() {
		add_shortcode( 'woocommerce_cart_widget', [ $this, 'woocommerce_cart' ] );
	}

	public function woocommerce_cart() {
		$wc_cart = WC()->cart;

		ob_start();
		?>
		<div class="cart-dropdown" id="shopping-cart">
			<button class="cart-dropdown__basket">
				<div class="cart-dropdown__basket-icon">
					<img src="<?= get_template_directory_uri(); ?>/assets/img/svg/basket-white.svg" alt="shopping bag">
					<span class="cart-dropdown__amount"><?= $wc_cart->get_cart_contents_count(); ?></span>
				</div>
				<div class="cart-dropdown__basket-inner">
					<!-- Корзина -->
					<i class="fas fa-angle-down"></i>
				</div>
			</button>
			<div class="cart-dropdown__menu hide">
				<ul id="dropdown-products" class="cart-dropdown__products">
					<?php
					if ( ! $wc_cart->is_empty() ) :
						foreach ( $wc_cart->get_cart() as $item ) :
							get_template_part( 'woocommerce/cart/dropdown/cart-item', null, [ 'item' => $item ] );
						endforeach;
					else:
						get_template_part( 'woocommerce/cart/dropdown/empty-cart' );
					endif;
					?>
				</ul>
				<div class="cart-dropdown__hide <?= ( ! $wc_cart->is_empty() ) ? 'show' : ''; ?>">
					<div class="cart-dropdown__total">
						<span>Сумма</span>
						<span class="cart-total-price"><?= $wc_cart->get_cart_total(); ?></span>
					</div>
					<div class="cart-dropdown__action">
						<button id="clearCart"
								class="cart-dropdown__action-clear"
								type="button"
								data-nonce="<?= wp_create_nonce( 'clear-cart' ); ?>"
								title="Очистить корзину">Очистить корзину
						</button>
						<a href="<?= wc_get_cart_url(); ?>" class="cart-dropdown__action-pay"
						   title="Оплатить">Оплатить</a>
					</div>
				</div>
			</div>
		</div>
		<?php
		$html = ob_get_clean();

		return $html;
	}
}
