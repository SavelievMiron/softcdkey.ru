<?php

namespace SoftCDKey\Setup;

use SoftCDKey\Utils\Encryption;

final class Woocommerce {
	public function register() {
		add_action( 'cmb2_admin_init', [ $this, 'add_metaboxes_to_product' ] );

		// Add custom columns to woocommerce
		add_filter( 'manage_edit-product_columns', [ $this, 'admin_product_custom_columns' ], 9999 );
		add_filter( 'manage_edit-product_sortable_columns', [ $this, 'admin_product_custom_sortable_columns' ], 9999 );
		add_action( 'manage_product_posts_custom_column', [ $this, 'admin_product_custom_columns_content' ], 10, 2 );

		// Add custom fields to woocommerce product
		add_action( 'woocommerce_product_options_general_product_data', [ $this, 'product_custom_fields' ] );
		add_action( 'woocommerce_process_product_meta', [ $this, 'product_custom_fields_save' ] );

		// Set product view counter
		add_action( 'template_redirect', [ $this, 'product_views_counter' ] );

		// Remove breadcrumbs from single product
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

		// configure address and billing fields on checkout page
		add_filter( 'woocommerce_checkout_fields', [ $this, 'custom_override_checkout_fields' ] );

		// move payment section on checkout page
		add_action( 'after_setup_theme', [ $this, 'theme_wc_setup' ] );

		// changed order button text
		add_filter( 'woocommerce_order_button_text', [ $this, 'custom_order_button_text' ] );

		// admin custom style
		add_action( 'admin_head', [ $this, 'admin_custom_style' ] );

		// add arg to wc_product_query
		add_filter( 'woocommerce_product_data_store_cpt_get_products_query', [
			$this,
			'handle_custom_query_var_badge'
		], 10, 2 );

		// remove view cart link
		add_filter( 'wc_add_to_cart_message_html', '__return_null' );
	}

	public function add_metaboxes_to_product() {
		$metabox = new_cmb2_box( array(
			'id'           => 'softcdkey_product_info',
			'title'        => 'Additional Info',
			'object_types' => array( 'product' ),
			'context'      => 'normal',
			'priority'     => 'high',
		) );

		$characteristics_id = $metabox->add_field( array(
			'id'         => 'product_characteristics',
			'type'       => 'group',
			'title'      => 'Характеристики',
			'repeatable' => false
		) );

		$metabox->add_group_field( $characteristics_id, [
			'name' => 'Производитель',
			'id'   => 'production',
			'type' => 'text',
		] );

		$metabox->add_group_field( $characteristics_id, [
			'name' => 'Разрядность',
			'id'   => 'capacity',
			'type' => 'text',
		] );

		$metabox->add_group_field( $characteristics_id, [
			'name' => 'Тип носителя',
			'id'   => 'storage_type',
			'type' => 'text',
		] );

		$metabox->add_group_field( $characteristics_id, [
			'name' => 'Срок действия',
			'id'   => 'expiration_time',
			'type' => 'text',
		] );

		$metabox->add_group_field( $characteristics_id, [
			'name' => 'К-во устройств',
			'id'   => 'device_numbers',
			'type' => 'text',
		] );

		$metabox->add_group_field( $characteristics_id, [
			'name' => 'Назначение',
			'id'   => 'purpose',
			'type' => 'text',
		] );

		$metabox->add_group_field( $characteristics_id, [
			'name' => 'Язык',
			'id'   => 'language',
			'type' => 'text',
		] );

		$metabox->add_group_field( $characteristics_id, [
			'name' => 'Тип поставки',
			'id'   => 'delivery_type',
			'type' => 'text',
		] );

		$metabox->add_group_field( $characteristics_id, [
			'name' => 'Региональная привязка',
			'id'   => 'region',
			'type' => 'text',
		] );

		$metabox->add_group_field( $characteristics_id, [
			'name' => 'Версия',
			'id'   => 'version',
			'type' => 'text',
		] );

		$metabox->add_field( [
			'name' => 'Бегущая строка',
			'id'   => 'ticker',
			'type' => 'text'
		] );

		$metabox->add_field( [
			'name' => 'Ссылка на оф. ПО',
			'id'   => 'distributor_link',
			'type' => 'text_url'
		] );

		$metabox->add_field( [
			'name'         => 'Media Files',
			'id'           => 'media_files',
			'type'         => 'file_list',
			'query_args'   => array(
				'type' => array(
					'image/gif',
					'image/jpeg',
					'image/png',
					'video/mp4'
				),
			),
			'preview_size' => array( 300, 300 ),
		] );

		$faq = new_cmb2_box( array(
			'id'           => 'softcdkey_product_faq',
			'title'        => 'F.A.Q',
			'object_types' => array( 'product' ),
			'context'      => 'normal',
			'priority'     => 'high',
		) );

		$questions_id = $faq->add_field( array(
			'id'         => 'product_faq',
			'type'       => 'group',
			'title'      => 'Вопросы',
			'repeatable' => true,
			'options'    => array(
				'group_title'    => __( 'Вопрос {#}', 'cmb2' ),
				'add_button'     => __( 'Добавить вопрос', 'cmb2' ),
				'remove_button'  => __( 'Удалить', 'cmb2' ),
				'sortable'       => true,
				'closed'         => true,
				'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ),
			),
		) );

		$faq->add_group_field( $questions_id, [
			'name' => 'Вопрос',
			'id'   => 'question',
			'type' => 'text',
		] );

		$faq->add_group_field( $questions_id, [
			'name' => 'Ответ',
			'id'   => 'answer',
			'type' => 'text',
		] );
	}

