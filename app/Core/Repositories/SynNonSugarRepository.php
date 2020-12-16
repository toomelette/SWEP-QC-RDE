<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynNonSugarInterface;

use App\Models\SynNonSugar;


class SynNonSugarRepository extends BaseRepository implements SynNonSugarInterface {
	


    protected $syn_non_sugar;



	public function __construct(SynNonSugar $syn_non_sugar){

        $this->syn_non_sugar = $syn_non_sugar;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_non_sugar = $this->cache->remember('syn_non_sugar:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_non_sugar = $this->syn_non_sugar->newQuery();
            
            if(isset($request->q)){
                $syn_non_sugar->whereHas('mill', function($mill) use ($request){
                                  $mill->where('name', 'LIKE', '%'. $request->q .'%');
                              })
                              ->orWhereHas('cropYear', function($cy) use ($request){
                                  $cy->where('name', 'LIKE', '%'. $request->q .'%');
                              });
            }

            return $syn_non_sugar->select('slug', 'mill_id', 'crop_year_id', 'non_sugar_id')
                                 ->with('mill', 'cropYear')
                                 ->sortable()
                                 ->orderBy('updated_at', 'desc')
                                 ->paginate($entries);

        });

        return $syn_non_sugar;

    }




    public function store($request){

        $syn_non_sugar = new SynNonSugar;
        $syn_non_sugar->slug = $this->str->random(16);
        $syn_non_sugar->non_sugar_id = $this->getSynNonSugarIdInc();
        $syn_non_sugar->mill_id = $request->mill_id;
        $syn_non_sugar->crop_year_id = $request->crop_year_id;

        $syn_non_sugar->first_expressed_juice = $this->__dataType->string_to_num($request->first_expressed_juice);
        $syn_non_sugar->last_expressed_juice = $this->__dataType->string_to_num($request->last_expressed_juice);
        $syn_non_sugar->mixed_juice = $this->__dataType->string_to_num($request->mixed_juice);
        $syn_non_sugar->syrup = $this->__dataType->string_to_num($request->syrup);
        $syn_non_sugar->molasses = $this->__dataType->string_to_num($request->molasses);
        $syn_non_sugar->sugar = $this->__dataType->string_to_num($request->sugar);

        $syn_non_sugar->created_at = $this->carbon->now();
        $syn_non_sugar->updated_at = $this->carbon->now();
        $syn_non_sugar->ip_created = request()->ip();
        $syn_non_sugar->ip_updated = request()->ip();
        $syn_non_sugar->user_created = $this->auth->user()->user_id;
        $syn_non_sugar->user_updated = $this->auth->user()->user_id;
        $syn_non_sugar->save();
        
        return $syn_non_sugar;

    }




    public function update($request, $slug){

        $syn_non_sugar = $this->findBySlug($slug);
        $syn_non_sugar->mill_id = $request->mill_id;
        $syn_non_sugar->crop_year_id = $request->crop_year_id;

        $syn_non_sugar->first_expressed_juice = $this->__dataType->string_to_num($request->first_expressed_juice);
        $syn_non_sugar->last_expressed_juice = $this->__dataType->string_to_num($request->last_expressed_juice);
        $syn_non_sugar->mixed_juice = $this->__dataType->string_to_num($request->mixed_juice);
        $syn_non_sugar->syrup = $this->__dataType->string_to_num($request->syrup);
        $syn_non_sugar->molasses = $this->__dataType->string_to_num($request->molasses);
        $syn_non_sugar->sugar = $this->__dataType->string_to_num($request->sugar);

        $syn_non_sugar->updated_at = $this->carbon->now();
        $syn_non_sugar->ip_updated = request()->ip();
        $syn_non_sugar->user_updated = $this->auth->user()->user_id;
        $syn_non_sugar->save();
        
        return $syn_non_sugar;

    }




    public function destroy($slug){

        $syn_non_sugar = $this->findBySlug($slug);
        $syn_non_sugar->delete();

        return $syn_non_sugar;

    }




    public function findBySlug($slug){

        $syn_non_sugar = $this->cache->remember('syn_non_sugar:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_non_sugar->where('slug', $slug)
                                     ->with('mill', 'cropYear')
                                     ->first();
        }); 
        
        if(empty($syn_non_sugar)){ abort(404); }

        return $syn_non_sugar;

    }



    public function getByCropYearId($crop_year_id){

        $syn_non_sugar = $this->cache->remember('syn_non_sugar:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_non_sugar = $this->syn_non_sugar->newQuery();

            return $syn_non_sugar->select('mill_id', 'first_expressed_juice', 'last_expressed_juice', 'mixed_juice', 'syrup', 'molasses', 'sugar')
                               ->with('mill')
                               ->where('crop_year_id', $crop_year_id)
                               ->get();

        });

        return $syn_non_sugar;

    }




    public function getSynNonSugarIdInc(){

        $id = 'NS1001';
        $syn_non_sugar = $this->syn_non_sugar->select('non_sugar_id')->orderBy('non_sugar_id', 'desc')->first();

        if($syn_non_sugar != null){
            if($syn_non_sugar->non_sugar_id != null){
                $num = str_replace('NS', '', $syn_non_sugar->non_sugar_id) + 1;
                $id = 'NS' . $num;
            }
        }
        
        return $id;
        
    }




}