<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynTenYrAgriParamSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_ten_yr_agri_param.store', 'App\Core\Subscribers\SynTenYrAgriParamSubscriber@onStore');
        $events->listen('syn_ten_yr_agri_param.update', 'App\Core\Subscribers\SynTenYrAgriParamSubscriber@onUpdate');
        $events->listen('syn_ten_yr_agri_param.destroy', 'App\Core\Subscribers\SynTenYrAgriParamSubscriber@onDestroy');

    }




    public function onStore($syn_ten_yr_agri_param){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_agri_param:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_agri_param:getByCropYearId:*');

    }



    public function onUpdate($syn_ten_yr_agri_param){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_agri_param:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_agri_param:findBySlug:'. $syn_ten_yr_agri_param->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_agri_param:getByCropYearId:*');

    }



    public function onDestroy($syn_ten_yr_agri_param){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_agri_param:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_agri_param:findBySlug:'. $syn_ten_yr_agri_param->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ten_yr_agri_param:getByCropYearId:*');

    }



}