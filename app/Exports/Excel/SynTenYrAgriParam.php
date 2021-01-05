<?php

namespace App\Exports\Excel;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SynTenYrAgriParam implements FromView{
    

    private $collection;
    private $crop_year;


    public function __construct($collection, $crop_year){

    	$this->collection = $collection;
        $this->crop_year = $crop_year;
    }


    public function view(): View{

        return view('exports.synopsis.excel.TenYrAgriParam', [
            'collection' =>  $this->collection,
            'crop_year' => $this->crop_year,
        ]);


    }



}