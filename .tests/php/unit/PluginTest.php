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
use PluginName\Admin\Settings;

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
		$container_builder = \Mockery::mock( '\PluginName\Vendor\Symfony\Component\DependencyInjection\ContainerBuilder' );
		$container_builder
			->shouldReceive( 'get' )
			->once()
			->with( SettingsPage::class )
			->andReturn( $settings );
		$plugin = new Plugin( $container_builder );

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
		$container_builder = \Mockery::mock( '\PluginName\Vendor\Symfony\Component\DependencyInjection\ContainerBuilder' );
		$container_builder
			->shouldReceive( 'get' )
			->once()
			->with( Front::class )
			->andReturn( $front );
		$plugin = new Plugin( $container_builder );

		$plugin->run();
	}

}
