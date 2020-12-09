<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynCaneSugarTonInterface;
use App\Http\Requests\Synopsis\OutputFilterRequest;

class ApiSynOutputController extends Controller{



    protected $syn_cane_sugar_ton_repo;
    
    

	const SYN_OUTPUT_CATEGORIES = [

        ['id' => '1', 'label' => 'Cane-Sugar Tons',],
        ['id' => '2', 'label' => 'Ratios on Gross Cane',],

    ];
    
    

	const SYN_OUTPUT_REGIONS = [

        'LUZ' => 'LUZON', 
        'NEG' => 'NEGROS', 
        'EV' => 'EASTERN VISAYAS', 
        'PAN' => 'PANAY', 
        'MIN' => 'MINDANAO', 

    ];



	public function __construct(SynCaneSugarTonInterface $syn_cane_sugar_ton_repo){
		$this->syn_cane_sugar_ton_repo = $syn_cane_sugar_ton_repo;
        parent::__construct();
	}



	public function getAllCategories(){
	    return response()->json(self::SYN_OUTPUT_CATEGORIES, 200);
    }



	public function getAllRegions(){
	    return response()->json(self::SYN_OUTPUT_REGIONS, 200);
    }



	public function filter(OutputFilterRequest $request){

        $collection = [];

        if(isset($request->cy)){
            if($request->cat == '1'){
                $collection = $this->syn_cane_sugar_ton_repo->getByCropYearId($request->cy);
            }
        }

	    return response()->json($collection, 200);

    }



    
}
