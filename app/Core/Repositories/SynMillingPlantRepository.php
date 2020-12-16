<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynMillingPlantInterface;

use App\Models\SynMillingPlant;


class SynMillingPlantRepository extends BaseRepository implements SynMillingPlantInterface {
	


    protected $syn_milling_plant;



	public function __construct(SynMillingPlant $syn_milling_plant){

        $this->syn_milling_plant = $syn_milling_plant;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_milling_plant = $this->cache->remember('syn_milling_plant:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_milling_plant = $this->syn_milling_plant->newQuery();
            
            if(isset($request->q)){
                $syn_milling_plant->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_milling_plant->select('slug', 'mill_id', 'crop_year_id', 'milling_plant_id')
                                     ->with('mill', 'cropYear')
                                     ->sortable()
                                     ->orderBy('updated_at', 'desc')
                                     ->paginate($entries);

        });

        return $syn_milling_plant;

    }




    public function store($request){

        $syn_milling_plant = new SynMillingPlant;
        $syn_milling_plant->slug = $this->str->random(16);
        $syn_milling_plant->milling_plant_id = $this->getSynMillingPlantIdInc();
        $syn_milling_plant->mill_id = $request->mill_id;
        $syn_milling_plant->crop_year_id = $request->crop_year_id;

        $syn_milling_plant->extraction_equipment = $this->__dataType->string_to_num($request->extraction_equipment);
        $syn_milling_plant->imbibition_percent_fiber = $this->__dataType->string_to_num($request->imbibition_percent_fiber);
        $syn_milling_plant->imbibition_percent_cane = $this->__dataType->string_to_num($request->imbibition_percent_cane);
        $syn_milling_plant->pol = $this->__dataType->string_to_num($request->pol);
        $syn_milling_plant->sucrose = $this->__dataType->string_to_num($request->sucrose);
        $syn_milling_plant->reduced = $this->__dataType->string_to_num($request->reduced);
        $syn_milling_plant->whole_reduced = $this->__dataType->string_to_num($request->whole_reduced);

        $syn_milling_plant->created_at = $this->carbon->now();
        $syn_milling_plant->updated_at = $this->carbon->now();
        $syn_milling_plant->ip_created = request()->ip();
        $syn_milling_plant->ip_updated = request()->ip();
        $syn_milling_plant->user_created = $this->auth->user()->user_id;
        $syn_milling_plant->user_updated = $this->auth->user()->user_id;
        $syn_milling_plant->save();
        
        return $syn_milling_plant;

    }




    public function update($request, $slug){

        $syn_milling_plant = $this->findBySlug($slug);
        $syn_milling_plant->mill_id = $request->mill_id;
        $syn_milling_plant->crop_year_id = $request->crop_year_id;

        $syn_milling_plant->extraction_equipment = $this->__dataType->string_to_num($request->extraction_equipment);
        $syn_milling_plant->imbibition_percent_fiber = $this->__dataType->string_to_num($request->imbibition_percent_fiber);
        $syn_milling_plant->imbibition_percent_cane = $this->__dataType->string_to_num($request->imbibition_percent_cane);
        $syn_milling_plant->pol = $this->__dataType->string_to_num($request->pol);
        $syn_milling_plant->sucrose = $this->__dataType->string_to_num($request->sucrose);
        $syn_milling_plant->reduced = $this->__dataType->string_to_num($request->reduced);
        $syn_milling_plant->whole_reduced = $this->__dataType->string_to_num($request->whole_reduced);

        $syn_milling_plant->updated_at = $this->carbon->now();
        $syn_milling_plant->ip_updated = request()->ip();
        $syn_milling_plant->user_updated = $this->auth->user()->user_id;
        $syn_milling_plant->save();
        
        return $syn_milling_plant;

    }




    public function destroy($slug){

        $syn_milling_plant = $this->findBySlug($slug);
        $syn_milling_plant->delete();

        return $syn_milling_plant;

    }




    public function findBySlug($slug){

        $syn_milling_plant = $this->cache->remember('syn_milling_plant:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_milling_plant->where('slug', $slug)
                                         ->with('mill', 'cropYear')
                                         ->first();
        }); 
        
        if(empty($syn_milling_plant)){ abort(404); }

        return $syn_milling_plant;

    }



    public function getByCropYearId($crop_year_id){

        $syn_milling_plant = $this->cache->remember('syn_milling_plant:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_milling_plant = $this->syn_milling_plant->newQuery();

            return $syn_milling_plant->select('mill_id', 'extraction_equipment', 'imbibition_percent_fiber', 'imbibition_percent_cane', 'pol', 'sucrose', 'reduced', 'whole_reduced')
                                     ->with('mill')
                                     ->where('crop_year_id', $crop_year_id)
                                     ->get();

        });

        return $syn_milling_plant;

    }




    public function getSynMillingPlantIdInc(){

        $id = 'MP1001';
        $syn_milling_plant = $this->syn_milling_plant->select('milling_plant_id')->orderBy('milling_plant_id', 'desc')->first();

        if($syn_milling_plant != null){
            if($syn_milling_plant->milling_plant_id != null){
                $num = str_replace('MP', '', $syn_milling_plant->milling_plant_id) + 1;
                $id = 'MP' . $num;
            }
        }
        
        return $id;
        
    }




}