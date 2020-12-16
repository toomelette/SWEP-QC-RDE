<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynNonSugarInterface;
use App\Http\Requests\Synopsis\NonSugarFormRequest;
use Illuminate\Http\Request;

class ApiSynNonSugarController extends Controller{



	protected $syn_non_sugar_repo;


	public function __construct(SynNonSugarInterface $syn_non_sugar_repo){
		$this->syn_non_sugar_repo = $syn_non_sugar_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_non_sugar_list = $this->syn_non_sugar_repo->fetch($request);
	    return response()->json($syn_non_sugar_list, 200);

    }



	public function store(NonSugarFormRequest $request){

		$syn_non_sugar = $this->syn_non_sugar_repo->store($request);
        $this->event->fire('syn_non_sugar.store', $syn_non_sugar);
		return response()->json(['key' => $syn_non_sugar->slug], 200);

    }



	public function edit($slug){

		$syn_non_sugar = $this->syn_non_sugar_repo->findBySlug($slug);
		return response()->json(['data' => $syn_non_sugar], 200);

    }



	public function update(NonSugarFormRequest $request, $slug){

		$syn_non_sugar = $this->syn_non_sugar_repo->update($request, $slug);
        $this->event->fire('syn_non_sugar.update', $syn_non_sugar);
		return response()->json(['key' => $syn_non_sugar->slug], 200);

    }



	public function delete($slug){

		$syn_non_sugar = $this->syn_non_sugar_repo->destroy($slug);
        $this->event->fire('syn_non_sugar.destroy', $syn_non_sugar);
		return response()->json(['success' => true], 200);

    }



    
}
