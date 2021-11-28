<?php
/**
 * PluginSlug Bootstrap class
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginSlug
 * @author  {AUTHOR}
 */

namespace PluginSlug;

use Exception;
use PluginSlug\Front\Front;
use PluginSlug\Admin\SettingsPage;
use PluginSlug\Vendor\Auryn\Injector;
use PluginSlug\Vendor\Auryn\InjectionException;

/**
 * Class Plugin
 *
 * @since   {VERSION}
 *
 * @package PluginSlug
 */
class Plugin {

	/**
	 * Plugin slug
	 *
	 * @since {VERSION}
	 */
	const SLUG = 'plugin-slug';
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
