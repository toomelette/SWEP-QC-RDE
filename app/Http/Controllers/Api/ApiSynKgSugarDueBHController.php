<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynKgSugarDueBHInterface;
use App\Http\Requests\Synopsis\KgSugarDueBHFormRequest;
use Illuminate\Http\Request;

class ApiSynKgSugarDueBHController extends Controller{



	protected $syn_kg_sugar_due_bh_repo;


	public function __construct(SynKgSugarDueBHInterface $syn_kg_sugar_due_bh_repo){
		$this->syn_kg_sugar_due_bh_repo = $syn_kg_sugar_due_bh_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_kg_sugar_due_bh_list = $this->syn_kg_sugar_due_bh_repo->fetch($request);
	    return response()->json($syn_kg_sugar_due_bh_list, 200);

    }



	public function store(KgSugarDueBHFormRequest $request){

		$syn_kg_sugar_due_bh = $this->syn_kg_sugar_due_bh_repo->store($request);
        $this->event->fire('syn_kg_sugar_due_bh.store', $syn_kg_sugar_due_bh);
		return response()->json(['key' => $syn_kg_sugar_due_bh->slug], 200);

    }



	public function edit($slug){

		$syn_kg_sugar_due_bh = $this->syn_kg_sugar_due_bh_repo->findBySlug($slug);
		return response()->json(['data' => $syn_kg_sugar_due_bh], 200);

    }



	public function update(KgSugarDueBHFormRequest $request, $slug){

		$syn_kg_sugar_due_bh = $this->syn_kg_sugar_due_bh_repo->update($request, $slug);
        $this->event->fire('syn_kg_sugar_due_bh.update', $syn_kg_sugar_due_bh);
		return response()->json(['key' => $syn_kg_sugar_due_bh->slug], 200);

    }



	public function delete($slug){

		$syn_kg_sugar_due_bh = $this->syn_kg_sugar_due_bh_repo->destroy($slug);
        $this->event->fire('syn_kg_sugar_due_bh.destroy', $syn_kg_sugar_due_bh);
		return response()->json(['success' => true], 200);

    }



    
}
