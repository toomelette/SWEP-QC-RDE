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

            return $syn_cane_analysis->select('slug', 'mill_id', 'crop_year_id', 'cane_sugar_ton_id')
                                      ->with('mill', 'cropYear')
                                      ->sortable()
                                      ->orderBy('updated_at', 'desc')
                                      ->paginate($entries);

        });

        return $syn_cane_analysis;

    }




    // public function store($request){

    //     $syn_cane_analysis = new SynCaneAnalysis;
    //     $syn_cane_analysis->slug = $this->str->random(16);
    //     $syn_cane_analysis->cane_sugar_ton_id = $this->getSynCaneAnalysisIdInc();
    //     $syn_cane_analysis->mill_id = $request->mill_id;
    //     $syn_cane_analysis->crop_year_id = $request->crop_year_id;
    //     $syn_cane_analysis->sgrcane_gross_tonnes = $this->__dataType->string_to_num($request->sgrcane_gross_tonnes);
    //     $syn_cane_analysis->sgrcane_net_tonnes = $this->__dataType->string_to_num($request->sgrcane_net_tonnes);
    //     $syn_cane_analysis->rawsgr_tonnes_due_cane = $this->__dataType->string_to_num($request->rawsgr_tonnes_due_cane);
    //     $syn_cane_analysis->rawsgr_tonnes_manufactured = $this->__dataType->string_to_num($request->rawsgr_tonnes_manufactured);
    //     $syn_cane_analysis->equivalent = $this->__dataType->string_to_num($request->equivalent);
    //     $syn_cane_analysis->created_at = $this->carbon->now();
    //     $syn_cane_analysis->updated_at = $this->carbon->now();
    //     $syn_cane_analysis->ip_created = request()->ip();
    //     $syn_cane_analysis->ip_updated = request()->ip();
    //     $syn_cane_analysis->user_created = $this->auth->user()->user_id;
    //     $syn_cane_analysis->user_updated = $this->auth->user()->user_id;
    //     $syn_cane_analysis->save();
        
    //     return $syn_cane_analysis;

    // }




    // public function update($request, $slug){

    //     $syn_cane_analysis = $this->findBySlug($slug);
    //     $syn_cane_analysis->mill_id = $request->mill_id;
    //     $syn_cane_analysis->crop_year_id = $request->crop_year_id;
    //     $syn_cane_analysis->sgrcane_gross_tonnes = $this->__dataType->string_to_num($request->sgrcane_gross_tonnes);
    //     $syn_cane_analysis->sgrcane_net_tonnes = $this->__dataType->string_to_num($request->sgrcane_net_tonnes);
    //     $syn_cane_analysis->rawsgr_tonnes_due_cane = $this->__dataType->string_to_num($request->rawsgr_tonnes_due_cane);
    //     $syn_cane_analysis->rawsgr_tonnes_manufactured = $this->__dataType->string_to_num($request->rawsgr_tonnes_manufactured);
    //     $syn_cane_analysis->equivalent = $this->__dataType->string_to_num($request->equivalent);
    //     $syn_cane_analysis->updated_at = $this->carbon->now();
    //     $syn_cane_analysis->ip_updated = request()->ip();
    //     $syn_cane_analysis->user_updated = $this->auth->user()->user_id;
    //     $syn_cane_analysis->save();
        
    //     return $syn_cane_analysis;

    // }




    // public function destroy($slug){

    //     $syn_cane_analysis = $this->findBySlug($slug);
    //     $syn_cane_analysis->delete();

    //     return $syn_cane_analysis;

    // }




    // public function findBySlug($slug){

    //     $syn_cane_analysis = $this->cache->remember('syn_cane_analysis:findBySlug:' . $slug, 240, function() use ($slug){
    //         return $this->syn_cane_analysis->where('slug', $slug)
    //                                         ->with('mill', 'cropYear')
    //                                         ->first();
    //     }); 
        
    //     if(empty($syn_cane_analysis)){ abort(404); }

    //     return $syn_cane_analysis;

    // }



    // public function getByCropYearId($crop_year_id){

    //     $syn_cane_analysis = $this->cache->remember('syn_cane_analysis:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

    //         $syn_cane_analysis = $this->syn_cane_analysis->newQuery();

    //         return $syn_cane_analysis->select('mill_id', 'sgrcane_gross_tonnes', 'sgrcane_net_tonnes', 'rawsgr_tonnes_due_cane', 'rawsgr_tonnes_manufactured', 'equivalent')
    //                                   ->with('mill')
    //                                   ->where('crop_year_id', $crop_year_id)
    //                                   ->get();

    //     });

    //     return $syn_cane_analysis;

    // }




    // public function getSynCaneAnalysisIdInc(){

    //     $id = 'CST1001';
    //     $syn_cane_analysis = $this->syn_cane_analysis->select('cane_sugar_ton_id')->orderBy('cane_sugar_ton_id', 'desc')->first();

    //     if($syn_cane_analysis != null){
    //         if($syn_cane_analysis->cane_sugar_ton_id != null){
    //             $num = str_replace('CST', '', $syn_cane_analysis->cane_sugar_ton_id) + 1;
    //             $id = 'CST' . $num;
    //         }
    //     }
        
    //     return $id;
        
    // }




}