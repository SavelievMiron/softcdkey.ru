<?php

namespace SoftCDKey\Custom;

/**
 * Custom
 * use it to write your custom functions.
 */
class PostTypes
{
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register()
	{
		add_action('init', array( $this, 'custom_post_types'), 10, 4);
		add_action('after_switch_theme', array( $this, 'rewrite_flush'));
	}

  /**
	* Create Custom Post Types
	* @return void The registered post type object, or an error object
	*/
	public function custom_post_types()
	{
		/**
		 * Add the post types and their details
		 */
		$custom_posts = [
			[
				'slug' => 'promotions',
				'singular' => 'Campaign',
				'plural' => 'Campaigns',
				'text_domain' => 'softcdkey',
				'description' => '',
				'public' => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'menu_icon'          => 'dashicons-megaphone',
				'query_var'          => 'promotions',
				'rewrite'            => array( 'slug' => ['slug'] ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 32,
				'supports'           => ['thumbnail', 'comments'],
				'show_in_rest'       => true,
			]
		];

		foreach ($custom_posts as $custom_post) {
			$labels = [
				'name'               => _x($custom_post['plural'], 'post type general name', $custom_post['text_domain']),
				'singular_name'      => _x($custom_post['singular'], 'post type singular name', $custom_post['text_domain']),
				'menu_name'          => _x($custom_post['plural'], 'admin menu', $custom_post['text_domain']),
				'name_admin_bar'     => _x($custom_post['singular'], 'add new on admin bar', $custom_post['text_domain']),
				'add_new'            => _x('Add New ' . $custom_post['singular'], $custom_post['text_domain']),
				'add_new_item'       => __('Add New ' . $custom_post['singular'], $custom_post['text_domain']),
				'new_item'           => __('New ' . $custom_post['singular'], $custom_post['text_domain']),
				'edit_item'          => __('Edit ' . $custom_post['singular'], $custom_post['text_domain']),
				'view_item'          => __('View ' . $custom_post['singular'], $custom_post['text_domain']),
				'view_items'         => __('View ' . $custom_post['plural'], $custom_post['text_domain']),
				'all_items'          => __('All ' . $custom_post['plural'], $custom_post['text_domain']),
				'search_items'       => __('Search' . $custom_post['plural'], $custom_post['text_domain']),
				'parent_item_colon'  => __('Parent ' . $custom_post['plural'], $custom_post['text_domain']),
				'not_found'          => __('No ' . $custom_post['plural'] . ' found.', $custom_post['text_domain']),
				'not_found_in_trash' => __('No ' . $custom_post['plural'] . ' found in Trash.', $custom_post['text_domain']),
			];
			$args = [
				'labels'             => $labels,
				'description'        => __($custom_post['description'], $custom_post['text_domain']),
				'public'             => $custom_post['public'],
				'publicly_queryable' => $custom_post['publicly_queryable'],
				'show_ui'            => $custom_post['show_ui'],
				'show_in_menu'       => $custom_post['show_in_menu'],
				'menu_icon'          => $custom_post['menu_icon'],
				'query_var'          => $custom_post['query_var'],
				'rewrite'            => array( 'slug' => $custom_post['slug'] ),
				'capability_type'    => $custom_post['capability_type'],
				'has_archive'        => $custom_post['has_archive'],
				'hierarchical'       => $custom_post['hierarchical'],
				'menu_position'      => $custom_post['menu_position'],
				'supports'           => $custom_post['supports'],
				'show_in_rest'       => $custom_post['show_in_rest'],
			];

			register_post_type($custom_post['slug'], $args);
		}
	}

  /**
	* Flush Rewrite on CPT activation
	* @return empty
	*/
	public function rewrite_flush()
	{
		// Flush the rewrite rules only on theme activation
		flush_rewrite_rules();
	}
}
