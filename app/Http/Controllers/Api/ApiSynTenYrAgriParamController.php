<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynTenYrAgriParamInterface;
use App\Http\Requests\Synopsis\TenYrAgriParamFormRequest;
use Illuminate\Http\Request;

class ApiSynTenYrAgriParamController extends Controller{



	protected $syn_ten_yr_agri_param_repo;


	public function __construct(SynTenYrAgriParamInterface $syn_ten_yr_agri_param_repo){
		$this->syn_ten_yr_agri_param_repo = $syn_ten_yr_agri_param_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_ten_yr_agri_param_list = $this->syn_ten_yr_agri_param_repo->fetch($request);
	    return response()->json($syn_ten_yr_agri_param_list, 200);

    }



	// public function store(TenYrAgriParamFormRequest $request){

	// 	$syn_ten_yr_agri_param = $this->syn_ten_yr_agri_param_repo->store($request);
    //     $this->event->fire('syn_ten_yr_agri_param.store', $syn_ten_yr_agri_param);
	// 	return response()->json(['key' => $syn_ten_yr_agri_param->slug], 200);

    // }



	// public function edit($slug){

	// 	$syn_ten_yr_agri_param = $this->syn_ten_yr_agri_param_repo->findBySlug($slug);
	// 	return response()->json(['data' => $syn_ten_yr_agri_param], 200);

    // }



	// public function update(TenYrAgriParamFormRequest $request, $slug){

	// 	$syn_ten_yr_agri_param = $this->syn_ten_yr_agri_param_repo->update($request, $slug);
    //     $this->event->fire('syn_ten_yr_agri_param.update', $syn_ten_yr_agri_param);
	// 	return response()->json(['key' => $syn_ten_yr_agri_param->slug], 200);

    // }



	// public function delete($slug){

	// 	$syn_ten_yr_agri_param = $this->syn_ten_yr_agri_param_repo->destroy($slug);
    //     $this->event->fire('syn_ten_yr_agri_param.destroy', $syn_ten_yr_agri_param);
	// 	return response()->json(['success' => true], 200);

    // }



    
}
