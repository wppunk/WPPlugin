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

		$this->assertTrue( has_action( 'wp_enqueue_scripts', [ $front, 'enqueue_styles' ] ) );
		$this->assertTrue( has_action( 'wp_enqueue_scripts', [ $front, 'enqueue_scripts' ] ) );
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
			->with(
				'plugin-name',
				PLUGIN_NAME_URL . 'assets/css/build/main.css',
				[],
				Plugin::VERSION,
				'all'
			)
			->once();

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
			->with(
				'plugin-name',
				PLUGIN_NAME_URL . 'assets/js/build/main.js',
				[ 'jquery' ],
				Plugin::VERSION,
				true
			)
			->once();

		$front->enqueue_scripts();
	}

}
