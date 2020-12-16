const Encore = require( '@symfony/webpack-encore' );

if ( ! Encore.isRuntimeEnvironmentConfigured() ) {
	Encore.configureRuntimeEnvironment( process.env.NODE_ENV || 'dev' );
}

Encore
	.setOutputPath( 'assets/build' )
	.setPublicPath( '/' )
	.addEntry( 'js/admin/settings', './assets/.src/js/admin/settings/app.js' )
	.addEntry( 'js/main', './assets/.src/js/front/main/app.js' )
	.addStyleEntry( 'css/admin/settings', './assets/.src/scss/admin/settings.scss' )
	.addStyleEntry( 'css/main', './assets/.src/scss/main.scss' )
	.splitEntryChunks()
	.disableSingleRuntimeChunk()
	.cleanupOutputBeforeBuild()
	.enableBuildNotifications()
	.enableSourceMaps( ! Encore.isProduction() )
	.enableSassLoader()
	.copyFiles( { from: './assets/.src/img', to: './img/[path][name].[ext]' } )
	.enableEslintLoader();

module.exports = Encore.getWebpackConfig();
