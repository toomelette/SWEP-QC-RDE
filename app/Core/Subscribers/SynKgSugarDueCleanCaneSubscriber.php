<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynKgSugarDueCleanCaneSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }



    public function subscribe($events){

        $events->listen('syn_kg_sugar_due_clean_cane.store', 'App\Core\Subscribers\SynKgSugarDueCleanCaneSubscriber@onStore');
        $events->listen('syn_kg_sugar_due_clean_cane.update', 'App\Core\Subscribers\SynKgSugarDueCleanCaneSubscriber@onUpdate');
        $events->listen('syn_kg_sugar_due_clean_cane.destroy', 'App\Core\Subscribers\SynKgSugarDueCleanCaneSubscriber@onDestroy');

    }



    public function onStore($syn_kg_sugar_due_clean_cane){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_clean_cane:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_clean_cane:getByCropYearId:'. $syn_kg_sugar_due_clean_cane->crop_year_id .'');

    }



    public function onUpdate($syn_kg_sugar_due_clean_cane){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_clean_cane:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_clean_cane:findBySlug:'. $syn_kg_sugar_due_clean_cane->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_clean_cane:getByCropYearId:'. $syn_kg_sugar_due_clean_cane->crop_year_id .'');

    }



    public function onDestroy($syn_kg_sugar_due_clean_cane){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_clean_cane:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_clean_cane:findBySlug:'. $syn_kg_sugar_due_clean_cane->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_clean_cane:getByCropYearId:'. $syn_kg_sugar_due_clean_cane->crop_year_id .'');

    }



}