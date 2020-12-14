<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynCaneAnalysisInterface;
use App\Http\Requests\Synopsis\CaneAnalysisFormRequest;
use Illuminate\Http\Request;

class ApiSynCaneAnalysisController extends Controller{



	protected $syn_cane_analysis_repo;


	public function __construct(SynCaneAnalysisInterface $syn_cane_analysis_repo){
		$this->syn_cane_analysis_repo = $syn_cane_analysis_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_cane_analysis_list = $this->syn_cane_analysis_repo->fetch($request);
	    return response()->json($syn_cane_analysis_list, 200);

    }



	public function store(CaneAnalysisFormRequest $request){

		$syn_cane_analysis = $this->syn_cane_analysis_repo->store($request);
        $this->event->fire('syn_cane_analysis.store', $syn_cane_analysis);
		return response()->json(['key' => $syn_cane_analysis->slug], 200);

    }



	public function edit($slug){

		$syn_cane_analysis = $this->syn_cane_analysis_repo->findBySlug($slug);
		return response()->json(['data' => $syn_cane_analysis], 200);

    }



	public function update(CaneAnalysisFormRequest $request, $slug){

		$syn_cane_analysis = $this->syn_cane_analysis_repo->update($request, $slug);
        $this->event->fire('syn_cane_analysis.update', $syn_cane_analysis);
		return response()->json(['key' => $syn_cane_analysis->slug], 200);

    }



	public function delete($slug){

		$syn_cane_analysis = $this->syn_cane_analysis_repo->destroy($slug);
        $this->event->fire('syn_cane_analysis.destroy', $syn_cane_analysis);
		return response()->json(['success' => true], 200);

    }



    
}
