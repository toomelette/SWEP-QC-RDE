<?php

namespace App\Exports\Excel;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SynGrindStoppage implements FromView{
    

    private $collection;
    private $regions;
    private $crop_year;


    public function __construct($collection, $regions, $crop_year){

    	$this->collection = $collection;
    	$this->regions = $regions;
        $this->crop_year = $crop_year;
    }


    public function view(): View{

        return view('exports.synopsis.excel.GrindStoppage', [
            'collection' =>  $this->collection,
            'regions' =>  $this->regions,
            'crop_year' => $this->crop_year,
        ]);


    }



}