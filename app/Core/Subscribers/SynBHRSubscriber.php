<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynBHRSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }



    public function subscribe($events){

        $events->listen('syn_bhr.store', 'App\Core\Subscribers\SynBHRSubscriber@onStore');
        $events->listen('syn_bhr.update', 'App\Core\Subscribers\SynBHRSubscriber@onUpdate');
        $events->listen('syn_bhr.destroy', 'App\Core\Subscribers\SynBHRSubscriber@onDestroy');

    }



    public function onStore($syn_bhr){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bhr:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bhr:getByCropYearId:'. $syn_bhr->crop_year_id .'');

    }



    public function onUpdate($syn_bhr){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bhr:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bhr:findBySlug:'. $syn_bhr->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bhr:getByCropYearId:'. $syn_bhr->crop_year_id .'');

    }



    public function onDestroy($syn_bhr){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bhr:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bhr:findBySlug:'. $syn_bhr->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bhr:getByCropYearId:'. $syn_bhr->crop_year_id .'');

    }



}