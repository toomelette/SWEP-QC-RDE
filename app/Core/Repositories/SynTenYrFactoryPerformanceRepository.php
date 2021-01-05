<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynTenYrFactoryPerformanceInterface;
use App\Core\Interfaces\CropYearInterface;

use App\Models\SynTenYrFactoryPerformance;


class SynTenYrFactoryPerformanceRepository extends BaseRepository implements SynTenYrFactoryPerformanceInterface {
	


    protected $syn_ten_yr_factory_performance;
    protected $crop_year;



	public function __construct(SynTenYrFactoryPerformance $syn_ten_yr_factory_performance, CropYearInterface $crop_year){

        $this->syn_ten_yr_factory_performance = $syn_ten_yr_factory_performance;
        $this->crop_year = $crop_year;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_ten_yr_factory_performance = $this->cache->remember('syn_ten_yr_factory_performance:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_ten_yr_factory_performance = $this->syn_ten_yr_factory_performance->newQuery();
            
            if(isset($request->q)){
                $syn_ten_yr_factory_performance->whereHas('cropYear', function($cy) use ($request){
                                                    $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                                });
            }

            return $syn_ten_yr_factory_performance->select('slug', 'crop_year_id', 'ten_yr_factory_performance_id')
                                                  ->with('cropYear')
                                                  ->sortable()
                                                  ->orderBy('updated_at', 'desc')
                                                  ->paginate($entries);

        });

        return $syn_ten_yr_factory_performance;

    }




    public function store($request){

        $syn_ten_yr_factory_performance = new SynTenYrFactoryPerformance;
        $syn_ten_yr_factory_performance->slug = $this->str->random(16);
        $syn_ten_yr_factory_performance->ten_yr_factory_performance_id = $this->getSynTenYrFactoryPerformanceIdInc();
        $syn_ten_yr_factory_performance->crop_year_id = $request->crop_year_id;

        $syn_ten_yr_factory_performance->rated_capacity = $this->__dataType->string_to_num($request->rated_capacity);
        $syn_ten_yr_factory_performance->cap_utilization = $this->__dataType->string_to_num($request->cap_utilization);
        $syn_ten_yr_factory_performance->pol_extraction = $this->__dataType->string_to_num($request->pol_extraction);
        $syn_ten_yr_factory_performance->actual_bhr = $this->__dataType->string_to_num($request->actual_bhr);
        $syn_ten_yr_factory_performance->reduced_overall_recovery = $this->__dataType->string_to_num($request->reduced_overall_recovery);
        $syn_ten_yr_factory_performance->ave_num_of_grinding = $this->__dataType->string_to_num($request->ave_num_of_grinding);

        $syn_ten_yr_factory_performance->created_at = $this->carbon->now();
        $syn_ten_yr_factory_performance->updated_at = $this->carbon->now();
        $syn_ten_yr_factory_performance->ip_created = request()->ip();
        $syn_ten_yr_factory_performance->ip_updated = request()->ip();
        $syn_ten_yr_factory_performance->user_created = $this->auth->user()->user_id;
        $syn_ten_yr_factory_performance->user_updated = $this->auth->user()->user_id;
        $syn_ten_yr_factory_performance->save();
        
        return $syn_ten_yr_factory_performance;

    }




    public function update($request, $slug){

        $syn_ten_yr_factory_performance = $this->findBySlug($slug);
        $syn_ten_yr_factory_performance->crop_year_id = $request->crop_year_id;

        $syn_ten_yr_factory_performance->rated_capacity = $this->__dataType->string_to_num($request->rated_capacity);
        $syn_ten_yr_factory_performance->cap_utilization = $this->__dataType->string_to_num($request->cap_utilization);
        $syn_ten_yr_factory_performance->pol_extraction = $this->__dataType->string_to_num($request->pol_extraction);
        $syn_ten_yr_factory_performance->actual_bhr = $this->__dataType->string_to_num($request->actual_bhr);
        $syn_ten_yr_factory_performance->reduced_overall_recovery = $this->__dataType->string_to_num($request->reduced_overall_recovery);
        $syn_ten_yr_factory_performance->ave_num_of_grinding = $this->__dataType->string_to_num($request->ave_num_of_grinding);

        $syn_ten_yr_factory_performance->updated_at = $this->carbon->now();
        $syn_ten_yr_factory_performance->ip_updated = request()->ip();
        $syn_ten_yr_factory_performance->user_updated = $this->auth->user()->user_id;
        $syn_ten_yr_factory_performance->save();
        
        return $syn_ten_yr_factory_performance;

    }




    public function destroy($slug){

        $syn_ten_yr_factory_performance = $this->findBySlug($slug);
        $syn_ten_yr_factory_performance->delete();

        return $syn_ten_yr_factory_performance;

    }




    public function findBySlug($slug){

        $syn_ten_yr_factory_performance = $this->cache->remember('syn_ten_yr_factory_performance:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_ten_yr_factory_performance->where('slug', $slug)
                                                        ->with('cropYear')
                                                        ->first();
        }); 
        
        if(empty($syn_ten_yr_factory_performance)){ abort(404); }

        return $syn_ten_yr_factory_performance;

    }



    public function getByCropYearId($crop_year_id){

        $syn_ten_yr_factory_performance = $this->cache->remember('syn_ten_yr_factory_performance:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $crop_years = $this->crop_year->getLastTenByCropYear($crop_year_id);
            $list = array();

            foreach ($crop_years as $data) {

                $ten_yr_factory_performance = $this->syn_ten_yr_factory_performance->where('crop_year_id', $data['crop_year_id'])->first();

                if(!empty($ten_yr_factory_performance)){

                    $list[] = array(
                        'cy_name' => $data['name'],
                        'rated_capacity' => $ten_yr_factory_performance->rated_capacity,
                        'cap_utilization' => $ten_yr_factory_performance->cap_utilization,
                        'pol_extraction' => $ten_yr_factory_performance->pol_extraction,
                        'actual_bhr' => $ten_yr_factory_performance->actual_bhr,
                        'reduced_overall_recovery' => $ten_yr_factory_performance->reduced_overall_recovery,
                        'ave_num_of_grinding' => $ten_yr_factory_performance->ave_num_of_grinding,
                    );
                    
                }

            }

            return $list;

        });

        return $syn_ten_yr_factory_performance;

    }




    public function getSynTenYrFactoryPerformanceIdInc(){

        $id = 'TYFP1001';
        $syn_ten_yr_factory_performance = $this->syn_ten_yr_factory_performance->select('ten_yr_factory_performance_id')->orderBy('ten_yr_factory_performance_id', 'desc')->first();

        if($syn_ten_yr_factory_performance != null){
            if($syn_ten_yr_factory_performance->ten_yr_factory_performance_id != null){
                $num = str_replace('TYFP', '', $syn_ten_yr_factory_performance->ten_yr_factory_performance_id) + 1;
                $id = 'TYFP' . $num;
            }
        }
        
        return $id;
        
    }




}