<?php
/**
 * PluginTest
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginName
 * @author  {AUTHOR}
 */

namespace PluginNameUnitTests;

use PluginName\Plugin;
use PluginName\Front\Front;
use PluginNameTests\TestCase;
use PluginName\Admin\SettingsPage;

use function Brain\Monkey\Functions\expect;

/**
 * Class FrontTest
 *
 * @since   {VERSION}
 *
 * @package PluginNameUnitTests\Front
 */
class PluginTest extends TestCase {

	/**
	 * Test for adding hooks
	 *
	 * @since {VERSION}
	 */
	public function test_run_admin() {
		expect( 'is_admin' )
			->once()
			->withNoArgs()
			->andReturn( true );
		$settings = \Mockery::mock( '\PluginName\Admin\SettingsPage' );
		$settings
			->shouldReceive( 'hooks' )
			->once()
			->withNoArgs();
		$injector = \Mockery::mock( 'PluginName\Vendor\Auryn\Injector' );
		$injector
			->shouldReceive( 'make' )
			->once()
			->with( SettingsPage::class )
			->andReturn( $settings );
		$plugin = new Plugin( $injector );

		$plugin->run();
	}

	/**
	 * Test for adding hooks
	 *
	 * @since {VERSION}
	 */
	public function test_run_front() {
		expect( 'is_admin' )
			->once()
			->withNoArgs()
			->andReturn( false );
		$front = \Mockery::mock( '\PluginName\Front\Front' );
		$front
			->shouldReceive( 'hooks' )
			->once()
			->withNoArgs();
		$injector = \Mockery::mock( 'PluginName\Vendor\Auryn\Injector' );
		$injector
			->shouldReceive( 'make' )
			->once()
			->with( Front::class )
			->andReturn( $front );
		$plugin = new Plugin( $injector );

		$plugin->run();
	}

}
