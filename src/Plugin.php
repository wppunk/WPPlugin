<?php
/**
 * PluginName Bootstrap class
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginName
 * @author  {AUTHOR}
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
	 * Run plugin
	 *
	 * @since {VERSION}
	 */
	public function run() {
		if ( is_admin() ) {
			$this->run_admin();
		} else {
			$this->run_front();
		}
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
