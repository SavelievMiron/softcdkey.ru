<?php

namespace SoftCDKey\Setup;

/**
 * Enqueue.
 */
class Enqueue
{
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'global_js' ) );
	}

	/**
	 * Notice the mix() function in wp_enqueue_...
	 * It provides the path to a versioned asset by Laravel Mix using querystring-based
	 * cache-busting (This means, the file name won't change, but the md5. Look here for
	 * more information: https://github.com/JeffreyWay/laravel-mix/issues/920 )
	 */
	public function enqueue_scripts()
	{
		// CSS
		wp_enqueue_style( 'main', mix('css/style.css'), array(), filemtime(get_template_directory() . '/assets/dist//css/style.css'), 'all' );
		wp_enqueue_style( 'changes', mix('css/changes.css'), array(), filemtime(get_template_directory() . '/assets/dist/css/changes.css'), 'all' );

		// JS
		wp_enqueue_script( 'main', mix('js/app.js'), array(), filemtime(get_template_directory() . '/assets/dist/js/app.js'), true );
		// wp_enqueue_script( 'jquery-validation', mix('js/validation/jquery-validation.min.js'), array('main'), '1.9.2', true );
		wp_enqueue_script( 'cart', get_template_directory_uri() . '/assets/dist/js/cart.js', array('main'), filemtime(get_template_directory() . '/assets/dist/js/cart.js'), true );

		// Activate browser-sync on development environment
		if ( getenv( 'APP_ENV' ) === 'development' ) :
			wp_enqueue_script( '__bs_script__', getenv('WP_SITEURL') . ':3000/browser-sync/browser-sync-client.js', array(), null, true );
		endif;
	}

	public function global_js()
	{
		$vars = [
			'ajax_url' => admin_url('admin-ajax.php'),
			'ajax_actions' => [
				'cart_contents' => 'get_cart_contents',
				'remove_cart_item' => 'remove_cart_item',
				'add_to_cart' => 'add_to_cart',
				'clear_cart' => 'clear_cart',
				'get_product_info' => 'get_product_info',
				'get_products' => 'get_products',
				'get_question' => 'get_question',
			],
			'rest_api' => [
				'login' => rest_url(RestAPI::BASE . '/' . 'login'),
				'register' => rest_url(RestAPI::BASE . '/' . 'register'),
				'cart' => rest_url('wc/store/cart'),
			],
			'nonce' => [
				'rest_api' => [
					'cart' => wp_create_nonce('softcdkey-cart-actions'),
				],
				'ajax' => [
					'cart_contents' => wp_create_nonce('softcdkey-get_cart_contents'),
					'remove_cart_item' => wp_create_nonce('softcdkey-remove_cart_item'),
					'add_to_cart' => wp_create_nonce('softcdkey-add_to_cart'),
					'clear_cart' => wp_create_nonce('softcdkey-clear_cart'),
					'get_product_info' => wp_create_nonce('softcdkey-get_product_info'),
					'get_products' => wp_create_nonce('softcdkey-get_products'),
					'get_question' => wp_create_nonce('softcdkey-get_question'),
				]
			]
		];

		ob_start();

		echo 'const globalJS = ' . json_encode($vars) . ';';

		$inline = ob_get_clean();

		wp_add_inline_script('main', preg_replace('/\s+/', ' ', $inline), 'before');
	}
}
