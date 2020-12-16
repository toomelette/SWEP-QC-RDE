<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynMillingPlantInterface;
use App\Http\Requests\Synopsis\MillingPlantFormRequest;
use Illuminate\Http\Request;

class ApiSynMillingPlantController extends Controller{



	protected $syn_milling_plant_repo;


	public function __construct(SynMillingPlantInterface $syn_milling_plant_repo){
		$this->syn_milling_plant_repo = $syn_milling_plant_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_milling_plant_list = $this->syn_milling_plant_repo->fetch($request);
	    return response()->json($syn_milling_plant_list, 200);

    }



	public function store(MillingPlantFormRequest $request){

		$syn_milling_plant = $this->syn_milling_plant_repo->store($request);
        $this->event->fire('syn_milling_plant.store', $syn_milling_plant);
		return response()->json(['key' => $syn_milling_plant->slug], 200);

    }



	public function edit($slug){

		$syn_milling_plant = $this->syn_milling_plant_repo->findBySlug($slug);
		return response()->json(['data' => $syn_milling_plant], 200);

    }



	public function update(MillingPlantFormRequest $request, $slug){

		$syn_milling_plant = $this->syn_milling_plant_repo->update($request, $slug);
        $this->event->fire('syn_milling_plant.update', $syn_milling_plant);
		return response()->json(['key' => $syn_milling_plant->slug], 200);

    }



	public function delete($slug){

		$syn_milling_plant = $this->syn_milling_plant_repo->destroy($slug);
        $this->event->fire('syn_milling_plant.destroy', $syn_milling_plant);
		return response()->json(['success' => true], 200);

    }



    
}
