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
use PluginNameTests\TestCase;

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
			->withNoArgs()
			->once()
			->andReturn( true );
		$settings = \Mockery::mock( '\PluginName\Admin\Settings' );
		$settings
			->shouldReceive( 'hooks' )
			->withNoArgs()
			->once();
		$container_builder = \Mockery::mock( '\PluginName\Vendor\Symfony\Component\DependencyInjection\ContainerBuilder' );
		$container_builder
			->shouldReceive( 'get' )
			->with( 'settings' )
			->once()
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
			->withNoArgs()
			->once()
			->andReturn( false );
		$front = \Mockery::mock( '\PluginName\Front\Front' );
		$front
			->shouldReceive( 'hooks' )
			->withNoArgs()
			->once();
		$container_builder = \Mockery::mock( '\PluginName\Vendor\Symfony\Component\DependencyInjection\ContainerBuilder' );
		$container_builder
			->shouldReceive( 'get' )
			->with( 'front' )
			->once()
			->andReturn( $front );
		$plugin = new Plugin( $container_builder );

		$plugin->run();
	}

}
