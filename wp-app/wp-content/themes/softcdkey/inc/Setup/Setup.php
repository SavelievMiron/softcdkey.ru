<?php

namespace SoftCDKey\Setup;

class Setup {
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_action( 'after_setup_theme', array( $this, 'content_width' ), 0 );
	}

	public function setup() {

		// disable Gutenberg
		add_filter('use_block_editor_for_post', '__return_false', 10);

		/*
		 * Default Theme Support options better have
		 */
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add woocommerce support and woocommerce override
		 */
		add_theme_support( 'woocommerce', [
			'thumbnail_image_width'         => 230,
			'gallery_thumbnail_image_width' => 120,
			'single_image_width'            => 325,
		] );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'awps_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/*
		 * Activate Post formats if you need
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat',
		) );
	}

	/*
		Define a max content width to allow WordPress to properly resize your images
	*/
	public function content_width() {
		$GLOBALS['content_width'] = apply_filters( 'content_width', 1440 );
	}
}
