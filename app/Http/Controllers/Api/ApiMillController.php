<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\MillInterface;
use Illuminate\Http\Request;


class ApiMillController extends Controller{


	protected $mill;


	public function __construct(MillInterface $mill){
		$this->mill = $mill;
	}


	public function getAll(){

		$mills = $this->mill->getAll();
	    return response()->json($mills);

    }


    
}
