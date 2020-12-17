<?php

namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
 

class RepositoryServiceProvider extends ServiceProvider {
	


	public function register(){

		$this->app->bind('App\Core\Interfaces\UserInterface', 'App\Core\Repositories\UserRepository');

		$this->app->bind('App\Core\Interfaces\UserMenuInterface', 'App\Core\Repositories\UserMenuRepository');

		$this->app->bind('App\Core\Interfaces\UserSubmenuInterface', 'App\Core\Repositories\UserSubmenuRepository');


		$this->app->bind('App\Core\Interfaces\MenuInterface', 'App\Core\Repositories\MenuRepository');

		$this->app->bind('App\Core\Interfaces\SubmenuInterface', 'App\Core\Repositories\SubmenuRepository');

		$this->app->bind('App\Core\Interfaces\ProfileInterface', 'App\Core\Repositories\ProfileRepository');


		$this->app->bind('App\Core\Interfaces\RegionInterface', 'App\Core\Repositories\RegionRepository');

		$this->app->bind('App\Core\Interfaces\CropYearInterface', 'App\Core\Repositories\CropYearRepository');

		$this->app->bind('App\Core\Interfaces\MillInterface', 'App\Core\Repositories\MillRepository');

		$this->app->bind('App\Core\Interfaces\SynCaneSugarTonInterface', 'App\Core\Repositories\SynCaneSugarTonRepository');

		$this->app->bind('App\Core\Interfaces\SynPRDNIncrementInterface', 'App\Core\Repositories\SynPRDNIncrementRepository');

		$this->app->bind('App\Core\Interfaces\SynRatiosOnGrossCaneInterface', 'App\Core\Repositories\SynRatiosOnGrossCaneRepository');

		$this->app->bind('App\Core\Interfaces\SynCaneAnalysisInterface', 'App\Core\Repositories\SynCaneAnalysisRepository');

		$this->app->bind('App\Core\Interfaces\SynSugarAnalysisInterface', 'App\Core\Repositories\SynSugarAnalysisRepository');

		$this->app->bind('App\Core\Interfaces\SynFirstExpressedJuiceInterface', 'App\Core\Repositories\SynFirstExpressedJuiceRepository');
		
		$this->app->bind('App\Core\Interfaces\SynLastExpressedJuiceInterface', 'App\Core\Repositories\SynLastExpressedJuiceRepository');
		
		$this->app->bind('App\Core\Interfaces\SynMixedJuiceInterface', 'App\Core\Repositories\SynMixedJuiceRepository');
		
		$this->app->bind('App\Core\Interfaces\SynClarificationInterface', 'App\Core\Repositories\SynClarificationRepository');
		
		$this->app->bind('App\Core\Interfaces\SynSyrupInterface', 'App\Core\Repositories\SynSyrupRepository');
		
		$this->app->bind('App\Core\Interfaces\SynBagasseInterface', 'App\Core\Repositories\SynBagasseRepository');
		
		$this->app->bind('App\Core\Interfaces\SynFilterCakeInterface', 'App\Core\Repositories\SynFilterCakeRepository');
		
		$this->app->bind('App\Core\Interfaces\SynMolassesInterface', 'App\Core\Repositories\SynMolassesRepository');
		
		$this->app->bind('App\Core\Interfaces\SynNonSugarInterface', 'App\Core\Repositories\SynNonSugarRepository');
		
		$this->app->bind('App\Core\Interfaces\SynCapUtilizationInterface', 'App\Core\Repositories\SynCapUtilizationRepository');
		
		$this->app->bind('App\Core\Interfaces\SynMillingPlantInterface', 'App\Core\Repositories\SynMillingPlantRepository');
		
		$this->app->bind('App\Core\Interfaces\SynBHRInterface', 'App\Core\Repositories\SynBHRRepository');
		
		$this->app->bind('App\Core\Interfaces\SynOARInterface', 'App\Core\Repositories\SynOARRepository');
		
		$this->app->bind('App\Core\Interfaces\SynBHLossInterface', 'App\Core\Repositories\SynBHLossRepository');
		
		$this->app->bind('App\Core\Interfaces\SynKgSugarDueBHInterface', 'App\Core\Repositories\SynKgSugarDueBHRepository');
		
	}



}