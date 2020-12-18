<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynMillingDurationInterface;

use App\Models\SynMillingDuration;


class SynMillingDurationRepository extends BaseRepository implements SynMillingDurationInterface {
	


    protected $syn_milling_duration;



	public function __construct(SynMillingDuration $syn_milling_duration){

        $this->syn_milling_duration = $syn_milling_duration;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_milling_duration = $this->cache->remember('syn_milling_duration:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_milling_duration = $this->syn_milling_duration->newQuery();
            
            if(isset($request->q)){
                $syn_milling_duration->whereHas('mill', function($mill) use ($request){
                                         $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                     })
                                     ->orWhereHas('cropYear', function($cy) use ($request){
                                         $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                     });
            }

            return $syn_milling_duration->select('slug', 'mill_id', 'crop_year_id', 'milling_duration_id')
                                        ->with('mill', 'cropYear')
                                        ->sortable()
                                        ->orderBy('updated_at', 'desc')
                                        ->paginate($entries);

        });

        return $syn_milling_duration;

    }




    public function store($request){

        $syn_milling_duration = new SynMillingDuration;
        $syn_milling_duration->slug = $this->str->random(16);
        $syn_milling_duration->milling_duration_id = $this->getSynMillingDurationIdInc();
        $syn_milling_duration->mill_id = $request->mill_id;
        $syn_milling_duration->crop_year_id = $request->crop_year_id;

        $syn_milling_duration->mill_start = $this->__dataType->date_parse($request->mill_start);
        $syn_milling_duration->mill_end = $this->__dataType->date_parse($request->mill_end);
        $syn_milling_duration->crop_length = $this->__dataType->string_to_num($request->crop_length);
        $syn_milling_duration->tet = $this->__dataType->string_to_num($request->tet);

        $syn_milling_duration->created_at = $this->carbon->now();
        $syn_milling_duration->updated_at = $this->carbon->now();
        $syn_milling_duration->ip_created = request()->ip();
        $syn_milling_duration->ip_updated = request()->ip();
        $syn_milling_duration->user_created = $this->auth->user()->user_id;
        $syn_milling_duration->user_updated = $this->auth->user()->user_id;
        $syn_milling_duration->save();
        
        return $syn_milling_duration;

    }




    public function update($request, $slug){

        $syn_milling_duration = $this->findBySlug($slug);
        $syn_milling_duration->mill_id = $request->mill_id;
        $syn_milling_duration->crop_year_id = $request->crop_year_id;

        $syn_milling_duration->mill_start = $this->__dataType->date_parse($request->mill_start);
        $syn_milling_duration->mill_end = $this->__dataType->date_parse($request->mill_end);
        $syn_milling_duration->crop_length = $this->__dataType->string_to_num($request->crop_length);
        $syn_milling_duration->tet = $this->__dataType->string_to_num($request->tet);
        
        $syn_milling_duration->updated_at = $this->carbon->now();
        $syn_milling_duration->ip_updated = request()->ip();
        $syn_milling_duration->user_updated = $this->auth->user()->user_id;
        $syn_milling_duration->save();
        
        return $syn_milling_duration;

    }




    public function destroy($slug){

        $syn_milling_duration = $this->findBySlug($slug);
        $syn_milling_duration->delete();

        return $syn_milling_duration;

    }




    public function findBySlug($slug){

        $syn_milling_duration = $this->cache->remember('syn_milling_duration:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_milling_duration->where('slug', $slug)
                                               ->with('mill', 'cropYear')
                                               ->first();
        }); 
        
        if(empty($syn_milling_duration)){ abort(404); }

        return $syn_milling_duration;

    }



    // public function getByCropYearId($crop_year_id){

    //     $syn_milling_duration = $this->cache->remember('syn_milling_duration:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

    //         $syn_milling_duration = $this->syn_milling_duration->newQuery();

    //         return $syn_milling_duration->select('mill_id', 'due_bh', 'due_trash', 'total', 'milling_duration')
    //                                   ->with('mill')
    //                                   ->where('crop_year_id', $crop_year_id)
    //                                   ->get();

    //     });

    //     return $syn_milling_duration;

    // }




    public function getSynMillingDurationIdInc(){

        $id = 'MD1001';
        $syn_milling_duration = $this->syn_milling_duration->select('milling_duration_id')->orderBy('milling_duration_id', 'desc')->first();

        if($syn_milling_duration != null){
            if($syn_milling_duration->milling_duration_id != null){
                $num = str_replace('MD', '', $syn_milling_duration->milling_duration_id) + 1;
                $id = 'MD' . $num;
            }
        }
        
        return $id;
        
    }




}