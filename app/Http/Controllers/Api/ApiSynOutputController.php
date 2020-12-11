<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Synopsis\OutputFilterRequest;

use App\Core\Interfaces\SynCaneSugarTonInterface;
use App\Core\Interfaces\SynPRDNIncrementInterface;
use App\Core\Interfaces\SynRatiosOnGrossCaneInterface;

class ApiSynOutputController extends Controller{
    
    

	const SYN_OUTPUT_CATEGORIES = [

        ['id' => '1', 'label' => 'Cane-Sugar Tons',],
        ['id' => '2', 'label' => 'Production Increment',],
        ['id' => '3', 'label' => 'Ratios on Gross Cane',],

    ];
    
    

	const SYN_OUTPUT_REGIONS = [

        'LUZ' => 'LUZON', 
        'NEG' => 'NEGROS', 
        'EV' => 'EASTERN VISAYAS', 
        'PAN' => 'PANAY', 
        'MIN' => 'MINDANAO', 

    ];



    protected $cane_sugar_ton_repo;
    protected $prdn_increment_repo;
    protected $ratios_on_grosscane_repo;



    public function __construct(SynCaneSugarTonInterface $cane_sugar_ton_repo, 
                                SynPRDNIncrementInterface $prdn_increment_repo,
                                SynRatiosOnGrossCaneInterface $ratios_on_grosscane_repo){

		$this->cane_sugar_ton_repo = $cane_sugar_ton_repo;
		$this->prdn_increment_repo = $prdn_increment_repo;
        $this->ratios_on_grosscane_repo = $ratios_on_grosscane_repo;
        
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
                $collection = $this->cane_sugar_ton_repo->getByCropYearId($request->cy);
            }
            
            if($request->cat == '2'){
                $collection = $this->prdn_increment_repo->getByCropYearId($request->cy);
            }
            
            if($request->cat == '3'){
                $collection = $this->ratios_on_grosscane_repo->getByCropYearId($request->cy);
            }

        }

	    return response()->json($collection, 200);

    }



    
}
