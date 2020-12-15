<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynMixedJuiceSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_mixed_juice.store', 'App\Core\Subscribers\SynMixedJuiceSubscriber@onStore');
        $events->listen('syn_mixed_juice.update', 'App\Core\Subscribers\SynMixedJuiceSubscriber@onUpdate');
        $events->listen('syn_mixed_juice.destroy', 'App\Core\Subscribers\SynMixedJuiceSubscriber@onDestroy');

    }




    public function onStore($syn_mixed_juice){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_mixed_juice:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_mixed_juice:getByCropYearId:'. $syn_mixed_juice->crop_year_id .'');

    }



    public function onUpdate($syn_mixed_juice){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_mixed_juice:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_mixed_juice:findBySlug:'. $syn_mixed_juice->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_mixed_juice:getByCropYearId:'. $syn_mixed_juice->crop_year_id .'');

    }



    public function onDestroy($syn_mixed_juice){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_mixed_juice:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_mixed_juice:findBySlug:'. $syn_mixed_juice->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_mixed_juice:getByCropYearId:'. $syn_mixed_juice->crop_year_id .'');

    }



}