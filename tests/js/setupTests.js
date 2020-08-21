/* global jest */

global.fetch = require( 'jest-fetch-mock' );

global.jQuery = jest.fn();
