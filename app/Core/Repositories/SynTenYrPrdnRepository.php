<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynTenYrPrdnInterface;
use App\Core\Interfaces\CropYearInterface;

use App\Models\SynTenYrPrdn;


class SynTenYrPrdnRepository extends BaseRepository implements SynTenYrPrdnInterface {
	


    protected $syn_ten_yr_prdn;
    protected $crop_year;



	public function __construct(SynTenYrPrdn $syn_ten_yr_prdn, CropYearInterface $crop_year){

        $this->syn_ten_yr_prdn = $syn_ten_yr_prdn;
        $this->crop_year = $crop_year;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_ten_yr_prdn = $this->cache->remember('syn_ten_yr_prdn:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_ten_yr_prdn = $this->syn_ten_yr_prdn->newQuery();
            
            if(isset($request->q)){
                $syn_ten_yr_prdn->whereHas('cropYear', function($cy) use ($request){
                                    $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                  });
            }

            return $syn_ten_yr_prdn->select('slug', 'crop_year_id', 'ten_yr_prdn_id')
                                   ->with('cropYear')
                                   ->sortable()
                                   ->orderBy('updated_at', 'desc')
                                   ->paginate($entries);

        });

        return $syn_ten_yr_prdn;

    }




    public function store($request){

        $syn_ten_yr_prdn = new SynTenYrPrdn;
        $syn_ten_yr_prdn->slug = $this->str->random(16);
        $syn_ten_yr_prdn->ten_yr_prdn_id = $this->getSynTenYrPrdnIdInc();
        $syn_ten_yr_prdn->crop_year_id = $request->crop_year_id;

        $syn_ten_yr_prdn->gross_cane_milled = $this->__dataType->string_to_num($request->gross_cane_milled);
        $syn_ten_yr_prdn->raw_sugar_man = $this->__dataType->string_to_num($request->raw_sugar_man);
        $syn_ten_yr_prdn->molasses_due_cane = $this->__dataType->string_to_num($request->molasses_due_cane);
        $syn_ten_yr_prdn->bagasse = $this->__dataType->string_to_num($request->bagasse);
        $syn_ten_yr_prdn->filter_cake = $this->__dataType->string_to_num($request->filter_cake);

        $syn_ten_yr_prdn->created_at = $this->carbon->now();
        $syn_ten_yr_prdn->updated_at = $this->carbon->now();
        $syn_ten_yr_prdn->ip_created = request()->ip();
        $syn_ten_yr_prdn->ip_updated = request()->ip();
        $syn_ten_yr_prdn->user_created = $this->auth->user()->user_id;
        $syn_ten_yr_prdn->user_updated = $this->auth->user()->user_id;
        $syn_ten_yr_prdn->save();
        
        return $syn_ten_yr_prdn;

    }




    public function update($request, $slug){

        $syn_ten_yr_prdn = $this->findBySlug($slug);
        $syn_ten_yr_prdn->crop_year_id = $request->crop_year_id;

        $syn_ten_yr_prdn->gross_cane_milled = $this->__dataType->string_to_num($request->gross_cane_milled);
        $syn_ten_yr_prdn->raw_sugar_man = $this->__dataType->string_to_num($request->raw_sugar_man);
        $syn_ten_yr_prdn->molasses_due_cane = $this->__dataType->string_to_num($request->molasses_due_cane);
        $syn_ten_yr_prdn->bagasse = $this->__dataType->string_to_num($request->bagasse);
        $syn_ten_yr_prdn->filter_cake = $this->__dataType->string_to_num($request->filter_cake);

        $syn_ten_yr_prdn->updated_at = $this->carbon->now();
        $syn_ten_yr_prdn->ip_updated = request()->ip();
        $syn_ten_yr_prdn->user_updated = $this->auth->user()->user_id;
        $syn_ten_yr_prdn->save();
        
        return $syn_ten_yr_prdn;

    }




    public function destroy($slug){

        $syn_ten_yr_prdn = $this->findBySlug($slug);
        $syn_ten_yr_prdn->delete();

        return $syn_ten_yr_prdn;

    }




    public function findBySlug($slug){

        $syn_ten_yr_prdn = $this->cache->remember('syn_ten_yr_prdn:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_ten_yr_prdn->where('slug', $slug)
                                         ->with('cropYear')
                                         ->first();
        }); 
        
        if(empty($syn_ten_yr_prdn)){ abort(404); }

        return $syn_ten_yr_prdn;

    }



    public function getByCropYearId($crop_year_id){

        $syn_ten_yr_prdn = $this->cache->remember('syn_ten_yr_prdn:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $crop_years = $this->crop_year->getLastTenByCropYear($crop_year_id);
            $list = array();

            foreach ($crop_years as $data) {

                $ten_yr_prdn = $this->syn_ten_yr_prdn->where('crop_year_id', $data['crop_year_id'])->first();

                if(!empty($ten_yr_prdn)){

                    $list[] = array(
                        'cy_name' => $data['name'],
                        'gross_cane_milled' => $ten_yr_prdn->gross_cane_milled,
                        'raw_sugar_man' => $ten_yr_prdn->raw_sugar_man,
                        'molasses_due_cane' => $ten_yr_prdn->molasses_due_cane,
                        'bagasse' => $ten_yr_prdn->bagasse,
                        'filter_cake' => $ten_yr_prdn->filter_cake,
                    );
                    
                }

            }

            return $list;

        });

        return $syn_ten_yr_prdn;

    }




    public function getSynTenYrPrdnIdInc(){

        $id = 'TYP1001';
        $syn_ten_yr_prdn = $this->syn_ten_yr_prdn->select('ten_yr_prdn_id')->orderBy('ten_yr_prdn_id', 'desc')->first();

        if($syn_ten_yr_prdn != null){
            if($syn_ten_yr_prdn->ten_yr_prdn_id != null){
                $num = str_replace('TYP', '', $syn_ten_yr_prdn->ten_yr_prdn_id) + 1;
                $id = 'TYP' . $num;
            }
        }
        
        return $id;
        
    }




}