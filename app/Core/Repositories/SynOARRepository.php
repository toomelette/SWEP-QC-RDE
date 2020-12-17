<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynOARInterface;

use App\Models\SynOAR;


class SynOARRepository extends BaseRepository implements SynOARInterface {
	


    protected $syn_oar;



	public function __construct(SynOAR $syn_oar){

        $this->syn_oar = $syn_oar;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_oar = $this->cache->remember('syn_oar:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_oar = $this->syn_oar->newQuery();
            
            if(isset($request->q)){
                $syn_oar->whereHas('mill', function($mill) use ($request){
                            $mill->where('name', 'LIKE', '%'. $request->q .'%');
                        })
                        ->orWhereHas('cropYear', function($cy) use ($request){
                            $cy->where('name', 'LIKE', '%'. $request->q .'%');
                        });
}

            return $syn_oar->select('slug', 'mill_id', 'crop_year_id', 'oar_id')
                           ->with('mill', 'cropYear')
                           ->sortable()
                           ->orderBy('updated_at', 'desc')
                           ->paginate($entries);

        });

        return $syn_oar;

    }




    public function store($request){

        $syn_oar = new SynOAR;
        $syn_oar->slug = $this->str->random(16);
        $syn_oar->oar_id = $this->getSynOARIdInc();
        $syn_oar->mill_id = $request->mill_id;
        $syn_oar->crop_year_id = $request->crop_year_id;

        $syn_oar->actual_oar = $this->__dataType->string_to_num($request->actual_oar);
        $syn_oar->standard_oar = $this->__dataType->string_to_num($request->standard_oar);
        $syn_oar->reduced_oar = $this->__dataType->string_to_num($request->reduced_oar);

        $syn_oar->created_at = $this->carbon->now();
        $syn_oar->updated_at = $this->carbon->now();
        $syn_oar->ip_created = request()->ip();
        $syn_oar->ip_updated = request()->ip();
        $syn_oar->user_created = $this->auth->user()->user_id;
        $syn_oar->user_updated = $this->auth->user()->user_id;
        $syn_oar->save();
        
        return $syn_oar;

    }




    public function update($request, $slug){

        $syn_oar = $this->findBySlug($slug);
        $syn_oar->mill_id = $request->mill_id;
        $syn_oar->crop_year_id = $request->crop_year_id;

        $syn_oar->actual_oar = $this->__dataType->string_to_num($request->actual_oar);
        $syn_oar->standard_oar = $this->__dataType->string_to_num($request->standard_oar);
        $syn_oar->reduced_oar = $this->__dataType->string_to_num($request->reduced_oar);

        $syn_oar->updated_at = $this->carbon->now();
        $syn_oar->ip_updated = request()->ip();
        $syn_oar->user_updated = $this->auth->user()->user_id;
        $syn_oar->save();
        
        return $syn_oar;

    }




    public function destroy($slug){

        $syn_oar = $this->findBySlug($slug);
        $syn_oar->delete();

        return $syn_oar;

    }




    public function findBySlug($slug){

        $syn_oar = $this->cache->remember('syn_oar:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_oar->where('slug', $slug)
                                 ->with('mill', 'cropYear')
                                 ->first();
        }); 
        
        if(empty($syn_oar)){ abort(404); }

        return $syn_oar;

    }



    public function getByCropYearId($crop_year_id){

        $syn_oar = $this->cache->remember('syn_oar:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_oar = $this->syn_oar->newQuery();

            return $syn_oar->select('mill_id', 'actual_oar', 'standard_oar', 'reduced_oar')
                           ->with('mill')
                           ->where('crop_year_id', $crop_year_id)
                           ->get();

        });

        return $syn_oar;

    }




    public function getSynOARIdInc(){

        $id = 'OAR1001';
        $syn_oar = $this->syn_oar->select('oar_id')->orderBy('oar_id', 'desc')->first();

        if($syn_oar != null){
            if($syn_oar->oar_id != null){
                $num = str_replace('OAR', '', $syn_oar->oar_id) + 1;
                $id = 'OAR' . $num;
            }
        }
        
        return $id;
        
    }




}