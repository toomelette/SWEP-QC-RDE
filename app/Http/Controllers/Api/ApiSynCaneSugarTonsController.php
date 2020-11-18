<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\Controller;
use App\Core\Interfaces\SynCaneSugarTonInterface;
use App\Http\Requests\Synopsis\CaneSugarTonsFormRequest;
use Illuminate\Http\Request;
use JWTAuth;

class ApiSynCaneSugarTonsController extends Controller{



	protected $syn_cane_sugar_ton_repo;



	public function __construct(SynCaneSugarTonInterface $syn_cane_sugar_ton_repo){
		$this->syn_cane_sugar_ton_repo = $syn_cane_sugar_ton_repo;
	}



	public function fetch(Request $request){
		
		$syn_cane_sugar_tons = $this->syn_cane_sugar_ton_repo->fetch($request);
	    return response()->json($syn_cane_sugar_tons);

    }



	public function store(CaneSugarTonsFormRequest $request){

		$this->syn_cane_sugar_ton_repo->store($request);
        $this->event->fire('syn_cane_sugar_ton.store');
        return 'success';

    }



    
}
