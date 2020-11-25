<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SynCaneSugarTonSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('syn_cane_sugar_ton.store', 'App\Core\Subscribers\SynCaneSugarTonSubscriber@onStore');
        // $events->listen('syn_cane_sugar_ton.update', 'App\Core\Subscribers\SynCaneSugarTonSubscriber@onUpdate');
        // $events->listen('syn_cane_sugar_ton.destroy', 'App\Core\Subscribers\SynCaneSugarTonSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_sugar_tons:fetch:*');

    }



    // public function onUpdate($syn_cane_sugar_ton){

    //     $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_sugar_tons:fetch:*');
    //     $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_sugar_tons:findBySlug:'. $syn_cane_sugar_ton->slug .'');

    //     $this->session->flash('SYN_CANE_SUGAR_TON_UPDATE_SUCCESS', 'The Data has been successfully updated!');
    //     $this->session->flash('SYN_CANE_SUGAR_TON_UPDATE_SUCCESS_SLUG', $syn_cane_sugar_ton->slug);

    // }



    // public function onDestroy($syn_cane_sugar_ton){

    //     $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_sugar_tons:fetch:*');
    //     $this->__cache->deletePattern(''. config('app.name') .'_cache:syn_cane_sugar_tons:findBySlug:'. $syn_cane_sugar_ton->slug .'');

    //     $this->session->flash('SYN_CANE_SUGAR_TON_DELETE_SUCCESS', 'The Data has been successfully deleted!');
    //     $this->session->flash('SYN_CANE_SUGAR_TON_DELETE_SUCCESS_SLUG', $syn_cane_sugar_ton->slug);

    // }



}