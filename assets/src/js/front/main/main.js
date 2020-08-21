/* global jQuery */

'use strict';
const PluginName =
	window.PluginName ||
	// eslint-disable-next-line no-unused-vars
	( function ( document, window, $ ) {
		return {
			init() {
				// eslint-disable-next-line no-console
				console.log( 'PluginName was started' );
			},
		};
	} )( document, window, jQuery );

module.exports = PluginName;
