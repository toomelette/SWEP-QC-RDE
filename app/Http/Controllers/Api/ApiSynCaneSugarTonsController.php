<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynCaneSugarTonInterface;
use App\Http\Requests\Synopsis\CaneSugarTonsFormRequest;
use Illuminate\Http\Request;

class ApiSynCaneSugarTonsController extends Controller{



	protected $syn_cane_sugar_ton_repo;


	public function __construct(SynCaneSugarTonInterface $syn_cane_sugar_ton_repo){
		$this->syn_cane_sugar_ton_repo = $syn_cane_sugar_ton_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_cane_sugar_ton_list = $this->syn_cane_sugar_ton_repo->fetch($request);
	    return response()->json($syn_cane_sugar_ton_list, 200);

    }



	public function store(CaneSugarTonsFormRequest $request){

		$syn_cane_sugar_ton = $this->syn_cane_sugar_ton_repo->store($request);
        $this->event->fire('syn_cane_sugar_ton.store', $syn_cane_sugar_ton);
		return response()->json(['key' => $syn_cane_sugar_ton->slug], 200);

    }



	public function edit($slug){

		$syn_cane_sugar_ton = $this->syn_cane_sugar_ton_repo->findBySlug($slug);
		return response()->json(['data' => $syn_cane_sugar_ton], 200);

    }



	public function update(CaneSugarTonsFormRequest $request, $slug){

		$syn_cane_sugar_ton = $this->syn_cane_sugar_ton_repo->update($request, $slug);
        $this->event->fire('syn_cane_sugar_ton.update', $syn_cane_sugar_ton);
		return response()->json(['key' => $syn_cane_sugar_ton->slug], 200);

    }



	public function delete($slug){

		$syn_cane_sugar_ton = $this->syn_cane_sugar_ton_repo->destroy($slug);
        $this->event->fire('syn_cane_sugar_ton.destroy', $syn_cane_sugar_ton);
		return response()->json(['success' => true], 200);

    }



    
}
