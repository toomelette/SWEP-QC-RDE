<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynNonSugarSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_non_sugar.store', 'App\Core\Subscribers\SynNonSugarSubscriber@onStore');
        $events->listen('syn_non_sugar.update', 'App\Core\Subscribers\SynNonSugarSubscriber@onUpdate');
        $events->listen('syn_non_sugar.destroy', 'App\Core\Subscribers\SynNonSugarSubscriber@onDestroy');

    }




    public function onStore($syn_non_sugar){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_non_sugar:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_non_sugar:getByCropYearId:'. $syn_non_sugar->crop_year_id .'');

    }



    public function onUpdate($syn_non_sugar){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_non_sugar:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_non_sugar:findBySlug:'. $syn_non_sugar->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_non_sugar:getByCropYearId:'. $syn_non_sugar->crop_year_id .'');

    }



    public function onDestroy($syn_non_sugar){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_non_sugar:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_non_sugar:findBySlug:'. $syn_non_sugar->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_non_sugar:getByCropYearId:'. $syn_non_sugar->crop_year_id .'');

    }



}