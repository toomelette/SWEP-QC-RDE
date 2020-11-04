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
        View::composer(['dashboard.mill.create', 
                        'dashboard.mill.edit',], 'App\Core\ViewComposers\RegionComposer');
        

        // Crop Year
        View::composer(['dashboard.synopsis.*',], 'App\Core\ViewComposers\CropYearComposer');

        
    }

    




    
    public function register(){

      


    
    }






}
