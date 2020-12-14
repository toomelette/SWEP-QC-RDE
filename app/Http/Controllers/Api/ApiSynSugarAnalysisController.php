<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynSugarAnalysisInterface;
use App\Http\Requests\Synopsis\SugarAnalysisFormRequest;
use Illuminate\Http\Request;

class ApiSynSugarAnalysisController extends Controller{



	protected $syn_sugar_analysis_repo;


	public function __construct(SynSugarAnalysisInterface $syn_sugar_analysis_repo){
		$this->syn_sugar_analysis_repo = $syn_sugar_analysis_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_sugar_analysis_list = $this->syn_sugar_analysis_repo->fetch($request);
	    return response()->json($syn_sugar_analysis_list, 200);

    }



	public function store(SugarAnalysisFormRequest $request){

		$syn_sugar_analysis = $this->syn_sugar_analysis_repo->store($request);
        $this->event->fire('syn_sugar_analysis.store', $syn_sugar_analysis);
		return response()->json(['key' => $syn_sugar_analysis->slug], 200);

    }



	public function edit($slug){

		$syn_sugar_analysis = $this->syn_sugar_analysis_repo->findBySlug($slug);
		return response()->json(['data' => $syn_sugar_analysis], 200);

    }



	public function update(SugarAnalysisFormRequest $request, $slug){

		$syn_sugar_analysis = $this->syn_sugar_analysis_repo->update($request, $slug);
        $this->event->fire('syn_sugar_analysis.update', $syn_sugar_analysis);
		return response()->json(['key' => $syn_sugar_analysis->slug], 200);

    }



	public function delete($slug){

		$syn_sugar_analysis = $this->syn_sugar_analysis_repo->destroy($slug);
        $this->event->fire('syn_sugar_analysis.destroy', $syn_sugar_analysis);
		return response()->json(['success' => true], 200);

    }



    
}
