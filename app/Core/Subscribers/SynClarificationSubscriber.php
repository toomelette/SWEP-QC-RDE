<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynClarificationSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_clarification.store', 'App\Core\Subscribers\SynClarificationSubscriber@onStore');
        $events->listen('syn_clarification.update', 'App\Core\Subscribers\SynClarificationSubscriber@onUpdate');
        $events->listen('syn_clarification.destroy', 'App\Core\Subscribers\SynClarificationSubscriber@onDestroy');

    }




    public function onStore($syn_clarification){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_clarification:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_clarification:getByCropYearId:'. $syn_clarification->crop_year_id .'');

    }



    public function onUpdate($syn_clarification){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_clarification:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_clarification:findBySlug:'. $syn_clarification->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_clarification:getByCropYearId:'. $syn_clarification->crop_year_id .'');

    }



    public function onDestroy($syn_clarification){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_clarification:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_clarification:findBySlug:'. $syn_clarification->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_clarification:getByCropYearId:'. $syn_clarification->crop_year_id .'');

    }



}