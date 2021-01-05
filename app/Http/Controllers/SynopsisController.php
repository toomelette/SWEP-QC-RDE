<?php

namespace App\Http\Controllers;

use App\Http\Requests\Synopsis\OutputExportExcelRequest;
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



use App\Exports\Excel\SynCaneSugarTon;
use App\Exports\Excel\SynPRDNIncrement;
use App\Exports\Excel\SynRatiosOnGrossCane;
use App\Exports\Excel\SynCaneAnalysis;
use App\Exports\Excel\SynSugarAnalysis;
use App\Exports\Excel\SynFirstExpressedJuice;
use App\Exports\Excel\SynLastExpressedJuice;
use App\Exports\Excel\SynMixedJuice;
use App\Exports\Excel\SynClarification;
use App\Exports\Excel\SynSyrup;
use App\Exports\Excel\SynBagasse;
use App\Exports\Excel\SynFilterCake;
use App\Exports\Excel\SynMolasses;
use App\Exports\Excel\SynNonSugar;
use App\Exports\Excel\SynCapUtilization;
use App\Exports\Excel\SynMillingPlant;
use App\Exports\Excel\SynBHR;
use App\Exports\Excel\SynOAR;
use App\Exports\Excel\SynBHLoss;
use App\Exports\Excel\SynKgSugarDueBH;
use App\Exports\Excel\SynKgSugarDueCleanCane;
use App\Exports\Excel\SynPotentialRevenue;
use App\Exports\Excel\SynMillingDuration;
use App\Exports\Excel\SynGrindStoppage;
use App\Exports\Excel\SynDetailOfStoppageA;
use App\Exports\Excel\SynDetailOfStoppageB;
use App\Exports\Excel\SynTenYrPrdn;
use App\Exports\Excel\SynTenYrRatioYield;
use App\Exports\Excel\SynTenYrFactoryPerformance;
use App\Exports\Excel\SynTenYrAgriParam;


use Maatwebsite\Excel\Facades\Excel;


class SynopsisController extends Controller{



    protected $cane_sugar_ton_repo;
    protected $prdn_increment;
    protected $ratios_on_grosscane;
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
    
    
	const SYN_OUTPUT_REGIONS = [

        'LUZ' => 'LUZON', 
        'NEG' => 'NEGROS', 
        'EV' => 'EASTERN VISAYAS', 
        'PAN' => 'PANAY', 
        'MIN' => 'MINDANAO', 

    ];



