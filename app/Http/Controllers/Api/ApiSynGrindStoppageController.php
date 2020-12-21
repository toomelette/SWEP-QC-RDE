<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynGrindStoppageInterface;
use App\Http\Requests\Synopsis\GrindStoppageFormRequest;
use Illuminate\Http\Request;

class ApiSynGrindStoppageController extends Controller{



	protected $syn_grind_stoppage_repo;


	public function __construct(SynGrindStoppageInterface $syn_grind_stoppage_repo){
		$this->syn_grind_stoppage_repo = $syn_grind_stoppage_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_grind_stoppage_list = $this->syn_grind_stoppage_repo->fetch($request);
	    return response()->json($syn_grind_stoppage_list, 200);

    }



	public function store(GrindStoppageFormRequest $request){

		$syn_grind_stoppage = $this->syn_grind_stoppage_repo->store($request);
        $this->event->fire('syn_grind_stoppage.store', $syn_grind_stoppage);
		return response()->json(['key' => $syn_grind_stoppage->slug], 200);

    }



	public function edit($slug){

		$syn_grind_stoppage = $this->syn_grind_stoppage_repo->findBySlug($slug);
		return response()->json(['data' => $syn_grind_stoppage], 200);

    }



	public function update(GrindStoppageFormRequest $request, $slug){

		$syn_grind_stoppage = $this->syn_grind_stoppage_repo->update($request, $slug);
        $this->event->fire('syn_grind_stoppage.update', $syn_grind_stoppage);
		return response()->json(['key' => $syn_grind_stoppage->slug], 200);

    }



	public function delete($slug){

		$syn_grind_stoppage = $this->syn_grind_stoppage_repo->destroy($slug);
        $this->event->fire('syn_grind_stoppage.destroy', $syn_grind_stoppage);
		return response()->json(['success' => true], 200);

    }



    
}
