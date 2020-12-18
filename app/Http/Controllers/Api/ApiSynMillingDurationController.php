<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynMillingDurationInterface;
use App\Http\Requests\Synopsis\MillingDurationFormRequest;
use Illuminate\Http\Request;

class ApiSynMillingDurationController extends Controller{



	protected $syn_milling_duration_repo;


	public function __construct(SynMillingDurationInterface $syn_milling_duration_repo){
		$this->syn_milling_duration_repo = $syn_milling_duration_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_milling_duration_list = $this->syn_milling_duration_repo->fetch($request);
	    return response()->json($syn_milling_duration_list, 200);

    }



	public function store(MillingDurationFormRequest $request){

		$syn_milling_duration = $this->syn_milling_duration_repo->store($request);
        $this->event->fire('syn_milling_duration.store', $syn_milling_duration);
		return response()->json(['key' => $syn_milling_duration->slug], 200);

    }



	public function edit($slug){

		$syn_milling_duration = $this->syn_milling_duration_repo->findBySlug($slug);
		return response()->json(['data' => $syn_milling_duration], 200);

    }



	public function update(MillingDurationFormRequest $request, $slug){

		$syn_milling_duration = $this->syn_milling_duration_repo->update($request, $slug);
        $this->event->fire('syn_milling_duration.update', $syn_milling_duration);
		return response()->json(['key' => $syn_milling_duration->slug], 200);

    }



	public function delete($slug){

		$syn_milling_duration = $this->syn_milling_duration_repo->destroy($slug);
        $this->event->fire('syn_milling_duration.destroy', $syn_milling_duration);
		return response()->json(['success' => true], 200);

    }



    
}
