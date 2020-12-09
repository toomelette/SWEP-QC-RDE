<?php

namespace App\Http\Controllers;

use App\Http\Requests\Synopsis\OutputExportExcelRequest;
use App\Core\Interfaces\SynCaneSugarTonInterface;

use App\Exports\Excel\SynCaneSugarTon;

use Maatwebsite\Excel\Facades\Excel;


class SynopsisController extends Controller{



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



    public function caneSugarTons(){
        return view('dashboard.synopsis.cane_sugar_tons');
    }



    public function ratiosOnGrossCane(){
        return view('dashboard.synopsis.ratios_on_gross_cane');
    }

    

    public function outputs(){
        return view('dashboard.synopsis.outputs');
    }



	public function outputsExportExcel (OutputExportExcelRequest $request){

        if(isset($request->cy_id) && isset($request->cy_name) && isset($request->cat)){
            
            $collection = [];
            $category = self::SYN_OUTPUT_CATEGORIES[$request->cat];
            $filename = $category['label'].'-'.$request->cy_name.'.xlsx';

            if($request->cat == '1'){
                $collection = $this->syn_cane_sugar_ton_repo->getByCropYearId($request->cy_id);
                return Excel::download(new SynCaneSugarTon($collection, self::SYN_OUTPUT_REGIONS, $request->cy_name), $filename);
            }

        }else{

            return abort(404);

        }

    }



	public function outputsPrint (OutputExportExcelRequest $request){

        if(isset($request->cy_id) && isset($request->cy_name) && isset($request->cat)){
            
            $collection = [];
            $category = self::SYN_OUTPUT_CATEGORIES[$request->cat];
            $filename = $category['label'].'-'.$request->cy_name.'.xlsx';

            if($request->cat == '1'){
                $collection = $this->syn_cane_sugar_ton_repo->getByCropYearId($request->cy_id);
                return view('printables.synopsis.cane_sugar_tons_print')->with([
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
