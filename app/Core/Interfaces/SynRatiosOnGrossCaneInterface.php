<?php

namespace App\Core\Interfaces;
 


interface SynRatiosOnGrossCaneInterface {

	public function fetch($request);

	public function store($request);

	public function findBySlug($slug);

	public function update($request, $slug);

	public function destroy($slug);
		
}