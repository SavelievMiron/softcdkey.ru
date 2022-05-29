<?php

namespace SoftCDKey\Setup;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use CMB2_Boxes;

final class Settings {

	public function register() {
		add_action( 'cmb2_admin_init', [ $this, 'register_main_options_metabox' ] );

		// add new admin pages
		add_action( 'carbon_fields_register_fields', [ $this, 'faq_page_content' ] );

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

		/** Contacts */
		$main_options->add_field( array(
				'name' => 'Contacts',
				'type' => 'title',
				'id'   => 'softcdkey_contacts_title'
		) );

		$contacts = $main_options->add_field( array(
				'id'         => 'softcdkey_contacts',
				'type'       => 'group',
				'repeatable' => false,
		) );

		$contact_fields_url = [
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
				]
		];

		$contact_fields_text = [
				[
						'name' => 'Email',
						'id'   => 'email',
				],
				[
						'name' => 'Skype',
						'id'   => 'skype',
				],
				[
						'name' => 'Telegram',
						'id'   => 'telegram'
				],
		];

		foreach ( $contact_fields_url as $field ) {
			$main_options->add_group_field( $contacts, array(
					'name'      => $field['name'],
					'id'        => $field['id'],
					'type'      => 'text_url',
					'protocols' => array( 'https' )
			) );
		}

		foreach ( $contact_fields_text as $field ) {
			$main_options->add_group_field( $contacts, array(
					'name'      => $field['name'],
					'id'        => $field['id'],
					'type'      => 'text',
					'protocols' => array( 'https' )
			) );
		}

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
				'desc'		   => 'Рекомендумый размер -- 675x500',
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
				'name'         => 'Image',
				'desc'		   => 'Рекомендумый размер -- 500x265',
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

		$sliders->add_group_field( $top_slider_id, array(
				'name'       => 'Product',
				'id'         => 'product',
				'type'       => 'post_search_ajax',
				'limit'      => 1,
				'sortable'   => true,
				'query_args' => array(
						'post_type'      => array( 'product' ),
						'post_status'    => array( 'publish' ),
						'posts_per_page' => - 1
				)
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

	public function faq_page_content() {
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
	}

	public function redirection_rules() {
		global $wp_query;

		if ( is_page( 'profile' ) ) {
			if ( ! is_user_logged_in() ) {
				$wp_query->set_404();
				status_header( 404 );
				get_template_part( 404 );
				exit();
			}
		}

		if ( is_page( 'login' ) || is_page( 'register' ) ) {
			if ( is_user_logged_in() ) {
				$wp_query->set_404();
				status_header( 404 );
				get_template_part( 404 );
				exit();
			}
		}
	}
}
