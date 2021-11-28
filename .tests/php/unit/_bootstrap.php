<?php
/**
 * Bootstrap file for unit tests that run before all tests.
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginSlug
 * @author  {AUTHOR}
 */

define( 'PLUGIN_SLUG_DEBUG', true );
define( 'PLUGIN_SLUG_PATH', realpath( __DIR__ . '/../../../' ) . '/' );
define( 'ABSPATH', realpath( PLUGIN_SLUG_PATH . '../../' ) . '/' );
define( 'PLUGIN_SLUG_URL', 'https://site.com/wp-content/plugins/plugin-slug/' );
