<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynGrindStoppageInterface;

use App\Models\SynGrindStoppage;


class SynGrindStoppageRepository extends BaseRepository implements SynGrindStoppageInterface {
	


    protected $syn_grind_stoppage;



	public function __construct(SynGrindStoppage $syn_grind_stoppage){

        $this->syn_grind_stoppage = $syn_grind_stoppage;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_grind_stoppage = $this->cache->remember('syn_grind_stoppage:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_grind_stoppage = $this->syn_grind_stoppage->newQuery();
            
            if(isset($request->q)){
                $syn_grind_stoppage->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_grind_stoppage->select('slug', 'mill_id', 'crop_year_id', 'grind_stoppage_id')
                                      ->with('mill', 'cropYear')
                                      ->sortable()
                                      ->orderBy('updated_at', 'desc')
                                      ->paginate($entries);

        });

        return $syn_grind_stoppage;

    }




    public function store($request){

        $syn_grind_stoppage = new SynGrindStoppage;
        $syn_grind_stoppage->slug = $this->str->random(16);
        $syn_grind_stoppage->grind_stoppage_id = $this->getSynGrindStoppageIdInc();
        $syn_grind_stoppage->mill_id = $request->mill_id;
        $syn_grind_stoppage->crop_year_id = $request->crop_year_id;
        $syn_grind_stoppage->actual_grind_hrs = $this->__dataType->string_to_num($request->actual_grind_hrs);
        $syn_grind_stoppage->actual_grind_tet = $this->__dataType->string_to_num($request->actual_grind_tet);
        $syn_grind_stoppage->total_delays_hrs = $this->__dataType->string_to_num($request->total_delays_hrs);
        $syn_grind_stoppage->total_delays_tet = $this->__dataType->string_to_num($request->total_delays_tet);
        $syn_grind_stoppage->created_at = $this->carbon->now();
        $syn_grind_stoppage->updated_at = $this->carbon->now();
        $syn_grind_stoppage->ip_created = request()->ip();
        $syn_grind_stoppage->ip_updated = request()->ip();
        $syn_grind_stoppage->user_created = $this->auth->user()->user_id;
        $syn_grind_stoppage->user_updated = $this->auth->user()->user_id;
        $syn_grind_stoppage->save();
        
        return $syn_grind_stoppage;

    }




    public function update($request, $slug){

        $syn_grind_stoppage = $this->findBySlug($slug);
        $syn_grind_stoppage->mill_id = $request->mill_id;
        $syn_grind_stoppage->crop_year_id = $request->crop_year_id;
        $syn_grind_stoppage->actual_grind_hrs = $this->__dataType->string_to_num($request->actual_grind_hrs);
        $syn_grind_stoppage->actual_grind_tet = $this->__dataType->string_to_num($request->actual_grind_tet);
        $syn_grind_stoppage->total_delays_hrs = $this->__dataType->string_to_num($request->total_delays_hrs);
        $syn_grind_stoppage->total_delays_tet = $this->__dataType->string_to_num($request->total_delays_tet);
        $syn_grind_stoppage->updated_at = $this->carbon->now();
        $syn_grind_stoppage->ip_updated = request()->ip();
        $syn_grind_stoppage->user_updated = $this->auth->user()->user_id;
        $syn_grind_stoppage->save();
        
        return $syn_grind_stoppage;

    }




    public function destroy($slug){

        $syn_grind_stoppage = $this->findBySlug($slug);
        $syn_grind_stoppage->delete();

        return $syn_grind_stoppage;

    }




    public function findBySlug($slug){

        $syn_grind_stoppage = $this->cache->remember('syn_grind_stoppage:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_grind_stoppage->where('slug', $slug)
                                            ->with('mill', 'cropYear')
                                            ->first();
        }); 
        
        if(empty($syn_grind_stoppage)){ abort(404); }

        return $syn_grind_stoppage;

    }



    public function getByCropYearId($crop_year_id){

        $syn_grind_stoppage = $this->cache->remember('syn_grind_stoppage:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_grind_stoppage = $this->syn_grind_stoppage->newQuery();

            return $syn_grind_stoppage->select('mill_id', 'actual_grind_hrs', 'actual_grind_tet', 'total_delays_hrs', 'total_delays_tet')
                                      ->with('mill')
                                      ->where('crop_year_id', $crop_year_id)
                                      ->get();

        });

        return $syn_grind_stoppage;

    }




    public function getSynGrindStoppageIdInc(){

        $id = 'GS1001';
        $syn_grind_stoppage = $this->syn_grind_stoppage->select('grind_stoppage_id')->orderBy('grind_stoppage_id', 'desc')->first();

        if($syn_grind_stoppage != null){
            if($syn_grind_stoppage->grind_stoppage_id != null){
                $num = str_replace('GS', '', $syn_grind_stoppage->grind_stoppage_id) + 1;
                $id = 'GS' . $num;
            }
        }
        
        return $id;
        
    }




}