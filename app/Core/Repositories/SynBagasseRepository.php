<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynBagasseInterface;

use App\Models\SynBagasse;


class SynBagasseRepository extends BaseRepository implements SynBagasseInterface {
	


    protected $syn_bagasse;



	public function __construct(SynBagasse $syn_bagasse){

        $this->syn_bagasse = $syn_bagasse;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_bagasse = $this->cache->remember('syn_bagasse:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_bagasse = $this->syn_bagasse->newQuery();
            
            if(isset($request->q)){
                $syn_bagasse->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_bagasse->select('slug', 'mill_id', 'crop_year_id', 'bagasse_id')
                             ->with('mill', 'cropYear')
                             ->sortable()
                             ->orderBy('updated_at', 'desc')
                             ->paginate($entries);

        });

        return $syn_bagasse;

    }




    public function store($request){

        $syn_bagasse = new SynBagasse;
        $syn_bagasse->slug = $this->str->random(16);
        $syn_bagasse->bagasse_id = $this->getSynBagasseIdInc();
        $syn_bagasse->mill_id = $request->mill_id;
        $syn_bagasse->crop_year_id = $request->crop_year_id;

        $syn_bagasse->tonnes = $this->__dataType->string_to_num($request->tonnes);
        $syn_bagasse->percent_on_cane = $this->__dataType->string_to_num($request->percent_on_cane);
        $syn_bagasse->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_bagasse->percent_moisture = $this->__dataType->string_to_num($request->percent_moisture);
        $syn_bagasse->percent_fiber = $this->__dataType->string_to_num($request->percent_fiber);
        $syn_bagasse->calorific_value = $this->__dataType->string_to_num($request->calorific_value);

        $syn_bagasse->created_at = $this->carbon->now();
        $syn_bagasse->updated_at = $this->carbon->now();
        $syn_bagasse->ip_created = request()->ip();
        $syn_bagasse->ip_updated = request()->ip();
        $syn_bagasse->user_created = $this->auth->user()->user_id;
        $syn_bagasse->user_updated = $this->auth->user()->user_id;
        $syn_bagasse->save();
        
        return $syn_bagasse;

    }




    public function update($request, $slug){

        $syn_bagasse = $this->findBySlug($slug);
        $syn_bagasse->mill_id = $request->mill_id;
        $syn_bagasse->crop_year_id = $request->crop_year_id;

        $syn_bagasse->tonnes = $this->__dataType->string_to_num($request->tonnes);
        $syn_bagasse->percent_on_cane = $this->__dataType->string_to_num($request->percent_on_cane);
        $syn_bagasse->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_bagasse->percent_moisture = $this->__dataType->string_to_num($request->percent_moisture);
        $syn_bagasse->percent_fiber = $this->__dataType->string_to_num($request->percent_fiber);
        $syn_bagasse->calorific_value = $this->__dataType->string_to_num($request->calorific_value);

        $syn_bagasse->updated_at = $this->carbon->now();
        $syn_bagasse->ip_updated = request()->ip();
        $syn_bagasse->user_updated = $this->auth->user()->user_id;
        $syn_bagasse->save();
        
        return $syn_bagasse;

    }




    public function destroy($slug){

        $syn_bagasse = $this->findBySlug($slug);
        $syn_bagasse->delete();

        return $syn_bagasse;

    }




    public function findBySlug($slug){

        $syn_bagasse = $this->cache->remember('syn_bagasse:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_bagasse->where('slug', $slug)
                                     ->with('mill', 'cropYear')
                                     ->first();
        }); 
        
        if(empty($syn_bagasse)){ abort(404); }

        return $syn_bagasse;

    }



    public function getByCropYearId($crop_year_id){

        $syn_bagasse = $this->cache->remember('syn_bagasse:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_bagasse = $this->syn_bagasse->newQuery();

            return $syn_bagasse->select('mill_id', 'tonnes', 'percent_on_cane', 'percent_pol', 'percent_moisture', 'percent_fiber', 'calorific_value')
                               ->with('mill')
                               ->where('crop_year_id', $crop_year_id)
                               ->get();

        });

        return $syn_bagasse;

    }




    public function getSynBagasseIdInc(){

        $id = 'B1001';
        $syn_bagasse = $this->syn_bagasse->select('bagasse_id')->orderBy('bagasse_id', 'desc')->first();

        if($syn_bagasse != null){
            if($syn_bagasse->bagasse_id != null){
                $num = str_replace('B', '', $syn_bagasse->bagasse_id) + 1;
                $id = 'B' . $num;
            }
        }
        
        return $id;
        
    }




}