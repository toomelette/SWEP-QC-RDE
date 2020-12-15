<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Synopsis\OutputFilterRequest;

use App\Core\Interfaces\SynCaneSugarTonInterface;
use App\Core\Interfaces\SynPRDNIncrementInterface;
use App\Core\Interfaces\SynRatiosOnGrossCaneInterface;
use App\Core\Interfaces\SynCaneAnalysisInterface;
use App\Core\Interfaces\SynSugarAnalysisInterface;
use App\Core\Interfaces\SynFirstExpressedJuiceInterface;
use App\Core\Interfaces\SynLastExpressedJuiceInterface;
use App\Core\Interfaces\SynMixedJuiceInterface;
use App\Core\Interfaces\SynClarificationInterface;
use App\Core\Interfaces\SynSyrupInterface;

class ApiSynOutputController extends Controller{
    
    

	const SYN_OUTPUT_CATEGORIES = [

        ['id' => '1', 'label' => 'Cane-Sugar Tons',],
        ['id' => '2', 'label' => 'Production Increment',],
        ['id' => '3', 'label' => 'Ratios on Gross Cane',],
        ['id' => '4', 'label' => 'Cane Analyses',],
        ['id' => '5', 'label' => 'Sugar Analyses',],
        ['id' => '6', 'label' => 'First Expressed Juice',],
        ['id' => '7', 'label' => 'Last Expressed Juice',],
        ['id' => '8', 'label' => 'Mixed Juice',],
        ['id' => '9', 'label' => 'Clarification',],
        ['id' => '10', 'label' => 'Syrup',],

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
    protected $cane_analysis_repo;
    protected $sugar_analysis_repo;
    protected $first_expressed_juice_repo;
    protected $last_expressed_juice_repo;
    protected $mixed_juice_repo;
    protected $clarification_repo;
    protected $syrup_repo;



    public function __construct(SynCaneSugarTonInterface $cane_sugar_ton_repo, 
                                SynPRDNIncrementInterface $prdn_increment_repo,
                                SynRatiosOnGrossCaneInterface $ratios_on_grosscane_repo,
                                SynCaneAnalysisInterface $cane_analysis_repo,
                                SynSugarAnalysisInterface $sugar_analysis_repo,
                                SynFirstExpressedJuiceInterface $first_expressed_juice_repo,
                                SynLastExpressedJuiceInterface $last_expressed_juice_repo,
                                SynMixedJuiceInterface $mixed_juice_repo,
                                SynClarificationInterface $clarification_repo,
                                SynSyrupInterface $syrup_repo){

		$this->cane_sugar_ton_repo = $cane_sugar_ton_repo;
		$this->prdn_increment_repo = $prdn_increment_repo;
        $this->ratios_on_grosscane_repo = $ratios_on_grosscane_repo;
        $this->cane_analysis_repo = $cane_analysis_repo;
        $this->sugar_analysis_repo = $sugar_analysis_repo;
        $this->first_expressed_juice_repo = $first_expressed_juice_repo;
        $this->last_expressed_juice_repo = $last_expressed_juice_repo;
        $this->mixed_juice_repo = $mixed_juice_repo;
        $this->clarification_repo = $clarification_repo;
        $this->syrup_repo = $syrup_repo;
        
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

        switch ($request->cat) {

            case '1':
                $collection = $this->cane_sugar_ton_repo->getByCropYearId($request->cy);
                break;

            case '2':
                $collection = $this->prdn_increment_repo->getByCropYearId($request->cy);
                break;

            case '3':
                $collection = $this->ratios_on_grosscane_repo->getByCropYearId($request->cy);
                break;
            
            case '4':
                $collection = $this->cane_analysis_repo->getByCropYearId($request->cy);
                break;
            
            case '5':
                $collection = $this->sugar_analysis_repo->getByCropYearId($request->cy);
                break;
            
            case '6':
                $collection = $this->first_expressed_juice_repo->getByCropYearId($request->cy);
                break;
            
            case '7':
                $collection = $this->last_expressed_juice_repo->getByCropYearId($request->cy);
                break;
            
            case '8':
                $collection = $this->mixed_juice_repo->getByCropYearId($request->cy);
                break;
            
            case '9':
                $collection = $this->clarification_repo->getByCropYearId($request->cy);
                break;
            
            case '10':
                $collection = $this->syrup_repo->getByCropYearId($request->cy);
                break;

            default:
                $collection = [];
                break;

        }

        return response()->json($collection, 200);

    }



    
}
