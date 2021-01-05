<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynTenYrRatioYieldSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_ten_yr_ratio_yield.store', 'App\Core\Subscribers\SynTenYrRatioYieldSubscriber@onStore');
        $events->listen('syn_ten_yr_ratio_yield.update', 'App\Core\Subscribers\SynTenYrRatioYieldSubscriber@onUpdate');
        $events->listen('syn_ten_yr_ratio_yield.destroy', 'App\Core\Subscribers\SynTenYrRatioYieldSubscriber@onDestroy');

    }




    public function onStore($syn_ten_yr_ratio_yield){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_ratio_yield:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_ratio_yield:getByCropYearId:*');

    }



    public function onUpdate($syn_ten_yr_ratio_yield){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_ratio_yield:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_ratio_yield:findBySlug:'. $syn_ten_yr_ratio_yield->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_ratio_yield:getByCropYearId:*');

    }



    public function onDestroy($syn_ten_yr_ratio_yield){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_ratio_yield:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_ratio_yield:findBySlug:'. $syn_ten_yr_ratio_yield->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_ratio_yield:getByCropYearId:*');

    }



}