<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynMillingDurationSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }



    public function subscribe($events){

        $events->listen('syn_milling_duration.store', 'App\Core\Subscribers\SynMillingDurationSubscriber@onStore');
        $events->listen('syn_milling_duration.update', 'App\Core\Subscribers\SynMillingDurationSubscriber@onUpdate');
        $events->listen('syn_milling_duration.destroy', 'App\Core\Subscribers\SynMillingDurationSubscriber@onDestroy');

    }



    public function onStore($syn_milling_duration){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_duration:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_duration:getByCropYearId:'. $syn_milling_duration->crop_year_id .'');

    }



    public function onUpdate($syn_milling_duration){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_duration:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_duration:findBySlug:'. $syn_milling_duration->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_duration:getByCropYearId:'. $syn_milling_duration->crop_year_id .'');

    }



    public function onDestroy($syn_milling_duration){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_duration:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_duration:findBySlug:'. $syn_milling_duration->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_duration:getByCropYearId:'. $syn_milling_duration->crop_year_id .'');

    }



}