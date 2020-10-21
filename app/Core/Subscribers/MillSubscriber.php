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
        $events->listen('mill.renew_license', 'App\Core\Subscribers\MillSubscriber@onRenewLicense');

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



    public function onRenewLicense($mill, $mill_reg, $request){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:mills:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:mills:findBySlug:'. $mill->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:mill_registrations:fetchByMillId:'. $mill_reg->mill_id .':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:mill_registrations:findBySlug:'. $mill_reg->slug);

        if (isset($request->ft)) {

            if($request->ft == 'rl') {
                $this->session->flash('RENEW_LICENSE_SUCCESS', 'The Mill has been successfully registered!');
            }elseif ($request->ft == 'bs') {
                $this->session->flash('BILLING_STATEMENT_SUCCESS', 'The Billing Statement has been successfully created!');
            }elseif ($request->ft == 'ml') {
                $this->session->flash('MILL_LIB_SUCCESS', 'The Mill Library has been added successfully!');
            }

            $this->session->flash('MILL_RENEW_LICENSE_SUCCESS_SLUG', $mill->slug);
            $this->session->flash('MILL_RENEW_LICENSE_SUCCESS_TR_SLUG', $mill_reg->slug);

        }else{

            $this->session->flash('MILL_RENEW_LICENSE_SUCCESS', 'The Renewal Details has been successfully updated!');
            $this->session->flash('MILL_RENEW_LICENSE_SUCCESS_SLUG', $mill->slug);
            $this->session->flash('MILL_RENEW_LICENSE_SUCCESS_TR_SLUG', $mill_reg->slug);
        }

    }





}