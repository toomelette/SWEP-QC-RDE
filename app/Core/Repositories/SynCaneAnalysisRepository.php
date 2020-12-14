<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynCaneAnalysisInterface;

use App\Models\SynCaneAnalysis;


class SynCaneAnalysisRepository extends BaseRepository implements SynCaneAnalysisInterface {
	


    protected $syn_cane_analysis;



	public function __construct(SynCaneAnalysis $syn_cane_analysis){

        $this->syn_cane_analysis = $syn_cane_analysis;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_cane_analysis = $this->cache->remember('syn_cane_analysis:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_cane_analysis = $this->syn_cane_analysis->newQuery();
            
            if(isset($request->q)){
                $syn_cane_analysis->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_cane_analysis->select('slug', 'mill_id', 'crop_year_id', 'cane_analysis_id')
                                      ->with('mill', 'cropYear')
                                      ->sortable()
                                      ->orderBy('updated_at', 'desc')
                                      ->paginate($entries);

        });

        return $syn_cane_analysis;

    }




    public function store($request){

        $syn_cane_analysis = new SynCaneAnalysis;
        $syn_cane_analysis->slug = $this->str->random(16);
        $syn_cane_analysis->cane_analysis_id = $this->getSynCaneAnalysisIdInc();
        $syn_cane_analysis->mill_id = $request->mill_id;
        $syn_cane_analysis->crop_year_id = $request->crop_year_id;
        $syn_cane_analysis->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_cane_analysis->percent_sucrose = $this->__dataType->string_to_num($request->percent_sucrose);
        $syn_cane_analysis->percent_fiber = $this->__dataType->string_to_num($request->percent_fiber);
        $syn_cane_analysis->percent_trash = $this->__dataType->string_to_num($request->percent_trash);
        $syn_cane_analysis->pol_percent_fiber = $this->__dataType->string_to_num($request->pol_percent_fiber);
        $syn_cane_analysis->created_at = $this->carbon->now();
        $syn_cane_analysis->updated_at = $this->carbon->now();
        $syn_cane_analysis->ip_created = request()->ip();
        $syn_cane_analysis->ip_updated = request()->ip();
        $syn_cane_analysis->user_created = $this->auth->user()->user_id;
        $syn_cane_analysis->user_updated = $this->auth->user()->user_id;
        $syn_cane_analysis->save();
        
        return $syn_cane_analysis;

    }




    public function update($request, $slug){

        $syn_cane_analysis = $this->findBySlug($slug);
        $syn_cane_analysis->mill_id = $request->mill_id;
        $syn_cane_analysis->crop_year_id = $request->crop_year_id;
        $syn_cane_analysis->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_cane_analysis->percent_sucrose = $this->__dataType->string_to_num($request->percent_sucrose);
        $syn_cane_analysis->percent_fiber = $this->__dataType->string_to_num($request->percent_fiber);
        $syn_cane_analysis->percent_trash = $this->__dataType->string_to_num($request->percent_trash);
        $syn_cane_analysis->pol_percent_fiber = $this->__dataType->string_to_num($request->pol_percent_fiber);
        $syn_cane_analysis->updated_at = $this->carbon->now();
        $syn_cane_analysis->ip_updated = request()->ip();
        $syn_cane_analysis->user_updated = $this->auth->user()->user_id;
        $syn_cane_analysis->save();
        
        return $syn_cane_analysis;

    }




    public function destroy($slug){

        $syn_cane_analysis = $this->findBySlug($slug);
        $syn_cane_analysis->delete();

        return $syn_cane_analysis;

    }




    public function findBySlug($slug){

        $syn_cane_analysis = $this->cache->remember('syn_cane_analysis:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_cane_analysis->where('slug', $slug)
                                            ->with('mill', 'cropYear')
                                            ->first();
        }); 
        
        if(empty($syn_cane_analysis)){ abort(404); }

        return $syn_cane_analysis;

    }



    public function getByCropYearId($crop_year_id){

        $syn_cane_analysis = $this->cache->remember('syn_cane_analysis:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_cane_analysis = $this->syn_cane_analysis->newQuery();

            return $syn_cane_analysis->select('mill_id', 'percent_pol', 'percent_sucrose', 'percent_fiber', 'percent_trash', 'pol_percent_fiber')
                                      ->with('mill')
                                      ->where('crop_year_id', $crop_year_id)
                                      ->get();

        });

        return $syn_cane_analysis;

    }




    public function getSynCaneAnalysisIdInc(){

        $id = 'CA1001';
        $syn_cane_analysis = $this->syn_cane_analysis->select('cane_analysis_id')->orderBy('cane_analysis_id', 'desc')->first();

        if($syn_cane_analysis != null){
            if($syn_cane_analysis->cane_analysis_id != null){
                $num = str_replace('CA', '', $syn_cane_analysis->cane_analysis_id) + 1;
                $id = 'CA' . $num;
            }
        }
        
        return $id;
        
    }




}