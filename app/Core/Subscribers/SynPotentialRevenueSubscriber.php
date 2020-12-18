<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynPotentialRevenueSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }



    public function subscribe($events){

        $events->listen('syn_potential_revenue.store', 'App\Core\Subscribers\SynPotentialRevenueSubscriber@onStore');
        $events->listen('syn_potential_revenue.update', 'App\Core\Subscribers\SynPotentialRevenueSubscriber@onUpdate');
        $events->listen('syn_potential_revenue.destroy', 'App\Core\Subscribers\SynPotentialRevenueSubscriber@onDestroy');

    }



    public function onStore($syn_potential_revenue){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_potential_revenue:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_potential_revenue:getByCropYearId:'. $syn_potential_revenue->crop_year_id .'');

    }



    public function onUpdate($syn_potential_revenue){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_potential_revenue:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_potential_revenue:findBySlug:'. $syn_potential_revenue->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_potential_revenue:getByCropYearId:'. $syn_potential_revenue->crop_year_id .'');

    }



    public function onDestroy($syn_potential_revenue){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_potential_revenue:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_potential_revenue:findBySlug:'. $syn_potential_revenue->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_potential_revenue:getByCropYearId:'. $syn_potential_revenue->crop_year_id .'');

    }



}