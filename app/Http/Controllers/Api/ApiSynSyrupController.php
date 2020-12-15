<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynSyrupInterface;
use App\Http\Requests\Synopsis\SyrupFormRequest;
use Illuminate\Http\Request;

class ApiSynSyrupController extends Controller{



	protected $syn_syrup_repo;


	public function __construct(SynSyrupInterface $syn_syrup_repo){
		$this->syn_syrup_repo = $syn_syrup_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_syrup_list = $this->syn_syrup_repo->fetch($request);
	    return response()->json($syn_syrup_list, 200);

    }



	public function store(SyrupFormRequest $request){

		$syn_syrup = $this->syn_syrup_repo->store($request);
        $this->event->fire('syn_syrup.store', $syn_syrup);
		return response()->json(['key' => $syn_syrup->slug], 200);

    }



	public function edit($slug){

		$syn_syrup = $this->syn_syrup_repo->findBySlug($slug);
		return response()->json(['data' => $syn_syrup], 200);

    }



	public function update(SyrupFormRequest $request, $slug){

		$syn_syrup = $this->syn_syrup_repo->update($request, $slug);
        $this->event->fire('syn_syrup.update', $syn_syrup);
		return response()->json(['key' => $syn_syrup->slug], 200);

    }



	public function delete($slug){

		$syn_syrup = $this->syn_syrup_repo->destroy($slug);
        $this->event->fire('syn_syrup.destroy', $syn_syrup);
		return response()->json(['success' => true], 200);

    }



    
}
