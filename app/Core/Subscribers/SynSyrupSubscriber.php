<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynSyrupSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_syrup.store', 'App\Core\Subscribers\SynSyrupSubscriber@onStore');
        $events->listen('syn_syrup.update', 'App\Core\Subscribers\SynSyrupSubscriber@onUpdate');
        $events->listen('syn_syrup.destroy', 'App\Core\Subscribers\SynSyrupSubscriber@onDestroy');

    }




    public function onStore($syn_syrup){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_syrup:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_syrup:getByCropYearId:'. $syn_syrup->crop_year_id .'');

    }



    public function onUpdate($syn_syrup){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_syrup:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_syrup:findBySlug:'. $syn_syrup->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_syrup:getByCropYearId:'. $syn_syrup->crop_year_id .'');

    }



    public function onDestroy($syn_syrup){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_syrup:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_syrup:findBySlug:'. $syn_syrup->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_syrup:getByCropYearId:'. $syn_syrup->crop_year_id .'');

    }



}