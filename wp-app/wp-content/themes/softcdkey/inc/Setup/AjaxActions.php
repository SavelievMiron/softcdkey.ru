<?php

namespace SoftCDKey\Setup;

/**
 * AjaxActions
 */
class AjaxActions {
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register() {
		$actions = [
			// cart actions
				'get_cart_contents',
				'remove_cart_item',
				'add_to_cart',
				'clear_cart',
			// products
				'get_product_info',
				'get_products',
			// faq
				'get_question',
		];

		foreach ( $actions as $action ) {
			add_action( "wp_ajax_nopriv_$action", [ $this, $action ] );
			add_action( "wp_ajax_$action", [ $this, $action ] );
		}
	}

	public function get_cart_contents() {
		check_ajax_referer( 'softcdkey-get_cart_contents' );

		$wc_cart = WC()->cart;

		ob_start();

		if ( ! $wc_cart->is_empty() ) :
			foreach ( $wc_cart->get_cart() as $item ) :
				get_template_part( 'woocommerce/cart/dropdown/cart-item', null, [ 'item' => $item ] );
			endforeach;
		else :
			get_template_part( 'woocommerce/cart/dropdown/empty-cart' );
		endif;

		$items = ob_get_clean();

		$response = [
				'items'       => $items,
				'count'       => $wc_cart->get_cart_contents_count(),
				'total_price' => $wc_cart->get_cart_total()
		];

		wp_send_json_success( $response );
	}

	public function remove_cart_item() {
		check_ajax_referer( 'softcdkey-remove_cart_item' );

		$wc_cart = WC()->cart;

		$id = intval( $_POST['id'] );

		// remove cart item by product_id
		foreach ( $wc_cart->get_cart() as $cart_item_key => $cart_item ) {
			if ( $cart_item['product_id'] == $id ) {
				$wc_cart->remove_cart_item( $cart_item_key );
			}
		}

		ob_start();

		if ( ! $wc_cart->is_empty() ) :
			foreach ( $wc_cart->get_cart() as $item ) :
				get_template_part( 'woocommerce/cart/dropdown/cart-item', null, [ 'item' => $item ] );
			endforeach;
		else :
			get_template_part( 'woocommerce/cart/dropdown/empty-cart' );
		endif;

		$items = ob_get_clean();

		$response = [
				'items'       => $items,
				'count'       => $wc_cart->get_cart_contents_count(),
				'total_price' => $wc_cart->get_cart_total()
		];

		wp_send_json_success( $response );
	}

	public function clear_cart() {
		check_ajax_referer( 'softcdkey-clear_cart' );

		$wc_cart = WC()->cart;

		$wc_cart->empty_cart();

		ob_start();

		get_template_part( 'woocommerce/cart/dropdown/empty-cart' );

		$items = ob_get_clean();

		$response = [
				'items' => $items
		];

		wp_send_json_success( $response );
	}

	public function add_to_cart() {
		check_ajax_referer( 'softcdkey-add_to_cart' );

		$id       = intval( $_POST['id'] );
		$quantity = intval( $_POST['quantity'] );

		WC()->cart->add_to_cart( $id, $quantity );

		wp_send_json_success();
	}

	public function get_product_info() {
		check_ajax_referer( 'softcdkey-get_product_info' );

		$id = intval( $_GET['id'] );

		if ( false === get_post_status( $id ) ) {
			wp_send_json_error( [ 'message' => 'There is no product with such ID' ] );
		}

		$product = wc_get_product( $id );

		$response = [
				'info'    => $product->get_meta( 'product_characteristics' ),
				'gallery' => array_map( fn( $id ) => wp_get_attachment_image_url( $id, 'full' ), $product->get_gallery_image_ids() )
		];

		wp_send_json_success( $response );
	}

	public function get_products() {
		check_ajax_referer( 'softcdkey-get_products' );

		$args = [
				'paginate' => true,
				'limit'    => 15,
				'orderby'  => [ 'meta_value_num' => 'ASC' ],
				'meta_key' => 'total_sales'
		];

		if ( isset( $_POST['page'] ) && intval( $_POST['page'] ) ) {
			$args['page'] = $_POST['page'];
		}

		if ( isset( $_POST['search'] ) && ! empty( $_POST['search'] ) ) {
			$args['s'] = sanitize_text_field( $_POST['search'] );
		}

		if ( isset( $_POST['tags'] ) && ! empty( $_POST['tags'] ) ) {
			$tags = $_POST['tags'];
			if ( count( $_POST['tags'] ) >= 2 ) {
				$parent_cats = get_terms( [
						'taxonomy' => 'product_cat',
						'fields'   => 'slugs',
						'parent'   => 0
				] );
				foreach ( $tags as $k => $tag ) {
					if ( in_array( $tag, $parent_cats ) ) {
						unset( $tags[ $k ] );
					}
				}
			}
			$args['category'] = array_map( 'sanitize_text_field', $tags );
		}

		if ( isset( $_POST['badges'] ) && ! empty( $_POST['badges'] ) ) {
			$args['tag'] = array_map( 'sanitize_text_field', $_POST['badges'] );
		}

		$products = wc_get_products( $args );

		ob_start();

		if ( $products->total !== 0 ) {
			foreach ( $products->products as $product ) {
				get_template_part( 'woocommerce/product-card', null, [ 'product' => $product ] );
			}
		} else {
			get_template_part( 'woocommerce/product-no-found' );
		}

		$items = ob_get_clean();

		$response = [
				'items'         => $items,
				'total'         => $products->total,
				'max_num_pages' => $products->max_num_pages
		];

		wp_send_json_success( $response );
	}

	public function get_question() {
		check_ajax_referer( 'softcdkey-get_question' );

		$id = intval( $_GET['id'] );

		$faq = carbon_get_theme_option( 'topics' );

		if ( ! in_array( $id, array_keys( $faq ) ) ) {
			wp_send_json_error( [
					'message' => 'There is no topic with such ID',
					'keys'    => array_keys( $faq )
			] );
		}

		ob_start();

		foreach ( $faq[ $id ]['entries'] as $entry ) :
			?>
			<button class="faq__question">
				<i class="fas fa-angle-down"></i>
				<span>
                    <?= $entry['question']; ?>
                </span>
			</button>
			<div class="faq__answer">
				<p>
					<?= $entry['answer']; ?>
				</p>
			</div>
		<?
		endforeach;

		$html = ob_get_clean();

		wp_send_json_success( [
				'items' => preg_replace( '/\s+/', ' ', $html )
		] );
	}

}
