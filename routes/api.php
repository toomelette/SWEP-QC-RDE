<?php


// Submenu
Route::get('/submenu/select_submenu_byMenuId/{menu_id}',
		   'Api\ApiSubmenuController@selectSubmenuByMenuId')->name('selectSubmenuByMenuId');


// User
Route::get('/usr/bt','Api\ApiUserController@getUserBearerToken')->name('api.user.get_bearer_token');


// Mills
Route::get('/mill/get_all','Api\ApiMillController@getAll')->name('api.mill.get_all');


// Crop Years
Route::get('/crop_year/get_all','Api\ApiCropYearController@getAll')->name('api.crop_year.get_all');


// Synopsis
Route::get('/cane_sugar_tons','Api\ApiSynCaneSugarTonsController@fetch')->name('synopsis.cane_sugar_tons_list');
Route::post('/cane_sugar_tons/store','Api\ApiSynCaneSugarTonsController@store')->name('synopsis.cane_sugar_tons_store');