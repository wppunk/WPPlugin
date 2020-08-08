<?php
/**
 * PluginName Bootstrap class
 *
 * @since   {VERSION}
 * @link    https://github.com/wppunk/WPPlugin
 * @license GPLv2 or later
 * @package PluginName
 * @author  WPPunk
 */

namespace PluginName;

use PluginName\Front\Front;
use PluginName\Admin\Settings;

/**
 * Class Plugin
 *
 * @since   {VERSION}
 *
 * @package PluginName
 */
class Plugin {

	/**
	 * Plugin slug
	 *
	 * @since {VERSION}
	 */
	const SLUG = 'plugin-name';
	/**
	 * Plugin version
	 *
	 * @sicne {VERSION}
	 */
	const VERSION = '{VERSION}';

	/**
	 * Get suffix for assets URLs
	 *
	 * @since {VERSION}
	 *
	 * @return string
	 */
	public static function get_assets_suffix(): string {
		return PLUGIN_NAME_DEBUG ? '.min' : '';
	}

	/**
	 * Run plugin
	 *
	 * @since {VERSION}
	 */
	public function run() {
		is_admin() ?
			$this->run_admin() :
			$this->run_front();
	}

	/**
	 * Run admin part
	 *
	 * @since {VERSION}
	 */
	private function run_admin() {
		( new Settings() )->hooks();
	}

	/**
	 * Run frontend part
	 *
	 * @since {VERSION}
	 */
	private function run_front() {
		( new Front() )->hooks();
	}

}
