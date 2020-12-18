<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynKgSugarDueCleanCaneInterface;
use App\Http\Requests\Synopsis\KgSugarDueCleanCaneFormRequest;
use Illuminate\Http\Request;

class ApiSynKgSugarDueCleanCaneController extends Controller{



	protected $syn_kg_sugar_due_clean_cane_repo;


	public function __construct(SynKgSugarDueCleanCaneInterface $syn_kg_sugar_due_clean_cane_repo){
		$this->syn_kg_sugar_due_clean_cane_repo = $syn_kg_sugar_due_clean_cane_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_kg_sugar_due_clean_cane_list = $this->syn_kg_sugar_due_clean_cane_repo->fetch($request);
	    return response()->json($syn_kg_sugar_due_clean_cane_list, 200);

    }



	public function store(KgSugarDueCleanCaneFormRequest $request){

		$syn_kg_sugar_due_clean_cane = $this->syn_kg_sugar_due_clean_cane_repo->store($request);
        $this->event->fire('syn_kg_sugar_due_clean_cane.store', $syn_kg_sugar_due_clean_cane);
		return response()->json(['key' => $syn_kg_sugar_due_clean_cane->slug], 200);

    }



	public function edit($slug){

		$syn_kg_sugar_due_clean_cane = $this->syn_kg_sugar_due_clean_cane_repo->findBySlug($slug);
		return response()->json(['data' => $syn_kg_sugar_due_clean_cane], 200);

    }



	public function update(KgSugarDueCleanCaneFormRequest $request, $slug){

		$syn_kg_sugar_due_clean_cane = $this->syn_kg_sugar_due_clean_cane_repo->update($request, $slug);
        $this->event->fire('syn_kg_sugar_due_clean_cane.update', $syn_kg_sugar_due_clean_cane);
		return response()->json(['key' => $syn_kg_sugar_due_clean_cane->slug], 200);

    }



	public function delete($slug){

		$syn_kg_sugar_due_clean_cane = $this->syn_kg_sugar_due_clean_cane_repo->destroy($slug);
        $this->event->fire('syn_kg_sugar_due_clean_cane.destroy', $syn_kg_sugar_due_clean_cane);
		return response()->json(['success' => true], 200);

    }



    
}
