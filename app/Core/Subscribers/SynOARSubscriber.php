<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynOARSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }



    public function subscribe($events){

        $events->listen('syn_oar.store', 'App\Core\Subscribers\SynOARSubscriber@onStore');
        $events->listen('syn_oar.update', 'App\Core\Subscribers\SynOARSubscriber@onUpdate');
        $events->listen('syn_oar.destroy', 'App\Core\Subscribers\SynOARSubscriber@onDestroy');

    }



    public function onStore($syn_oar){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_oar:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_oar:getByCropYearId:'. $syn_oar->crop_year_id .'');

    }



    public function onUpdate($syn_oar){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_oar:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_oar:findBySlug:'. $syn_oar->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_oar:getByCropYearId:'. $syn_oar->crop_year_id .'');

    }



    public function onDestroy($syn_oar){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_oar:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_oar:findBySlug:'. $syn_oar->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_oar:getByCropYearId:'. $syn_oar->crop_year_id .'');

    }



}