<?php

namespace App\Core\Interfaces;
 


interface SynMixedJuiceInterface {

	public function fetch($request);

	public function store($request);

	public function findBySlug($slug);

    public function update($request, $slug);

	public function destroy($slug);

	public function getByCropYearId($crop_year_id);
		
}