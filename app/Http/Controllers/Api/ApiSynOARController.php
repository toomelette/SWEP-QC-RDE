<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynOARInterface;
use App\Http\Requests\Synopsis\OARFormRequest;
use Illuminate\Http\Request;

class ApiSynOARController extends Controller{



	protected $syn_oar_repo;


	public function __construct(SynOARInterface $syn_oar_repo){
		$this->syn_oar_repo = $syn_oar_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_oar_list = $this->syn_oar_repo->fetch($request);
	    return response()->json($syn_oar_list, 200);

    }



	public function store(OARFormRequest $request){

		$syn_oar = $this->syn_oar_repo->store($request);
        $this->event->fire('syn_oar.store', $syn_oar);
		return response()->json(['key' => $syn_oar->slug], 200);

    }



	public function edit($slug){

		$syn_oar = $this->syn_oar_repo->findBySlug($slug);
		return response()->json(['data' => $syn_oar], 200);

    }



	public function update(OARFormRequest $request, $slug){

		$syn_oar = $this->syn_oar_repo->update($request, $slug);
        $this->event->fire('syn_oar.update', $syn_oar);
		return response()->json(['key' => $syn_oar->slug], 200);

    }



	public function delete($slug){

		$syn_oar = $this->syn_oar_repo->destroy($slug);
        $this->event->fire('syn_oar.destroy', $syn_oar);
		return response()->json(['success' => true], 200);

    }



    
}
