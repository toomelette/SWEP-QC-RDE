<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynClarificationInterface;

use App\Models\SynClarification;


class SynClarificationRepository extends BaseRepository implements SynClarificationInterface {
	


    protected $syn_clarification;



	public function __construct(SynClarification $syn_clarification){

        $this->syn_clarification = $syn_clarification;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_clarification = $this->cache->remember('syn_clarification:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_clarification = $this->syn_clarification->newQuery();
            
            if(isset($request->q)){
                $syn_clarification->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_clarification->select('slug', 'mill_id', 'crop_year_id', 'clarification_id')
                                      ->with('mill', 'cropYear')
                                      ->sortable()
                                      ->orderBy('updated_at', 'desc')
                                      ->paginate($entries);

        });

        return $syn_clarification;

    }




    public function store($request){

        $syn_clarification = new SynClarification;
        $syn_clarification->slug = $this->str->random(16);
        $syn_clarification->clarification_id = $this->getSynClarificationIdInc();
        $syn_clarification->mill_id = $request->mill_id;
        $syn_clarification->crop_year_id = $request->crop_year_id;

        $syn_clarification->juice_apparent_purity = $this->__dataType->string_to_num($request->juice_apparent_purity);
        $syn_clarification->juice_brix = $this->__dataType->string_to_num($request->juice_brix);
        $syn_clarification->juice_ph = $this->__dataType->string_to_num($request->juice_ph);
        $syn_clarification->juice_clarity = $this->__dataType->string_to_num($request->juice_clarity);
        $syn_clarification->lime_tonnes_used = $this->__dataType->string_to_num($request->lime_tonnes_used);
        $syn_clarification->lime_cao = $this->__dataType->string_to_num($request->lime_cao);
        $syn_clarification->lime_cao_per_tc = $this->__dataType->string_to_num($request->lime_cao_per_tc);

        $syn_clarification->created_at = $this->carbon->now();
        $syn_clarification->updated_at = $this->carbon->now();
        $syn_clarification->ip_created = request()->ip();
        $syn_clarification->ip_updated = request()->ip();
        $syn_clarification->user_created = $this->auth->user()->user_id;
        $syn_clarification->user_updated = $this->auth->user()->user_id;
        $syn_clarification->save();
        
        return $syn_clarification;

    }




    public function update($request, $slug){

        $syn_clarification = $this->findBySlug($slug);
        $syn_clarification->mill_id = $request->mill_id;
        $syn_clarification->crop_year_id = $request->crop_year_id;

        $syn_clarification->juice_apparent_purity = $this->__dataType->string_to_num($request->juice_apparent_purity);
        $syn_clarification->juice_brix = $this->__dataType->string_to_num($request->juice_brix);
        $syn_clarification->juice_ph = $this->__dataType->string_to_num($request->juice_ph);
        $syn_clarification->juice_clarity = $this->__dataType->string_to_num($request->juice_clarity);
        $syn_clarification->lime_tonnes_used = $this->__dataType->string_to_num($request->lime_tonnes_used);
        $syn_clarification->lime_cao = $this->__dataType->string_to_num($request->lime_cao);
        $syn_clarification->lime_cao_per_tc = $this->__dataType->string_to_num($request->lime_cao_per_tc);

        $syn_clarification->updated_at = $this->carbon->now();
        $syn_clarification->ip_updated = request()->ip();
        $syn_clarification->user_updated = $this->auth->user()->user_id;
        $syn_clarification->save();
        
        return $syn_clarification;

    }




    public function destroy($slug){

        $syn_clarification = $this->findBySlug($slug);
        $syn_clarification->delete();

        return $syn_clarification;

    }




    public function findBySlug($slug){

        $syn_clarification = $this->cache->remember('syn_clarification:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_clarification->where('slug', $slug)
                                           ->with('mill', 'cropYear')
                                           ->first();
        }); 
        
        if(empty($syn_clarification)){ abort(404); }

        return $syn_clarification;

    }



    public function getByCropYearId($crop_year_id){

        $syn_clarification = $this->cache->remember('syn_clarification:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_clarification = $this->syn_clarification->newQuery();

            return $syn_clarification->select('mill_id', 'juice_apparent_purity', 'juice_brix', 'juice_ph', 'juice_clarity', 'lime_tonnes_used', 'lime_cao', 'lime_cao_per_tc')
                                     ->with('mill')
                                     ->where('crop_year_id', $crop_year_id)
                                     ->get();

        });

        return $syn_clarification;

    }




    public function getSynClarificationIdInc(){

        $id = 'C1001';
        $syn_clarification = $this->syn_clarification->select('clarification_id')->orderBy('clarification_id', 'desc')->first();

        if($syn_clarification != null){
            if($syn_clarification->clarification_id != null){
                $num = str_replace('C', '', $syn_clarification->clarification_id) + 1;
                $id = 'C' . $num;
            }
        }
        
        return $id;
        
    }




}