<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynPRDNIncrementInterface;
use App\Http\Requests\Synopsis\PRDNIncrementFormRequest;
use Illuminate\Http\Request;

class ApiSynPRDNIncrementController extends Controller{



	protected $syn_prdn_increment_repo;


	public function __construct(SynPRDNIncrementInterface $syn_prdn_increment_repo){
		$this->syn_prdn_increment_repo = $syn_prdn_increment_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_prdn_increment_list = $this->syn_prdn_increment_repo->fetch($request);
	    return response()->json($syn_prdn_increment_list, 200);

    }



	public function store(PRDNIncrementFormRequest $request){

		$syn_prdn_increment = $this->syn_prdn_increment_repo->store($request);
        $this->event->fire('syn_prdn_increment.store', $syn_prdn_increment);
		return response()->json(['key' => $syn_prdn_increment->slug], 200);

    }



	public function edit($slug){

		$syn_prdn_increment = $this->syn_prdn_increment_repo->findBySlug($slug);
		return response()->json(['data' => $syn_prdn_increment], 200);

    }



	public function update(PRDNIncrementFormRequest $request, $slug){

		$syn_prdn_increment = $this->syn_prdn_increment_repo->update($request, $slug);
        $this->event->fire('syn_prdn_increment.update', $syn_prdn_increment);
		return response()->json(['key' => $syn_prdn_increment->slug], 200);

    }



	public function delete($slug){

		$syn_prdn_increment = $this->syn_prdn_increment_repo->destroy($slug);
        $this->event->fire('syn_prdn_increment.destroy', $syn_prdn_increment);
		return response()->json(['success' => true], 200);

    }



    
}
