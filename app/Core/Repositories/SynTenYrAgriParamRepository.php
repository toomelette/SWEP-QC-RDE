<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynTenYrAgriParamInterface;
use App\Core\Interfaces\CropYearInterface;

use App\Models\SynTenYrAgriParam;


class SynTenYrAgriParamRepository extends BaseRepository implements SynTenYrAgriParamInterface {
	


    protected $syn_ten_yr_agri_param;
    protected $crop_year;



	public function __construct(SynTenYrAgriParam $syn_ten_yr_agri_param, CropYearInterface $crop_year){

        $this->syn_ten_yr_agri_param = $syn_ten_yr_agri_param;
        $this->crop_year = $crop_year;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_ten_yr_agri_param = $this->cache->remember('syn_ten_yr_agri_param:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_ten_yr_agri_param = $this->syn_ten_yr_agri_param->newQuery();
            
            if(isset($request->q)){
                $syn_ten_yr_agri_param->whereHas('cropYear', function($cy) use ($request){
                                                    $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                                });
            }

            return $syn_ten_yr_agri_param->select('slug', 'crop_year_id', 'ten_yr_agri_param_id')
                                                  ->with('cropYear')
                                                  ->sortable()
                                                  ->orderBy('updated_at', 'desc')
                                                  ->paginate($entries);

        });

        return $syn_ten_yr_agri_param;

    }




    // public function store($request){

    //     $syn_ten_yr_agri_param = new SynTenYrAgriParam;
    //     $syn_ten_yr_agri_param->slug = $this->str->random(16);
    //     $syn_ten_yr_agri_param->ten_yr_agri_param_id = $this->getSynTenYrAgriParamIdInc();
    //     $syn_ten_yr_agri_param->crop_year_id = $request->crop_year_id;

    //     $syn_ten_yr_agri_param->rated_capacity = $this->__dataType->string_to_num($request->rated_capacity);
    //     $syn_ten_yr_agri_param->cap_utilization = $this->__dataType->string_to_num($request->cap_utilization);
    //     $syn_ten_yr_agri_param->pol_extraction = $this->__dataType->string_to_num($request->pol_extraction);
    //     $syn_ten_yr_agri_param->actual_bhr = $this->__dataType->string_to_num($request->actual_bhr);
    //     $syn_ten_yr_agri_param->reduced_overall_recovery = $this->__dataType->string_to_num($request->reduced_overall_recovery);
    //     $syn_ten_yr_agri_param->ave_num_of_grinding = $this->__dataType->string_to_num($request->ave_num_of_grinding);

    //     $syn_ten_yr_agri_param->created_at = $this->carbon->now();
    //     $syn_ten_yr_agri_param->updated_at = $this->carbon->now();
    //     $syn_ten_yr_agri_param->ip_created = request()->ip();
    //     $syn_ten_yr_agri_param->ip_updated = request()->ip();
    //     $syn_ten_yr_agri_param->user_created = $this->auth->user()->user_id;
    //     $syn_ten_yr_agri_param->user_updated = $this->auth->user()->user_id;
    //     $syn_ten_yr_agri_param->save();
        
    //     return $syn_ten_yr_agri_param;

    // }




    // public function update($request, $slug){

    //     $syn_ten_yr_agri_param = $this->findBySlug($slug);
    //     $syn_ten_yr_agri_param->crop_year_id = $request->crop_year_id;

    //     $syn_ten_yr_agri_param->rated_capacity = $this->__dataType->string_to_num($request->rated_capacity);
    //     $syn_ten_yr_agri_param->cap_utilization = $this->__dataType->string_to_num($request->cap_utilization);
    //     $syn_ten_yr_agri_param->pol_extraction = $this->__dataType->string_to_num($request->pol_extraction);
    //     $syn_ten_yr_agri_param->actual_bhr = $this->__dataType->string_to_num($request->actual_bhr);
    //     $syn_ten_yr_agri_param->reduced_overall_recovery = $this->__dataType->string_to_num($request->reduced_overall_recovery);
    //     $syn_ten_yr_agri_param->ave_num_of_grinding = $this->__dataType->string_to_num($request->ave_num_of_grinding);

    //     $syn_ten_yr_agri_param->updated_at = $this->carbon->now();
    //     $syn_ten_yr_agri_param->ip_updated = request()->ip();
    //     $syn_ten_yr_agri_param->user_updated = $this->auth->user()->user_id;
    //     $syn_ten_yr_agri_param->save();
        
    //     return $syn_ten_yr_agri_param;

    // }




    // public function destroy($slug){

    //     $syn_ten_yr_agri_param = $this->findBySlug($slug);
    //     $syn_ten_yr_agri_param->delete();

    //     return $syn_ten_yr_agri_param;

    // }




    // public function findBySlug($slug){

    //     $syn_ten_yr_agri_param = $this->cache->remember('syn_ten_yr_agri_param:findBySlug:' . $slug, 240, function() use ($slug){
    //         return $this->syn_ten_yr_agri_param->where('slug', $slug)
    //                                                     ->with('cropYear')
    //                                                     ->first();
    //     }); 
        
    //     if(empty($syn_ten_yr_agri_param)){ abort(404); }

    //     return $syn_ten_yr_agri_param;

    // }



    // public function getByCropYearId($crop_year_id){

    //     $syn_ten_yr_agri_param = $this->cache->remember('syn_ten_yr_agri_param:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

    //         $crop_years = $this->crop_year->getLastTenByCropYear($crop_year_id);
    //         $list = array();

    //         foreach ($crop_years as $data) {

    //             $ten_yr_agri_param = $this->syn_ten_yr_agri_param->where('crop_year_id', $data['crop_year_id'])->first();

    //             if(!empty($ten_yr_agri_param)){

    //                 $list[] = array(
    //                     'cy_name' => $data['name'],
    //                     'rated_capacity' => $ten_yr_agri_param->rated_capacity,
    //                     'cap_utilization' => $ten_yr_agri_param->cap_utilization,
    //                     'pol_extraction' => $ten_yr_agri_param->pol_extraction,
    //                     'actual_bhr' => $ten_yr_agri_param->actual_bhr,
    //                     'reduced_overall_recovery' => $ten_yr_agri_param->reduced_overall_recovery,
    //                     'ave_num_of_grinding' => $ten_yr_agri_param->ave_num_of_grinding,
    //                 );
                    
    //             }

    //         }

    //         return $list;

    //     });

    //     return $syn_ten_yr_agri_param;

    // }




    public function getSynTenYrAgriParamIdInc(){

        $id = 'TYAP1001';
        $syn_ten_yr_agri_param = $this->syn_ten_yr_agri_param->select('ten_yr_agri_param_id')->orderBy('ten_yr_agri_param_id', 'desc')->first();

        if($syn_ten_yr_agri_param != null){
            if($syn_ten_yr_agri_param->ten_yr_agri_param_id != null){
                $num = str_replace('TYAP', '', $syn_ten_yr_agri_param->ten_yr_agri_param_id) + 1;
                $id = 'TYAP' . $num;
            }
        }
        
        return $id;
        
    }




}