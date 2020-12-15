<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynClarificationInterface;
use App\Http\Requests\Synopsis\ClarificationFormRequest;
use Illuminate\Http\Request;

class ApiSynClarificationController extends Controller{



	protected $syn_clarification_repo;


	public function __construct(SynClarificationInterface $syn_clarification_repo){
		$this->syn_clarification_repo = $syn_clarification_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_clarification_list = $this->syn_clarification_repo->fetch($request);
	    return response()->json($syn_clarification_list, 200);

    }



	public function store(ClarificationFormRequest $request){

		$syn_clarification = $this->syn_clarification_repo->store($request);
        $this->event->fire('syn_clarification.store', $syn_clarification);
		return response()->json(['key' => $syn_clarification->slug], 200);

    }



	public function edit($slug){

		$syn_clarification = $this->syn_clarification_repo->findBySlug($slug);
		return response()->json(['data' => $syn_clarification], 200);

    }



	public function update(ClarificationFormRequest $request, $slug){

		$syn_clarification = $this->syn_clarification_repo->update($request, $slug);
        $this->event->fire('syn_clarification.update', $syn_clarification);
		return response()->json(['key' => $syn_clarification->slug], 200);

    }



	public function delete($slug){

		$syn_clarification = $this->syn_clarification_repo->destroy($slug);
        $this->event->fire('syn_clarification.destroy', $syn_clarification);
		return response()->json(['success' => true], 200);

    }



    
}
