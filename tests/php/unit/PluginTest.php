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

use AspectMock\Test;
use PluginName\Plugin;
use PluginName\Front\Front;
use PluginNameTests\TestCase;
use PluginName\Admin\Settings;
use tad\FunctionMocker\FunctionMocker;

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
		$settings = Test::double( Settings::class, [ 'hooks' ] );
		$plugin   = new Plugin();

		$plugin->run();

		$settings->verifyInvokedOnce( 'hooks' );
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
		$front  = Test::double( Front::class, [ 'hooks' ] );
		$plugin = new Plugin();

		$plugin->run();

		$front->verifyInvokedOnce( 'hooks' );
	}
}
