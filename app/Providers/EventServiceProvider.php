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
        'App\Core\Subscribers\SynFirstExpressedJuiceSubscriber'
        
    ];





}
