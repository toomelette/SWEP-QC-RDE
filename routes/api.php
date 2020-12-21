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
	
	// Filter Cake
	Route::get('synopsis/filter_cake','Api\ApiSynFilterCakeController@fetch')->name('synopsis.filter_cake_list');
	Route::post('synopsis/filter_cake/store','Api\ApiSynFilterCakeController@store')->name('synopsis.filter_cake_store');
	Route::get('synopsis/filter_cake/{slug}','Api\ApiSynFilterCakeController@edit')->name('synopsis.filter_cake_edit');
	Route::post('synopsis/filter_cake/{slug}','Api\ApiSynFilterCakeController@update')->name('synopsis.filter_cake_update');
	Route::delete('synopsis/filter_cake/{slug}','Api\ApiSynFilterCakeController@delete')->name('synopsis.filter_cake_delete');
	
	// MOLASSES
	Route::get('synopsis/molasses','Api\ApiSynMolassesController@fetch')->name('synopsis.molasses_list');
	Route::post('synopsis/molasses/store','Api\ApiSynMolassesController@store')->name('synopsis.molasses_store');
	Route::get('synopsis/molasses/{slug}','Api\ApiSynMolassesController@edit')->name('synopsis.molasses_edit');
	Route::post('synopsis/molasses/{slug}','Api\ApiSynMolassesController@update')->name('synopsis.molasses_update');
	Route::delete('synopsis/molasses/{slug}','Api\ApiSynMolassesController@delete')->name('synopsis.molasses_delete');
	
	// Non Sugar
	Route::get('synopsis/non_sugar','Api\ApiSynNonSugarController@fetch')->name('synopsis.non_sugar_list');
	Route::post('synopsis/non_sugar/store','Api\ApiSynNonSugarController@store')->name('synopsis.non_sugar_store');
	Route::get('synopsis/non_sugar/{slug}','Api\ApiSynNonSugarController@edit')->name('synopsis.non_sugar_edit');
	Route::post('synopsis/non_sugar/{slug}','Api\ApiSynNonSugarController@update')->name('synopsis.non_sugar_update');
	Route::delete('synopsis/non_sugar/{slug}','Api\ApiSynNonSugarController@delete')->name('synopsis.non_sugar_delete');
	
	// Cap Utilization
	Route::get('synopsis/cap_utilization','Api\ApiSynCapUtilizationController@fetch')->name('synopsis.cap_utilization_list');
	Route::post('synopsis/cap_utilization/store','Api\ApiSynCapUtilizationController@store')->name('synopsis.cap_utilization_store');
	Route::get('synopsis/cap_utilization/{slug}','Api\ApiSynCapUtilizationController@edit')->name('synopsis.cap_utilization_edit');
	Route::post('synopsis/cap_utilization/{slug}','Api\ApiSynCapUtilizationController@update')->name('synopsis.cap_utilization_update');
	Route::delete('synopsis/cap_utilization/{slug}','Api\ApiSynCapUtilizationController@delete')->name('synopsis.cap_utilization_delete');
	
	// Milling Plant
	Route::get('synopsis/milling_plant','Api\ApiSynMillingPlantController@fetch')->name('synopsis.milling_plant_list');
	Route::post('synopsis/milling_plant/store','Api\ApiSynMillingPlantController@store')->name('synopsis.milling_plant_store');
	Route::get('synopsis/milling_plant/{slug}','Api\ApiSynMillingPlantController@edit')->name('synopsis.milling_plant_edit');
	Route::post('synopsis/milling_plant/{slug}','Api\ApiSynMillingPlantController@update')->name('synopsis.milling_plant_update');
	Route::delete('synopsis/milling_plant/{slug}','Api\ApiSynMillingPlantController@delete')->name('synopsis.milling_plant_delete');
	
	// BHR
	Route::get('synopsis/oar','Api\ApiSynBHRController@fetch')->name('synopsis.brh_list');
	Route::post('synopsis/oar/store','Api\ApiSynBHRController@store')->name('synopsis.brh_store');
	Route::get('synopsis/oar/{slug}','Api\ApiSynBHRController@edit')->name('synopsis.brh_edit');
	Route::post('synopsis/oar/{slug}','Api\ApiSynBHRController@update')->name('synopsis.brh_update');
	Route::delete('synopsis/oar/{slug}','Api\ApiSynBHRController@delete')->name('synopsis.brh_delete');
	
	// OAR
	Route::get('synopsis/oar','Api\ApiSynOARController@fetch')->name('synopsis.oar_list');
	Route::post('synopsis/oar/store','Api\ApiSynOARController@store')->name('synopsis.oar_store');
	Route::get('synopsis/oar/{slug}','Api\ApiSynOARController@edit')->name('synopsis.oar_edit');
	Route::post('synopsis/oar/{slug}','Api\ApiSynOARController@update')->name('synopsis.oar_update');
	Route::delete('synopsis/oar/{slug}','Api\ApiSynOARController@delete')->name('synopsis.oar_delete');
	
	// BH Loss
	Route::get('synopsis/bh_loss','Api\ApiSynBHLossController@fetch')->name('synopsis.bh_loss_list');
	Route::post('synopsis/bh_loss/store','Api\ApiSynBHLossController@store')->name('synopsis.bh_loss_store');
	Route::get('synopsis/bh_loss/{slug}','Api\ApiSynBHLossController@edit')->name('synopsis.bh_loss_edit');
	Route::post('synopsis/bh_loss/{slug}','Api\ApiSynBHLossController@update')->name('synopsis.bh_loss_update');
	Route::delete('synopsis/bh_loss/{slug}','Api\ApiSynBHLossController@delete')->name('synopsis.bh_loss_delete');
	
	// KG of Sugar Due BH
	Route::get('synopsis/kg_sugar_due_bh','Api\ApiSynKgSugarDueBHController@fetch')->name('synopsis.kg_sugar_due_bh_list');
	Route::post('synopsis/kg_sugar_due_bh/store','Api\ApiSynKgSugarDueBHController@store')->name('synopsis.kg_sugar_due_bh_store');
	Route::get('synopsis/kg_sugar_due_bh/{slug}','Api\ApiSynKgSugarDueBHController@edit')->name('synopsis.kg_sugar_due_bh_edit');
	Route::post('synopsis/kg_sugar_due_bh/{slug}','Api\ApiSynKgSugarDueBHController@update')->name('synopsis.kg_sugar_due_bh_update');
	Route::delete('synopsis/kg_sugar_due_bh/{slug}','Api\ApiSynKgSugarDueBHController@delete')->name('synopsis.kg_sugar_due_bh_delete');
	
	// KG of Sugar Due Clean Cane
	Route::get('synopsis/kg_sugar_due_clean_cane','Api\ApiSynKgSugarDueCleanCaneController@fetch')->name('synopsis.kg_sugar_due_clean_cane_list');
	Route::post('synopsis/kg_sugar_due_clean_cane/store','Api\ApiSynKgSugarDueCleanCaneController@store')->name('synopsis.kg_sugar_due_clean_cane_store');
	Route::get('synopsis/kg_sugar_due_clean_cane/{slug}','Api\ApiSynKgSugarDueCleanCaneController@edit')->name('synopsis.kg_sugar_due_clean_cane_edit');
	Route::post('synopsis/kg_sugar_due_clean_cane/{slug}','Api\ApiSynKgSugarDueCleanCaneController@update')->name('synopsis.kg_sugar_due_clean_cane_update');
	Route::delete('synopsis/kg_sugar_due_clean_cane/{slug}','Api\ApiSynKgSugarDueCleanCaneController@delete')->name('synopsis.kg_sugar_due_clean_cane_delete');
	
	// Potential Revenue
	Route::get('synopsis/potential_revenue','Api\ApiSynPotentialRevenueController@fetch')->name('synopsis.potential_revenuene_list');
	Route::post('synopsis/potential_revenue/store','Api\ApiSynPotentialRevenueController@store')->name('synopsis.potential_revenue_store');
	Route::get('synopsis/potential_revenue/{slug}','Api\ApiSynPotentialRevenueController@edit')->name('synopsis.potential_revenuene_edit');
	Route::post('synopsis/potential_revenue/{slug}','Api\ApiSynPotentialRevenueController@update')->name('synopsis.potential_revenue_update');
	Route::delete('synopsis/potential_revenue/{slug}','Api\ApiSynPotentialRevenueController@delete')->name('synopsis.potential_revenue_delete');
	
	// Milling Duration
	Route::get('synopsis/milling_duration','Api\ApiSynMillingDurationController@fetch')->name('synopsis.milling_duration_list');
	Route::post('synopsis/milling_duration/store','Api\ApiSynMillingDurationController@store')->name('synopsis.milling_duration_store');
	Route::get('synopsis/milling_duration/{slug}','Api\ApiSynMillingDurationController@edit')->name('synopsis.milling_duration_edit');
	Route::post('synopsis/milling_duration/{slug}','Api\ApiSynMillingDurationController@update')->name('synopsis.milling_duration_update');
	Route::delete('synopsis/milling_duration/{slug}','Api\ApiSynMillingDurationController@delete')->name('synopsis.milling_duration_delete');
	
	// Grinding Stoppages
	Route::get('synopsis/grind_stoppage','Api\ApiSynGrindStoppageController@fetch')->name('synopsis.grind_stoppage_list');
	Route::post('synopsis/grind_stoppage/store','Api\ApiSynGrindStoppageController@store')->name('synopsis.grind_stoppage_store');
	Route::get('synopsis/grind_stoppage/{slug}','Api\ApiSynGrindStoppageController@edit')->name('synopsis.grind_stoppage_edit');
	Route::post('synopsis/grind_stoppage/{slug}','Api\ApiSynGrindStoppageController@update')->name('synopsis.grind_stoppage_update');
	Route::delete('synopsis/grind_stoppage/{slug}','Api\ApiSynGrindStoppageController@delete')->name('synopsis.grind_stoppage_delete');
	
	// Detail of Stoppage - A
	Route::get('synopsis/detail_of_stoppage_a','Api\ApiSynDetailOfStoppageAController@fetch')->name('synopsis.detail_of_stoppag_a_list');
	Route::post('synopsis/detail_of_stoppage_a/store','Api\ApiSynDetailOfStoppageAController@store')->name('synopsis.detail_of_stoppag_a_store');
	Route::get('synopsis/detail_of_stoppage_a/{slug}','Api\ApiSynDetailOfStoppageAController@edit')->name('synopsis.detail_of_stoppag_a_edit');
	Route::post('synopsis/detail_of_stoppage_a/{slug}','Api\ApiSynDetailOfStoppageAController@update')->name('synopsis.detail_of_stoppag_a_update');
	Route::delete('synopsis/detail_of_stoppage_a/{slug}','Api\ApiSynDetailOfStoppageAController@delete')->name('synopsis.detail_of_stoppag_a_delete');

	// OUTPUT
	Route::get('synopsis/outputs/get_categories','Api\ApiSynOutputController@getAllCategories')->name('synopsis.output_get_categories');
	Route::get('synopsis/outputs/get_regions','Api\ApiSynOutputController@getAllRegions')->name('synopsis.output_get_regions');
	Route::get('synopsis/outputs/filter','Api\ApiSynOutputController@filter')->name('synopsis.output_filter');
	Route::get('synopsis/outputs/export_excel','Api\ApiSynOutputController@exportExcel')->name('synopsis.output_export_excel');

});