<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynMolassesInterface;
use App\Http\Requests\Synopsis\MolassesFormRequest;
use Illuminate\Http\Request;

class ApiSynMolassesController extends Controller{



	protected $syn_molasses_repo;


	public function __construct(SynMolassesInterface $syn_molasses_repo){
		$this->syn_molasses_repo = $syn_molasses_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_molasses_list = $this->syn_molasses_repo->fetch($request);
	    return response()->json($syn_molasses_list, 200);

    }



	public function store(MolassesFormRequest $request){

		$syn_molasses = $this->syn_molasses_repo->store($request);
        $this->event->fire('syn_molasses.store', $syn_molasses);
		return response()->json(['key' => $syn_molasses->slug], 200);

    }



	public function edit($slug){

		$syn_molasses = $this->syn_molasses_repo->findBySlug($slug);
		return response()->json(['data' => $syn_molasses], 200);

    }



	public function update(MolassesFormRequest $request, $slug){

		$syn_molasses = $this->syn_molasses_repo->update($request, $slug);
        $this->event->fire('syn_molasses.update', $syn_molasses);
		return response()->json(['key' => $syn_molasses->slug], 200);

    }



	public function delete($slug){

		$syn_molasses = $this->syn_molasses_repo->destroy($slug);
        $this->event->fire('syn_molasses.destroy', $syn_molasses);
		return response()->json(['success' => true], 200);

    }



    
}
