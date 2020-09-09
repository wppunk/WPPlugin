<?php
/**
 * Bootstrap file
 *
 * Plugin Name: Plugin Name
 * Description: The plugin adds information about the games to the site posts.
 * Version:     {VERSION}
 * Author:      {AUTHOR}
 * Author URI:  {AUTHOR_URL}
 * License:     MIT
 * Text Domain: plugin-name
 *
 * @package     PluginName
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use PluginName\Plugin;
use PluginName\Vendor\Symfony\Component\Config\FileLocator;
use PluginName\Vendor\Symfony\Component\DependencyInjection\ContainerBuilder;
use PluginName\Vendor\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

if ( version_compare( phpversion(), '7.2.5', '<' ) ) {

	/**
	 * Display the notice after deactivation.
	 *
	 * @since {VERSION}
	 */
	function plugin_name_php_notice() {
		?>
		<div class="notice notice-error">
			<p>
				<?php
				echo wp_kses(
					__( 'The minimum version of PHP is <strong>7.2.5</strong>. Please update the PHP on your server and try again.', 'plugin_name' ),
					[
						'strong' => [],
					]
				);
				?>
			</p>
		</div>

		<?php
		// In case this is on plugin activation.
		if ( isset( $_GET['activate'] ) ) { //phpcs:ignore
			unset( $_GET['activate'] ); //phpcs:ignore
		}
	}

	add_action( 'admin_notices', 'plugin_name_php_notice' );

	// Don't process the plugin code further.
	return;
}

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
	require_once PLUGIN_NAME_PATH . 'vendor/autoload.php';

	$container_builder = new ContainerBuilder();
	$loader            = new PhpFileLoader( $container_builder, new FileLocator( __DIR__ ) );
	$loader->load( PLUGIN_NAME_PATH . 'dependencies/services.php' );
	$plugin_name = new Plugin( $container_builder );
	$plugin_name->run();

	do_action( 'plugin_name_init', $plugin_name );
}

add_action( 'plugins_loaded', 'run_plugin_name' );
