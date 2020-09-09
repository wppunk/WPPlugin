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
use PluginName\Vendor\Symfony\Component\DependencyInjection\ContainerBuilder;

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
	 * @var ContainerBuilder
	 */
	private $container_builder;

	/**
	 * Plugin constructor.
	 *
	 * @param ContainerBuilder $container_builder Dependency Injection Container.
	 */
	public function __construct( ContainerBuilder $container_builder ) {
		$this->container_builder = $container_builder;
	}

	/**
	 * Run plugin
	 *
	 * @since {VERSION}
	 *
	 * @throws \Exception Object doesn't exist.
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
	 * @throws Exception Object doesn't exist.
	 */
	private function run_admin(): void {
		$this->get_service( 'settings' )->hooks();
	}

	/**
	 * Run frontend part
	 *
	 * @since {VERSION}
	 *
	 * @throws Exception Object doesn't exist.
	 */
	private function run_front(): void {
		$this->get_service( 'front' )->hooks();
	}

	/**
	 * Get service.
	 *
	 * @param string $container_name Container name.
	 *
	 * @return object|null Get object from DIC.
	 *
	 * @throws Exception Object doesn't exist.
	 */
	public function get_service( string $container_name ): ?object {
		return $this->container_builder->get( $container_name );
	}

}
