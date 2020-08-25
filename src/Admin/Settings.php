<?php
/**
 * PluginName Settings
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginName
 * @author  {AUTHOR}
 */

namespace PluginName\Admin;

use PluginName\Plugin;

/**
 * Class Settings
 *
 * @since   {VERSION}
 *
 * @package PluginName\Admin
 */
class Settings {

	/**
	 * Init hooks
	 *
	 * @since {VERSION}
	 */
	public function hooks(): void {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'admin_menu', [ $this, 'add_menu' ] );
	}

	/**
	 * Register the styles for the admin area.
	 *
	 * @since {VERSION}
	 *
	 * @param string $hook_suffix The current admin page.
	 */
	public function enqueue_styles( string $hook_suffix ): void {
		if ( false === strpos( $hook_suffix, Plugin::SLUG ) ) {
			return;
		}

		wp_enqueue_style(
			'plugin-name-settings',
			PLUGIN_NAME_URL . 'assets/css/build/settings.css',
			[],
			Plugin::VERSION,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since {VERSION}
	 *
	 * @param string $hook_suffix The current admin page.
	 */
	public function enqueue_scripts( string $hook_suffix ): void {
		if ( false === strpos( $hook_suffix, Plugin::SLUG ) ) {
			return;
		}

		wp_enqueue_script(
			'plugin-name-settings',
			PLUGIN_NAME_URL . 'assets/js/build/settings.js',
			[ 'jquery' ],
			Plugin::VERSION,
			true
		);
	}

	/**
	 * Add plugin page in WordPress menu.
	 *
	 * @since {VERSION}
	 */
	public function add_menu(): void {
		add_menu_page(
			'Plugin Name Settings',
			'Plugin Name',
			'manage_options',
			Plugin::SLUG,
			[
				$this,
				'page_options',
			]
		);
	}

	/**
	 * Plugin page callback.
	 *
	 * @since {VERSION}
	 */
	public function page_options(): void {
		require_once PLUGIN_NAME_PATH . 'templates/admin/settings.php';
	}

}
