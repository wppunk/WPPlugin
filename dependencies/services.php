<?php
/**
 * Describe plugin dependencies.
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginName
 * @author  {AUTHOR}
 */

// Exit if accessed directly.
use PluginName\Plugin;
use PluginName\Vendor\Symfony\Component\DependencyInjection\Reference;
use PluginName\Vendor\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return function ( ContainerConfigurator $configurator ) {
	$services = $configurator
		->services()
		->defaults()
		->public()
		->autowire()
		->autoconfigure();

	$services
		->load( 'PluginName\\', __DIR__ . '/../src/*' );

	$services
		->get( Plugin::class )
		->args( [ new Reference( 'service_container' ) ] );
};
