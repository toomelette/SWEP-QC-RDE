<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynFilterCakeSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_filter_cake.store', 'App\Core\Subscribers\SynFilterCakeSubscriber@onStore');
        $events->listen('syn_filter_cake.update', 'App\Core\Subscribers\SynFilterCakeSubscriber@onUpdate');
        $events->listen('syn_filter_cake.destroy', 'App\Core\Subscribers\SynFilterCakeSubscriber@onDestroy');

    }




    public function onStore($syn_filter_cake){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_filter_cake:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_filter_cake:getByCropYearId:'. $syn_filter_cake->crop_year_id .'');

    }



    public function onUpdate($syn_filter_cake){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_filter_cake:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_filter_cake:findBySlug:'. $syn_filter_cake->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_filter_cake:getByCropYearId:'. $syn_filter_cake->crop_year_id .'');

    }



    public function onDestroy($syn_filter_cake){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_filter_cake:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_filter_cake:findBySlug:'. $syn_filter_cake->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_filter_cake:getByCropYearId:'. $syn_filter_cake->crop_year_id .'');

    }



}