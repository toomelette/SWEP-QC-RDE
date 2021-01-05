<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynTenYrRatioYieldInterface;
use App\Http\Requests\Synopsis\TenYrRatioYieldFormRequest;
use Illuminate\Http\Request;

class ApiSynTenYrRatioYieldController extends Controller{



	protected $syn_ten_yr_ratio_yield_repo;


	public function __construct(SynTenYrRatioYieldInterface $syn_ten_yr_ratio_yield_repo){
		$this->syn_ten_yr_ratio_yield_repo = $syn_ten_yr_ratio_yield_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_ten_yr_ratio_yield_list = $this->syn_ten_yr_ratio_yield_repo->fetch($request);
	    return response()->json($syn_ten_yr_ratio_yield_list, 200);

    }



	public function store(TenYrRatioYieldFormRequest $request){

		$syn_ten_yr_ratio_yield = $this->syn_ten_yr_ratio_yield_repo->store($request);
        $this->event->fire('syn_ten_yr_ratio_yield.store', $syn_ten_yr_ratio_yield);
		return response()->json(['key' => $syn_ten_yr_ratio_yield->slug], 200);

    }



	public function edit($slug){

		$syn_ten_yr_ratio_yield = $this->syn_ten_yr_ratio_yield_repo->findBySlug($slug);
		return response()->json(['data' => $syn_ten_yr_ratio_yield], 200);

    }



	public function update(TenYrRatioYieldFormRequest $request, $slug){

		$syn_ten_yr_ratio_yield = $this->syn_ten_yr_ratio_yield_repo->update($request, $slug);
        $this->event->fire('syn_ten_yr_ratio_yield.update', $syn_ten_yr_ratio_yield);
		return response()->json(['key' => $syn_ten_yr_ratio_yield->slug], 200);

    }



	public function delete($slug){

		$syn_ten_yr_ratio_yield = $this->syn_ten_yr_ratio_yield_repo->destroy($slug);
        $this->event->fire('syn_ten_yr_ratio_yield.destroy', $syn_ten_yr_ratio_yield);
		return response()->json(['success' => true], 200);

    }



    
}
