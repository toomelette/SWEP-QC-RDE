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
		
		
	}



}