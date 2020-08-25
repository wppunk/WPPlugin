<?php
/**
 * Bootstrap file
 *
 * Plugin Name: Plugin Name
 * Description: The plugin adds information about the games to the site posts.
 * Version:     {VERSION}
 * Author:      {AUTHOR}
 * Author URI:  {AUTHOR_URL}
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
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

if ( ! defined( 'PLUGIN_NAME_DEBUG' ) ) {
	/**
	 * Enable plugin debug mod.
	 */
	define( 'PLUGIN_NAME_DEBUG', false );
}
/**
 * Path to the plugin root directory.
 */
define( 'PLUGIN_NAME_PATH', plugin_dir_path( __FILE__ ) );
/**
 * Url to the plugin root directory.
 */
define( 'PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );

/**
 * Run plugin function.
 *
 * @since {VERSION}
 *
 * @throws Exception If something went wrong.
 */
function run_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

	$container_builder = new ContainerBuilder();
	$loader            = new PhpFileLoader( $container_builder, new FileLocator( __DIR__ ) );
	$loader->load( PLUGIN_NAME_PATH . 'dependencies/services.php' );
	$plugin_name = new Plugin( $container_builder );
	$plugin_name->run();

	do_action( 'plugin_name_init', $plugin_name );
}

add_action( 'plugins_loaded', 'run_plugin_name' );
