<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynPRDNIncrementSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_prdn_increment.store', 'App\Core\Subscribers\SynPRDNIncrementSubscriber@onStore');
        $events->listen('syn_prdn_increment.update', 'App\Core\Subscribers\SynPRDNIncrementSubscriber@onUpdate');
        $events->listen('syn_prdn_increment.destroy', 'App\Core\Subscribers\SynPRDNIncrementSubscriber@onDestroy');

    }




    public function onStore($syn_prdn_increment){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_prdn_increment:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_prdn_increment:getByCropYearId:'. $syn_prdn_increment->crop_year_id .'');

    }



    public function onUpdate($syn_prdn_increment){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_prdn_increment:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_prdn_increment:findBySlug:'. $syn_prdn_increment->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_prdn_increment:getByCropYearId:'. $syn_prdn_increment->crop_year_id .'');

    }



    public function onDestroy($syn_prdn_increment){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_prdn_increment:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_prdn_increment:findBySlug:'. $syn_prdn_increment->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_prdn_increment:getByCropYearId:'. $syn_prdn_increment->crop_year_id .'');

    }



}