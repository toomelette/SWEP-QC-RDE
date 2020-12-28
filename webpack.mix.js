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

// SYNOPSIS LAST EXPRESSED JUICE
mix.js('resources/assets/js/SynLastExpressedJuiceMain.js', 'public/js')
	.sass('resources/assets/sass/SynLastExpressedJuiceMain.scss', 'public/css');
	
// SYNOPSIS MIXED JUICE
mix.js('resources/assets/js/SynMixedJuiceMain.js', 'public/js')
	.sass('resources/assets/sass/SynMixedJuiceMain.scss', 'public/css');

// SYNOPSIS CLARIFICATION
mix.js('resources/assets/js/SynClarificationMain.js', 'public/js')
.sass('resources/assets/sass/SynClarificationMain.scss', 'public/css');

// SYNOPSIS SYRUP
mix.js('resources/assets/js/SynSyrupMain.js', 'public/js')
.sass('resources/assets/sass/SynSyrupMain.scss', 'public/css');

// SYNOPSIS BAGASSE
mix.js('resources/assets/js/SynBagasseMain.js', 'public/js')
.sass('resources/assets/sass/SynBagasseMain.scss', 'public/css');

// SYNOPSIS FILTER CAKE
mix.js('resources/assets/js/SynFilterCakeMain.js', 'public/js')
.sass('resources/assets/sass/SynFilterCakeMain.scss', 'public/css');

// SYNOPSIS MOLASSES
mix.js('resources/assets/js/SynMolassesMain.js', 'public/js')
.sass('resources/assets/sass/SynMolassesMain.scss', 'public/css');

// SYNOPSIS NON SUGAR
mix.js('resources/assets/js/SynNonSugarMain.js', 'public/js')
.sass('resources/assets/sass/SynNonSugarMain.scss', 'public/css');

// SYNOPSIS CAP UTILIZATION
mix.js('resources/assets/js/SynCapUtilizationMain.js', 'public/js')
.sass('resources/assets/sass/SynCapUtilizationMain.scss', 'public/css');

// SYNOPSIS MILLING PLANT
mix.js('resources/assets/js/SynMillingPlantMain.js', 'public/js')
.sass('resources/assets/sass/SynMillingPlantMain.scss', 'public/css');

// SYNOPSIS BHR
mix.js('resources/assets/js/SynBHRMain.js', 'public/js')
.sass('resources/assets/sass/SynBHRMain.scss', 'public/css');

// SYNOPSIS OAR
mix.js('resources/assets/js/SynOARMain.js', 'public/js')
.sass('resources/assets/sass/SynOARMain.scss', 'public/css');

// SYNOPSIS BH LOSSES
mix.js('resources/assets/js/SynBHLossMain.js', 'public/js')
.sass('resources/assets/sass/SynBHLossMain.scss', 'public/css');

// SYNOPSIS KGs of Sugar Due BH
mix.js('resources/assets/js/SynKgSugarDueBHMain.js', 'public/js')
.sass('resources/assets/sass/SynKgSugarDueBHMain.scss', 'public/css');

// SYNOPSIS KGs of Sugar Due Clean Cane
mix.js('resources/assets/js/SynKgSugarDueCleanCaneMain.js', 'public/js')
.sass('resources/assets/sass/SynKgSugarDueCleanCaneMain.scss', 'public/css');

// SYNOPSIS Potential Revenue
mix.js('resources/assets/js/SynPotentialRevenueMain.js', 'public/js')
.sass('resources/assets/sass/SynPotentialRevenueMain.scss', 'public/css');

// SYNOPSIS Milling Duration
mix.js('resources/assets/js/SynMillingDurationMain.js', 'public/js')
.sass('resources/assets/sass/SynMillingDurationMain.scss', 'public/css');

// SYNOPSIS GRIND STOPPAGES
mix.js('resources/assets/js/SynGrindStoppageMain.js', 'public/js')
.sass('resources/assets/sass/SynGrindStoppageMain.scss', 'public/css');

// SYNOPSIS Detail of Stoppage - A
mix.js('resources/assets/js/SynDetailOfStoppageAMain.js', 'public/js')
.sass('resources/assets/sass/SynDetailOfStoppageAMain.scss', 'public/css');

// SYNOPSIS Detail of Stoppage - B
mix.js('resources/assets/js/SynDetailOfStoppageBMain.js', 'public/js')
.sass('resources/assets/sass/SynDetailOfStoppageBMain.scss', 'public/css');

// TEN YEAR PRODUCTION DATA
mix.js('resources/assets/js/SynTenYrPrdnMain.js', 'public/js')
.sass('resources/assets/sass/SynTenYrPrdnMain.scss', 'public/css');

// SYNOPSIS OUTPUTS
mix.js('resources/assets/js/SynOutputsMain.js', 'public/js')
	.sass('resources/assets/sass/SynOutputsMain.scss', 'public/css');
