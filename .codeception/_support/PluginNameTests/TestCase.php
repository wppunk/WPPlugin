<?php
/**
 * TestCase for Unit tests
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginSlug
 * @author  {AUTHOR}
 */

namespace PluginSlugTests;

use Mockery;

use function Brain\Monkey\setUp;
use function Brain\Monkey\tearDown;

/**
 * Class TestCase
 *
 * @since   {VERSION}
 *
 * @package PluginSlugTests
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
		parent::tearDown();
	}

}
