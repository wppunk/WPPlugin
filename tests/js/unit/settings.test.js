import PluginNameSettings from '../../../assets/src/js/admin/settings/settings.js';

describe( 'Init PluginNameSettings', () => {
	it( 'console.log the text "PluginNameSettings was started"', () => {
		const consoleSpy = jest.spyOn( console, 'log' );

		PluginNameSettings.init();

		expect( consoleSpy ).toHaveBeenCalledWith( 'PluginNameSettings was started' );
	} );
} );
