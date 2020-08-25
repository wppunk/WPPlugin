import { Settings } from '../../../assets/.src/js/admin/settings/settings.js';

describe( 'Settings constructor', () => {
	it( 'console.log the text "Settings was started"', () => {
		const consoleSpy = jest.spyOn( console, 'log' );

		new Settings();

		expect( consoleSpy ).toHaveBeenCalledWith( 'Settings was started' );
	} );
} );
