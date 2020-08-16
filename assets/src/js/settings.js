/* global jQuery */

'use strict';
const PluginNameSettings =
	window.PluginNameSettings ||
	// eslint-disable-next-line no-unused-vars
	( function ( document, window, $ ) {
		return {
			init() {
				// eslint-disable-next-line no-console
				console.log( 'PluginName was started' );
			},
		};
	} )( document, window, jQuery );

PluginNameSettings.init();
