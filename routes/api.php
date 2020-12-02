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
	Route::get('/cane_sugar_tons','Api\ApiSynCaneSugarTonsController@fetch')->name('synopsis.cane_sugar_tons_list');
	Route::post('/cane_sugar_tons/store','Api\ApiSynCaneSugarTonsController@store')->name('synopsis.cane_sugar_tons_store');
	Route::get('/cane_sugar_tons/{slug}','Api\ApiSynCaneSugarTonsController@edit')->name('synopsis.cane_sugar_tons_edit');
	Route::post('/cane_sugar_tons/{slug}','Api\ApiSynCaneSugarTonsController@update')->name('synopsis.cane_sugar_tons_update');
	Route::delete('/cane_sugar_tons/{slug}','Api\ApiSynCaneSugarTonsController@delete')->name('synopsis.cane_sugar_tons_delete');
	
	// Ratios On Gross Cane
	Route::get('/ratios_on_gross_cane','Api\ApiSynRatiosOnGrossCaneController@fetch')->name('synopsis.ratios_on_gross_cane_list');
	Route::post('/ratios_on_gross_cane/store','Api\ApiSynRatiosOnGrossCaneController@store')->name('synopsis.ratios_on_gross_cane_store');
	Route::get('/ratios_on_gross_cane/{slug}','Api\ApiSynRatiosOnGrossCaneController@edit')->name('synopsis.ratios_on_gross_cane_edit');
	Route::post('/ratios_on_gross_cane/{slug}','Api\ApiSynRatiosOnGrossCaneController@update')->name('synopsis.ratios_on_gross_cane_update');
	Route::delete('/ratios_on_gross_cane/{slug}','Api\ApiSynRatiosOnGrossCaneController@delete')->name('synopsis.ratios_on_gross_cane_delete');

});