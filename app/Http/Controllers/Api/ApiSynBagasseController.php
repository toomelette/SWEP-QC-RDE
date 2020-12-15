<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynBagasseInterface;
use App\Http\Requests\Synopsis\BagasseFormRequest;
use Illuminate\Http\Request;

class ApiSynBagasseController extends Controller{



	protected $syn_bagasse_repo;


	public function __construct(SynBagasseInterface $syn_bagasse_repo){
		$this->syn_bagasse_repo = $syn_bagasse_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_bagasse_list = $this->syn_bagasse_repo->fetch($request);
	    return response()->json($syn_bagasse_list, 200);

    }



	public function store(BagasseFormRequest $request){

		$syn_bagasse = $this->syn_bagasse_repo->store($request);
        $this->event->fire('syn_bagasse.store', $syn_bagasse);
		return response()->json(['key' => $syn_bagasse->slug], 200);

    }



	public function edit($slug){

		$syn_bagasse = $this->syn_bagasse_repo->findBySlug($slug);
		return response()->json(['data' => $syn_bagasse], 200);

    }



	public function update(BagasseFormRequest $request, $slug){

		$syn_bagasse = $this->syn_bagasse_repo->update($request, $slug);
        $this->event->fire('syn_bagasse.update', $syn_bagasse);
		return response()->json(['key' => $syn_bagasse->slug], 200);

    }



	public function delete($slug){

		$syn_bagasse = $this->syn_bagasse_repo->destroy($slug);
        $this->event->fire('syn_bagasse.destroy', $syn_bagasse);
		return response()->json(['success' => true], 200);

    }



    
}
