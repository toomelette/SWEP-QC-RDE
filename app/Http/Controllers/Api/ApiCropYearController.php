<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\CropYearInterface;
use Illuminate\Http\Request;


class ApiCropYearController extends Controller{


	protected $crop_year;


	public function __construct(CropYearInterface $crop_year){
		$this->crop_year = $crop_year;
	}


	public function getAll(){

		$crop_years = $this->crop_year->getAll();
	    return response()->json($crop_years);

    }


    
}
