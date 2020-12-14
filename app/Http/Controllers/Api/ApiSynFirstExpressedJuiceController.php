<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynFirstExpressedJuiceInterface;
use App\Http\Requests\Synopsis\FirstExpressedJuiceFormRequest;
use Illuminate\Http\Request;

class ApiSynFirstExpressedJuiceController extends Controller{



	protected $syn_first_expressed_juice_repo;


	public function __construct(SynFirstExpressedJuiceInterface $syn_first_expressed_juice_repo){
		$this->syn_first_expressed_juice_repo = $syn_first_expressed_juice_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_first_expressed_juice_list = $this->syn_first_expressed_juice_repo->fetch($request);
	    return response()->json($syn_first_expressed_juice_list, 200);

    }



	public function store(FirstExpressedJuiceFormRequest $request){

		$syn_first_expressed_juice = $this->syn_first_expressed_juice_repo->store($request);
        $this->event->fire('syn_first_expressed_juice.store', $syn_first_expressed_juice);
		return response()->json(['key' => $syn_first_expressed_juice->slug], 200);

    }



	public function edit($slug){

		$syn_first_expressed_juice = $this->syn_first_expressed_juice_repo->findBySlug($slug);
		return response()->json(['data' => $syn_first_expressed_juice], 200);

    }



	public function update(FirstExpressedJuiceFormRequest $request, $slug){

		$syn_first_expressed_juice = $this->syn_first_expressed_juice_repo->update($request, $slug);
        $this->event->fire('syn_first_expressed_juice.update', $syn_first_expressed_juice);
		return response()->json(['key' => $syn_first_expressed_juice->slug], 200);

    }



	public function delete($slug){

		$syn_first_expressed_juice = $this->syn_first_expressed_juice_repo->destroy($slug);
        $this->event->fire('syn_first_expressed_juice.destroy', $syn_first_expressed_juice);
		return response()->json(['success' => true], 200);

    }



    
}
