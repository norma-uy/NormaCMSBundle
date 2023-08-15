const Encore = require('@symfony/webpack-encore')
const glob = require('glob-all')
const path = require('path')

/// ///////////// WEBSITE CONFIG //////////////////

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev')
}

Encore

    // directory where compiled assets will be stored
    .setOutputPath('public/website/')

    // public path used by the web server to access the output path
    .setPublicPath('/website/')

    // only needed for CDN's or subdirectory deploy
    // .setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app-recaptcha', './assets/website/recaptcha.js')

    .configureFontRule({
        type: 'asset'

        // maxSize: 4 * 1024
    })

    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    // .enableStimulusBridge('./assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())

    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // configure Babel
    // .configureBabel((config) => {
    //     config.plugins.push('@babel/a-babel-plugin');
    // })

    // enables and configure @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage'
        config.corejs = '3.23'
    })

    // enables Sass/SCSS support
    // .enableSassLoader()
    .enablePostCssLoader()

    // uncomment if you use TypeScript
    // .enableTypeScriptLoader()

    // uncomment if you use React
    // .enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    // .enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()

// build the first configuration
const websiteConfig = Encore.getWebpackConfig()

// Set a unique name for the config (needed later!)
websiteConfig.name = 'website-config'

// reset Encore to build the second config
Encore.reset()

/// ////////////////////////////////////////////////////

/// ///////////// ADMIN CONFIG //////////////////

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev')
}

Encore

    // directory where compiled assets will be stored
    .setOutputPath('public/admin/')

    // public path used by the web server to access the output path
    .setPublicPath('/admin/')

    // only needed for CDN's or subdirectory deploy
    // .setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('index', './assets/admin/index.js')

    .configureFontRule({
        type: 'asset'

        // maxSize: 4 * 1024
    })

    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    // .enableStimulusBridge('./assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    // .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .disableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())

    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // configure Babel
    // .configureBabel((config) => {
    //     config.plugins.push('@babel/a-babel-plugin');
    // })

    // enables and configure @babel/preset-env polyfills
    // .configureBabelPresetEnv((config) => {
    //     config.useBuiltIns = 'usage'
    //     config.corejs = '3.23'
    // })

    // enables Sass/SCSS support
    // .enableSassLoader()
    .enablePostCssLoader()

    // uncomment if you use TypeScript
    // .enableTypeScriptLoader()

    // uncomment if you use React
    // .enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    // .enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()

// build the first configuration
const adminConfig = Encore.getWebpackConfig()

// Set a unique name for the config (needed later!)
adminConfig.name = 'admin-config'

// reset Encore to build the second config
Encore.reset()

/// ////////////////////////////////////////////////////

module.exports = [websiteConfig, adminConfig]
