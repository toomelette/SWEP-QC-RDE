<?php

namespace App\Http\Controllers;


class SynopsisController extends Controller{


    public function caneSugarTons(){
        return view('dashboard.synopsis.cane_sugar_tons');
    }


    public function ratiosOnGrossCane(){
        return view('dashboard.synopsis.ratios_on_gross_cane');
    }
    

}
