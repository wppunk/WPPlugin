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

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return function ( ContainerConfigurator $configurator ) {
	$services = $configurator->services();
	$services->set( 'settings', 'PluginName\Admin\Settings' );
	$services->set( 'front', 'PluginName\Front\Front' );
	$services->set( 'plugin', 'PluginName\Plugin' )->args( [ 'settings', 'front' ] );
};
