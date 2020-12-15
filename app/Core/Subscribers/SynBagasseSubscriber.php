<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynBagasseSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_bagasse.store', 'App\Core\Subscribers\SynBagasseSubscriber@onStore');
        $events->listen('syn_bagasse.update', 'App\Core\Subscribers\SynBagasseSubscriber@onUpdate');
        $events->listen('syn_bagasse.destroy', 'App\Core\Subscribers\SynBagasseSubscriber@onDestroy');

    }




    public function onStore($syn_bagasse){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bagasse:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bagasse:getByCropYearId:'. $syn_bagasse->crop_year_id .'');

    }



    public function onUpdate($syn_bagasse){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bagasse:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bagasse:findBySlug:'. $syn_bagasse->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bagasse:getByCropYearId:'. $syn_bagasse->crop_year_id .'');

    }



    public function onDestroy($syn_bagasse){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bagasse:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bagasse:findBySlug:'. $syn_bagasse->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bagasse:getByCropYearId:'. $syn_bagasse->crop_year_id .'');

    }



}