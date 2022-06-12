<?php

namespace SoftCDKey\Setup;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

final class Settings {

	public function register() {
		add_action( 'cmb2_admin_init', [ $this, 'register_main_options_metabox' ] );

		// register carbon fields
		add_action( 'carbon_fields_register_fields', [ $this, 'register_carbon_fields' ] );

		// create default pages
		add_action( 'after_setup_theme', [ $this, 'create_default_pages' ] );

		// redirection rules
		add_action( 'template_redirect', [ $this, 'redirection_rules' ] );
	}

	public function register_main_options_metabox() {
		$args = array(
			'id'           => 'softcdkey_settings_page',
			'title'        => 'Settings',
			'object_types' => array( 'options-page' ),
			'option_key'   => 'softcdkey_settings',
			'tab_group'    => 'softcdkey_settings',
			'tab_title'    => 'Settings',
		);

		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = 'softcdkey_options_display_with_tabs';
		}

		$main_options = new_cmb2_box( $args );
		unset( $args );

		$main_options->add_field( array(
			'name' => 'General',
			'type' => 'title',
			'id'   => 'softcdkey_general'
		) );

		$company_info = $main_options->add_field( array(
			'id'         => 'softcdkey_company_info',
			'type'       => 'group',
			'repeatable' => false,
			'options'    => [
				'group_title' => 'Информация о компании'
			]
		) );

		$company_info_fields = [
			[
				'name' => __( 'График работы', 'softcdkey' ),
				'id'   => 'worktime',
			],
			[
				'name' => __( 'Моб. номер', 'softcdkey' ),
				'id'   => 'phone',
			],
			[
				'name' => __( 'Эл. почта', 'softcdkey' ),
				'id'   => 'email',
			]
		];

		foreach ( $company_info_fields as $field ) {
			$main_options->add_group_field( $company_info, array(
				'name' => $field['name'],
				'id'   => $field['id'],
				'type' => 'text',
			) );
		}

		$homepage_settings_id = $main_options->add_field( array(
			'id'         => 'homepage_settings',
			'type'       => 'group',
			'repeatable' => false,
			'options'    => array(
				'group_title' => 'Настройки главной страницы',
			)
		) );

		$main_options->add_group_field( $homepage_settings_id, array(
			'name'       => 'К-во товаров',
			'type'       => 'text',
			'id'         => 'products',
			'attributes' => array(
				'type'    => 'number',
				'pattern' => '\d*',
			)
		) );

		$main_options->add_group_field( $homepage_settings_id, array(
			'name'       => 'К-во популярных товаров',
			'type'       => 'text',
			'id'         => 'featured_products',
			'attributes' => array(
				'type'    => 'number',
				'pattern' => '\d*',
			)
		) );

		$catalog_settings_id = $main_options->add_field( array(
			'id'         => 'catalog_settings',
			'type'       => 'group',
			'repeatable' => false,
			'options'    => array(
				'group_title' => 'Настройки страницы каталога',
			)
		) );

		$main_options->add_group_field( $catalog_settings_id, array(
			'name'       => 'К-во товаров',
			'type'       => 'text',
			'id'         => 'products',
			'attributes' => array(
				'type'    => 'number',
				'pattern' => '\d*',
			)
		) );

		$main_options->add_group_field( $catalog_settings_id, array(
			'name'       => 'К-во популярных товаров в выборке',
			'type'       => 'text',
			'id'         => 'featured_products_page',
			'attributes' => array(
				'type'    => 'number',
				'pattern' => '\d*',
			)
		) );

		$main_options->add_group_field( $catalog_settings_id, array(
			'name'       => 'К-во популярных товаров в боковой панели',
			'type'       => 'text',
			'id'         => 'featured_products_sidebar',
			'attributes' => array(
				'type'    => 'number',
				'pattern' => '\d*',
			)
		) );


		/** Contacts */
		$main_options->add_field( array(
			'name' => 'Контакты',
			'type' => 'title',
			'id'   => 'softcdkey_contacts_title'
		) );

