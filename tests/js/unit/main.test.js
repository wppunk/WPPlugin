import PluginName from '../../../assets/src/js/front/main/main.js';

describe( 'Init PluginName', () => {
	it( 'console.log the text "PluginName was started"', () => {
		const consoleSpy = jest.spyOn( console, 'log' );

		PluginName.init();

		expect( consoleSpy ).toHaveBeenCalledWith( 'PluginName was started' );
	} );
} );
