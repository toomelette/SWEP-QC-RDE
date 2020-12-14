<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynSugarAnalysisSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_sugar_analysis.store', 'App\Core\Subscribers\SynSugarAnalysisSubscriber@onStore');
        $events->listen('syn_sugar_analysis.update', 'App\Core\Subscribers\SynSugarAnalysisSubscriber@onUpdate');
        $events->listen('syn_sugar_analysis.destroy', 'App\Core\Subscribers\SynSugarAnalysisSubscriber@onDestroy');

    }




    public function onStore($syn_sugar_analysis){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_sugar_analysis:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_sugar_analysis:getByCropYearId:'. $syn_sugar_analysis->crop_year_id .'');

    }



    public function onUpdate($syn_sugar_analysis){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_sugar_analysis:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_sugar_analysis:findBySlug:'. $syn_sugar_analysis->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_sugar_analysis:getByCropYearId:'. $syn_sugar_analysis->crop_year_id .'');

    }



    public function onDestroy($syn_sugar_analysis){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_sugar_analysis:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_sugar_analysis:findBySlug:'. $syn_sugar_analysis->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_sugar_analysis:getByCropYearId:'. $syn_sugar_analysis->crop_year_id .'');

    }



}