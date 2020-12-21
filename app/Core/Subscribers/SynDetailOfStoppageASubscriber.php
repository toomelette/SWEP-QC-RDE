<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynDetailOfStoppageASubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_detail_of_stoppage_a.store', 'App\Core\Subscribers\SynDetailOfStoppageASubscriber@onStore');
        $events->listen('syn_detail_of_stoppage_a.update', 'App\Core\Subscribers\SynDetailOfStoppageASubscriber@onUpdate');
        $events->listen('syn_detail_of_stoppage_a.destroy', 'App\Core\Subscribers\SynDetailOfStoppageASubscriber@onDestroy');

    }




    public function onStore($syn_detail_of_stoppage_a){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_a:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_a:getByCropYearId:'. $syn_detail_of_stoppage_a->crop_year_id .'');

    }



    public function onUpdate($syn_detail_of_stoppage_a){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_a:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_a:findBySlug:'. $syn_detail_of_stoppage_a->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_a:getByCropYearId:'. $syn_detail_of_stoppage_a->crop_year_id .'');

    }



    public function onDestroy($syn_detail_of_stoppage_a){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_a:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_a:findBySlug:'. $syn_detail_of_stoppage_a->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_detail_of_stoppage_a:getByCropYearId:'. $syn_detail_of_stoppage_a->crop_year_id .'');

    }



}