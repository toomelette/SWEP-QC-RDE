<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynBHLossSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }



    public function subscribe($events){

        $events->listen('syn_bh_loss.store', 'App\Core\Subscribers\SynBHLossSubscriber@onStore');
        $events->listen('syn_bh_loss.update', 'App\Core\Subscribers\SynBHLossSubscriber@onUpdate');
        $events->listen('syn_bh_loss.destroy', 'App\Core\Subscribers\SynBHLossSubscriber@onDestroy');

    }



    public function onStore($syn_bh_loss){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bh_loss:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bh_loss:getByCropYearId:'. $syn_bh_loss->crop_year_id .'');

    }



    public function onUpdate($syn_bh_loss){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bh_loss:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bh_loss:findBySlug:'. $syn_bh_loss->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bh_loss:getByCropYearId:'. $syn_bh_loss->crop_year_id .'');

    }



    public function onDestroy($syn_bh_loss){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bh_loss:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bh_loss:findBySlug:'. $syn_bh_loss->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_bh_loss:getByCropYearId:'. $syn_bh_loss->crop_year_id .'');

    }



}