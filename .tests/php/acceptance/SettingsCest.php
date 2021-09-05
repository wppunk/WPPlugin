<?php
/**
 * SettingsCest
 *
 * @since   {VERSION}
 * @link    {URL}
 * @license GPLv2 or later
 * @package PluginName
 * @author  {AUTHOR}
 */

/**
 * Class SettingsCest.
 */
class SettingsCest {

	/**
	 * Check a Settings Page
	 *
	 * @param AcceptanceTester $i Actor.
	 *
	 * @throws Exception Something when wrong.
	 */
	public function visitSettingsPage( AcceptanceTester $i ): void {
		$i->loginAsAdmin();
		$i->amOnAdminPage( '/admin.php?page=plugin-name' );
		$i->see( 'Plugin Name Settings' );
	}

}
