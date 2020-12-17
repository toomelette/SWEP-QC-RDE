<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynKgSugarDueBHInterface;

use App\Models\SynKgSugarDueBH;


class SynKgSugarDueBHRepository extends BaseRepository implements SynKgSugarDueBHInterface {
	


    protected $syn_kg_sugar_due_bh;



	public function __construct(SynKgSugarDueBH $syn_kg_sugar_due_bh){

        $this->syn_kg_sugar_due_bh = $syn_kg_sugar_due_bh;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_kg_sugar_due_bh = $this->cache->remember('syn_kg_sugar_due_bh:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_kg_sugar_due_bh = $this->syn_kg_sugar_due_bh->newQuery();
            
            if(isset($request->q)){
                $syn_kg_sugar_due_bh->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
}

            return $syn_kg_sugar_due_bh->select('slug', 'mill_id', 'crop_year_id', 'kg_sugar_due_bh_id')
                                       ->with('mill', 'cropYear')
                                       ->sortable()
                                       ->orderBy('updated_at', 'desc')
                                       ->paginate($entries);

        });

        return $syn_kg_sugar_due_bh;

    }




    public function store($request){

        $syn_kg_sugar_due_bh = new SynKgSugarDueBH;
        $syn_kg_sugar_due_bh->slug = $this->str->random(16);
        $syn_kg_sugar_due_bh->kg_sugar_due_bh_id = $this->getSynKgSugarDueBHIdInc();
        $syn_kg_sugar_due_bh->mill_id = $request->mill_id;
        $syn_kg_sugar_due_bh->crop_year_id = $request->crop_year_id;

        $syn_kg_sugar_due_bh->standard_oar = $this->__dataType->string_to_num($request->standard_oar);
        $syn_kg_sugar_due_bh->actual_oar = $this->__dataType->string_to_num($request->actual_oar);
        $syn_kg_sugar_due_bh->additional_kg_sugar = $this->__dataType->string_to_num($request->additional_kg_sugar);

        $syn_kg_sugar_due_bh->created_at = $this->carbon->now();
        $syn_kg_sugar_due_bh->updated_at = $this->carbon->now();
        $syn_kg_sugar_due_bh->ip_created = request()->ip();
        $syn_kg_sugar_due_bh->ip_updated = request()->ip();
        $syn_kg_sugar_due_bh->user_created = $this->auth->user()->user_id;
        $syn_kg_sugar_due_bh->user_updated = $this->auth->user()->user_id;
        $syn_kg_sugar_due_bh->save();
        
        return $syn_kg_sugar_due_bh;

    }




    public function update($request, $slug){

        $syn_kg_sugar_due_bh = $this->findBySlug($slug);
        $syn_kg_sugar_due_bh->mill_id = $request->mill_id;
        $syn_kg_sugar_due_bh->crop_year_id = $request->crop_year_id;

        $syn_kg_sugar_due_bh->standard_oar = $this->__dataType->string_to_num($request->standard_oar);
        $syn_kg_sugar_due_bh->actual_oar = $this->__dataType->string_to_num($request->actual_oar);
        $syn_kg_sugar_due_bh->additional_kg_sugar = $this->__dataType->string_to_num($request->additional_kg_sugar);

        $syn_kg_sugar_due_bh->updated_at = $this->carbon->now();
        $syn_kg_sugar_due_bh->ip_updated = request()->ip();
        $syn_kg_sugar_due_bh->user_updated = $this->auth->user()->user_id;
        $syn_kg_sugar_due_bh->save();
        
        return $syn_kg_sugar_due_bh;

    }




    public function destroy($slug){

        $syn_kg_sugar_due_bh = $this->findBySlug($slug);
        $syn_kg_sugar_due_bh->delete();

        return $syn_kg_sugar_due_bh;

    }




    public function findBySlug($slug){

        $syn_kg_sugar_due_bh = $this->cache->remember('syn_kg_sugar_due_bh:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_kg_sugar_due_bh->where('slug', $slug)
                                             ->with('mill', 'cropYear')
                                             ->first();
        }); 
        
        if(empty($syn_kg_sugar_due_bh)){ abort(404); }

        return $syn_kg_sugar_due_bh;

    }



    public function getByCropYearId($crop_year_id){

        $syn_kg_sugar_due_bh = $this->cache->remember('syn_kg_sugar_due_bh:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_kg_sugar_due_bh = $this->syn_kg_sugar_due_bh->newQuery();

            return $syn_kg_sugar_due_bh->select('mill_id', 'standard_oar', 'actual_oar', 'additional_kg_sugar')
                                       ->with('mill')
                                       ->where('crop_year_id', $crop_year_id)
                                       ->get();

        });

        return $syn_kg_sugar_due_bh;

    }




    public function getSynKgSugarDueBHIdInc(){

        $id = 'KSDBH1001';
        $syn_kg_sugar_due_bh = $this->syn_kg_sugar_due_bh->select('kg_sugar_due_bh_id')->orderBy('kg_sugar_due_bh_id', 'desc')->first();

        if($syn_kg_sugar_due_bh != null){
            if($syn_kg_sugar_due_bh->kg_sugar_due_bh_id != null){
                $num = str_replace('KSDBH', '', $syn_kg_sugar_due_bh->kg_sugar_due_bh_id) + 1;
                $id = 'KSDBH' . $num;
            }
        }
        
        return $id;
        
    }




}