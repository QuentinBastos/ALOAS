const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

const path = require('path');
Encore

    .addAliases({
        '@img': path.resolve(__dirname, 'assets/img'),
    })

    .setOutputPath('public/build/')

    .setPublicPath('/build')

    .addEntry('app', './assets/app.js')

    .addStyleEntry('app_css', './assets/styles/app.scss')
    .addStyleEntry('aside_css', './assets/styles/aside.scss')

    .splitEntryChunks()

    .enableSingleRuntimeChunk()
    .enablePostCssLoader()

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-transform-class-properties');
    })

    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[hash:8].[ext]',
        pattern: /\.(png|jpg|jpeg|svg|ico|webp)$/
    })

    .enableSassLoader()

;

module.exports = Encore.getWebpackConfig();