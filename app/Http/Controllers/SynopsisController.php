<?php

namespace App\Http\Controllers;

use App\Http\Requests\Synopsis\OutputExportExcelRequest;
use App\Core\Interfaces\SynCaneSugarTonInterface;
use App\Core\Interfaces\SynPRDNIncrementInterface;
use App\Core\Interfaces\SynRatiosOnGrossCaneInterface;

use App\Exports\Excel\SynCaneSugarTon;
use App\Exports\Excel\SynPRDNIncrement;
use App\Exports\Excel\SynRatiosOnGrossCane;

use Maatwebsite\Excel\Facades\Excel;


class SynopsisController extends Controller{



    protected $cane_sugar_ton_repo;
    protected $prdn_increment;
    protected $ratios_on_grosscane;
    
    

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



    public function __construct(SynCaneSugarTonInterface $cane_sugar_ton_repo, 
                                SynPRDNIncrementInterface $prdn_increment,
                                SynRatiosOnGrossCaneInterface $ratios_on_grosscane){

		$this->cane_sugar_ton_repo = $cane_sugar_ton_repo;
		$this->prdn_increment = $prdn_increment;
        $this->ratios_on_grosscane = $ratios_on_grosscane;
        
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

    public function outputs(){
        return view('dashboard.synopsis.outputs');
    }




	public function outputsExportExcel (OutputExportExcelRequest $request){

        if(isset($request->cy_id) && isset($request->cy_name) && isset($request->cat)){
            
            $collection = [];

            if($request->cat == '1'){
                $collection = $this->cane_sugar_ton_repo->getByCropYearId($request->cy_id);
                $filename = 'Cane-Sugar Tons'.' - '.$request->cy_name.'.xlsx';
                return Excel::download(new SynCaneSugarTon($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
            }
            
            if($request->cat == '2'){
                $collection = $this->prdn_increment->getByCropYearId($request->cy_id);
                $filename = 'PRDN-Increment'.' - '.$request->cy_name.'.xlsx';
                return Excel::download(new SynPRDNIncrement($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
            }
            
            if($request->cat == '3'){
                $collection = $this->ratios_on_grosscane->getByCropYearId($request->cy_id);
                $filename = 'Ratios on Gross Cane'.' - '.$request->cy_name.'.xlsx';
                return Excel::download(new SynRatiosOnGrossCane($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
            }
        

        }else{

            return abort(404);

        }

    }




	public function outputsPrint (OutputExportExcelRequest $request){

        if(isset($request->cy_id) && isset($request->cy_name) && isset($request->cat)){
            
            $collection = [];

            if($request->cat == '1'){
                $collection = $this->cane_sugar_ton_repo->getByCropYearId($request->cy_id);
                return view('printables.synopsis.cane_sugar_tons_print')->with([
                    'collection' => $collection,
                    'regions' => self::SYN_OUTPUT_REGIONS,
                    'crop_year' => $request->cy_name
                ]);
            }

            if($request->cat == '2'){
                $collection = $this->prdn_increment->getByCropYearId($request->cy_id);
                return view('printables.synopsis.prdn_increment')->with([
                    'collection' => $collection,
                    'regions' => self::SYN_OUTPUT_REGIONS,
                    'crop_year' => $request->cy_name
                ]);
            }

            if($request->cat == '3'){
                $collection = $this->ratios_on_grosscane->getByCropYearId($request->cy_id);
                return view('printables.synopsis.ratios_on_grosscane')->with([
                    'collection' => $collection,
                    'regions' => self::SYN_OUTPUT_REGIONS,
                    'crop_year' => $request->cy_name
                ]);
            }

        }else{

            return abort(404);

        }

    }

    


}
