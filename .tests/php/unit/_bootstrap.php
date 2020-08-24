<?php
/**
 * Bootstrap file for unit tests that run before all tests.
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginName
 * @author  {AUTHOR}
 */

define( 'PLUGIN_NAME_DEBUG', true );
define( 'PLUGIN_NAME_PATH', realpath( __DIR__ . '/../../../' ) . '/' );
define( 'ABSPATH', realpath( PLUGIN_NAME_PATH . '../../' ) . '/' );
define( 'PLUGIN_NAME_URL', 'https://site.com/wp-content/plugins/plugin-name/' );
