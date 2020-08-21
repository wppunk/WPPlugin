<?php
/**
 * PluginName frontend part
 *
 * @since   {VERSION}
 * @link    https://github.com/wppunk/WPPlugin
 * @license GPLv2 or later
 * @package PluginName
 * @author  WPPunk
 */

namespace PluginName\Front;

use PluginName\Plugin;

/**
 * Class Front
 *
 * @since   {VERSION}
 *
 * @package PluginName\Front
 */
class Front {

	/**
	 * Init hooks
	 *
	 * @since {VERSION}
	 */
	public function hooks() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	/**
	 * Enqueue styles for the front area.
	 *
	 * @since {VERSION}
	 */
	public function enqueue_styles() {

		wp_enqueue_style(
			'plugin-name',
			PLUGIN_NAME_URL . 'assets/css/main.css',
			[],
			Plugin::VERSION,
			'all'
		);
	}

	/**
	 * Enqueue scripts for the front area.
	 *
	 * @since {VERSION}
	 */
	public function enqueue_scripts() {

		wp_enqueue_script(
			'plugin-name',
			PLUGIN_NAME_URL . 'assets/js/main.js',
			[],
			Plugin::VERSION,
			true
		);
	}

}
