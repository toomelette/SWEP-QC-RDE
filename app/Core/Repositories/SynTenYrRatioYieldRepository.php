<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynTenYrRatioYieldInterface;
use App\Core\Interfaces\CropYearInterface;

use App\Models\SynTenYrRatioYield;


class SynTenYrRatioYieldRepository extends BaseRepository implements SynTenYrRatioYieldInterface {
	


    protected $syn_ten_yr_ratio_yield;
    protected $crop_year;



	public function __construct(SynTenYrRatioYield $syn_ten_yr_ratio_yield, CropYearInterface $crop_year){

        $this->syn_ten_yr_ratio_yield = $syn_ten_yr_ratio_yield;
        $this->crop_year = $crop_year;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_ten_yr_ratio_yield = $this->cache->remember('syn_ten_yr_ratio_yield:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_ten_yr_ratio_yield = $this->syn_ten_yr_ratio_yield->newQuery();
            
            if(isset($request->q)){
                $syn_ten_yr_ratio_yield->whereHas('cropYear', function($cy) use ($request){
                                           $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                        });
            }

            return $syn_ten_yr_ratio_yield->select('slug', 'crop_year_id', 'ten_yr_ratio_yield_id')
                                          ->with('cropYear')
                                          ->sortable()
                                          ->orderBy('updated_at', 'desc')
                                          ->paginate($entries);

        });

        return $syn_ten_yr_ratio_yield;

    }




    public function store($request){

        $syn_ten_yr_ratio_yield = new SynTenYrRatioYield;
        $syn_ten_yr_ratio_yield->slug = $this->str->random(16);
        $syn_ten_yr_ratio_yield->ten_yr_ratio_yield_id = $this->getSynTenYrRatioYieldIdInc();
        $syn_ten_yr_ratio_yield->crop_year_id = $request->crop_year_id;

        $syn_ten_yr_ratio_yield->imbibition_fiber_ratio = $this->__dataType->string_to_num($request->imbibition_fiber_ratio);
        $syn_ten_yr_ratio_yield->rendement = $this->__dataType->string_to_num($request->rendement);
        $syn_ten_yr_ratio_yield->quality_ratio = $this->__dataType->string_to_num($request->quality_ratio);
        $syn_ten_yr_ratio_yield->kg_mollasses_per_ton_cane = $this->__dataType->string_to_num($request->kg_mollasses_per_ton_cane);
        $syn_ten_yr_ratio_yield->kg_bagasse_per_ton_cane = $this->__dataType->string_to_num($request->kg_bagasse_per_ton_cane);
        $syn_ten_yr_ratio_yield->kg_fc_per_ton_cane = $this->__dataType->string_to_num($request->kg_fc_per_ton_cane);

        $syn_ten_yr_ratio_yield->created_at = $this->carbon->now();
        $syn_ten_yr_ratio_yield->updated_at = $this->carbon->now();
        $syn_ten_yr_ratio_yield->ip_created = request()->ip();
        $syn_ten_yr_ratio_yield->ip_updated = request()->ip();
        $syn_ten_yr_ratio_yield->user_created = $this->auth->user()->user_id;
        $syn_ten_yr_ratio_yield->user_updated = $this->auth->user()->user_id;
        $syn_ten_yr_ratio_yield->save();
        
        return $syn_ten_yr_ratio_yield;

    }




    public function update($request, $slug){

        $syn_ten_yr_ratio_yield = $this->findBySlug($slug);
        $syn_ten_yr_ratio_yield->crop_year_id = $request->crop_year_id;

        $syn_ten_yr_ratio_yield->imbibition_fiber_ratio = $this->__dataType->string_to_num($request->imbibition_fiber_ratio);
        $syn_ten_yr_ratio_yield->rendement = $this->__dataType->string_to_num($request->rendement);
        $syn_ten_yr_ratio_yield->quality_ratio = $this->__dataType->string_to_num($request->quality_ratio);
        $syn_ten_yr_ratio_yield->kg_mollasses_per_ton_cane = $this->__dataType->string_to_num($request->kg_mollasses_per_ton_cane);
        $syn_ten_yr_ratio_yield->kg_bagasse_per_ton_cane = $this->__dataType->string_to_num($request->kg_bagasse_per_ton_cane);
        $syn_ten_yr_ratio_yield->kg_fc_per_ton_cane = $this->__dataType->string_to_num($request->kg_fc_per_ton_cane);

        $syn_ten_yr_ratio_yield->updated_at = $this->carbon->now();
        $syn_ten_yr_ratio_yield->ip_updated = request()->ip();
        $syn_ten_yr_ratio_yield->user_updated = $this->auth->user()->user_id;
        $syn_ten_yr_ratio_yield->save();
        
        return $syn_ten_yr_ratio_yield;

    }




    public function destroy($slug){

        $syn_ten_yr_ratio_yield = $this->findBySlug($slug);
        $syn_ten_yr_ratio_yield->delete();

        return $syn_ten_yr_ratio_yield;

    }




    public function findBySlug($slug){

        $syn_ten_yr_ratio_yield = $this->cache->remember('syn_ten_yr_ratio_yield:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_ten_yr_ratio_yield->where('slug', $slug)
                                                ->with('cropYear')
                                                ->first();
        }); 
        
        if(empty($syn_ten_yr_ratio_yield)){ abort(404); }

        return $syn_ten_yr_ratio_yield;

    }



    public function getByCropYearId($crop_year_id){

        $syn_ten_yr_ratio_yield = $this->cache->remember('syn_ten_yr_ratio_yield:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $crop_years = $this->crop_year->getLastTenByCropYear($crop_year_id);
            $list = array();

            foreach ($crop_years as $data) {

                $ten_yr_prdn = $this->syn_ten_yr_ratio_yield->where('crop_year_id', $data['crop_year_id'])->first();

                if(!empty($ten_yr_prdn)){

                    $list[] = array(
                        'cy_name' => $data['name'],
                        'imbibition_fiber_ratio' => $ten_yr_prdn->imbibition_fiber_ratio,
                        'rendement' => $ten_yr_prdn->rendement,
                        'quality_ratio' => $ten_yr_prdn->quality_ratio,
                        'kg_mollasses_per_ton_cane' => $ten_yr_prdn->kg_mollasses_per_ton_cane,
                        'kg_bagasse_per_ton_cane' => $ten_yr_prdn->kg_bagasse_per_ton_cane,
                        'kg_fc_per_ton_cane' => $ten_yr_prdn->kg_fc_per_ton_cane,
                    );
                    
                }

            }

            return $list;

        });

        return $syn_ten_yr_ratio_yield;

    }




    public function getSynTenYrRatioYieldIdInc(){

        $id = 'TYRY1001';
        $syn_ten_yr_ratio_yield = $this->syn_ten_yr_ratio_yield->select('ten_yr_ratio_yield_id')->orderBy('ten_yr_ratio_yield_id', 'desc')->first();

        if($syn_ten_yr_ratio_yield != null){
            if($syn_ten_yr_ratio_yield->ten_yr_ratio_yield_id != null){
                $num = str_replace('TYRY', '', $syn_ten_yr_ratio_yield->ten_yr_ratio_yield_id) + 1;
                $id = 'TYRY' . $num;
            }
        }
        
        return $id;
        
    }




}