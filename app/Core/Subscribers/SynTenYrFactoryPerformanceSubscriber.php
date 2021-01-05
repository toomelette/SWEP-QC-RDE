<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynTenYrFactoryPerformanceSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_ten_yr_factory_performance.store', 'App\Core\Subscribers\SynTenYrFactoryPerformanceSubscriber@onStore');
        $events->listen('syn_ten_yr_factory_performance.update', 'App\Core\Subscribers\SynTenYrFactoryPerformanceSubscriber@onUpdate');
        $events->listen('syn_ten_yr_factory_performance.destroy', 'App\Core\Subscribers\SynTenYrFactoryPerformanceSubscriber@onDestroy');

    }




    public function onStore($syn_ten_yr_factory_performance){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_factory_performance:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_factory_performance:getByCropYearId:*');

    }



    public function onUpdate($syn_ten_yr_factory_performance){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_factory_performance:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_factory_performance:findBySlug:'. $syn_ten_yr_factory_performance->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_factory_performance:getByCropYearId:*');

    }



    public function onDestroy($syn_ten_yr_factory_performance){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_factory_performance:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_factory_performance:findBySlug:'. $syn_ten_yr_factory_performance->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_factory_performance:getByCropYearId:*');

    }



}