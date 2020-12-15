<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynLastExpressedJuiceInterface;
use App\Http\Requests\Synopsis\LastExpressedJuiceFormRequest;
use Illuminate\Http\Request;

class ApiSynLastExpressedJuiceController extends Controller{



	protected $syn_last_expressed_juice_repo;


	public function __construct(SynLastExpressedJuiceInterface $syn_last_expressed_juice_repo){
		$this->syn_last_expressed_juice_repo = $syn_last_expressed_juice_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_last_expressed_juice_list = $this->syn_last_expressed_juice_repo->fetch($request);
	    return response()->json($syn_last_expressed_juice_list, 200);

    }



	public function store(LastExpressedJuiceFormRequest $request){

		$syn_last_expressed_juice = $this->syn_last_expressed_juice_repo->store($request);
        $this->event->fire('syn_last_expressed_juice.store', $syn_last_expressed_juice);
		return response()->json(['key' => $syn_last_expressed_juice->slug], 200);

    }



	public function edit($slug){

		$syn_last_expressed_juice = $this->syn_last_expressed_juice_repo->findBySlug($slug);
		return response()->json(['data' => $syn_last_expressed_juice], 200);

    }



	public function update(LastExpressedJuiceFormRequest $request, $slug){

		$syn_last_expressed_juice = $this->syn_last_expressed_juice_repo->update($request, $slug);
        $this->event->fire('syn_last_expressed_juice.update', $syn_last_expressed_juice);
		return response()->json(['key' => $syn_last_expressed_juice->slug], 200);

    }



	public function delete($slug){

		$syn_last_expressed_juice = $this->syn_last_expressed_juice_repo->destroy($slug);
        $this->event->fire('syn_last_expressed_juice.destroy', $syn_last_expressed_juice);
		return response()->json(['success' => true], 200);

    }



    
}
