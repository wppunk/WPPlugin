<?php
/**
 * PluginName frontend part
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginName
 * @author  {AUTHOR}
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
	public function hooks(): void {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	/**
	 * Enqueue styles for the front area.
	 *
	 * @since {VERSION}
	 */
	public function enqueue_styles(): void {
		wp_enqueue_style(
			'plugin-name',
			PLUGIN_NAME_URL . 'assets/css/build/main.css',
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
	public function enqueue_scripts(): void {
		wp_enqueue_script(
			'plugin-name',
			PLUGIN_NAME_URL . 'assets/js/build/main.js',
			[],
			Plugin::VERSION,
			true
		);
	}

}
