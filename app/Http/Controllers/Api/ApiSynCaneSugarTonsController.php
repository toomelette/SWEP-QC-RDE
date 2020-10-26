<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynCaneSugarTonInterface;
use Illuminate\Http\Request;


class ApiSynCaneSugarTonsController extends Controller{


	protected $syn_cane_sugar_ton;


	public function __construct(SynCaneSugarTonInterface $syn_cane_sugar_ton){
		$this->syn_cane_sugar_ton = $syn_cane_sugar_ton;
	}


	public function fetch(Request $request){

	    return $this->syn_cane_sugar_ton->fetch($request);

    }


    
}
