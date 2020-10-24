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

use PluginName\Plugin;
use PluginName\Front\Front;
use PluginNameTests\TestCase;

use function Brain\Monkey\Functions\expect;

/**
 * Class FrontTest
 *
 * @since   {VERSION}
 *
 * @package PluginNameUnitTests\Front
 */
class FrontTest extends TestCase {

	/**
	 * Test for adding hooks
	 *
	 * @since {VERSION}
	 */
	public function test_hooks() {
		$front = new Front();

		$front->hooks();

		$this->assertSame( 10, has_action( 'wp_enqueue_scripts', [ $front, 'enqueue_styles' ] ) );
		$this->assertSame( 10, has_action( 'wp_enqueue_scripts', [ $front, 'enqueue_scripts' ] ) );
	}

	/**
	 * Test enqueue styles
	 *
	 * @since {VERSION}
	 *
	 * @throws \Brain\Monkey\Expectation\Exception\ExpectationArgsRequired Invalid arguments.
	 */
	public function test_enqueue_styles() {
		$front = new Front();
		expect( 'wp_enqueue_style' )
			->once()
			->with(
				'plugin-name',
				PLUGIN_NAME_URL . 'assets/css/build/main.css',
				[],
				Plugin::VERSION,
				'all'
			);

		$front->enqueue_styles();
	}

	/**
	 * Test enqueue scripts
	 *
	 * @since {VERSION}
	 *
	 * @throws \Brain\Monkey\Expectation\Exception\ExpectationArgsRequired Invalid arguments.
	 */
	public function test_enqueue_scripts() {
		$front = new Front();
		expect( 'wp_enqueue_script' )
			->once()
			->with(
				'plugin-name',
				PLUGIN_NAME_URL . 'assets/js/build/main.js',
				[],
				Plugin::VERSION,
				true
			);

		$front->enqueue_scripts();
	}

}
