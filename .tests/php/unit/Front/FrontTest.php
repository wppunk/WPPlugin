<?php
/**
 * FrontTest
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginName
 * @author  {AUTHOR}
 */

namespace PluginNameUnitTests\Front;

use Brain\Monkey\Expectation\Exception\ExpectationArgsRequired;
use PluginName\Plugin;
use PluginName\Front\Front;
use PluginNameTests\TestCase;

use function Brain\Monkey\Functions\expect;

/**
 * Class FrontTest
 */
class FrontTest extends TestCase {

	/**
	 * Test for adding hooks
	 */
	public function testHooks(): void {
		$front = new Front();

		$front->hooks();

		$this->assertSame( 10, has_action( 'wp_enqueue_scripts', [ $front, 'enqueue_styles' ] ) );
		$this->assertSame( 10, has_action( 'wp_enqueue_scripts', [ $front, 'enqueue_scripts' ] ) );
	}

	/**
	 * Test enqueue styles
	 *
	 * @throws ExpectationArgsRequired Invalid arguments.
	 */
	public function testEnqueueStyles(): void {
		$front = new Front();
		expect( 'wp_enqueue_style' )
			->once()
			->with(
				'plugin-name',
				PLUGIN_NAME_URL . 'assets/build/css/main.css',
				[],
				Plugin::VERSION,
				'all'
			);

		$front->enqueue_styles();
	}

	/**
	 * Test enqueue scripts
	 *
	 * @throws ExpectationArgsRequired Invalid arguments.
	 */
	public function testEnqueueScripts(): void {
		$front = new Front();
		expect( 'wp_enqueue_script' )
			->once()
			->with(
				'plugin-name',
				PLUGIN_NAME_URL . 'assets/build/js/main.js',
				[],
				Plugin::VERSION,
				true
			);

		$front->enqueue_scripts();
	}

}
