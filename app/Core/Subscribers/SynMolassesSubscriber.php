<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynMolassesSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_molasses.store', 'App\Core\Subscribers\SynMolassesSubscriber@onStore');
        $events->listen('syn_molasses.update', 'App\Core\Subscribers\SynMolassesSubscriber@onUpdate');
        $events->listen('syn_molasses.destroy', 'App\Core\Subscribers\SynMolassesSubscriber@onDestroy');

    }




    public function onStore($syn_molasses){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_molasses:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_molasses:getByCropYearId:'. $syn_molasses->crop_year_id .'');

    }



    public function onUpdate($syn_molasses){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_molasses:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_molasses:findBySlug:'. $syn_molasses->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_molasses:getByCropYearId:'. $syn_molasses->crop_year_id .'');

    }



    public function onDestroy($syn_molasses){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_molasses:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_molasses:findBySlug:'. $syn_molasses->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_molasses:getByCropYearId:'. $syn_molasses->crop_year_id .'');

    }



}