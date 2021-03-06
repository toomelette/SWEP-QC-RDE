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
use App\Core\Interfaces\SynBagasseInterface;
use App\Core\Interfaces\SynFilterCakeInterface;
use App\Core\Interfaces\SynMolassesInterface;
use App\Core\Interfaces\SynNonSugarInterface;
use App\Core\Interfaces\SynCapUtilizationInterface;
use App\Core\Interfaces\SynMillingPlantInterface;
use App\Core\Interfaces\SynBHRInterface;
use App\Core\Interfaces\SynOARInterface;
use App\Core\Interfaces\SynBHLossInterface;
use App\Core\Interfaces\SynKgSugarDueBHInterface;
use App\Core\Interfaces\SynKgSugarDueCleanCaneInterface;
use App\Core\Interfaces\SynPotentialRevenueInterface;
use App\Core\Interfaces\SynMillingDurationInterface;
use App\Core\Interfaces\SynGrindStoppageInterface;
use App\Core\Interfaces\SynDetailOfStoppageAInterface;
use App\Core\Interfaces\SynDetailOfStoppageBInterface;
use App\Core\Interfaces\SynTenYrPrdnInterface;
use App\Core\Interfaces\SynTenYrRatioYieldInterface;
use App\Core\Interfaces\SynTenYrFactoryPerformanceInterface;
use App\Core\Interfaces\SynTenYrAgriParamInterface;

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
        ['id' => '11', 'label' => 'Bagasse',],
        ['id' => '12', 'label' => 'Filter Cake',],
        ['id' => '13', 'label' => 'Molasses',],
        ['id' => '14', 'label' => 'Non Sugar',],
        ['id' => '15', 'label' => 'Capacity Utilization',],
        ['id' => '16', 'label' => 'Milling Plant',],
        ['id' => '17', 'label' => 'BHR',],
        ['id' => '18', 'label' => 'OAR',],
        ['id' => '19', 'label' => 'BH Losses',],
        ['id' => '20', 'label' => 'Kgs of Sugar Due BH',],
        ['id' => '21', 'label' => 'Kgs of Sugar Due Clean Cane',],
        ['id' => '22', 'label' => 'Potential Revenue',],
        ['id' => '23', 'label' => 'Milling Duration',],
        ['id' => '24', 'label' => 'Grinding Stoppages',],
        ['id' => '25', 'label' => 'Detail of Stoppage - A',],
        ['id' => '26', 'label' => 'Detail of Stoppage - B',],
        ['id' => '27', 'label' => '10 Year Production Data',],
        ['id' => '28', 'label' => '10 Year Ratio Yield',],
        ['id' => '29', 'label' => '10 Year Factory Performance',],
        ['id' => '30', 'label' => '10 Year Agri Parameters',],

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
    protected $bagasse_repo;
    protected $filter_cake_repo;
    protected $molasses_repo;
    protected $non_sugar_repo;
    protected $cap_utilization_repo;
    protected $milling_plant_repo;
    protected $bhr_repo;
    protected $oar_repo;
    protected $bh_loss_repo;
    protected $kg_sugar_due_bh_repo;
    protected $kg_sugar_due_clean_cane_repo;
    protected $potential_revenue_repo;
    protected $milling_duration_repo;
    protected $grind_stoppage_repo;
    protected $detail_of_stoppage_a_repo;
    protected $detail_of_stoppage_b_repo;
    protected $ten_yr_prdn_repo;
    protected $ten_yr_ratio_yield_repo;
    protected $ten_yr_factory_performance_repo;
    protected $ten_yr_agri_param_repo;



    public function __construct(SynCaneSugarTonInterface $cane_sugar_ton_repo, 
                                SynPRDNIncrementInterface $prdn_increment_repo,
                                SynRatiosOnGrossCaneInterface $ratios_on_grosscane_repo,
                                SynCaneAnalysisInterface $cane_analysis_repo,
                                SynSugarAnalysisInterface $sugar_analysis_repo,
                                SynFirstExpressedJuiceInterface $first_expressed_juice_repo,
                                SynLastExpressedJuiceInterface $last_expressed_juice_repo,
                                SynMixedJuiceInterface $mixed_juice_repo,
                                SynClarificationInterface $clarification_repo,
                                SynSyrupInterface $syrup_repo,
                                SynBagasseInterface $bagasse_repo,
                                SynFilterCakeInterface $filter_cake_repo,
                                SynMolassesInterface $molasses_repo,
                                SynNonSugarInterface $non_sugar_repo,
                                SynCapUtilizationInterface $cap_utilization_repo,
                                SynMillingPlantInterface $milling_plant_repo,
                                SynBHRInterface $bhr_repo,
                                SynOARInterface $oar_repo,
                                SynBHLossInterface $bh_loss_repo,
                                SynKgSugarDueBHInterface $kg_sugar_due_bh_repo,
                                SynKgSugarDueCleanCaneInterface $kg_sugar_due_clean_cane_repo,
                                SynPotentialRevenueInterface $potential_revenue_repo,
                                SynMillingDurationInterface $milling_duration_repo,
                                SynGrindStoppageInterface $grind_stoppage_repo,
                                SynDetailOfStoppageAInterface $detail_of_stoppage_a_repo,
                                SynDetailOfStoppageBInterface $detail_of_stoppage_b_repo,
                                SynTenYrPrdnInterface $ten_yr_prdn_repo,
                                SynTenYrRatioYieldInterface $ten_yr_ratio_yield_repo,
                                SynTenYrFactoryPerformanceInterface $ten_yr_factory_performance_repo,
                                SynTenYrAgriParamInterface $ten_yr_agri_param_repo){

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
        $this->bagasse_repo = $bagasse_repo;
        $this->filter_cake_repo = $filter_cake_repo;
        $this->molasses_repo = $molasses_repo;
        $this->non_sugar_repo = $non_sugar_repo;
        $this->cap_utilization_repo = $cap_utilization_repo;
        $this->milling_plant_repo = $milling_plant_repo;
        $this->bhr_repo = $bhr_repo;
        $this->oar_repo = $oar_repo;
        $this->bh_loss_repo = $bh_loss_repo;
        $this->kg_sugar_due_bh_repo = $kg_sugar_due_bh_repo;
        $this->kg_sugar_due_clean_cane_repo = $kg_sugar_due_clean_cane_repo;
        $this->potential_revenue_repo = $potential_revenue_repo;
        $this->milling_duration_repo = $milling_duration_repo;
        $this->grind_stoppage_repo = $grind_stoppage_repo;
        $this->detail_of_stoppage_a_repo = $detail_of_stoppage_a_repo;
        $this->detail_of_stoppage_b_repo = $detail_of_stoppage_b_repo;
        $this->ten_yr_prdn_repo = $ten_yr_prdn_repo;
        $this->ten_yr_ratio_yield_repo = $ten_yr_ratio_yield_repo;
        $this->ten_yr_factory_performance_repo = $ten_yr_factory_performance_repo;
        $this->ten_yr_agri_param_repo = $ten_yr_agri_param_repo;
        
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
            
            case '11':
                $collection = $this->bagasse_repo->getByCropYearId($request->cy);
                break;

            
            case '12':
                $collection = $this->filter_cake_repo->getByCropYearId($request->cy);
                break;
                
            
            case '13':
                $collection = $this->molasses_repo->getByCropYearId($request->cy);
                break;
                
            
            case '14':
                $collection = $this->non_sugar_repo->getByCropYearId($request->cy);
                break;


            case '15':
                $collection = $this->cap_utilization_repo->getByCropYearId($request->cy);
                break;


            case '16':
                $collection = $this->milling_plant_repo->getByCropYearId($request->cy);
                break;


            case '17':
                $collection = $this->bhr_repo->getByCropYearId($request->cy);
                break;


            case '18':
                $collection = $this->oar_repo->getByCropYearId($request->cy);
                break;


            case '19':
                $collection = $this->bh_loss_repo->getByCropYearId($request->cy);
                break;

            case '20':
                $collection = $this->kg_sugar_due_bh_repo->getByCropYearId($request->cy);
                break;

            case '21':
                $collection = $this->kg_sugar_due_clean_cane_repo->getByCropYearId($request->cy);
                break;

            case '22':
                $collection = $this->potential_revenue_repo->getByCropYearId($request->cy);
                break;

            case '23':
                $collection = $this->milling_duration_repo->getByCropYearId($request->cy);
                break;

            case '24':
                $collection = $this->grind_stoppage_repo->getByCropYearId($request->cy);
                break;

            case '25':
                $collection = $this->detail_of_stoppage_a_repo->getByCropYearId($request->cy);
                break;

            case '26':
                $collection = $this->detail_of_stoppage_b_repo->getByCropYearId($request->cy);
                break;

            case '27':
                $collection = $this->ten_yr_prdn_repo->getByCropYearId($request->cy);
                break;

            case '28':
                $collection = $this->ten_yr_ratio_yield_repo->getByCropYearId($request->cy);
                break;

            case '29':
                $collection = $this->ten_yr_factory_performance_repo->getByCropYearId($request->cy);
                break;

            case '30':
                $collection = $this->ten_yr_agri_param_repo->getByCropYearId($request->cy);
                break;

            default:
                $collection = [];
                break;

        }

        return response()->json($collection, 200);

    }



    
}
