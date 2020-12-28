<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\CropYearInterface;

use App\Models\CropYear;


class CropYearRepository extends BaseRepository implements CropYearInterface {
	

    protected $crop_year;


	public function __construct(CropYear $crop_year){

        $this->crop_year = $crop_year;
        parent::__construct();

    }



    public function getAll(){

        $crop_years = $this->cache->remember('crop_years:getAll', 240, function(){
                return $this->crop_year->select('crop_year_id', 'name', 'is_active')
                                       ->orderBy('name', 'desc')
                                       ->get();
            }
        );
        
        return $crop_years;

    }



    public function currentCropYear(){

        $crop_year = $this->cache->remember('crop_years:currentCropYear', 240, 
            function(){
                return $this->crop_year->select('crop_year_id', 'name')
                                       ->where('is_active', 1)
                                       ->first();
            }
        );
        
        if(empty($crop_year)){
            abort(404);
        }
        
        return $crop_year;

    }



    public function findByCropYearId($cy_id){

        $crop_year = $this->cache->remember('crop_years:findByCYId:'. $cy_id, 240, 
            function() use ($cy_id){
                return $this->crop_year->select('name')->where('crop_year_id', $cy_id)->first();
            }
        );
        
        if(empty($crop_year)){
            abort(404);
        }
        
        return $crop_year;

    }



    public function getLastTenByCropYear($cy_id){

        $crop_years = $this->cache->remember('crop_years:getLastTenByCropYear:'. $cy_id, 240, function() use ($cy_id){

            $array = array();
            $crop_year_set =  $this->crop_year->select('seq_no')->where('crop_year_id', $cy_id)->first();
            $i = 0;

            for ($x = $crop_year_set->seq_no; $x >= 1; $x--) {

                $i++;

                if($i <= 10){

                    $data = $this->crop_year->where('seq_no', $x)->first();
                    
                    if(!empty($data)){
                        $array[] = array(
                            'crop_year_id' => $data->crop_year_id,
                            'name' => $data->name,
                        );
                    }

                }
            }

            $array = array_values(array_sort($array, function ($value) {
                return $value['name'];
            }));

            return $array;

        });
        
        return $crop_years;

    }




}