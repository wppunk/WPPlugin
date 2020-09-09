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
use PluginName\Vendor\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return function ( ContainerConfigurator $configurator ) {
	$services = $configurator->services();
	$services->set( 'settings', 'PluginName\Admin\Settings' );
	$services->set( 'front', 'PluginName\Front\Front' );
};