		$contacts = $main_options->add_field( array(
			'id'         => 'softcdkey_contacts',
			'type'       => 'group',
			'repeatable' => true,
			'options'    => [
				'group_title'    => __( 'Контакт #{#}' ),
				'add_button'     => __( 'Добавить Контакт' ),
				'remove_button'  => __( 'Удалить' ),
				'sortable'       => true,
				'closed'         => false, // true to have the groups closed by default
				'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' )
			]
		) );

		$main_options->add_group_field( $contacts, array(
			'name'             => 'Лого',
			'id'               => 'icon',
			'type'             => 'select',
			'show_option_none' => true,
			'default'          => 'custom',
			'options'          => array(
				'vkontakte' => __( 'Vkontakte' ),
				'facebook'  => __( 'Facebook' ),
				'instagram' => __( 'Instagram' ),
				'twitter'   => __( 'Twitter' ),
				'skype'     => __( 'Skype' ),
				'telegram'  => __( 'Telegram' ),
				'email'     => __( 'Email' ),
				'phone'     => __( 'Phone' )
			),
		) );

		$main_options->add_group_field( $contacts, array(
			'name' => 'Название',
			'id'   => 'name',
			'type' => 'text',
		) );

		$main_options->add_group_field( $contacts, array(
			'name'      => 'Линк',
			'id'        => 'link',
			'type'      => 'text_url',
			'protocols' => array( 'https' )
		) );


		/** Social Media */
		$main_options->add_field( array(
			'name' => 'Social Media',
			'type' => 'title',
			'id'   => 'softcdkey_socialmedia'
		) );

		$socials = $main_options->add_field( array(
			'id'         => 'softcdkey_socials',
			'type'       => 'group',
			'repeatable' => false,
		) );

		$social_fields = [
			[
				'name' => 'VKontakte',
				'id'   => 'vkontakte',
			],
			[
				'name' => 'Facebook',
				'id'   => 'facebook',
			],
			[
				'name' => 'Instagram',
				'id'   => 'instagram',
			],
			[
				'name' => 'Twitter',
				'id'   => 'twitter',
			],
			[
				'name' => 'Skype',
				'id'   => 'skype',
			],
			[
				'name' => 'Telegram',
				'id'   => 'telegram'
			]
		];

		foreach ( $social_fields as $field ) {
			$main_options->add_group_field( $socials, array(
				'name'      => $field['name'],
				'id'        => $field['id'],
				'type'      => 'text_url',
				'protocols' => array( 'https' )
			) );
		}

		/** Payment Methods **/
		$main_options->add_field( array(
			'name' => 'Payment Methods',
			'type' => 'title',
			'id'   => 'softcdkey_payment_methods_title'
		) );

		$payment_methods_id = $main_options->add_field( array(
			'id'      => 'softcdkey_payment_methods',
			'type'    => 'group',
			'options' => array(
				'group_title'   => __( 'Способ Оплаты #{#}', 'cmb2' ),
				// since version 1.1.4, {#} gets replaced by row number
				'add_button'    => __( 'Добавить Способ Оплаты', 'cmb2' ),
				'remove_button' => __( 'Удалить', 'cmb2' ),
				'sortable'      => true,
			),
		) );

		$main_options->add_group_field( $payment_methods_id, [
			'name'       => 'Name',
			'id'         => 'name',
			'type'       => 'text',
			'attributes' => array(
				'data-validation' => 'required',
			),
		] );

		$main_options->add_group_field( $payment_methods_id, [
			'name'         => 'Logo',
			'id'           => 'logo',
			'type'         => 'file',
			'options'      => array(
				'url' => false,
			),
			'query_args'   => array(
				'type' => array(
					'image/webp',
					'image/jpeg',
					'image/png',
				),
			),
			'preview_size' => array( 300, 250 ),
			'attributes'   => array(
				'data-validation' => 'required',
			),
		] );

		/** ----------------- Sliders ----------------- **/

		$args = array(
			'id'           => 'softcdkey_sliders_page',
			'menu_title'   => 'Sliders',
			'title'        => 'Sliders',
			'object_types' => array( 'options-page' ),
			'option_key'   => 'softcdkey_sliders',
			'parent_slug'  => 'softcdkey_settings',
			'tab_group'    => 'softcdkey_settings',
			'tab_title'    => 'Sliders',
		);

		if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
			$args['display_cb'] = 'softcdkey_options_display_with_tabs';
		}

		$sliders = new_cmb2_box( $args );
		unset( $args );

		$sliders->add_field( array(
			'name' => 'Main Slider',
			'type' => 'title',
			'id'   => 'softcdkey_sliders_main-slider'
		) );

		$main_slider_id = $sliders->add_field( array(
			'id'         => 'softcdkey_mainslider',
			'type'       => 'group',
			'repeatable' => true,
			'options'    => array(
				'group_title'    => 'Slide №{#}', // since version 1.1.4, {#} gets replaced by row number
				'add_button'     => 'Add Slide',
				'remove_button'  => 'Remove Slide',
				'sortable'       => true,
				'closed'         => true,
				'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ),
			),
		) );

		$sliders->add_group_field( $main_slider_id, array(
			'name' => 'Title',
			'id'   => 'title',
			'type' => 'text',
		) );

		$sliders->add_group_field( $main_slider_id, array(
			'name' => 'Subtitle',
			'id'   => 'subtitle',
			'type' => 'text',
		) );

		$sliders->add_group_field( $main_slider_id, array(
			'name'         => 'Image',
			'desc'         => 'Рекомендумый размер -- 675x500',
			'type'         => 'file',
			'id'           => 'image',
			'options'      => array(
				'url' => false,
			),
			'query_args'   => array(
				'type' => array(
					'image/webp',
					'image/jpeg',
					'image/png',
				),
			),
			'preview_size' => array( 675, 500 ),
		) );

		$sliders->add_group_field( $main_slider_id, array(
			'name'            => 'Product ID',
			'id'              => 'product_id',
			'type'            => 'text',
			'attributes'      => array(
				'type'    => 'number',
				'pattern' => '\d*',
			),
			'sanitization_cb' => 'absint',
			'escape_cb'       => 'absint',
		) );

		$sliders->add_field( array(
			'name' => 'Top Slider',
			'type' => 'title',
			'id'   => 'softcdkey_sliders_top-slider'
		) );

		$top_slider_id = $sliders->add_field( array(
			'id'         => 'softcdkey_topslider',
			'type'       => 'group',
			'repeatable' => true,
			'options'    => array(
				'group_title'    => 'Slide №{#}', // since version 1.1.4, {#} gets replaced by row number
				'add_button'     => 'Add Slide',
				'remove_button'  => 'Remove Slide',
				'sortable'       => true,
				'closed'         => true,
				'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ),
			),
		) );

		$sliders->add_group_field( $top_slider_id, array(
			'name' => 'Title',
			'id'   => 'title',
			'type' => 'text',
		) );

		$sliders->add_group_field( $top_slider_id, array(
			'name' => 'Text',
			'id'   => 'text',
			'type' => 'text',
		) );

		$sliders->add_group_field( $top_slider_id, array(
			'name'             => 'Discount',
			'id'               => 'discount',
			'type'             => 'select',
			'show_option_none' => true,
			'default'          => 'custom',
			'options'          => array(
				'55' => '55%',
				'25' => '25%',
				'15' => '15%',
				'5'  => '5%',
			),
		) );

		$sliders->add_group_field( $top_slider_id, array(
			'name' => 'The Best Discount',
			'id'   => 'best_discount',
			'type' => 'checkbox',
		) );

		$sliders->add_group_field( $top_slider_id, array(
			'name'       => 'Product',
			'id'         => 'product',
			'type'       => 'text',
			'attributes' => array(
				'type'    => 'number',
				'pattern' => '\d*',
			),
		) );

		$sliders->add_group_field( $top_slider_id, array(
			'name'         => 'Image',
			'desc'         => 'Рекомендумый размер -- 500x265',
			'type'         => 'file',
			'id'           => 'image',
			'options'      => array(
				'url' => false,
			),
			'query_args'   => array(
				'type' => array(
					'image/webp',
					'image/jpeg',
					'image/png',
				),
			),
			'preview_size' => array( 500, 265 ),
		) );

		$sliders->add_field( array(
			'name' => 'About Slider',
			'type' => 'title',
			'id'   => 'softcdkey_sliders_about-slider'
		) );

		$about_slider_id = $sliders->add_field( array(
			'id'         => 'softcdkey_aboutslider',
			'type'       => 'group',
			'repeatable' => true,
			'options'    => array(
				'group_title'    => 'Slide №{#}', // since version 1.1.4, {#} gets replaced by row number
				'add_button'     => 'Add Slide',
				'remove_button'  => 'Remove Slide',
				'sortable'       => true,
				'closed'         => true,
				'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ),
			),
		) );

		$sliders->add_group_field( $about_slider_id, array(
			'name'         => 'Image',
			'type'         => 'file',
			'id'           => 'image',
			'options'      => array(
				'url' => false,
			),
			'query_args'   => array(
				'type' => array(
					'image/webp',
					'image/jpeg',
					'image/png',
				),
			),
			'preview_size' => array( 600, 200 ),
		) );
	}

	public function register_carbon_fields() {
		Container::make( 'theme_options', 'F.A.Q' )
		         ->set_icon( 'dashicons-media-document' )
		         ->add_fields( array(
			         Field::make( 'complex', 'topics' )
			              ->setup_labels( [
				              'plural_name'   => 'Темы',
				              'singular_name' => 'Тема',
			              ] )
			              ->add_fields( array(
				              Field::make( 'text', 'name', 'Название' ),
				              Field::make( 'textarea', 'desc', 'Краткое описание' )
				                   ->set_rows( 2 ),
				              Field::make( 'complex', 'entries', 'Вопросы' )
				                   ->setup_labels( [
					                   'plural_name'   => 'Вопросы',
					                   'singular_name' => 'Вопрос'
				                   ] )
				                   ->add_fields( array(
					                   Field::make( 'text', 'question' ),
					                   Field::make( 'textarea', 'answer' )->set_rows( 4 ),
				                   ) )
			              ) ),
		         ) );

		Container::make( 'post_meta', __( 'Настройки главной страницы' ) )
		         ->where( 'post_type', '=', 'page' )
		         ->where( 'post_template', '=', 'front-page.php' )
		         ->add_tab( __( 'Популярные товары' ), array(
			         Field::make( 'association', 'popular_products', __( 'Popular Products' ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'product',
				              ),
			              ) )
			              ->set_max( 20 )
		         ) );

		$shop_id = get_page_by_path( 'shop' )->ID;
		Container::make( 'post_meta', __( 'Настройки каталога' ) )
		         ->where( 'post_type', '=', 'page' )
		         ->where( 'post_id', '=', $shop_id )
		         ->add_tab( __( 'Популярные товары' ), array(
			         Field::make( 'association', 'popular_products_sidebar', __( 'Popular Products for Sidebar' ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'product',
				              ),
			              ) )
			              ->set_max( 20 ),
			         Field::make( 'association', 'popular_products_page', __( 'Popular Products for Page' ) )
			              ->set_types( array(
				              array(
					              'type'      => 'post',
					              'post_type' => 'product',
				              ),
			              ) )
			              ->set_max( 20 )
		         ) );

		// get products which either are featured or have tag 'popular'
		$filter_name_1 = 'carbon_fields_association_field_options_popular_products_post_product';
		$filter_name_2 = 'carbon_fields_association_field_options_popular_products_sidebar_post_product';
		$filter_name_3 = 'carbon_fields_association_field_options_popular_products_page_post_product';

		add_filter( $filter_name_1, [$this, 'crb_modify_association_posts_query_args'] );
		add_filter( $filter_name_2, [$this, 'crb_modify_association_posts_query_args'] );
		add_filter( $filter_name_3, [$this, 'crb_modify_association_posts_query_args'] );
	}

	public function crb_modify_association_posts_query_args( $args ) {
		$args['tax_query'] = array(
			'relation' => 'OR',
			[
				'taxonomy' => 'product_tag',
				'field'    => 'slug',
				'terms'    => 'popular',
			],
			[
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
				'operator' => 'IN',
			]
		);

		return $args;
	}

	public function create_default_pages() {
		$pages = [
			[
				'post_type'     => 'page',
				'post_title'    => 'Логин',
				'post_content'  => '',
				'post_author'   => 1,
				'post_name'     => 'login',
				'post_status'   => 'publish',
				'page_template' => 'page-templates/login.php'
			],
			[
				'post_type'     => 'page',
				'post_title'    => 'Регистрация',
				'post_content'  => '',
				'post_author'   => 1,
				'post_name'     => 'register',
				'post_status'   => 'publish',
				'page_template' => 'page-templates/register.php'
			],
		];

		foreach ( $pages as $page ) {
			if ( ! get_page_by_title( $page['post_title'] ) ) {
				wp_insert_post( $page );
			}
		}
	}

	public function redirection_rules() {
		if ( is_page( 'profile' ) ) {
			if ( ! is_user_logged_in() ) {
				$this->redirect_to_404();
			}
		}

		if ( is_page( 'login' ) || is_page( 'register' ) ) {
			if ( is_user_logged_in() ) {
				$this->redirect_to_404();
			}
		}

		if ( is_shop() ) {
			if ( ! empty( $_GET['cat'] ) ) {
				if ( ! is_string( $_GET['cat'] ) ) {
					$this->redirect_to_404();
				}

				if ( ! in_array( $_GET['cat'], [ 'windows', 'office', 'antivirus', 'komlekty' ] ) ) {
					$this->redirect_to_404();
				}
			}
		}
	}

	private function redirect_to_404() {
		global $wp_query;

		$wp_query->set_404();
		status_header( 404 );
		get_template_part( 404 );
		exit();
	}
}
