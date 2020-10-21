<?php

namespace App\Providers;


use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider{

    
    public function boot(){

        /** VIEW COMPOSERS  **/


        // USERMENU
        View::composer('layouts.admin-sidenav', 'App\Core\ViewComposers\UserMenuComposer');


        // USER SUBMENU
        View::composer(['*'], 'App\Core\ViewComposers\UserSubmenuComposer');


        // MENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Core\ViewComposers\MenuComposer');
        

        // SUBMENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Core\ViewComposers\SubmenuComposer');
        

        // REGION
        View::composer(['dashboard.trader.create',
                        'dashboard.trader.edit',
                        'dashboard.trader_registration.create',
                        'dashboard.trader_registration.edit',
                        'printables.trader_registration.list_bcyc_br',
                        'printables.trader_registration.list_bdc_br',
                        'printables.trader_registration.count_by_cropyear',
                        'exports.trader.bcyc_by_region',
                        'exports.trader.bdc_by_region',
                        'dashboard.mill.create', 
                        'dashboard.mill.edit',
                        'dashboard.refinery.create', 
                        'dashboard.refinery.edit',], 'App\Core\ViewComposers\RegionComposer');
        

        // TRADER
        View::composer(['dashboard.trader_registration.create', 
                        'dashboard.trader_registration.edit', 
                        'dashboard.trader_registration.index'], 'App\Core\ViewComposers\TraderComposer');
        

        // TRADER CATEGORY
        View::composer(['dashboard.trader.reports',
                        'dashboard.trader.index',
                        'dashboard.trader.renewal_history',], 'App\Core\ViewComposers\TraderCategoryComposer');
        

        // Crop Year
        View::composer(['dashboard.trader.index',
                        'dashboard.trader.renewal_history',
                        'dashboard.trader.reports',
                        'dashboard.mill.index',
                        'dashboard.mill.renewal_history',
                        'dashboard.mill.reports',
                        'dashboard.refinery.index',
                        'dashboard.refinery.renewal_history',
                        'dashboard.refinery.reports',], 'App\Core\ViewComposers\CropYearComposer');

        
    }

    




    
    public function register(){

      


    
    }






}
