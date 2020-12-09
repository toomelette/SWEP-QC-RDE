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

	// OUTPUT
	Route::get('synopsis/outputs/get_categories','Api\ApiSynOutputController@getAllCategories')->name('synopsis.output_get_categories');
	Route::get('synopsis/outputs/get_regions','Api\ApiSynOutputController@getAllRegions')->name('synopsis.output_get_regions');
	Route::get('synopsis/outputs/filter','Api\ApiSynOutputController@filter')->name('synopsis.output_filter');
	Route::get('synopsis/outputs/export_excel','Api\ApiSynOutputController@exportExcel')->name('synopsis.output_export_excel');

});