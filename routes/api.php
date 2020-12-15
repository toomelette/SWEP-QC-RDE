<?php

// Submenu
Route::get('/submenu/select_submenu_byMenuId/{menu_id}','Api\ApiSubmenuController@selectSubmenuByMenuId')->name('selectSubmenuByMenuId');




/** API **/
Route::group(['middleware' => 'jwt.auth'], function () {


	// Mills
	Route::get('/mill/get_all','Api\ApiMillController@getAll')->name('api.mill.get_all');
	

	// Crop Years
	Route::get('/crop_year/get_all','Api\ApiCropYearController@getAll')->name('api.crop_year.get_all');
	
	
	// SYNOPSIS

	// Cane Sugar Tons
	Route::get('synopsis/cane_sugar_tons','Api\ApiSynCaneSugarTonsController@fetch')->name('synopsis.cane_sugar_tons_list');
	Route::post('synopsis/cane_sugar_tons/store','Api\ApiSynCaneSugarTonsController@store')->name('synopsis.cane_sugar_tons_store');
	Route::get('synopsis/cane_sugar_tons/{slug}','Api\ApiSynCaneSugarTonsController@edit')->name('synopsis.cane_sugar_tons_edit');
	Route::post('synopsis/cane_sugar_tons/{slug}','Api\ApiSynCaneSugarTonsController@update')->name('synopsis.cane_sugar_tons_update');
	Route::delete('synopsis/cane_sugar_tons/{slug}','Api\ApiSynCaneSugarTonsController@delete')->name('synopsis.cane_sugar_tons_delete');
	
	// PRDN Increment
	Route::get('synopsis/prdn_increment','Api\ApiSynPRDNINcrementController@fetch')->name('synopsis.prdn_increment_list');
	Route::post('synopsis/prdn_increment/store','Api\ApiSynPRDNINcrementController@store')->name('synopsis.prdn_increment_store');
	Route::get('synopsis/prdn_increment/{slug}','Api\ApiSynPRDNINcrementController@edit')->name('synopsis.prdn_increment_edit');
	Route::post('synopsis/prdn_increment/{slug}','Api\ApiSynPRDNINcrementController@update')->name('synopsis.prdn_increment_update');
	Route::delete('synopsis/prdn_increment/{slug}','Api\ApiSynPRDNINcrementController@delete')->name('synopsis.prdn_increment_delete');
	
	// Ratios On Gross Cane
	Route::get('synopsis/ratios_on_gross_cane','Api\ApiSynRatiosOnGrossCaneController@fetch')->name('synopsis.ratios_on_gross_cane_list');
	Route::post('synopsis/ratios_on_gross_cane/store','Api\ApiSynRatiosOnGrossCaneController@store')->name('synopsis.ratios_on_gross_cane_store');
	Route::get('synopsis/ratios_on_gross_cane/{slug}','Api\ApiSynRatiosOnGrossCaneController@edit')->name('synopsis.ratios_on_gross_cane_edit');
	Route::post('synopsis/ratios_on_gross_cane/{slug}','Api\ApiSynRatiosOnGrossCaneController@update')->name('synopsis.ratios_on_gross_cane_update');
	Route::delete('synopsis/ratios_on_gross_cane/{slug}','Api\ApiSynRatiosOnGrossCaneController@delete')->name('synopsis.ratios_on_gross_cane_delete');
	
	// Cane Analysis
	Route::get('synopsis/cane_analysis','Api\ApiSynCaneAnalysisController@fetch')->name('synopsis.cane_analysis_list');
	Route::post('synopsis/cane_analysis/store','Api\ApiSynCaneAnalysisController@store')->name('synopsis.cane_analysis_store');
	Route::get('synopsis/cane_analysis/{slug}','Api\ApiSynCaneAnalysisController@edit')->name('synopsis.cane_analysis_edit');
	Route::post('synopsis/cane_analysis/{slug}','Api\ApiSynCaneAnalysisController@update')->name('synopsis.cane_analysis_update');
	Route::delete('synopsis/cane_analysis/{slug}','Api\ApiSynCaneAnalysisController@delete')->name('synopsis.cane_analysis_delete');
	
	// Sugar Analysis
	Route::get('synopsis/sugar_analysis','Api\ApiSynSugarAnalysisController@fetch')->name('synopsis.sugar_analysis_list');
	Route::post('synopsis/sugar_analysis/store','Api\ApiSynSugarAnalysisController@store')->name('synopsis.sugar_analysis_store');
	Route::get('synopsis/sugar_analysis/{slug}','Api\ApiSynSugarAnalysisController@edit')->name('synopsis.sugar_analysis_edit');
	Route::post('synopsis/sugar_analysis/{slug}','Api\ApiSynSugarAnalysisController@update')->name('synopsis.sugar_analysis_update');
	Route::delete('synopsis/sugar_analysis/{slug}','Api\ApiSynSugarAnalysisController@delete')->name('synopsis.sugar_analysis_delete');
	
	// First Expressed Juice
	Route::get('synopsis/first_expressed_juice','Api\ApiSynFirstExpressedJuiceController@fetch')->name('synopsis.first_expressed_juice_list');
	Route::post('synopsis/first_expressed_juice/store','Api\ApiSynFirstExpressedJuiceController@store')->name('synopsis.first_expressed_juice_store');
	Route::get('synopsis/first_expressed_juice/{slug}','Api\ApiSynFirstExpressedJuiceController@edit')->name('synopsis.first_expressed_juice_edit');
	Route::post('synopsis/first_expressed_juice/{slug}','Api\ApiSynFirstExpressedJuiceController@update')->name('synopsis.first_expressed_juice_update');
	Route::delete('synopsis/first_expressed_juice/{slug}','Api\ApiSynFirstExpressedJuiceController@delete')->name('synopsis.first_expressed_juice_delete');
	
	// Last Expressed Juice
	Route::get('synopsis/last_expressed_juice','Api\ApiSynLastExpressedJuiceController@fetch')->name('synopsis.last_expressed_juice_list');
	Route::post('synopsis/last_expressed_juice/store','Api\ApiSynLastExpressedJuiceController@store')->name('synopsis.last_expressed_juice_store');
	Route::get('synopsis/last_expressed_juice/{slug}','Api\ApiSynLastExpressedJuiceController@edit')->name('synopsis.last_expressed_juice_edit');
	Route::post('synopsis/last_expressed_juice/{slug}','Api\ApiSynLastExpressedJuiceController@update')->name('synopsis.last_expressed_juice_update');
	Route::delete('synopsis/last_expressed_juice/{slug}','Api\ApiSynLastExpressedJuiceController@delete')->name('synopsis.last_expressed_juice_delete');
	
	// Mixed Juice
	Route::get('synopsis/mixed_juice','Api\ApiSynMixedJuiceController@fetch')->name('synopsis.mixed_juice_list');
	Route::post('synopsis/mixed_juice/store','Api\ApiSynMixedJuiceController@store')->name('synopsis.mixed_juice_store');
	Route::get('synopsis/mixed_juice/{slug}','Api\ApiSynMixedJuiceController@edit')->name('synopsis.mixed_juice_edit');
	Route::post('synopsis/mixed_juice/{slug}','Api\ApiSynMixedJuiceController@update')->name('synopsis.mixed_juice_update');
	Route::delete('synopsis/mixed_juice/{slug}','Api\ApiSynMixedJuiceController@delete')->name('synopsis.mixed_juice_delete');
	
	// Clarification
	Route::get('synopsis/clarification','Api\ApiSynClarificationController@fetch')->name('synopsis.clarification_list');
	Route::post('synopsis/clarification/store','Api\ApiSynClarificationController@store')->name('synopsis.clarification_store');
	Route::get('synopsis/clarification/{slug}','Api\ApiSynClarificationController@edit')->name('synopsis.clarification_edit');
	Route::post('synopsis/clarification/{slug}','Api\ApiSynClarificationController@update')->name('synopsis.clarification_update');
	Route::delete('synopsis/clarification/{slug}','Api\ApiSynClarificationController@delete')->name('synopsis.clarification_delete');
	
	// Syrup
	Route::get('synopsis/syrup','Api\ApiSynSyrupController@fetch')->name('synopsis.syrup_list');
	Route::post('synopsis/syrup/store','Api\ApiSynSyrupController@store')->name('synopsis.syrup_store');
	Route::get('synopsis/syrup/{slug}','Api\ApiSynSyrupController@edit')->name('synopsis.syrup_edit');
	Route::post('synopsis/syrup/{slug}','Api\ApiSynSyrupController@update')->name('synopsis.syrup_update');
	Route::delete('synopsis/syrup/{slug}','Api\ApiSynSyrupController@delete')->name('synopsis.syrup_delete');
	
	// Bagasse
	Route::get('synopsis/bagasse','Api\ApiSynBagasseController@fetch')->name('synopsis.bagasse_list');
	Route::post('synopsis/bagasse/store','Api\ApiSynBagasseController@store')->name('synopsis.bagasse_store');
	Route::get('synopsis/bagasse/{slug}','Api\ApiSynBagasseController@edit')->name('synopsis.bagasse_edit');
	Route::post('synopsis/bagasse/{slug}','Api\ApiSynBagasseController@update')->name('synopsis.bagasse_update');
	Route::delete('synopsis/bagasse/{slug}','Api\ApiSynBagasseController@delete')->name('synopsis.bagasse_delete');

	// OUTPUT
	Route::get('synopsis/outputs/get_categories','Api\ApiSynOutputController@getAllCategories')->name('synopsis.output_get_categories');
	Route::get('synopsis/outputs/get_regions','Api\ApiSynOutputController@getAllRegions')->name('synopsis.output_get_regions');
	Route::get('synopsis/outputs/filter','Api\ApiSynOutputController@filter')->name('synopsis.output_filter');
	Route::get('synopsis/outputs/export_excel','Api\ApiSynOutputController@exportExcel')->name('synopsis.output_export_excel');

});