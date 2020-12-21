<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynDetailOfStoppageAInterface;
use App\Http\Requests\Synopsis\DetailOfStoppageAFormRequest;
use Illuminate\Http\Request;

class ApiSynDetailOfStoppageAController extends Controller{



	protected $syn_detail_of_stoppage_a_repo;


	public function __construct(SynDetailOfStoppageAInterface $syn_detail_of_stoppage_a_repo){
		$this->syn_detail_of_stoppage_a_repo = $syn_detail_of_stoppage_a_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_detail_of_stoppage_a_list = $this->syn_detail_of_stoppage_a_repo->fetch($request);
	    return response()->json($syn_detail_of_stoppage_a_list, 200);

    }



	public function store(DetailOfStoppageAFormRequest $request){

		$syn_detail_of_stoppage_a = $this->syn_detail_of_stoppage_a_repo->store($request);
        $this->event->fire('syn_detail_of_stoppage_a.store', $syn_detail_of_stoppage_a);
		return response()->json(['key' => $syn_detail_of_stoppage_a->slug], 200);

    }



	public function edit($slug){

		$syn_detail_of_stoppage_a = $this->syn_detail_of_stoppage_a_repo->findBySlug($slug);
		return response()->json(['data' => $syn_detail_of_stoppage_a], 200);

    }



	public function update(DetailOfStoppageAFormRequest $request, $slug){

		$syn_detail_of_stoppage_a = $this->syn_detail_of_stoppage_a_repo->update($request, $slug);
        $this->event->fire('syn_detail_of_stoppage_a.update', $syn_detail_of_stoppage_a);
		return response()->json(['key' => $syn_detail_of_stoppage_a->slug], 200);

    }



	public function delete($slug){

		$syn_detail_of_stoppage_a = $this->syn_detail_of_stoppage_a_repo->destroy($slug);
        $this->event->fire('syn_detail_of_stoppage_a.destroy', $syn_detail_of_stoppage_a);
		return response()->json(['success' => true], 200);

    }



    
}
