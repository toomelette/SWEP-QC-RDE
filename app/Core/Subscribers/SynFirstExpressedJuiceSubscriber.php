<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynFirstExpressedJuiceSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_first_expressed_juice.store', 'App\Core\Subscribers\SynFirstExpressedJuiceSubscriber@onStore');
        $events->listen('syn_first_expressed_juice.update', 'App\Core\Subscribers\SynFirstExpressedJuiceSubscriber@onUpdate');
        $events->listen('syn_first_expressed_juice.destroy', 'App\Core\Subscribers\SynFirstExpressedJuiceSubscriber@onDestroy');

    }




    public function onStore($syn_first_expressed_juice){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_first_expressed_juice:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_first_expressed_juice:getByCropYearId:'. $syn_first_expressed_juice->crop_year_id .'');

    }



    public function onUpdate($syn_first_expressed_juice){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_first_expressed_juice:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_first_expressed_juice:findBySlug:'. $syn_first_expressed_juice->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_first_expressed_juice:getByCropYearId:'. $syn_first_expressed_juice->crop_year_id .'');

    }



    public function onDestroy($syn_first_expressed_juice){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_first_expressed_juice:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_first_expressed_juice:findBySlug:'. $syn_first_expressed_juice->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_first_expressed_juice:getByCropYearId:'. $syn_first_expressed_juice->crop_year_id .'');

    }



}