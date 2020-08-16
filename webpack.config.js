const Encore = require( '@symfony/webpack-encore' );

if ( ! Encore.isRuntimeEnvironmentConfigured() ) {
	Encore.configureRuntimeEnvironment( process.env.NODE_ENV || 'dev' );
}

Encore.setOutputPath( 'assets/' )
	.setPublicPath( '/' )
	.addEntry( 'js/admin/settings', './build/js/settings.js' )
	.addEntry( 'js/main', './build/js/main.js' )
	.addStyleEntry( 'css/admin/settings', './build/pcss/main.pcss' )
	.addStyleEntry( 'css/main', './build/pcss/main.pcss' )
	.splitEntryChunks()
	.disableSingleRuntimeChunk()
	.cleanupOutputBeforeBuild()
	.enableBuildNotifications()
	.enableSourceMaps( ! Encore.isProduction() )
	.enablePostCssLoader()
	.configureLoaderRule( 'css', ( loaderRule ) => {
		loaderRule.test = /\.(css|p(ost)?css)$/;
	} )
	.copyFiles( { from: './build/img' } )
	.enableEslintLoader();

module.exports = Encore.getWebpackConfig();
