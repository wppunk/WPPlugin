const mix = require( 'laravel-mix' ),
	path = require( 'path' ),
	envFile = '.env.' + process.env.NODE_ENV;

require( 'mix-env-file' );
require( 'laravel-mix-purgecss' );
require( 'laravel-mix-copy-watched' );

mix.env( envFile );

mix
	.setPublicPath( './assets/build' )
	.browserSync( process.env.WP_URL ); // Change domain to the domain for the current project.

mix
	.sass( 'assets/.src/scss/admin/settings.scss', 'css/admin' )
	.sass( 'assets/.src/scss/main.scss', 'css' )
	.purgeCss( {
		extend: { content: [ path.join( __dirname, 'index.php' ) ] },
		whitelist: require( 'purgecss-with-wordpress' ).whitelist,
		whitelistPatterns: require( 'purgecss-with-wordpress' ).whitelistPatterns,
	} );

mix
	.js( 'assets/.src/js/admin/settings/app.js', 'js/admin' )
	.js( 'assets/.src/js/front/main/app.js', 'js' )
	.extract();

mix
	.copyWatched( 'assets/.src/img/**/*.{jpg,jpeg,png,gif,svg}', 'assets/build/img', { base: 'assets/.src/img' } );

mix
	.autoload( {
		jquery: [ '$',
			'window.jQuery' ],
	} )
	.options( { processCssUrls: false } )
	.sourceMaps( false, 'source-map' )
	.version();
