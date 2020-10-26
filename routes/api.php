<?php


// Submenu
Route::get('/submenu/select_submenu_byMenuId/{menu_id}',
		   'Api\ApiSubmenuController@selectSubmenuByMenuId')->name('selectSubmenuByMenuId');

Route::get('/cane_sugar_tons','Api\ApiSynCaneSugarTonsController@fetch')->name('api.synopsis.cane_sugar_tons');


