<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynFilterCakeInterface;
use App\Http\Requests\Synopsis\FilterCakeFormRequest;
use Illuminate\Http\Request;

class ApiSynFilterCakeController extends Controller{



	protected $syn_filter_cake_repo;


	public function __construct(SynFilterCakeInterface $syn_filter_cake_repo){
		$this->syn_filter_cake_repo = $syn_filter_cake_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_filter_cake_list = $this->syn_filter_cake_repo->fetch($request);
	    return response()->json($syn_filter_cake_list, 200);

    }



	public function store(FilterCakeFormRequest $request){

		$syn_filter_cake = $this->syn_filter_cake_repo->store($request);
        $this->event->fire('syn_filter_cake.store', $syn_filter_cake);
		return response()->json(['key' => $syn_filter_cake->slug], 200);

    }



	public function edit($slug){

		$syn_filter_cake = $this->syn_filter_cake_repo->findBySlug($slug);
		return response()->json(['data' => $syn_filter_cake], 200);

    }



	public function update(FilterCakeFormRequest $request, $slug){

		$syn_filter_cake = $this->syn_filter_cake_repo->update($request, $slug);
        $this->event->fire('syn_filter_cake.update', $syn_filter_cake);
		return response()->json(['key' => $syn_filter_cake->slug], 200);

    }



	public function delete($slug){

		$syn_filter_cake = $this->syn_filter_cake_repo->destroy($slug);
        $this->event->fire('syn_filter_cake.destroy', $syn_filter_cake);
		return response()->json(['success' => true], 200);

    }



    
}
