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

use Symfony\Component\DependencyInjection\ContainerBuilder;

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
		( $this->container_builder->get( 'settings' ) )->hooks();
	}

	/**
	 * Run frontend part
	 *
	 * @since {VERSION}
	 */
	private function run_front() {
		( $this->container_builder->get( 'front' ) )->hooks();
	}

}