    public function __construct(SynCaneSugarTonInterface $cane_sugar_ton_repo, 
                                SynPRDNIncrementInterface $prdn_increment,
                                SynRatiosOnGrossCaneInterface $ratios_on_grosscane,
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
		$this->prdn_increment = $prdn_increment;
        $this->ratios_on_grosscane = $ratios_on_grosscane;
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



    public function caneSugarTons(){
        return view('dashboard.synopsis.cane_sugar_tons');
    }

    public function prdnIncrement(){
        return view('dashboard.synopsis.prdn_increment');
    }

    public function ratiosOnGrossCane(){
        return view('dashboard.synopsis.ratios_on_gross_cane');
    }

    public function caneAnalysis(){
        return view('dashboard.synopsis.cane_analysis');
    }

    public function sugarAnalysis(){
        return view('dashboard.synopsis.sugar_analysis');
    }

    public function firstExpressedJuice(){
        return view('dashboard.synopsis.first_expressed_juice');
    }

    public function lastExpressedJuice(){
        return view('dashboard.synopsis.last_expressed_juice');
    }

    public function mixedJuice(){
        return view('dashboard.synopsis.mixed_juice');
    }

    public function clarification(){
        return view('dashboard.synopsis.clarification');
    }

    public function syrup(){
        return view('dashboard.synopsis.syrup');
    }

    public function bagasse(){
        return view('dashboard.synopsis.bagasse');
    }

    public function filterCake(){
        return view('dashboard.synopsis.filter_cake');
    }

    public function molasses(){
        return view('dashboard.synopsis.molasses');
    }

    public function nonSugar(){
        return view('dashboard.synopsis.non_sugar');
    }

    public function capUtilization(){
        return view('dashboard.synopsis.cap_utilization');
    }

    public function millingPlant(){
        return view('dashboard.synopsis.milling_plant');
    }

    public function BHR(){
        return view('dashboard.synopsis.bhr');
    }

    public function OAR(){
        return view('dashboard.synopsis.oar');
    }

    public function BHLoss(){
        return view('dashboard.synopsis.bh_loss');
    }

    public function kgSugarDueBH(){
        return view('dashboard.synopsis.kg_sugar_due_bh');
    }

    public function kgSugarDueCleanCane(){
        return view('dashboard.synopsis.kg_sugar_due_clean_cane');
    }

    public function potentialRevenue(){
        return view('dashboard.synopsis.potential_revenue');
    }

    public function millingDuration(){
        return view('dashboard.synopsis.milling_duration');
    }

    public function grindStoppage(){
        return view('dashboard.synopsis.grind_stoppage');
    }

    public function detailOfStoppageA(){
        return view('dashboard.synopsis.detail_of_stoppage_a');
    }

    public function detailOfStoppageB(){
        return view('dashboard.synopsis.detail_of_stoppage_b');
    }

    public function tenYrPrdn(){
        return view('dashboard.synopsis.ten_yr_prdn');
    }

    public function tenYrRatioYield(){
        return view('dashboard.synopsis.ten_yr_ratio_yield');
    }

    public function tenYrFactoryPerformance(){
        return view('dashboard.synopsis.ten_yr_factory_performance');
    }

    public function tenYrAgriParam(){
        return view('dashboard.synopsis.ten_yr_agri_param');
    }

    public function outputs(){
        return view('dashboard.synopsis.outputs');
    }




	public function outputsExportExcel (OutputExportExcelRequest $request){

        if(isset($request->cy_id) && isset($request->cy_name) && isset($request->cat)){
            
            $collection = [];

            switch ($request->cat) {

                case '1':

                    $collection = $this->cane_sugar_ton_repo->getByCropYearId($request->cy_id);
                    $filename = 'Cane-Sugar Tons'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynCaneSugarTon($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '2':

                    $collection = $this->prdn_increment->getByCropYearId($request->cy_id);
                    $filename = 'PRDN-Increment'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynPRDNIncrement($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '3':

                    $collection = $this->ratios_on_grosscane->getByCropYearId($request->cy_id);
                    $filename = 'Ratios on Gross Cane'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynRatiosOnGrossCane($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '4':

                    $collection = $this->cane_analysis_repo->getByCropYearId($request->cy_id);
                    $filename = 'Cane Analysis'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynCaneAnalysis($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '5':

                    $collection = $this->sugar_analysis_repo->getByCropYearId($request->cy_id);
                    $filename = 'Sugar Analysis'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynSugarAnalysis($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '6':

                    $collection = $this->first_expressed_juice_repo->getByCropYearId($request->cy_id);
                    $filename = 'First Expressed Juice'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynFirstExpressedJuice($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '7':

                    $collection = $this->last_expressed_juice_repo->getByCropYearId($request->cy_id);
                    $filename = 'Last Expressed Juice'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynLastExpressedJuice($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '8':

                    $collection = $this->mixed_juice_repo->getByCropYearId($request->cy_id);
                    $filename = 'Mixed Juice'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynMixedJuice($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '9':

                    $collection = $this->clarification_repo->getByCropYearId($request->cy_id);
                    $filename = 'Clarification'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynClarification($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '10':

                    $collection = $this->syrup_repo->getByCropYearId($request->cy_id);
                    $filename = 'Syrup'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynSyrup($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '11':

                    $collection = $this->bagasse_repo->getByCropYearId($request->cy_id);
                    $filename = 'Bagasse'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynBagasse($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '12':

                    $collection = $this->filter_cake_repo->getByCropYearId($request->cy_id);
                    $filename = 'Filter Cake'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynFilterCake($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '13':

                    $collection = $this->molasses_repo->getByCropYearId($request->cy_id);
                    $filename = 'Molasses'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynMolasses($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '14':

                    $collection = $this->non_sugar_repo->getByCropYearId($request->cy_id);
                    $filename = 'Non-Sugar'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynNonSugar($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '15':

                    $collection = $this->cap_utilization_repo->getByCropYearId($request->cy_id);
                    $filename = 'Capacity-Utilization'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynCapUtilization($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '16':

                    $collection = $this->milling_plant_repo->getByCropYearId($request->cy_id);
                    $filename = 'Milling-Plant'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynMillingPlant($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '17':

                    $collection = $this->bhr_repo->getByCropYearId($request->cy_id);
                    $filename = 'BHR'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynBHR($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '18':

                    $collection = $this->oar_repo->getByCropYearId($request->cy_id);
                    $filename = 'OAR'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynOAR($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '19':

                    $collection = $this->bh_loss_repo->getByCropYearId($request->cy_id);
                    $filename = 'BH Loss'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynBHLoss($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '20':

                    $collection = $this->kg_sugar_due_bh_repo->getByCropYearId($request->cy_id);
                    $filename = 'Kgs of Sugar Due BH'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynKgSugarDueBH($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '21':

                    $collection = $this->kg_sugar_due_clean_cane_repo->getByCropYearId($request->cy_id);
                    $filename = 'Kgs of Sugar Due Clean Cane'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynKgSugarDueCleanCane($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '22':

                    $collection = $this->potential_revenue_repo->getByCropYearId($request->cy_id);
                    $filename = 'Potential Revenue'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynPotentialRevenue($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;
                
                case '23':

                    $collection = $this->milling_duration_repo->getByCropYearId($request->cy_id);
                    $filename = 'Milling Duration'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynMillingDuration($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '24':

                    $collection = $this->grind_stoppage_repo->getByCropYearId($request->cy_id);
                    $filename = 'Grind Stoppage'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynGrindStoppage($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '25':

                    $collection = $this->detail_of_stoppage_a_repo->getByCropYearId($request->cy_id);
                    $filename = 'Detail of Stoppage - A'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynDetailOfStoppageA($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '26':

                    $collection = $this->detail_of_stoppage_b_repo->getByCropYearId($request->cy_id);
                    $filename = 'Detail of Stoppage - B'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynDetailOfStoppageB($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
                    break;

                case '27':

                    $collection = $this->ten_yr_prdn_repo->getByCropYearId($request->cy_id);
                    $filename = '10 Year Production Data'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynTenYrPrdn($collection, $request->cy_name), $filename);
                    break;

                case '28':

                    $collection = $this->ten_yr_ratio_yield_repo->getByCropYearId($request->cy_id);
                    $filename = '10 Year Ratio Yield'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynTenYrRatioYield($collection, $request->cy_name), $filename);
                    break;

                case '29':

                    $collection = $this->ten_yr_factory_performance_repo->getByCropYearId($request->cy_id);
                    $filename = '10 Year Factory Performance'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynTenYrFactoryPerformance($collection, $request->cy_name), $filename);
                    break;

                case '30':

                    $collection = $this->ten_yr_agri_param_repo->getByCropYearId($request->cy_id);
                    $filename = '10 Year Agri Parameters'.' - '.$request->cy_name.'.xlsx';
                    return Excel::download(new SynTenYrAgriParam($collection, $request->cy_name), $filename);
                    break;

                default:

                    abort(404);
                    break;

            }


        }else{

            return abort(404);

        }

    }




	public function outputsPrint (OutputExportExcelRequest $request){

        if(isset($request->cy_id) && isset($request->cy_name) && isset($request->cat)){
            
            $collection = [];

            switch ($request->cat) {

                case '1':

                    $collection = $this->cane_sugar_ton_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.cane_sugar_tons_print')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '2':

                    $collection = $this->prdn_increment->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.prdn_increment')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '3':

                    $collection = $this->ratios_on_grosscane->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.ratios_on_grosscane')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;
                
                case '4':

                    $collection = $this->cane_analysis_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.cane_analysis')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;
                
                case '5':

                    $collection = $this->sugar_analysis_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.sugar_analysis')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;
                
                case '6':

                    $collection = $this->first_expressed_juice_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.first_expressed_juice')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;
                
                case '7':

                    $collection = $this->last_expressed_juice_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.last_expressed_juice')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;
                
                case '8':
                    
                    $collection = $this->mixed_juice_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.mixed_juice')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;
                
                case '9':

                    $collection = $this->clarification_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.clarification')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;
                
                case '10':

                    $collection = $this->syrup_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.syrup')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;
                
                case '11':

                    $collection = $this->bagasse_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.bagasse')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;
                
                case '12':

                    $collection = $this->filter_cake_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.filter_cake')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;
                
                case '13':

                    $collection = $this->molasses_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.molasses')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;
                
                case '14':

                    $collection = $this->non_sugar_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.non_sugar')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '15':

                    $collection = $this->cap_utilization_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.cap_utilization')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '16':

                    $collection = $this->milling_plant_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.milling_plant')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '17':

                    $collection = $this->bhr_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.bhr')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '18':

                    $collection = $this->oar_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.oar')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '19':

                    $collection = $this->bh_loss_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.bh_loss')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '20':

                    $collection = $this->kg_sugar_due_bh_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.kg_sugar_due_bh')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '21':

                    $collection = $this->kg_sugar_due_clean_cane_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.kg_sugar_due_clean_cane')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '22':

                    $collection = $this->potential_revenue_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.potential_revenue')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '23':

                    $collection = $this->milling_duration_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.milling_duration')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '24':

                    $collection = $this->grind_stoppage_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.grind_stoppage')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '25':

                    $collection = $this->detail_of_stoppage_a_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.detail_of_stoppage_a')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '26':

                    $collection = $this->detail_of_stoppage_b_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.detail_of_stoppage_b')->with([
                        'collection' => $collection,
                        'regions' => self::SYN_OUTPUT_REGIONS,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '27':

                    $collection = $this->ten_yr_prdn_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.ten_yr_prdn')->with([
                        'collection' => $collection,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '28':

                    $collection = $this->ten_yr_ratio_yield_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.ten_yr_ratio_yield')->with([
                        'collection' => $collection,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '29':

                    $collection = $this->ten_yr_factory_performance_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.ten_yr_factory_performance')->with([
                        'collection' => $collection,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                case '30':

                    $collection = $this->ten_yr_agri_param_repo->getByCropYearId($request->cy_id);
                    return view('printables.synopsis.ten_yr_agri_param')->with([
                        'collection' => $collection,
                        'crop_year' => $request->cy_name
                    ]);
                    break;

                default:

                    abort(404);
                    break;

            }

        }else{

            return abort(404);

        }

    }

    


}
