<?php

namespace SoftCDKey\Custom;

/**
 * Extras.
 */
class Extras
{
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register()
	{
		add_filter('body_class', [ $this, 'body_class' ]);

		// Additional class for nav items
		add_filter('nav_menu_css_class', [$this, 'add_custom_classes_on_nav_item'], 1, 3);
		add_filter('nav_menu_link_attributes', [$this, 'add_custom_classes_on_nav_link'], 10, 3);
	}

	public function body_class($classes)
	{
		return $classes;
	}

	public function add_custom_classes_on_nav_item($classes, $item, $args)
	{
		$classes = [];

		if (isset($args->custom_li_classes)) {
			$classes[] = $args->custom_li_classes;
		}

		return $classes;
	}

	public function add_custom_classes_on_nav_link($atts, $item, $args)
	{
		if (isset($args->custom_link_classes)) {
			$atts['class'] = $args->custom_link_classes;
		}

		return $atts;
	}
}
