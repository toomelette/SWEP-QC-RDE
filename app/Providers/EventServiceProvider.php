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
        'App\Core\Subscribers\TraderSubscriber',
        'App\Core\Subscribers\TraderRegistrationSubscriber',
        'App\Core\Subscribers\TraderFileSubscriber',
        'App\Core\Subscribers\MillSubscriber',
        'App\Core\Subscribers\MillRegistrationSubscriber',
        'App\Core\Subscribers\MillFileSubscriber',
        'App\Core\Subscribers\RefinerySubscriber',
        'App\Core\Subscribers\RefineryRegistrationSubscriber',
        'App\Core\Subscribers\RefineryFileSubscriber',
        
    ];





}
