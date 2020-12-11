<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynRatiosOnGrossCaneInterface;

use App\Models\SynRatiosOnGrossCane;


class SynRatiosOnGrossCaneRepository extends BaseRepository implements SynRatiosOnGrossCaneInterface {
	


    protected $syn_ratios_on_gross_cane;



	public function __construct(SynRatiosOnGrossCane $syn_ratios_on_gross_cane){

        $this->syn_ratios_on_gross_cane = $syn_ratios_on_gross_cane;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_ratios_on_gross_canes = $this->cache->remember('syn_ratios_on_gross_cane:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_ratios_on_gross_cane = $this->syn_ratios_on_gross_cane->newQuery();
            
            if(isset($request->q)){
                $syn_ratios_on_gross_cane->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_ratios_on_gross_cane->select('slug', 'crop_year_id', 'mill_id', 'ratios_on_gross_cane_id')
                                            ->with('mill', 'cropYear')
                                            ->sortable()
                                            ->orderBy('updated_at', 'desc')
                                            ->paginate($entries);
                
        });

        return $syn_ratios_on_gross_canes;

    }




    public function store($request){

        $syn_ratios_on_gross_cane = new SynRatiosOnGrossCane;
        $syn_ratios_on_gross_cane->slug = $this->str->random(16);
        $syn_ratios_on_gross_cane->ratios_on_gross_cane_id = $this->getSynRatiosOnGrossCaneIdInc();
        $syn_ratios_on_gross_cane->mill_id = $request->mill_id;
        $syn_ratios_on_gross_cane->crop_year_id = $request->crop_year_id;
        $syn_ratios_on_gross_cane->burnt_cane_percent = $this->__dataType->string_to_num($request->burnt_cane_percent);
        $syn_ratios_on_gross_cane->quality_ratio = $this->__dataType->string_to_num($request->quality_ratio);
        $syn_ratios_on_gross_cane->rendement = $this->__dataType->string_to_num($request->rendement);
        $syn_ratios_on_gross_cane->total_sugar_recovered = $this->__dataType->string_to_num($request->total_sugar_recovered);
        $syn_ratios_on_gross_cane->created_at = $this->carbon->now();
        $syn_ratios_on_gross_cane->updated_at = $this->carbon->now();
        $syn_ratios_on_gross_cane->ip_created = request()->ip();
        $syn_ratios_on_gross_cane->ip_updated = request()->ip();
        $syn_ratios_on_gross_cane->user_created = $this->auth->user()->user_id;
        $syn_ratios_on_gross_cane->user_updated = $this->auth->user()->user_id;
        $syn_ratios_on_gross_cane->save();
        
        return $syn_ratios_on_gross_cane;

    }




    public function update($request, $slug){

        $syn_ratios_on_gross_cane = $this->findBySlug($slug);
        $syn_ratios_on_gross_cane->mill_id = $request->mill_id;
        $syn_ratios_on_gross_cane->crop_year_id = $request->crop_year_id;
        $syn_ratios_on_gross_cane->burnt_cane_percent = $this->__dataType->string_to_num($request->burnt_cane_percent);
        $syn_ratios_on_gross_cane->quality_ratio = $this->__dataType->string_to_num($request->quality_ratio);
        $syn_ratios_on_gross_cane->rendement = $this->__dataType->string_to_num($request->rendement);
        $syn_ratios_on_gross_cane->total_sugar_recovered = $this->__dataType->string_to_num($request->total_sugar_recovered);
        $syn_ratios_on_gross_cane->updated_at = $this->carbon->now();
        $syn_ratios_on_gross_cane->ip_updated = request()->ip();
        $syn_ratios_on_gross_cane->user_updated = $this->auth->user()->user_id;
        $syn_ratios_on_gross_cane->save();
        
        return $syn_ratios_on_gross_cane;

    }




    public function destroy($slug){

        $syn_ratios_on_gross_cane = $this->findBySlug($slug);
        $syn_ratios_on_gross_cane->delete();

        return $syn_ratios_on_gross_cane;

    }




    public function findBySlug($slug){

        $syn_ratios_on_gross_cane = $this->cache->remember('syn_ratios_on_gross_cane:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_ratios_on_gross_cane->where('slug', $slug)
                                                 ->with('mill', 'cropYear')
                                                 ->first();
        }); 
        
        if(empty($syn_ratios_on_gross_cane)){ abort(404); }

        return $syn_ratios_on_gross_cane;

    }



    public function getByCropYearId($crop_year_id){

        $syn_ratios_on_gross_cane = $this->cache->remember('syn_ratios_on_gross_cane:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_ratios_on_gross_cane = $this->syn_ratios_on_gross_cane->newQuery();

            return $syn_ratios_on_gross_cane->select('mill_id', 'burnt_cane_percent', 'quality_ratio', 'rendement', 'total_sugar_recovered')
                                            ->with('mill')
                                            ->where('crop_year_id', $crop_year_id)
                                            ->get();

        });

        return $syn_ratios_on_gross_cane;

    }




    public function getSynRatiosOnGrossCaneIdInc(){

        $id = 'ROGC1001';
        $syn_ratios_on_gross_cane = $this->syn_ratios_on_gross_cane->select('ratios_on_gross_cane_id')
                                                                   ->orderBy('ratios_on_gross_cane_id', 'desc')
                                                                   ->first();

        if($syn_ratios_on_gross_cane != null){
            if($syn_ratios_on_gross_cane->ratios_on_gross_cane_id != null){
                $num = str_replace('ROGC', '', $syn_ratios_on_gross_cane->ratios_on_gross_cane_id) + 1;
                $id = 'ROGC' . $num;
            }
        }
        
        return $id;
        
    }




}