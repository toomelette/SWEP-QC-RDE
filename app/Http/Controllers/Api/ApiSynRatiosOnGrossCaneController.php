<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Core\Interfaces\SynRatiosOnGrossCaneInterface;
use App\Http\Requests\Synopsis\RatiosOnGrossCaneFormRequest;
use Illuminate\Http\Request;

class ApiSynRatiosOnGrossCaneController extends Controller{



	protected $syn_ratios_on_gross_cane_repo;

	const syn_ratios_on_gross_cane = [];
	const syn_ratios_on_gross_cane_list = [];


	public function __construct(SynRatiosOnGrossCaneInterface $syn_ratios_on_gross_cane_repo){
		$this->syn_ratios_on_gross_cane_repo = $syn_ratios_on_gross_cane_repo;
        parent::__construct();
	}



	public function fetch(Request $request){

		$this->syn_ratios_on_gross_cane_list = $this->syn_ratios_on_gross_cane_repo->fetch($request);
	    return response()->json($this->syn_ratios_on_gross_cane_list, 200);

    }



	public function store(RatiosOnGrossCaneFormRequest $request){

		$this->syn_ratios_on_gross_cane = $this->syn_ratios_on_gross_cane_repo->store($request);
        $this->event->fire('syn_ratios_on_gross_cane.store');
		return response()->json(['key' => $this->syn_ratios_on_gross_cane->slug], 200);

    }



	public function edit($slug){

		$this->syn_ratios_on_gross_cane = $this->syn_ratios_on_gross_cane_repo->findBySlug($slug);
		return response()->json(['data' => $this->syn_ratios_on_gross_cane], 200);

    }



	public function update(RatiosOnGrossCaneFormRequest $request, $slug){

		$this->syn_ratios_on_gross_cane = $this->syn_ratios_on_gross_cane_repo->update($request, $slug);
        $this->event->fire('syn_ratios_on_gross_cane.update', $this->syn_ratios_on_gross_cane);
		return response()->json(['key' => $this->syn_ratios_on_gross_cane->slug], 200);

    }



	public function delete($slug){

		$this->syn_ratios_on_gross_cane = $this->syn_ratios_on_gross_cane_repo->destroy($slug);
        $this->event->fire('syn_ratios_on_gross_cane.destroy', $this->syn_ratios_on_gross_cane);
		return response()->json(['success' => true], 200);

    }



    
}
