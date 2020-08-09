<?php
/**
 * SettingsCest
 *
 * @since   {VERSION}
 * @link    https://github.com/wppunk/WPPlugin
 * @license GPLv2 or later
 * @package PluginName
 * @author  WPPunk
 */

/**
 * Class SettingsCest.
 *
 * phpcs:ignoreFile WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
 *
 * @since {VERSION}
 */
class SettingsCest {

	/**
	 * Check a Settings Page
	 *
	 * @since        {VERSION}
	 *
	 * @param \AcceptanceTester $I Actor.
	 *
	 * @throws \Exception Something when wrong.
	 */
	public function visitSettingsPage( AcceptanceTester $I ) {
		$I->loginAsAdmin();
		$I->amOnPage( '/wp-admin/admin.php?page=plugin-name' );
		$I->see( 'Plugin Name Settings' );
	}

}
