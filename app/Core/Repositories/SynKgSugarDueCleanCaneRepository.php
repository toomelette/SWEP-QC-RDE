<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynKgSugarDueCleanCaneInterface;

use App\Models\SynKgSugarDueCleanCane;


class SynKgSugarDueCleanCaneRepository extends BaseRepository implements SynKgSugarDueCleanCaneInterface {
	


    protected $syn_kg_sugar_due_clean_cane;



	public function __construct(SynKgSugarDueCleanCane $syn_kg_sugar_due_clean_cane){

        $this->syn_kg_sugar_due_clean_cane = $syn_kg_sugar_due_clean_cane;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_kg_sugar_due_clean_cane = $this->cache->remember('syn_kg_sugar_due_clean_cane:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_kg_sugar_due_clean_cane = $this->syn_kg_sugar_due_clean_cane->newQuery();
            
            if(isset($request->q)){
                $syn_kg_sugar_due_clean_cane->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
}

            return $syn_kg_sugar_due_clean_cane->select('slug', 'mill_id', 'crop_year_id', 'kg_sugar_due_clean_cane_id')
                                               ->with('mill', 'cropYear')
                                               ->sortable()
                                               ->orderBy('updated_at', 'desc')
                                               ->paginate($entries);

        });

        return $syn_kg_sugar_due_clean_cane;

    }




    public function store($request){

        $syn_kg_sugar_due_clean_cane = new SynKgSugarDueCleanCane;
        $syn_kg_sugar_due_clean_cane->slug = $this->str->random(16);
        $syn_kg_sugar_due_clean_cane->kg_sugar_due_clean_cane_id = $this->getSynKgSugarDueCleanCaneIdInc();
        $syn_kg_sugar_due_clean_cane->mill_id = $request->mill_id;
        $syn_kg_sugar_due_clean_cane->crop_year_id = $request->crop_year_id;

        $syn_kg_sugar_due_clean_cane->trash_percent_cane = $this->__dataType->string_to_num($request->trash_percent_cane);
        $syn_kg_sugar_due_clean_cane->percent_recovery = $this->__dataType->string_to_num($request->percent_recovery);
        $syn_kg_sugar_due_clean_cane->recoverable = $this->__dataType->string_to_num($request->recoverable);

        $syn_kg_sugar_due_clean_cane->created_at = $this->carbon->now();
        $syn_kg_sugar_due_clean_cane->updated_at = $this->carbon->now();
        $syn_kg_sugar_due_clean_cane->ip_created = request()->ip();
        $syn_kg_sugar_due_clean_cane->ip_updated = request()->ip();
        $syn_kg_sugar_due_clean_cane->user_created = $this->auth->user()->user_id;
        $syn_kg_sugar_due_clean_cane->user_updated = $this->auth->user()->user_id;
        $syn_kg_sugar_due_clean_cane->save();
        
        return $syn_kg_sugar_due_clean_cane;

    }




    public function update($request, $slug){

        $syn_kg_sugar_due_clean_cane = $this->findBySlug($slug);
        $syn_kg_sugar_due_clean_cane->mill_id = $request->mill_id;
        $syn_kg_sugar_due_clean_cane->crop_year_id = $request->crop_year_id;

        $syn_kg_sugar_due_clean_cane->trash_percent_cane = $this->__dataType->string_to_num($request->trash_percent_cane);
        $syn_kg_sugar_due_clean_cane->percent_recovery = $this->__dataType->string_to_num($request->percent_recovery);
        $syn_kg_sugar_due_clean_cane->recoverable = $this->__dataType->string_to_num($request->recoverable);

        $syn_kg_sugar_due_clean_cane->updated_at = $this->carbon->now();
        $syn_kg_sugar_due_clean_cane->ip_updated = request()->ip();
        $syn_kg_sugar_due_clean_cane->user_updated = $this->auth->user()->user_id;
        $syn_kg_sugar_due_clean_cane->save();
        
        return $syn_kg_sugar_due_clean_cane;

    }




    public function destroy($slug){

        $syn_kg_sugar_due_clean_cane = $this->findBySlug($slug);
        $syn_kg_sugar_due_clean_cane->delete();

        return $syn_kg_sugar_due_clean_cane;

    }




    public function findBySlug($slug){

        $syn_kg_sugar_due_clean_cane = $this->cache->remember('syn_kg_sugar_due_clean_cane:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_kg_sugar_due_clean_cane->where('slug', $slug)
                                                     ->with('mill', 'cropYear')
                                                     ->first();
        }); 
        
        if(empty($syn_kg_sugar_due_clean_cane)){ abort(404); }

        return $syn_kg_sugar_due_clean_cane;

    }



    public function getByCropYearId($crop_year_id){

        $syn_kg_sugar_due_clean_cane = $this->cache->remember('syn_kg_sugar_due_clean_cane:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_kg_sugar_due_clean_cane = $this->syn_kg_sugar_due_clean_cane->newQuery();

            return $syn_kg_sugar_due_clean_cane->select('mill_id', 'trash_percent_cane', 'percent_recovery', 'recoverable')
                                               ->with('mill')
                                               ->where('crop_year_id', $crop_year_id)
                                               ->get();

        });

        return $syn_kg_sugar_due_clean_cane;

    }




    public function getSynKgSugarDueCleanCaneIdInc(){

        $id = 'KSDCC1001';
        $syn_kg_sugar_due_clean_cane = $this->syn_kg_sugar_due_clean_cane->select('kg_sugar_due_clean_cane_id')->orderBy('kg_sugar_due_clean_cane_id', 'desc')->first();

        if($syn_kg_sugar_due_clean_cane != null){
            if($syn_kg_sugar_due_clean_cane->kg_sugar_due_clean_cane_id != null){
                $num = str_replace('KSDCC', '', $syn_kg_sugar_due_clean_cane->kg_sugar_due_clean_cane_id) + 1;
                $id = 'KSDCC' . $num;
            }
        }
        
        return $id;
        
    }




}