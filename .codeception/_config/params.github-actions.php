<?php
/**
 * GH Actions parameters
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginName
 * @author  {AUTHOR}
 */

return [
	'WP_URL'            => getenv( 'WP_URL' ),
	'WP_ADMIN_USERNAME' => getenv( 'WP_ADMIN_USERNAME' ),
	'WP_ADMIN_PASSWORD' => getenv( 'WP_ADMIN_PASSWORD' ),
	'WP_ADMIN_PATH'     => getenv( 'WP_ADMIN_PATH' ),
	'DB_HOST'           => getenv( 'DB_HOST' ),
	'DB_NAME'           => getenv( 'DB_HOST' ),
	'DB_USER'           => getenv( 'DB_USER' ),
	'DB_PASSWORD'       => getenv( 'DB_PASSWORD' ),
	'DB_TABLE_PREFIX'   => getenv( 'DB_TABLE_PREFIX' ),
];
