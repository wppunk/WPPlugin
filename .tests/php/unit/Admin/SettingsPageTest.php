<?php
/**
 * SettingsTest
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginName
 * @author  {AUTHOR}
 */

namespace PluginNameUnitTests\Admin;

use Brain\Monkey\Expectation\Exception\ExpectationArgsRequired;
use PluginName\Plugin;
use PluginNameTests\TestCase;
use PluginName\Admin\SettingsPage;

use function Brain\Monkey\Functions\when;
use function Brain\Monkey\Functions\expect;

/**
 * Class SettingsPageTest
 */
class SettingsPageTest extends TestCase {

	/**
	 * Test for adding hooks
	 */
	public function testHooks(): void {
		$settings = new SettingsPage();

		$settings->hooks();

		$this->assertSame( 10, has_action( 'admin_enqueue_scripts', [ $settings, 'enqueue_styles' ] ) );
		$this->assertSame( 10, has_action( 'admin_enqueue_scripts', [ $settings, 'enqueue_scripts' ] ) );
		$this->assertSame( 10, has_action( 'admin_menu', [ $settings, 'add_menu' ] ) );
	}

	/**
	 * Test don't enqueue styles
	 */
	public function testDontEnqueueStyles(): void {
		$settings = new SettingsPage();

		$settings->enqueue_styles( 'hook-suffix' );
	}

	/**
	 * Test enqueue styles
	 *
	 * @throws ExpectationArgsRequired Invalid arguments.
	 */
	public function testEnqueueStyles(): void {
		$settings = new SettingsPage();
		expect( 'wp_enqueue_style' )
			->once()
			->with(
				'plugin-name-settings',
				PLUGIN_NAME_URL . 'assets/build/css/admin/settings.css',
				[],
				Plugin::VERSION,
				'all'
			);

		$settings->enqueue_styles( 'plugin-name' );
	}

	/**
	 * Test don't enqueue scripts
	 */
	public function testDontEnqueueScripts(): void {
		$settings = new SettingsPage();

		$settings->enqueue_scripts( 'hook-suffix' );
	}

	/**
	 * Test enqueue scripts
	 *
	 * @throws ExpectationArgsRequired Invalid arguments.
	 */
	public function testEnqueueScripts(): void {
		$settings = new SettingsPage();
		expect( 'wp_enqueue_script' )
			->once()
			->with(
				'plugin-name-settings',
				PLUGIN_NAME_URL . 'assets/build/js/admin/settings.js',
				[ 'jquery' ],
				Plugin::VERSION,
				true
			);

		$settings->enqueue_scripts( 'plugin-name' );
	}

	/**
	 * Test register menu
	 *
	 * @throws ExpectationArgsRequired
	 */
	public function testAddMenu(): void {
		$settings = new SettingsPage();
		when( 'esc_html__' )->returnArg();
		expect( 'add_menu_page' )
			->once()
			->with(
				'Plugin Name Settings',
				'Plugin Name',
				'manage_options',
				Plugin::SLUG,
				[
					$settings,
					'page_options',
				]
			);

		$settings->add_menu();
	}

	/**
	 * Test view for settings page
	 *
	 * @throws ExpectationArgsRequired
	 */
	public function testPageOption(): void {
		$pageTitle = 'Plugin Name Settings';
		$settings  = new SettingsPage();
		expect( 'get_admin_page_title' )
			->once()
			->withNoArgs()
			->andReturn( $pageTitle );
		when( 'esc_html' )->returnArg();

		$settings->page_options();
	}

}
