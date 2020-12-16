<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynFilterCakeInterface;

use App\Models\SynFilterCake;


class SynFilterCakeRepository extends BaseRepository implements SynFilterCakeInterface {
	


    protected $syn_filter_cake;



	public function __construct(SynFilterCake $syn_filter_cake){

        $this->syn_filter_cake = $syn_filter_cake;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_filter_cake = $this->cache->remember('syn_filter_cake:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_filter_cake = $this->syn_filter_cake->newQuery();
            
            if(isset($request->q)){
                $syn_filter_cake->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_filter_cake->select('slug', 'mill_id', 'crop_year_id', 'filter_cake_id')
                                  ->with('mill', 'cropYear')
                                  ->sortable()
                                  ->orderBy('updated_at', 'desc')
                                  ->paginate($entries);

        });

        return $syn_filter_cake;

    }




    public function store($request){

        $syn_filter_cake = new SynFilterCake;
        $syn_filter_cake->slug = $this->str->random(16);
        $syn_filter_cake->filter_cake_id = $this->getSynFilterCakeIdInc();
        $syn_filter_cake->mill_id = $request->mill_id;
        $syn_filter_cake->crop_year_id = $request->crop_year_id;

        $syn_filter_cake->tonnes = $this->__dataType->string_to_num($request->tonnes);
        $syn_filter_cake->percent_on_cane = $this->__dataType->string_to_num($request->percent_on_cane);
        $syn_filter_cake->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_filter_cake->percent_moisture = $this->__dataType->string_to_num($request->percent_moisture);
        $syn_filter_cake->filtered_juice = $this->__dataType->string_to_num($request->filtered_juice);
        $syn_filter_cake->purity_drop = $this->__dataType->string_to_num($request->purity_drop);

        $syn_filter_cake->created_at = $this->carbon->now();
        $syn_filter_cake->updated_at = $this->carbon->now();
        $syn_filter_cake->ip_created = request()->ip();
        $syn_filter_cake->ip_updated = request()->ip();
        $syn_filter_cake->user_created = $this->auth->user()->user_id;
        $syn_filter_cake->user_updated = $this->auth->user()->user_id;
        $syn_filter_cake->save();
        
        return $syn_filter_cake;

    }




    public function update($request, $slug){

        $syn_filter_cake = $this->findBySlug($slug);
        $syn_filter_cake->mill_id = $request->mill_id;
        $syn_filter_cake->crop_year_id = $request->crop_year_id;

        $syn_filter_cake->tonnes = $this->__dataType->string_to_num($request->tonnes);
        $syn_filter_cake->percent_on_cane = $this->__dataType->string_to_num($request->percent_on_cane);
        $syn_filter_cake->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_filter_cake->percent_moisture = $this->__dataType->string_to_num($request->percent_moisture);
        $syn_filter_cake->filtered_juice = $this->__dataType->string_to_num($request->filtered_juice);
        $syn_filter_cake->purity_drop = $this->__dataType->string_to_num($request->purity_drop);

        $syn_filter_cake->updated_at = $this->carbon->now();
        $syn_filter_cake->ip_updated = request()->ip();
        $syn_filter_cake->user_updated = $this->auth->user()->user_id;
        $syn_filter_cake->save();
        
        return $syn_filter_cake;

    }




    public function destroy($slug){

        $syn_filter_cake = $this->findBySlug($slug);
        $syn_filter_cake->delete();

        return $syn_filter_cake;

    }




    public function findBySlug($slug){

        $syn_filter_cake = $this->cache->remember('syn_filter_cake:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_filter_cake->where('slug', $slug)
                                         ->with('mill', 'cropYear')
                                         ->first();
        }); 
        
        if(empty($syn_filter_cake)){ abort(404); }

        return $syn_filter_cake;

    }



    public function getByCropYearId($crop_year_id){

        $syn_filter_cake = $this->cache->remember('syn_filter_cake:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_filter_cake = $this->syn_filter_cake->newQuery();

            return $syn_filter_cake->select('mill_id', 'tonnes', 'percent_on_cane', 'percent_pol', 'percent_moisture', 'filtered_juice', 'purity_drop')
                               ->with('mill')
                               ->where('crop_year_id', $crop_year_id)
                               ->get();

        });

        return $syn_filter_cake;

    }




    public function getSynFilterCakeIdInc(){

        $id = 'FC1001';
        $syn_filter_cake = $this->syn_filter_cake->select('filter_cake_id')->orderBy('filter_cake_id', 'desc')->first();

        if($syn_filter_cake != null){
            if($syn_filter_cake->filter_cake_id != null){
                $num = str_replace('FC', '', $syn_filter_cake->filter_cake_id) + 1;
                $id = 'FC' . $num;
            }
        }
        
        return $id;
        
    }




}