<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynCapUtilizationInterface;
use App\Http\Requests\Synopsis\CapUtilizationFormRequest;
use Illuminate\Http\Request;

class ApiSynCapUtilizationController extends Controller{



	protected $syn_cap_utilization_repo;


	public function __construct(SynCapUtilizationInterface $syn_cap_utilization_repo){
		$this->syn_cap_utilization_repo = $syn_cap_utilization_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_cap_utilization_list = $this->syn_cap_utilization_repo->fetch($request);
	    return response()->json($syn_cap_utilization_list, 200);

    }



	public function store(CapUtilizationFormRequest $request){

		$syn_cap_utilization = $this->syn_cap_utilization_repo->store($request);
        $this->event->fire('syn_cap_utilization.store', $syn_cap_utilization);
		return response()->json(['key' => $syn_cap_utilization->slug], 200);

    }



	public function edit($slug){

		$syn_cap_utilization = $this->syn_cap_utilization_repo->findBySlug($slug);
		return response()->json(['data' => $syn_cap_utilization], 200);

    }



	public function update(CapUtilizationFormRequest $request, $slug){

		$syn_cap_utilization = $this->syn_cap_utilization_repo->update($request, $slug);
        $this->event->fire('syn_cap_utilization.update', $syn_cap_utilization);
		return response()->json(['key' => $syn_cap_utilization->slug], 200);

    }



	public function delete($slug){

		$syn_cap_utilization = $this->syn_cap_utilization_repo->destroy($slug);
        $this->event->fire('syn_cap_utilization.destroy', $syn_cap_utilization);
		return response()->json(['success' => true], 200);

    }



    
}
