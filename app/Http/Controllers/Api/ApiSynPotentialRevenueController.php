<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynPotentialRevenueInterface;
use App\Http\Requests\Synopsis\PotentialRevenueFormRequest;
use Illuminate\Http\Request;

class ApiSynPotentialRevenueController extends Controller{



	protected $syn_potential_revenue_repo;


	public function __construct(SynPotentialRevenueInterface $syn_potential_revenue_repo){
		$this->syn_potential_revenue_repo = $syn_potential_revenue_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_potential_revenue_list = $this->syn_potential_revenue_repo->fetch($request);
	    return response()->json($syn_potential_revenue_list, 200);

    }



	public function store(PotentialRevenueFormRequest $request){

		$syn_potential_revenue = $this->syn_potential_revenue_repo->store($request);
        $this->event->fire('syn_potential_revenue.store', $syn_potential_revenue);
		return response()->json(['key' => $syn_potential_revenue->slug], 200);

    }



	public function edit($slug){

		$syn_potential_revenue = $this->syn_potential_revenue_repo->findBySlug($slug);
		return response()->json(['data' => $syn_potential_revenue], 200);

    }



	public function update(PotentialRevenueFormRequest $request, $slug){

		$syn_potential_revenue = $this->syn_potential_revenue_repo->update($request, $slug);
        $this->event->fire('syn_potential_revenue.update', $syn_potential_revenue);
		return response()->json(['key' => $syn_potential_revenue->slug], 200);

    }



	public function delete($slug){

		$syn_potential_revenue = $this->syn_potential_revenue_repo->destroy($slug);
        $this->event->fire('syn_potential_revenue.destroy', $syn_potential_revenue);
		return response()->json(['success' => true], 200);

    }



    
}
