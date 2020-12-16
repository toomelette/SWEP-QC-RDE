<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynMillingPlantSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_milling_plant.store', 'App\Core\Subscribers\SynMillingPlantSubscriber@onStore');
        $events->listen('syn_milling_plant.update', 'App\Core\Subscribers\SynMillingPlantSubscriber@onUpdate');
        $events->listen('syn_milling_plant.destroy', 'App\Core\Subscribers\SynMillingPlantSubscriber@onDestroy');

    }




    public function onStore($syn_milling_plant){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_plant:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_plant:getByCropYearId:'. $syn_milling_plant->crop_year_id .'');

    }



    public function onUpdate($syn_milling_plant){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_plant:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_plant:findBySlug:'. $syn_milling_plant->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_plant:getByCropYearId:'. $syn_milling_plant->crop_year_id .'');

    }



    public function onDestroy($syn_milling_plant){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_plant:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_plant:findBySlug:'. $syn_milling_plant->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_milling_plant:getByCropYearId:'. $syn_milling_plant->crop_year_id .'');

    }



}