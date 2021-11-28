<?php
/**
 * PluginSlug frontend part
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginSlug
 * @author  {AUTHOR}
 */

namespace PluginSlug\Front;

use PluginSlug\Plugin;

/**
 * Class Front
 *
 * @since   {VERSION}
 *
 * @package PluginSlug\Front
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
			'plugin-slug',
			PLUGIN_SLUG_URL . 'assets/build/css/main.css',
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
			'plugin-slug',
			PLUGIN_SLUG_URL . 'assets/build/js/main.js',
			[],
			Plugin::VERSION,
			true
		);
	}

}
