<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider{


   
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];




    public function boot(){

        parent::boot();

    }




    protected $subscribe = [

        'App\Core\Subscribers\UserSubscriber',
        'App\Core\Subscribers\ProfileSubscriber',
        'App\Core\Subscribers\MenuSubscriber',
        'App\Core\Subscribers\MillSubscriber',
        'App\Core\Subscribers\SynCaneSugarTonSubscriber',
        'App\Core\Subscribers\SynPRDNIncrementSubscriber',
        'App\Core\Subscribers\SynRatiosOnGrossCaneSubscriber',
        'App\Core\Subscribers\SynCaneAnalysisSubscriber',
        'App\Core\Subscribers\SynSugarAnalysisSubscriber',
        'App\Core\Subscribers\SynFirstExpressedJuiceSubscriber',
        'App\Core\Subscribers\SynLastExpressedJuiceSubscriber',
        'App\Core\Subscribers\SynMixedJuiceSubscriber',
        'App\Core\Subscribers\SynClarificationSubscriber',
        'App\Core\Subscribers\SynSyrupSubscriber',
        'App\Core\Subscribers\SynBagasseSubscriber',
        'App\Core\Subscribers\SynFilterCakeSubscriber',
        'App\Core\Subscribers\SynMolassesSubscriber',
        'App\Core\Subscribers\SynNonSugarSubscriber',
        'App\Core\Subscribers\SynCapUtilizationSubscriber',
        'App\Core\Subscribers\SynMillingPlantSubscriber',
        'App\Core\Subscribers\SynBHRSubscriber',
        'App\Core\Subscribers\SynOARSubscriber',
        'App\Core\Subscribers\SynBHLossSubscriber',
        'App\Core\Subscribers\SynKgSugarDueBHSubscriber',
        'App\Core\Subscribers\SynKgSugarDueCleanCaneSubscriber',
        'App\Core\Subscribers\SynPotentialRevenueSubscriber',
        'App\Core\Subscribers\SynMillingDurationSubscriber',
        'App\Core\Subscribers\SynGrindStoppageSubscriber',
        'App\Core\Subscribers\SynDetailOfStoppageASubscriber',

        

    ];





}
