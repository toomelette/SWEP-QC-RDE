<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynRatiosOnGrossCaneSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_ratios_on_gross_cane.store', 'App\Core\Subscribers\SynRatiosOnGrossCaneSubscriber@onStore');
        $events->listen('syn_ratios_on_gross_cane.update', 'App\Core\Subscribers\SynRatiosOnGrossCaneSubscriber@onUpdate');
        $events->listen('syn_ratios_on_gross_cane.destroy', 'App\Core\Subscribers\SynRatiosOnGrossCaneSubscriber@onDestroy');

    }




    public function onStore($syn_ratios_on_gross_cane){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ratios_on_gross_cane:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ratios_on_gross_cane:getByCropYearId:'. $syn_ratios_on_gross_cane->crop_year_id .'');

    }



    public function onUpdate($syn_ratios_on_gross_cane){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ratios_on_gross_cane:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ratios_on_gross_cane:findBySlug:'. $syn_ratios_on_gross_cane->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ratios_on_gross_cane:getByCropYearId:'. $syn_ratios_on_gross_cane->crop_year_id .'');

    }



    public function onDestroy($syn_ratios_on_gross_cane){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ratios_on_gross_cane:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ratios_on_gross_cane:findBySlug:'. $syn_ratios_on_gross_cane->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_ratios_on_gross_cane:getByCropYearId:'. $syn_ratios_on_gross_cane->crop_year_id .'');

    }



}