<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynRatiosOnGrossCaneInterface;
use App\Http\Requests\Synopsis\RatiosOnGrossCaneFormRequest;
use Illuminate\Http\Request;

class ApiSynRatiosOnGrossCaneController extends Controller{



	protected $syn_ratios_on_gross_cane_repo;


	public function __construct(SynRatiosOnGrossCaneInterface $syn_ratios_on_gross_cane_repo){
		$this->syn_ratios_on_gross_cane_repo = $syn_ratios_on_gross_cane_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$syn_ratios_on_gross_cane_list = $this->syn_ratios_on_gross_cane_repo->fetch($request);
	    return response()->json($syn_ratios_on_gross_cane_list, 200);

    }



	public function store(RatiosOnGrossCaneFormRequest $request){

		$syn_ratios_on_gross_cane = $this->syn_ratios_on_gross_cane_repo->store($request);
        $this->event->fire('syn_ratios_on_gross_cane.store');
		return response()->json(['key' => $syn_ratios_on_gross_cane->slug], 200);

    }



	public function edit($slug){

		$syn_ratios_on_gross_cane = $this->syn_ratios_on_gross_cane_repo->findBySlug($slug);
		return response()->json(['data' => $syn_ratios_on_gross_cane], 200);

    }



	public function update(RatiosOnGrossCaneFormRequest $request, $slug){

		$syn_ratios_on_gross_cane = $this->syn_ratios_on_gross_cane_repo->update($request, $slug);
        $this->event->fire('syn_ratios_on_gross_cane.update', $syn_ratios_on_gross_cane);
		return response()->json(['key' => $syn_ratios_on_gross_cane->slug], 200);

    }



	public function delete($slug){

		$syn_ratios_on_gross_cane = $this->syn_ratios_on_gross_cane_repo->destroy($slug);
        $this->event->fire('syn_ratios_on_gross_cane.destroy', $syn_ratios_on_gross_cane);
		return response()->json(['success' => true], 200);

    }



    
}
