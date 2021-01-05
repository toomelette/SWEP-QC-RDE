<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynTenYrFactoryPerformanceInterface;
use App\Http\Requests\Synopsis\TenYrFactoryPerformanceFormRequest;
use Illuminate\Http\Request;

class ApiSynTenYrFactoryPerformanceController extends Controller{



	protected $syn_ten_yr_factory_performance_repo;


	public function __construct(SynTenYrFactoryPerformanceInterface $syn_ten_yr_factory_performance_repo){
		$this->syn_ten_yr_factory_performance_repo = $syn_ten_yr_factory_performance_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_ten_yr_factory_performance_list = $this->syn_ten_yr_factory_performance_repo->fetch($request);
	    return response()->json($syn_ten_yr_factory_performance_list, 200);

    }



	public function store(TenYrFactoryPerformanceFormRequest $request){

		$syn_ten_yr_factory_performance = $this->syn_ten_yr_factory_performance_repo->store($request);
        $this->event->fire('syn_ten_yr_factory_performance.store', $syn_ten_yr_factory_performance);
		return response()->json(['key' => $syn_ten_yr_factory_performance->slug], 200);

    }



	public function edit($slug){

		$syn_ten_yr_factory_performance = $this->syn_ten_yr_factory_performance_repo->findBySlug($slug);
		return response()->json(['data' => $syn_ten_yr_factory_performance], 200);

    }



	public function update(TenYrFactoryPerformanceFormRequest $request, $slug){

		$syn_ten_yr_factory_performance = $this->syn_ten_yr_factory_performance_repo->update($request, $slug);
        $this->event->fire('syn_ten_yr_factory_performance.update', $syn_ten_yr_factory_performance);
		return response()->json(['key' => $syn_ten_yr_factory_performance->slug], 200);

    }



	public function delete($slug){

		$syn_ten_yr_factory_performance = $this->syn_ten_yr_factory_performance_repo->destroy($slug);
        $this->event->fire('syn_ten_yr_factory_performance.destroy', $syn_ten_yr_factory_performance);
		return response()->json(['success' => true], 200);

    }



    
}
