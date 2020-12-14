<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynCaneAnalysisSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_cane_analysis.store', 'App\Core\Subscribers\SynCaneAnalysisSubscriber@onStore');
        $events->listen('syn_cane_analysis.update', 'App\Core\Subscribers\SynCaneAnalysisSubscriber@onUpdate');
        $events->listen('syn_cane_analysis.destroy', 'App\Core\Subscribers\SynCaneAnalysisSubscriber@onDestroy');

    }




    public function onStore($syn_cane_analysis){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_analysis:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_analysis:getByCropYearId:'. $syn_cane_analysis->crop_year_id .'');

    }



    public function onUpdate($syn_cane_analysis){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_analysis:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_analysis:findBySlug:'. $syn_cane_analysis->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_analysis:getByCropYearId:'. $syn_cane_analysis->crop_year_id .'');

    }



    public function onDestroy($syn_cane_analysis){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_analysis:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_analysis:findBySlug:'. $syn_cane_analysis->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_analysis:getByCropYearId:'. $syn_cane_analysis->crop_year_id .'');

    }



}