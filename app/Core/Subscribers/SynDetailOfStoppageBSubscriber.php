<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynDetailOfStoppageBSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_detail_of_stoppage_b.store', 'App\Core\Subscribers\SynDetailOfStoppageBSubscriber@onStore');
        $events->listen('syn_detail_of_stoppage_b.update', 'App\Core\Subscribers\SynDetailOfStoppageBSubscriber@onUpdate');
        $events->listen('syn_detail_of_stoppage_b.destroy', 'App\Core\Subscribers\SynDetailOfStoppageBSubscriber@onDestroy');

    }




    public function onStore($syn_detail_of_stoppage_b){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_b:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_b:getByCropYearId:'. $syn_detail_of_stoppage_b->crop_year_id .'');

    }



    public function onUpdate($syn_detail_of_stoppage_b){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_b:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_b:findBySlug:'. $syn_detail_of_stoppage_b->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_b:getByCropYearId:'. $syn_detail_of_stoppage_b->crop_year_id .'');

    }



    public function onDestroy($syn_detail_of_stoppage_b){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_b:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_b:findBySlug:'. $syn_detail_of_stoppage_b->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_b:getByCropYearId:'. $syn_detail_of_stoppage_b->crop_year_id .'');

    }



}