<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class MillSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('mill.store', 'App\Core\Subscribers\MillSubscriber@onStore');
        $events->listen('mill.update', 'App\Core\Subscribers\MillSubscriber@onUpdate');
        $events->listen('mill.destroy', 'App\Core\Subscribers\MillSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:mills:fetch:*');

        $this->session->flash('MILL_CREATE_SUCCESS', 'The Mill has been successfully created!');

    }





    public function onUpdate($mill){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:mills:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:mills:findBySlug:'. $mill->slug .'');

        $this->session->flash('MILL_UPDATE_SUCCESS', 'The Mill has been successfully updated!');
        $this->session->flash('MILL_UPDATE_SUCCESS_SLUG', $mill->slug);

    }



    public function onDestroy($mill){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:mills:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:mills:findBySlug:'. $mill->slug .'');

        $this->session->flash('MILL_DELETE_SUCCESS', 'The Mill has been successfully deleted!');
        $this->session->flash('MILL_DELETE_SUCCESS_SLUG', $mill->slug);

    }





}