<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynBHRInterface;
use App\Http\Requests\Synopsis\BHRFormRequest;
use Illuminate\Http\Request;

class ApiSynBHRController extends Controller{



	protected $syn_bhr_repo;


	public function __construct(SynBHRInterface $syn_bhr_repo){
		$this->syn_bhr_repo = $syn_bhr_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_bhr_list = $this->syn_bhr_repo->fetch($request);
	    return response()->json($syn_bhr_list, 200);

    }



	public function store(BHRFormRequest $request){

		$syn_bhr = $this->syn_bhr_repo->store($request);
        $this->event->fire('syn_bhr.store', $syn_bhr);
		return response()->json(['key' => $syn_bhr->slug], 200);

    }



	public function edit($slug){

		$syn_bhr = $this->syn_bhr_repo->findBySlug($slug);
		return response()->json(['data' => $syn_bhr], 200);

    }



	public function update(BHRFormRequest $request, $slug){

		$syn_bhr = $this->syn_bhr_repo->update($request, $slug);
        $this->event->fire('syn_bhr.update', $syn_bhr);
		return response()->json(['key' => $syn_bhr->slug], 200);

    }



	public function delete($slug){

		$syn_bhr = $this->syn_bhr_repo->destroy($slug);
        $this->event->fire('syn_bhr.destroy', $syn_bhr);
		return response()->json(['success' => true], 200);

    }



    
}
