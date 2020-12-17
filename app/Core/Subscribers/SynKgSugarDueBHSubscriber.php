<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynKgSugarDueBHSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }



    public function subscribe($events){

        $events->listen('syn_kg_sugar_due_bh.store', 'App\Core\Subscribers\SynKgSugarDueBHSubscriber@onStore');
        $events->listen('syn_kg_sugar_due_bh.update', 'App\Core\Subscribers\SynKgSugarDueBHSubscriber@onUpdate');
        $events->listen('syn_kg_sugar_due_bh.destroy', 'App\Core\Subscribers\SynKgSugarDueBHSubscriber@onDestroy');

    }



    public function onStore($syn_kg_sugar_due_bh){
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_bh:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_bh:getByCropYearId:'. $syn_kg_sugar_due_bh->crop_year_id .'');

    }



    public function onUpdate($syn_kg_sugar_due_bh){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_bh:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_bh:findBySlug:'. $syn_kg_sugar_due_bh->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_bh:getByCropYearId:'. $syn_kg_sugar_due_bh->crop_year_id .'');

    }



    public function onDestroy($syn_kg_sugar_due_bh){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_bh:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_bh:findBySlug:'. $syn_kg_sugar_due_bh->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_kg_sugar_due_bh:getByCropYearId:'. $syn_kg_sugar_due_bh->crop_year_id .'');

    }



}