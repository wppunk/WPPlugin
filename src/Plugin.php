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

use Exception;
use PluginName\Front\Front;
use PluginName\Admin\SettingsPage;
use PluginName\Vendor\Auryn\Injector;
use PluginName\Vendor\Auryn\InjectionException;

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
	 * @since {VERSION}
	 */
	const VERSION = '{VERSION}';
	/**
	 * Dependency Injection Container.
	 *
	 * @since {VERSION}
	 *
	 * @var Injector
	 */
	private $injector;

	/**
	 * Plugin constructor.
	 *
	 * @param Injector $injector Dependency Injection Container.
	 */
	public function __construct( Injector $injector ) {
		$this->injector = $injector;
	}

	/**
	 * Run plugin
	 *
	 * @since {VERSION}
	 *
	 * @throws Exception Object doesn't exist.
	 */
	public function run(): void {
		is_admin()
			? $this->run_admin()
			: $this->run_front();
	}

	/**
	 * Run admin part
	 *
	 * @since {VERSION}
	 *
	 * @throws InjectionException If a cyclic gets detected when provisioning.
	 */
	private function run_admin(): void {
		$this->injector->make( SettingsPage::class )->hooks();
	}

	/**
	 * Run frontend part
	 *
	 * @since {VERSION}
	 *
	 * @throws InjectionException If a cyclic gets detected when provisioning.
	 */
	private function run_front(): void {
		$this->injector->make( Front::class )->hooks();
	}

}
