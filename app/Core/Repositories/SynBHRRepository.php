<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynBHRInterface;

use App\Models\SynBHR;


class SynBHRRepository extends BaseRepository implements SynBHRInterface {
	


    protected $syn_bhr;



	public function __construct(SynBHR $syn_bhr){

        $this->syn_bhr = $syn_bhr;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_bhr = $this->cache->remember('syn_bhr:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_bhr = $this->syn_bhr->newQuery();
            
            if(isset($request->q)){
                $syn_bhr->whereHas('mill', function($mill) use ($request){
                            $mill->where('name', 'LIKE', '%'. $request->q .'%');
                        })
                        ->orWhereHas('cropYear', function($cy) use ($request){
                            $cy->where('name', 'LIKE', '%'. $request->q .'%');
                        });
}

            return $syn_bhr->select('slug', 'mill_id', 'crop_year_id', 'bhr_id')
                           ->with('mill', 'cropYear')
                           ->sortable()
                           ->orderBy('updated_at', 'desc')
                           ->paginate($entries);

        });

        return $syn_bhr;

    }




    public function store($request){

        $syn_bhr = new SynBHR;
        $syn_bhr->slug = $this->str->random(16);
        $syn_bhr->bhr_id = $this->getSynBHRIdInc();
        $syn_bhr->mill_id = $request->mill_id;
        $syn_bhr->crop_year_id = $request->crop_year_id;

        $syn_bhr->actual_bhr = $this->__dataType->string_to_num($request->actual_bhr);
        $syn_bhr->theoritical_bhr = $this->__dataType->string_to_num($request->theoritical_bhr);
        $syn_bhr->basic_bhr = $this->__dataType->string_to_num($request->basic_bhr);
        $syn_bhr->reduced_bhr = $this->__dataType->string_to_num($request->reduced_bhr);

        $syn_bhr->created_at = $this->carbon->now();
        $syn_bhr->updated_at = $this->carbon->now();
        $syn_bhr->ip_created = request()->ip();
        $syn_bhr->ip_updated = request()->ip();
        $syn_bhr->user_created = $this->auth->user()->user_id;
        $syn_bhr->user_updated = $this->auth->user()->user_id;
        $syn_bhr->save();
        
        return $syn_bhr;

    }




    public function update($request, $slug){

        $syn_bhr = $this->findBySlug($slug);
        $syn_bhr->mill_id = $request->mill_id;
        $syn_bhr->crop_year_id = $request->crop_year_id;

        $syn_bhr->actual_bhr = $this->__dataType->string_to_num($request->actual_bhr);
        $syn_bhr->theoritical_bhr = $this->__dataType->string_to_num($request->theoritical_bhr);
        $syn_bhr->basic_bhr = $this->__dataType->string_to_num($request->basic_bhr);
        $syn_bhr->reduced_bhr = $this->__dataType->string_to_num($request->reduced_bhr);

        $syn_bhr->updated_at = $this->carbon->now();
        $syn_bhr->ip_updated = request()->ip();
        $syn_bhr->user_updated = $this->auth->user()->user_id;
        $syn_bhr->save();
        
        return $syn_bhr;

    }




    public function destroy($slug){

        $syn_bhr = $this->findBySlug($slug);
        $syn_bhr->delete();

        return $syn_bhr;

    }




    public function findBySlug($slug){

        $syn_bhr = $this->cache->remember('syn_bhr:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_bhr->where('slug', $slug)
                                 ->with('mill', 'cropYear')
                                 ->first();
        }); 
        
        if(empty($syn_bhr)){ abort(404); }

        return $syn_bhr;

    }



    public function getByCropYearId($crop_year_id){

        $syn_bhr = $this->cache->remember('syn_bhr:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_bhr = $this->syn_bhr->newQuery();

            return $syn_bhr->select('mill_id', 'actual_bhr', 'theoritical_bhr', 'basic_bhr', 'reduced_bhr')
                           ->with('mill')
                           ->where('crop_year_id', $crop_year_id)
                           ->get();

        });

        return $syn_bhr;

    }




    public function getSynBHRIdInc(){

        $id = 'BHR1001';
        $syn_bhr = $this->syn_bhr->select('bhr_id')->orderBy('bhr_id', 'desc')->first();

        if($syn_bhr != null){
            if($syn_bhr->bhr_id != null){
                $num = str_replace('BHR', '', $syn_bhr->bhr_id) + 1;
                $id = 'BHR' . $num;
            }
        }
        
        return $id;
        
    }




}