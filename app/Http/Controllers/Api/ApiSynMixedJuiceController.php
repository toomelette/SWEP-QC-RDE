<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynMixedJuiceInterface;
use App\Http\Requests\Synopsis\MixedJuiceFormRequest;
use Illuminate\Http\Request;

class ApiSynMixedJuiceController extends Controller{



	protected $syn_mixed_juice_repo;


	public function __construct(SynMixedJuiceInterface $syn_mixed_juice_repo){
		$this->syn_mixed_juice_repo = $syn_mixed_juice_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_mixed_juice_list = $this->syn_mixed_juice_repo->fetch($request);
	    return response()->json($syn_mixed_juice_list, 200);

    }



	public function store(MixedJuiceFormRequest $request){

		$syn_mixed_juice = $this->syn_mixed_juice_repo->store($request);
        $this->event->fire('syn_mixed_juice.store', $syn_mixed_juice);
		return response()->json(['key' => $syn_mixed_juice->slug], 200);

    }



	public function edit($slug){

		$syn_mixed_juice = $this->syn_mixed_juice_repo->findBySlug($slug);
		return response()->json(['data' => $syn_mixed_juice], 200);

    }



	public function update(MixedJuiceFormRequest $request, $slug){

		$syn_mixed_juice = $this->syn_mixed_juice_repo->update($request, $slug);
        $this->event->fire('syn_mixed_juice.update', $syn_mixed_juice);
		return response()->json(['key' => $syn_mixed_juice->slug], 200);

    }



	public function delete($slug){

		$syn_mixed_juice = $this->syn_mixed_juice_repo->destroy($slug);
        $this->event->fire('syn_mixed_juice.destroy', $syn_mixed_juice);
		return response()->json(['success' => true], 200);

    }



    
}
