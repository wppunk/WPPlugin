<?php
/**
 * Bootstrap file for unit tests that run before all tests.
 *
 * @since   {VERSION}
 * @link    https://github.com/wppunk/WPPlugin
 * @license GPLv2 or later
 * @package PluginName
 * @author  WPPunk
 */

use AspectMock\Kernel;

define( 'PLUGIN_NAME_DEBUG', true );
define( 'PLUGIN_NAME_PATH', realpath( __DIR__ . '/../../../' ) . '/' );
define( 'ABSPATH', realpath( PLUGIN_NAME_PATH . '../../' ) . '/' );
define( 'PLUGIN_NAME_URL', 'https://site.com/wp-content/plugins/plugin-name/' );

$kernel = Kernel::getInstance();
$kernel->init(
	[
		'cacheDir'     => PLUGIN_NAME_PATH . '.codeception/_cache',
		'debug'        => true,
		'includePaths' => [ PLUGIN_NAME_PATH . '/src' ],
	]
);
