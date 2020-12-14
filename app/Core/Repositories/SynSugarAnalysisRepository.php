<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynSugarAnalysisInterface;

use App\Models\SynSugarAnalysis;


class SynSugarAnalysisRepository extends BaseRepository implements SynSugarAnalysisInterface {
	


    protected $syn_sugar_analysis;



	public function __construct(SynSugarAnalysis $syn_sugar_analysis){

        $this->syn_sugar_analysis = $syn_sugar_analysis;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_sugar_analysis = $this->cache->remember('syn_sugar_analysis:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_sugar_analysis = $this->syn_sugar_analysis->newQuery();
            
            if(isset($request->q)){
                $syn_sugar_analysis->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_sugar_analysis->select('slug', 'mill_id', 'crop_year_id', 'sugar_analysis_id')
                                      ->with('mill', 'cropYear')
                                      ->sortable()
                                      ->orderBy('updated_at', 'desc')
                                      ->paginate($entries);

        });

        return $syn_sugar_analysis;

    }




    public function store($request){

        $syn_sugar_analysis = new SynSugarAnalysis;
        $syn_sugar_analysis->slug = $this->str->random(16);
        $syn_sugar_analysis->sugar_analysis_id = $this->getSynSugarAnalysisIdInc();
        $syn_sugar_analysis->mill_id = $request->mill_id;
        $syn_sugar_analysis->crop_year_id = $request->crop_year_id;

        $syn_sugar_analysis->gravity_purity = $this->__dataType->string_to_num($request->gravity_purity);
        $syn_sugar_analysis->apparent_purity = $this->__dataType->string_to_num($request->apparent_purity);
        $syn_sugar_analysis->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_sugar_analysis->percent_sucrose = $this->__dataType->string_to_num($request->percent_sucrose);
        $syn_sugar_analysis->percent_moisture = $this->__dataType->string_to_num($request->percent_moisture);
        $syn_sugar_analysis->di = $this->__dataType->string_to_num($request->di);
        $syn_sugar_analysis->clarity_turbidity = $this->__dataType->string_to_num($request->clarity_turbidity);
        $syn_sugar_analysis->percent_ash = $this->__dataType->string_to_num($request->percent_ash);

        $syn_sugar_analysis->created_at = $this->carbon->now();
        $syn_sugar_analysis->updated_at = $this->carbon->now();
        $syn_sugar_analysis->ip_created = request()->ip();
        $syn_sugar_analysis->ip_updated = request()->ip();
        $syn_sugar_analysis->user_created = $this->auth->user()->user_id;
        $syn_sugar_analysis->user_updated = $this->auth->user()->user_id;
        $syn_sugar_analysis->save();
        
        return $syn_sugar_analysis;

    }




    public function update($request, $slug){

        $syn_sugar_analysis = $this->findBySlug($slug);
        $syn_sugar_analysis->mill_id = $request->mill_id;
        $syn_sugar_analysis->crop_year_id = $request->crop_year_id;

        $syn_sugar_analysis->gravity_purity = $this->__dataType->string_to_num($request->gravity_purity);
        $syn_sugar_analysis->apparent_purity = $this->__dataType->string_to_num($request->apparent_purity);
        $syn_sugar_analysis->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_sugar_analysis->percent_sucrose = $this->__dataType->string_to_num($request->percent_sucrose);
        $syn_sugar_analysis->percent_moisture = $this->__dataType->string_to_num($request->percent_moisture);
        $syn_sugar_analysis->di = $this->__dataType->string_to_num($request->di);
        $syn_sugar_analysis->clarity_turbidity = $this->__dataType->string_to_num($request->clarity_turbidity);
        $syn_sugar_analysis->percent_ash = $this->__dataType->string_to_num($request->percent_ash);

        $syn_sugar_analysis->updated_at = $this->carbon->now();
        $syn_sugar_analysis->ip_updated = request()->ip();
        $syn_sugar_analysis->user_updated = $this->auth->user()->user_id;
        $syn_sugar_analysis->save();
        
        return $syn_sugar_analysis;

    }




    public function destroy($slug){

        $syn_sugar_analysis = $this->findBySlug($slug);
        $syn_sugar_analysis->delete();

        return $syn_sugar_analysis;

    }




    public function findBySlug($slug){

        $syn_sugar_analysis = $this->cache->remember('syn_sugar_analysis:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_sugar_analysis->where('slug', $slug)
                                            ->with('mill', 'cropYear')
                                            ->first();
        }); 
        
        if(empty($syn_sugar_analysis)){ abort(404); }

        return $syn_sugar_analysis;

    }



    public function getByCropYearId($crop_year_id){

        $syn_sugar_analysis = $this->cache->remember('syn_sugar_analysis:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_sugar_analysis = $this->syn_sugar_analysis->newQuery();

            return $syn_sugar_analysis->select('mill_id', 'gravity_purity', 'apparent_purity', 'percent_pol', 'percent_sucrose', 'percent_moisture', 'di', 'clarity_turbidity', 'percent_ash')
                                      ->with('mill')
                                      ->where('crop_year_id', $crop_year_id)
                                      ->get();

        });

        return $syn_sugar_analysis;

    }




    public function getSynSugarAnalysisIdInc(){

        $id = 'SA1001';
        $syn_sugar_analysis = $this->syn_sugar_analysis->select('sugar_analysis_id')->orderBy('sugar_analysis_id', 'desc')->first();

        if($syn_sugar_analysis != null){
            if($syn_sugar_analysis->sugar_analysis_id != null){
                $num = str_replace('SA', '', $syn_sugar_analysis->sugar_analysis_id) + 1;
                $id = 'SA' . $num;
            }
        }
        
        return $id;
        
    }




}