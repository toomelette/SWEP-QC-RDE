<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynTenYrPrdnSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_ten_yr_prdn.store', 'App\Core\Subscribers\SynTenYrPrdnSubscriber@onStore');
        $events->listen('syn_ten_yr_prdn.update', 'App\Core\Subscribers\SynTenYrPrdnSubscriber@onUpdate');
        $events->listen('syn_ten_yr_prdn.destroy', 'App\Core\Subscribers\SynTenYrPrdnSubscriber@onDestroy');

    }




    public function onStore($syn_ten_yr_prdn){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_prdn:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_prdn:getByCropYearId:*');

    }



    public function onUpdate($syn_ten_yr_prdn){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_prdn:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_prdn:findBySlug:'. $syn_ten_yr_prdn->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_prdn:getByCropYearId:*');

    }



    public function onDestroy($syn_ten_yr_prdn){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_prdn:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_prdn:findBySlug:'. $syn_ten_yr_prdn->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_prdn:getByCropYearId:*');

    }



}