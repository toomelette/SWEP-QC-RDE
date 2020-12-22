<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynDetailOfStoppageBInterface;
use App\Http\Requests\Synopsis\DetailOfStoppageAFormRequest;
use Illuminate\Http\Request;

class ApiSynDetailOfStoppageBController extends Controller{



	protected $syn_detail_of_stoppage_b_repo;


	public function __construct(SynDetailOfStoppageBInterface $syn_detail_of_stoppage_b_repo){
		$this->syn_detail_of_stoppage_b_repo = $syn_detail_of_stoppage_b_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_detail_of_stoppage_b_list = $this->syn_detail_of_stoppage_b_repo->fetch($request);
	    return response()->json($syn_detail_of_stoppage_b_list, 200);

    }



	public function store(DetailOfStoppageAFormRequest $request){

		$syn_detail_of_stoppage_b = $this->syn_detail_of_stoppage_b_repo->store($request);
        $this->event->fire('syn_detail_of_stoppage_b.store', $syn_detail_of_stoppage_b);
		return response()->json(['key' => $syn_detail_of_stoppage_b->slug], 200);

    }



	public function edit($slug){

		$syn_detail_of_stoppage_b = $this->syn_detail_of_stoppage_b_repo->findBySlug($slug);
		return response()->json(['data' => $syn_detail_of_stoppage_b], 200);

    }



	public function update(DetailOfStoppageAFormRequest $request, $slug){

		$syn_detail_of_stoppage_b = $this->syn_detail_of_stoppage_b_repo->update($request, $slug);
        $this->event->fire('syn_detail_of_stoppage_b.update', $syn_detail_of_stoppage_b);
		return response()->json(['key' => $syn_detail_of_stoppage_b->slug], 200);

    }



	public function delete($slug){

		$syn_detail_of_stoppage_b = $this->syn_detail_of_stoppage_b_repo->destroy($slug);
        $this->event->fire('syn_detail_of_stoppage_b.destroy', $syn_detail_of_stoppage_b);
		return response()->json(['success' => true], 200);

    }



    
}
