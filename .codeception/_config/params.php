<?php
/**
 * Loads configuration parameters.
 *
 * Don't modify this file directly.
 * Create and use 'params.local.php' instead.
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginSlug
 * @author  {AUTHOR}
 */

use Codeception\Exception\ConfigurationException;
use Codeception\Lib\ParamsLoader;

global $argv;

if ( ! in_array( 'acceptance', $argv, true ) ) {
	return [];
}

if ( ! in_array( 'github-actions', $argv, true ) ) {
	try {
		( new ParamsLoader() )->load( '.env.development' );
	} catch ( ConfigurationException $e ) {
		throw new Exception( 'If you wan\'t to run your tests locally, then create the `.env.development` configuration file.' );
	}
}

return [
	'WP_URL'            => getenv( 'WP_URL' ),
	'WP_ADMIN_USERNAME' => getenv( 'WP_ADMIN_USERNAME' ),
	'WP_ADMIN_PASSWORD' => getenv( 'WP_ADMIN_PASSWORD' ),
	'WP_ADMIN_PATH'     => getenv( 'WP_ADMIN_PATH' ),
	'DB_HOST'           => getenv( 'DB_HOST' ),
	'DB_NAME'           => getenv( 'DB_NAME' ),
	'DB_USER'           => getenv( 'DB_USER' ),
	'DB_PASSWORD'       => getenv( 'DB_PASSWORD' ),
	'DB_TABLE_PREFIX'   => getenv( 'DB_TABLE_PREFIX' ),
];

