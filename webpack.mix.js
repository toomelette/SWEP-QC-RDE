let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// Login
mix.js('resources/assets/js/LoginMain.js', 'public/js')
.sass('resources/assets/sass/LoginMain.scss', 'public/css');

// SYNOPSIS CANE SUGAR TONS
mix.js('resources/assets/js/SynCaneSugarTonsMain.js', 'public/js')
	.sass('resources/assets/sass/SynCaneSugarTonsMain.scss', 'public/css');

// SYNOPSIS PRODUCTION INCREMENT
mix.js('resources/assets/js/SynPRDNIncrementMain.js', 'public/js')
	.sass('resources/assets/sass/SynPRDNIncrementMain.scss', 'public/css');

// SYNOPSIS RATIOS ON GROSS CANE
mix.js('resources/assets/js/SynRatiosOnGrossCaneMain.js', 'public/js')
	.sass('resources/assets/sass/SynRatiosOnGrossCaneMain.scss', 'public/css');

// SYNOPSIS CANE ANALYSIS
mix.js('resources/assets/js/SynCaneAnalysisMain.js', 'public/js')
	.sass('resources/assets/sass/SynCaneAnalysisMain.scss', 'public/css');

// SYNOPSIS SUGAR ANALYSIS
mix.js('resources/assets/js/SynSugarAnalysisMain.js', 'public/js')
	.sass('resources/assets/sass/SynSugarAnalysisMain.scss', 'public/css');

// SYNOPSIS FIRST EXPRESSED JUICE
mix.js('resources/assets/js/SynFirstExpressedJuiceMain.js', 'public/js')
	.sass('resources/assets/sass/SynFirstExpressedJuiceMain.scss', 'public/css');

// SYNOPSIS OUTPUTS
mix.js('resources/assets/js/SynOutputsMain.js', 'public/js')
	.sass('resources/assets/sass/SynOutputsMain.scss', 'public/css');
