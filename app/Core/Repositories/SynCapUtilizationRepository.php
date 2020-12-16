<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynCapUtilizationInterface;

use App\Models\SynCapUtilization;


class SynCapUtilizationRepository extends BaseRepository implements SynCapUtilizationInterface {
	


    protected $syn_cap_utilization;



	public function __construct(SynCapUtilization $syn_cap_utilization){

        $this->syn_cap_utilization = $syn_cap_utilization;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_cap_utilization = $this->cache->remember('syn_cap_utilization:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_cap_utilization = $this->syn_cap_utilization->newQuery();
            
            if(isset($request->q)){
                $syn_cap_utilization->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_cap_utilization->select('slug', 'mill_id', 'crop_year_id', 'cap_utilization_id')
                                       ->with('mill', 'cropYear')
                                       ->sortable()
                                       ->orderBy('updated_at', 'desc')
                                       ->paginate($entries);

        });

        return $syn_cap_utilization;

    }




    public function store($request){

        $syn_cap_utilization = new SynCapUtilization;
        $syn_cap_utilization->slug = $this->str->random(16);
        $syn_cap_utilization->cap_utilization_id = $this->getSynCapUtilizationIdInc();
        $syn_cap_utilization->mill_id = $request->mill_id;
        $syn_cap_utilization->crop_year_id = $request->crop_year_id;

        $syn_cap_utilization->normal_rate_cap = $this->__dataType->string_to_num($request->normal_rate_cap);
        $syn_cap_utilization->tonnes_cane_per_hr = $this->__dataType->string_to_num($request->tonnes_cane_per_hr);
        $syn_cap_utilization->ave_hr_actual_grinding = $this->__dataType->string_to_num($request->ave_hr_actual_grinding);
        $syn_cap_utilization->cap_utilization = $this->__dataType->string_to_num($request->cap_utilization);
        $syn_cap_utilization->mechanical_time_eff = $this->__dataType->string_to_num($request->mechanical_time_eff);

        $syn_cap_utilization->created_at = $this->carbon->now();
        $syn_cap_utilization->updated_at = $this->carbon->now();
        $syn_cap_utilization->ip_created = request()->ip();
        $syn_cap_utilization->ip_updated = request()->ip();
        $syn_cap_utilization->user_created = $this->auth->user()->user_id;
        $syn_cap_utilization->user_updated = $this->auth->user()->user_id;
        $syn_cap_utilization->save();
        
        return $syn_cap_utilization;

    }




    public function update($request, $slug){

        $syn_cap_utilization = $this->findBySlug($slug);
        $syn_cap_utilization->mill_id = $request->mill_id;
        $syn_cap_utilization->crop_year_id = $request->crop_year_id;

        $syn_cap_utilization->normal_rate_cap = $this->__dataType->string_to_num($request->normal_rate_cap);
        $syn_cap_utilization->tonnes_cane_per_hr = $this->__dataType->string_to_num($request->tonnes_cane_per_hr);
        $syn_cap_utilization->ave_hr_actual_grinding = $this->__dataType->string_to_num($request->ave_hr_actual_grinding);
        $syn_cap_utilization->cap_utilization = $this->__dataType->string_to_num($request->cap_utilization);
        $syn_cap_utilization->mechanical_time_eff = $this->__dataType->string_to_num($request->mechanical_time_eff);

        $syn_cap_utilization->updated_at = $this->carbon->now();
        $syn_cap_utilization->ip_updated = request()->ip();
        $syn_cap_utilization->user_updated = $this->auth->user()->user_id;
        $syn_cap_utilization->save();
        
        return $syn_cap_utilization;

    }




    public function destroy($slug){

        $syn_cap_utilization = $this->findBySlug($slug);
        $syn_cap_utilization->delete();

        return $syn_cap_utilization;

    }




    public function findBySlug($slug){

        $syn_cap_utilization = $this->cache->remember('syn_cap_utilization:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_cap_utilization->where('slug', $slug)
                                             ->with('mill', 'cropYear')
                                             ->first();
        }); 
        
        if(empty($syn_cap_utilization)){ abort(404); }

        return $syn_cap_utilization;

    }



    public function getByCropYearId($crop_year_id){

        $syn_cap_utilization = $this->cache->remember('syn_cap_utilization:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_cap_utilization = $this->syn_cap_utilization->newQuery();

            return $syn_cap_utilization->select('mill_id', 'normal_rate_cap', 'tonnes_cane_per_hr', 'ave_hr_actual_grinding', 'cap_utilization', 'mechanical_time_eff')
                                      ->with('mill')
                                      ->where('crop_year_id', $crop_year_id)
                                      ->get();

        });

        return $syn_cap_utilization;

    }




    public function getSynCapUtilizationIdInc(){

        $id = 'CU1001';
        $syn_cap_utilization = $this->syn_cap_utilization->select('cap_utilization_id')->orderBy('cap_utilization_id', 'desc')->first();

        if($syn_cap_utilization != null){
            if($syn_cap_utilization->cap_utilization_id != null){
                $num = str_replace('CU', '', $syn_cap_utilization->cap_utilization_id) + 1;
                $id = 'CU' . $num;
            }
        }
        
        return $id;
        
    }




}