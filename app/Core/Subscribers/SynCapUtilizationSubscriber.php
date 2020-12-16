<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynCapUtilizationSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_cap_utilization.store', 'App\Core\Subscribers\SynCapUtilizationSubscriber@onStore');
        $events->listen('syn_cap_utilization.update', 'App\Core\Subscribers\SynCapUtilizationSubscriber@onUpdate');
        $events->listen('syn_cap_utilization.destroy', 'App\Core\Subscribers\SynCapUtilizationSubscriber@onDestroy');

    }




    public function onStore($syn_cap_utilization){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cap_utilization:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cap_utilization:getByCropYearId:'. $syn_cap_utilization->crop_year_id .'');

    }



    public function onUpdate($syn_cap_utilization){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cap_utilization:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cap_utilization:findBySlug:'. $syn_cap_utilization->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cap_utilization:getByCropYearId:'. $syn_cap_utilization->crop_year_id .'');

    }



    public function onDestroy($syn_cap_utilization){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cap_utilization:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cap_utilization:findBySlug:'. $syn_cap_utilization->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cap_utilization:getByCropYearId:'. $syn_cap_utilization->crop_year_id .'');

    }



}