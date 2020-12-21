<?php



/** Auth **/
Route::group(['as' => 'auth.'], function () {
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('api/auth/login','Api\ApiAuthController@login')->name('login_api');
	Route::post('api/auth/logout','Api\ApiAuthController@logout')->name('logout_api');
	// Route::post('/', 'Auth\LoginController@login')->name('login');
	// Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	// Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});



/** Dashboard **/
Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status', 'check.user_route']], function () {


	/** HOME **/	
	Route::get('/home', 'HomeController@index')->name('home');


	/** USER **/   
	Route::post('/user/activate/{slug}', 'UserController@activate')->name('user.activate');
	Route::post('/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
	Route::post('/user/logout/{slug}', 'UserController@logout')->name('user.logout');
	Route::get('/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
	Route::patch('/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
	Route::resource('user', 'UserController');


	/** PROFILE **/
	Route::get('/profile', 'ProfileController@details')->name('profile.details');
	Route::patch('/profile/update_account_username/{slug}', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
	Route::patch('/profile/update_account_password/{slug}', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
	Route::patch('/profile/update_account_color/{slug}', 'ProfileController@updateAccountColor')->name('profile.update_account_color');


	/** MENU **/
	Route::resource('menu', 'MenuController');


	/** MILLS **/
	Route::get('/mill/reports', 'MillController@reports')->name('mill.reports');
	Route::resource('mill', 'MillController');

	
	/** SYNOPSIS **/
	Route::get('/synopsis/cane_sugar_tons', 'SynopsisController@caneSugarTons')->name('synopsis.cane_sugar_tons_index');
	Route::get('/synopsis/ratios_on_gross_cane', 'SynopsisController@ratiosOnGrossCane')->name('synopsis.ratios_on_gross_cane_index');
	Route::get('/synopsis/prdn_increment', 'SynopsisController@prdnIncrement')->name('synopsis.prdn_increment_index');
	Route::get('/synopsis/cane_analysis', 'SynopsisController@caneAnalysis')->name('synopsis.cane_analysis');
	Route::get('/synopsis/sugar_analysis', 'SynopsisController@sugarAnalysis')->name('synopsis.sugar_analysis');
	Route::get('/synopsis/first_expressed_juice', 'SynopsisController@firstExpressedJuice')->name('synopsis.first_expressed_juice');
	Route::get('/synopsis/last_expressed_juice', 'SynopsisController@lastExpressedJuice')->name('synopsis.last_expressed_juice');
	Route::get('/synopsis/mixed_juice', 'SynopsisController@mixedJuice')->name('synopsis.mixed_juice');
	Route::get('/synopsis/clarification', 'SynopsisController@clarification')->name('synopsis.clarification');
	Route::get('/synopsis/syrup', 'SynopsisController@syrup')->name('synopsis.syrup');
	Route::get('/synopsis/bagasse', 'SynopsisController@bagasse')->name('synopsis.bagasse');
	Route::get('/synopsis/filter_cake', 'SynopsisController@filterCake')->name('synopsis.filter_cake');
	Route::get('/synopsis/molasses', 'SynopsisController@molasses')->name('synopsis.molasses');
	Route::get('/synopsis/non_sugar', 'SynopsisController@nonSugar')->name('synopsis.non_sugar');
	Route::get('/synopsis/cap_utilization', 'SynopsisController@capUtilization')->name('synopsis.cap_utilization');
	Route::get('/synopsis/milling_plant', 'SynopsisController@millingPlant')->name('synopsis.milling_plant');
	Route::get('/synopsis/bhr', 'SynopsisController@BHR')->name('synopsis.bhr');
	Route::get('/synopsis/oar', 'SynopsisController@OAR')->name('synopsis.oar');
	Route::get('/synopsis/bh_loss', 'SynopsisController@BHLoss')->name('synopsis.bh_loss');
	Route::get('/synopsis/kg_sugar_due_bh', 'SynopsisController@kgSugarDueBH')->name('synopsis.kg_sugar_due_bh');
	Route::get('/synopsis/kg_sugar_due_clean_cane', 'SynopsisController@kgSugarDueCleanCane')->name('synopsis.kg_sugar_due_clean_cane');
	Route::get('/synopsis/potential_revenue', 'SynopsisController@potentialRevenue')->name('synopsis.potential_revenue');
	Route::get('/synopsis/milling_duration', 'SynopsisController@millingDuration')->name('synopsis.milling_duration');
	Route::get('/synopsis/grind_stoppage', 'SynopsisController@grindStoppage')->name('synopsis.grind_stoppage');
	Route::get('/synopsis/detail_of_stoppage_a', 'SynopsisController@detailOfStoppageA')->name('synopsis.detail_of_stoppage_a');

	Route::get('/synopsis/outputs', 'SynopsisController@outputs')->name('synopsis.outputs');
	Route::get('/synopsis/outputs/export_excel', 'SynopsisController@outputsExportExcel')->name('synopsis.outputs_export_excel');
	Route::get('/synopsis/outputs/print', 'SynopsisController@outputsPrint')->name('synopsis.outputs_print');
	
	
});



/** Testing **/
// Route::get('/dashboard/test', function(){

// 	$mills = App\Models\Refinery::get(); 

// 	foreach ($mills as $data) {

// 		$trader_reg_obj = App\Models\TraderRegistration::select('trader_reg_id')->orderBy('trader_reg_id', 'desc')->first();

// 		$id = "TR1001";

// 	 	if($trader_reg_obj != null){
// 	 	    if($trader_reg_obj->trader_reg_id != null){
// 	 	        $num = str_replace('TR', '', $trader_reg_obj->trader_reg_id) + 1;
// 	 	        $id = 'TR' . $num;
// 	 	    }
// 	 	}
// 		$trader = App\Models\Trader::where('tin', $data->trader_id)->first();
// 		$mill = App\Models\Refinery::find($data->id);
// 		$mill->slug = Illuminate\Support\Str::random(16);
// 		$mill->save();
	
// 	}

// 	return 'Success';

// });

