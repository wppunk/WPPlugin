<?php
/**
 * Bootstrap file
 *
 * Plugin Name:         {PLUGIN_NAME}
 * Description:         The plugin adds information about the games to the site posts.
 * Version:             {VERSION}
 * Requires at least:   4.9
 * Requires PHP:        5.5
 * Author:              {AUTHOR}
 * Author URI:          {AUTHOR_URL}
 * License:             MIT
 * Text Domain:         plugin-slug
 *
 * @package     PluginSlug
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use PluginSlug\Plugin;
use PluginSlug\Vendor\Auryn\Injector;

if ( version_compare( phpversion(), '7.2.5', '<' ) ) {

	/**
	 * Display the notice after deactivation.
	 *
	 * @since {VERSION}
	 */
	function plugin_slug_php_notice() {
		?>
		<div class="notice notice-error">
			<p>
				<?php
				echo wp_kses(
					__( 'The minimum version of PHP is <strong>7.2.5</strong>. Please update the PHP on your server and try again.', 'plugin-slug' ),
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

	add_action( 'admin_notices', 'plugin_slug_php_notice' );

	// Don't process the plugin code further.
	return;
}

if ( ! defined( 'PLUGIN_SLUG_DEBUG' ) ) {
	/**
	 * Enable plugin debug mod.
	 */
	define( 'PLUGIN_SLUG_DEBUG', false );
}
/**
 * Path to the plugin root directory.
 */
define( 'PLUGIN_SLUG_PATH', plugin_dir_path( __FILE__ ) );
/**
 * Url to the plugin root directory.
 */
define( 'PLUGIN_SLUG_URL', plugin_dir_url( __FILE__ ) );

/**
 * Run plugin function.
 *
 * @since {VERSION}
 *
 * @throws Exception If something went wrong.
 */
function run_plugin_slug() {
	require_once PLUGIN_SLUG_PATH . 'vendor/autoload.php';

	$injector = new Injector();
	( $injector->make( Plugin::class ) )->run();

	/**
	 * You can use the $injector->make( PluginSlug\Some\Class::class ) for get any plugin class.
	 * More detail: https://github.com/wppunk/WPPlugin#dependency-injection-container
	 */
	do_action( 'plugin_slug_init', $injector );
}

add_action( 'plugins_loaded', 'run_plugin_slug' );