	public function product_custom_fields() {
		echo '<div class="product_custom_field">';

		$product = wc_get_product( get_the_ID() );

		$badge    = get_post_meta( get_the_ID(), '_badge', true );
		$act_code = Encryption::decrypt( get_post_meta( get_the_ID(), '_activation_code', true ) );

		woocommerce_wp_select( [
			'id'          => '_badge',
			'label'       => 'Badge',
			'description' => 'Choose product badge',
			'desc_tip'    => true,
			'value'       => $badge ? $badge : '',
			// 'style' => 'margin-bottom: 0px;',
			'options'     => [
				''        => 'None',
				'popular' => 'Popular',
				'new'     => 'New',
				'hot'     => 'Hot Discount',
				'sale'    => 'On Sale'
			]
		] );

		if ( ! $product->is_type( 'bundle' ) ) {
			woocommerce_wp_text_input( [
				'id'    => '_activation_code',
				'label' => 'Activation Code',
				'value' => $act_code,
			] );
		}

		echo '</div>';
	}

	public function product_custom_fields_save( ?int $post_id ) {
		if ( isset( $_POST['_badge'] ) && ! empty( $_POST['_badge'] ) ) {
			update_post_meta( $post_id, '_badge', sanitize_text_field( $_POST['_badge'] ) );
		}

		if ( isset( $_POST['_activation_code'] ) && ! empty( $_POST['_activation_code'] ) ) {
			$code = Encryption::encrypt( $_POST['_activation_code'] );
			update_post_meta( $post_id, '_badge', $code );
		}
	}

	public function product_views_counter() {
		global $post;
		if ( is_product() ) {
			$meta = get_post_meta( $post->ID, '_total_views_count', true );
			$meta = ( $meta ) ? $meta + 1 : 1;

			update_post_meta( $post->ID, '_total_views_count', $meta );
		}
	}

	public function admin_product_custom_columns( $columns ) {
		$before = array_slice( $columns, 0, 8, true );
		$after  = array_slice( $columns, 8, count( $columns ) - 8, true );

		$new_columns = [
			'comments'           => __( 'Reviews', 'woocommerce' ),
			'_total_views_count' => __( 'Views', 'woocommerce' )
		];

		return $before + $new_columns + $after;
	}

	public function admin_product_custom_sortable_columns( $columns ) {
		$new = [
			'_total_views_count' => '_total_views_count'
		];

		return $columns + $new;
	}

	public function admin_product_custom_columns_content( $column, $product_id ) {
		if ( $column == 'comments' ) {
			$product = wc_get_product( $product_id );
			echo $product->get_review_count();
		}
		if ( $column == '_total_views_count' ) {
			echo get_post_meta( $product_id, '_total_views_count', true );
		}
	}

	// configure checkout page
	public function custom_override_checkout_fields( $fields ) {
		$remove_fields = [
			'billing_first_name',
			'billing_last_name',
			'billing_company',
			'billing_address_1',
			'billing_address_2',
			'billing_city',
			'billing_postcode',
			'billing_country',
			'billing_state',
			// 'billing_email',
			'billing_phone'
		];

		foreach ( $remove_fields as $field ) {
			unset( $fields['billing'][ $field ] );
		}

		return $fields;
	}

	// configure woocommerce actions
	public function theme_wc_setup() {
		remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
		add_action( 'woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment', 20 );
	}

	public function custom_order_button_text() {
		return __( 'Оплатить', 'softcdkey' );
	}

	function handle_custom_query_var_badge( $query, $query_vars ) {
		if ( ! empty( $query_vars['badges'] ) ) {
			$query['meta_query'][] = [
				'key'     => '_badge',
				'value'   => $query_vars['badges'],
				'compare' => 'IN'
			];

			error_log( print_r( $query['meta_query'], 1 ) );
		}

		return $query;
	}

	// custom style for admin area
	function admin_custom_style() {
		echo '<style>
			table.wp-list-table .column-product_cat, table.wp-list-table .column-product_tag {
				width: 8%!important;
			}
		</style>';
	}

}
