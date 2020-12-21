<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynGrindStoppageSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_grind_stoppage.store', 'App\Core\Subscribers\SynGrindStoppageSubscriber@onStore');
        $events->listen('syn_grind_stoppage.update', 'App\Core\Subscribers\SynGrindStoppageSubscriber@onUpdate');
        $events->listen('syn_grind_stoppage.destroy', 'App\Core\Subscribers\SynGrindStoppageSubscriber@onDestroy');

    }




    public function onStore($syn_grind_stoppage){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_grind_stoppage:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_grind_stoppage:getByCropYearId:'. $syn_grind_stoppage->crop_year_id .'');

    }



    public function onUpdate($syn_grind_stoppage){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_grind_stoppage:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_grind_stoppage:findBySlug:'. $syn_grind_stoppage->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_grind_stoppage:getByCropYearId:'. $syn_grind_stoppage->crop_year_id .'');

    }



    public function onDestroy($syn_grind_stoppage){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_grind_stoppage:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_grind_stoppage:findBySlug:'. $syn_grind_stoppage->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_grind_stoppage:getByCropYearId:'. $syn_grind_stoppage->crop_year_id .'');

    }



}