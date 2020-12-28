<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynTenYrPrdnInterface;
use App\Http\Requests\Synopsis\TenYrPrdnFormRequest;
use Illuminate\Http\Request;

class ApiSynTenYrPrdnController extends Controller{



	protected $syn_ten_yr_prdn_repo;


	public function __construct(SynTenYrPrdnInterface $syn_ten_yr_prdn_repo){
		$this->syn_ten_yr_prdn_repo = $syn_ten_yr_prdn_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_ten_yr_prdn_list = $this->syn_ten_yr_prdn_repo->fetch($request);
	    return response()->json($syn_ten_yr_prdn_list, 200);

    }



	public function store(TenYrPrdnFormRequest $request){

		$syn_ten_yr_prdn = $this->syn_ten_yr_prdn_repo->store($request);
        $this->event->fire('syn_ten_yr_prdn.store', $syn_ten_yr_prdn);
		return response()->json(['key' => $syn_ten_yr_prdn->slug], 200);

    }



	public function edit($slug){

		$syn_ten_yr_prdn = $this->syn_ten_yr_prdn_repo->findBySlug($slug);
		return response()->json(['data' => $syn_ten_yr_prdn], 200);

    }



	public function update(TenYrPrdnFormRequest $request, $slug){

		$syn_ten_yr_prdn = $this->syn_ten_yr_prdn_repo->update($request, $slug);
        $this->event->fire('syn_ten_yr_prdn.update', $syn_ten_yr_prdn);
		return response()->json(['key' => $syn_ten_yr_prdn->slug], 200);

    }



	public function delete($slug){

		$syn_ten_yr_prdn = $this->syn_ten_yr_prdn_repo->destroy($slug);
        $this->event->fire('syn_ten_yr_prdn.destroy', $syn_ten_yr_prdn);
		return response()->json(['success' => true], 200);

    }



    
}
