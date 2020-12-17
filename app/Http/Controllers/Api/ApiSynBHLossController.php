<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynBHLossInterface;
use App\Http\Requests\Synopsis\BHLossFormRequest;
use Illuminate\Http\Request;

class ApiSynBHLossController extends Controller{



	protected $syn_bh_loss_repo;


	public function __construct(SynBHLossInterface $syn_bh_loss_repo){
		$this->syn_bh_loss_repo = $syn_bh_loss_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_bh_loss_list = $this->syn_bh_loss_repo->fetch($request);
	    return response()->json($syn_bh_loss_list, 200);

    }



	public function store(BHLossFormRequest $request){

		$syn_bh_loss = $this->syn_bh_loss_repo->store($request);
        $this->event->fire('syn_bh_loss.store', $syn_bh_loss);
		return response()->json(['key' => $syn_bh_loss->slug], 200);

    }



	public function edit($slug){

		$syn_bh_loss = $this->syn_bh_loss_repo->findBySlug($slug);
		return response()->json(['data' => $syn_bh_loss], 200);

    }



	public function update(BHLossFormRequest $request, $slug){

		$syn_bh_loss = $this->syn_bh_loss_repo->update($request, $slug);
        $this->event->fire('syn_bh_loss.update', $syn_bh_loss);
		return response()->json(['key' => $syn_bh_loss->slug], 200);

    }



	public function delete($slug){

		$syn_bh_loss = $this->syn_bh_loss_repo->destroy($slug);
        $this->event->fire('syn_bh_loss.destroy', $syn_bh_loss);
		return response()->json(['success' => true], 200);

    }



    
}
