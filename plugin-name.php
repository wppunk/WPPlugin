<?php
/**
 * Bootstrap file
 *
 * Plugin Name: Plugin Name
 * Description: The plugin adds information about the games to the site posts.
 * Version:     1.0.0
 * Author:      {AUTHOR}
 * Author URI:  https://profiles.wordpress.org/wppunk/
 * License:     GPLv2 or later
 * Text Domain: plugin-name
 *
 * @package     PluginName
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use PluginName\Plugin;

require_once plugin_dir_path( __FILE__ ) . '.vendor/autoload.php';

if ( ! defined( 'PLUGIN_NAME_DEBUG' ) ) {
	define( 'PLUGIN_NAME_DEBUG', false );
}
define( 'PLUGIN_NAME_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );

( new Plugin() )->run();
