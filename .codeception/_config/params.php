<?php
/**
 * Loads configuration parameters.
 *
 * Don't modify this file directly.
 * Create and use 'params.local.php' instead.
 *
 * @since   {VERSION}
 * @link    https://github.com/wppunk/WPPlugin
 * @license GPLv2 or later
 * @package PluginName
 * @author  WPPunk
 */

global $argv;

if ( in_array( 'unit', $argv, true ) ) {
	return [];
}

if ( in_array( 'clean', $argv, true ) ) {
	return [];
}

$config = '.codeception/_config/params.github-actions.php';
if ( in_array( 'github-actions', $argv, true ) && file_exists( $config ) ) {
	return include $config;
}

$config = '.codeception/_config/params.local.php';
if ( file_exists( $config ) ) {
	return include $config;
}

die( "No valid config provided.\nPlease use 'params.example.php' as a template to create your own 'params.local.php'.\n" );
