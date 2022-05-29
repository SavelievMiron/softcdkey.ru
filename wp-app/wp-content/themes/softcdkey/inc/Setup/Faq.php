<?php

namespace SoftCDKey\Setup;

final class FAQ
{
	/**
	 * Array of custom settings/options
	 **/
	private $options;

	/**
	 * Constructor
	 */
	public function register()
	{
		add_action('admin_menu', array($this, 'add_settings_page'));
		add_action('admin_init', array($this, 'page_init'));
	}

	/**
	 * Add settings page
	 * The page will appear in Admin menu
	 */
	public function add_settings_page()
	{
		add_menu_page(
			'F.A.Q', // Page title
			'F.A.Q', // Title
			'edit_pages', // Capability
			'faq', // Url slug
			array($this, 'create_admin_page'), // Callback
			'dashicons-media-document'
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page()
	{
		// Set class property
		$this->options = get_option('custom_settings');
		?>
		<div class="wrap">
			<h2>FAQ</h2>
			<form method="post" action="options.php">
				<?php
				// This prints out all hidden setting fields
				settings_fields('custom_settings_group');
				do_settings_sections('custom-settings-page');
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init()
	{
		register_setting(
			'custom_settings_group', // Option group
			'custom_settings', // Option name
			array($this, 'sanitize') // Sanitize
		);

		add_settings_section(
			'custom_settings_section', // ID
			'Custom Settings', // Title
			array($this, 'custom_settings_section'), // Callback
			'custom-settings-page' // Page
		);

		add_settings_field(
			'custom_setting_1', // ID
			'Custom Setting 1', // Title
			array($this, 'custom_setting1_html'), // Callback
			'custom-settings-page', // Page
			'custom_settings_section'
		);

		add_settings_field(
			'custom_setting_2',
			'Custom Setting 2',
			array($this, 'custom_setting2_html'),
			'custom-settings-page',
			'custom_settings_section'
		);
	}

	/**
	 * Sanitize POST data from custom settings form
	 *
	 * @param array $input Contains custom settings which are passed when saving the form
	 */
	public function sanitize($input)
	{
		$sanitized_input = array();
		if (isset($input['custom_setting_1'])) {
			$sanitized_input['custom_setting_1'] = sanitize_text_field($input['custom_setting_1']);
		}

		if (isset($input['custom_setting_2'])) {
			$sanitized_input['custom_setting_2'] = sanitize_text_field($input['custom_setting_2']);
		}

		return $sanitized_input;
	}

	/**
	 * Custom settings section text
	 */
	public function custom_settings_section()
	{
		print('Some text');
	}

	/**
	 * HTML for custom setting 1 input
	 */
	public function custom_setting1_html()
	{
		printf(
			'<input type="text" id="custom_setting_1" name="custom_settings[custom_setting_1]" value="%s" />',
			isset($this->options['custom_setting_1']) ? esc_attr($this->options['custom_setting_1']) : ''
		);
	}

	/**
	 * HTML for custom setting 2 input
	 */
	public function custom_setting2_html()
	{
		printf(
			'<input type="text" id="custom_setting_2" name="custom_settings[custom_setting_2]" value="%s" />',
			isset($this->options['custom_setting_2']) ? esc_attr($this->options['custom_setting_2']) : ''
		);
	}
}
