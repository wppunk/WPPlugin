import { Main } from '../../../assets/.src/js/front/main/main.js';

describe( 'Main constructor', () => {
	it( 'console.log the text "Main was started"', () => {
		const consoleSpy = jest.spyOn( console, 'log' );

		new Main();

		expect( consoleSpy ).toHaveBeenCalledWith( 'Main was started' );
	} );
} );
