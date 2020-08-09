<?php
/**
 * TestCase for Unit tests
 *
 * @since   {VERSION}
 * @link    https://github.com/wppunk/WPPlugin
 * @license GPLv2 or later
 * @package PluginName
 * @author  WPPunk
 */

namespace PluginNameTests;

use Mockery;
use AspectMock\Test;
use AspectMock\Core\Registry;

use function Brain\Monkey\setUp;
use function Brain\Monkey\tearDown;

/**
 * Class TestCase
 *
 * @since   {VERSION}
 *
 * @package PluginNameTests
 */
abstract class TestCase extends \Codeception\PHPUnit\TestCase {

	/**
	 * This method is called before each test.
	 *
	 * @since   {VERSION}
	 */
	protected function setUp(): void {
		parent::setUp();
		setUp();
	}

	/**
	 * This method is called after each test.
	 *
	 * @since   {VERSION}
	 */
	protected function tearDown(): void {
		tearDown();
		Mockery::close();
		if ( Registry::$mocker ) {
			Test::clean();
		}
		parent::tearDown();
	}

}
