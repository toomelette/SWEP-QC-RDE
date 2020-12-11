<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynPRDNIncrementInterface;

use App\Models\SynPRDNIncrement;


class SynPRDNIncrementRepository extends BaseRepository implements SynPRDNIncrementInterface {
	


    protected $syn_prdn_increment;



	public function __construct(SynPRDNIncrement $syn_prdn_increment){

        $this->syn_prdn_increment = $syn_prdn_increment;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_prdn_increments = $this->cache->remember('syn_prdn_increment:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_prdn_increment = $this->syn_prdn_increment->newQuery();
            
            if(isset($request->q)){
                $syn_prdn_increment->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_prdn_increment->select('slug', 'mill_id', 'crop_year_id', 'prdn_increment_id')
                                      ->with('mill', 'cropYear')
                                      ->sortable()
                                      ->orderBy('updated_at', 'desc')
                                      ->paginate($entries);

        });

        return $syn_prdn_increments;

    }




    public function store($request){

        $syn_prdn_increment = new SynPRDNIncrement;
        $syn_prdn_increment->slug = $this->str->random(16);
        $syn_prdn_increment->prdn_increment_id = $this->getSynPRDNIncrementIdInc();
        $syn_prdn_increment->mill_id = $request->mill_id;
        $syn_prdn_increment->crop_year_id = $request->crop_year_id;
        $syn_prdn_increment->current_cy_prod = $this->__dataType->string_to_num($request->current_cy_prod);
        $syn_prdn_increment->past_cy_prod = $this->__dataType->string_to_num($request->past_cy_prod);
        $syn_prdn_increment->increase_decrease = $this->__dataType->string_to_num($request->increase_decrease);
        $syn_prdn_increment->sharing_ratio = $request->sharing_ratio;
        $syn_prdn_increment->created_at = $this->carbon->now();
        $syn_prdn_increment->updated_at = $this->carbon->now();
        $syn_prdn_increment->ip_created = request()->ip();
        $syn_prdn_increment->ip_updated = request()->ip();
        $syn_prdn_increment->user_created = $this->auth->user()->user_id;
        $syn_prdn_increment->user_updated = $this->auth->user()->user_id;
        $syn_prdn_increment->save();
        
        return $syn_prdn_increment;

    }




    public function update($request, $slug){

        $syn_prdn_increment = $this->findBySlug($slug);
        $syn_prdn_increment->mill_id = $request->mill_id;
        $syn_prdn_increment->crop_year_id = $request->crop_year_id;
        $syn_prdn_increment->current_cy_prod = $this->__dataType->string_to_num($request->current_cy_prod);
        $syn_prdn_increment->past_cy_prod = $this->__dataType->string_to_num($request->past_cy_prod);
        $syn_prdn_increment->increase_decrease = $this->__dataType->string_to_num($request->increase_decrease);
        $syn_prdn_increment->sharing_ratio = $request->sharing_ratio;
        $syn_prdn_increment->updated_at = $this->carbon->now();
        $syn_prdn_increment->ip_updated = request()->ip();
        $syn_prdn_increment->user_updated = $this->auth->user()->user_id;
        $syn_prdn_increment->save();
        
        return $syn_prdn_increment;

    }




    public function destroy($slug){

        $syn_prdn_increment = $this->findBySlug($slug);
        $syn_prdn_increment->delete();

        return $syn_prdn_increment;

    }




    public function findBySlug($slug){

        $syn_prdn_increment = $this->cache->remember('syn_prdn_increment:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_prdn_increment->where('slug', $slug)
                                            ->with('mill', 'cropYear')
                                            ->first();
        }); 
        
        if(empty($syn_prdn_increment)){ abort(404); }

        return $syn_prdn_increment;

    }



    public function getByCropYearId($crop_year_id){

        $syn_prdn_increments = $this->cache->remember('syn_prdn_increment:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_prdn_increment = $this->syn_prdn_increment->newQuery();

            return $syn_prdn_increment->select('mill_id', 'current_cy_prod', 'past_cy_prod', 'increase_decrease', 'sharing_ratio')
                                      ->with('mill')
                                      ->where('crop_year_id', $crop_year_id)
                                      ->get();

        });

        return $syn_prdn_increments;

    }




    public function getSynPRDNIncrementIdInc(){

        $id = 'PI1001';
        $syn_prdn_increment = $this->syn_prdn_increment->select('prdn_increment_id')->orderBy('prdn_increment_id', 'desc')->first();

        if($syn_prdn_increment != null){
            if($syn_prdn_increment->prdn_increment_id != null){
                $num = str_replace('PI', '', $syn_prdn_increment->prdn_increment_id) + 1;
                $id = 'PI' . $num;
            }
        }
        
        return $id;
        
    }




}