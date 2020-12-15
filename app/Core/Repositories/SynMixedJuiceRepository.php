<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynMixedJuiceInterface;

use App\Models\SynMixedJuice;


class SynMixedJuiceRepository extends BaseRepository implements SynMixedJuiceInterface {
	


    protected $syn_mixed_juice;



	public function __construct(SynMixedJuice $syn_mixed_juice){

        $this->syn_mixed_juice = $syn_mixed_juice;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_mixed_juice = $this->cache->remember('syn_mixed_juice:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_mixed_juice = $this->syn_mixed_juice->newQuery();
            
            if(isset($request->q)){
                $syn_mixed_juice->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_mixed_juice->select('slug', 'mill_id', 'crop_year_id', 'mixed_juice_id')
                                      ->with('mill', 'cropYear')
                                      ->sortable()
                                      ->orderBy('updated_at', 'desc')
                                      ->paginate($entries);

        });

        return $syn_mixed_juice;

    }




    public function store($request){

        $syn_mixed_juice = new SynMixedJuice;
        $syn_mixed_juice->slug = $this->str->random(16);
        $syn_mixed_juice->mixed_juice_id = $this->getSynMixedJuiceIdInc();
        $syn_mixed_juice->mill_id = $request->mill_id;
        $syn_mixed_juice->crop_year_id = $request->crop_year_id;

        $syn_mixed_juice->tonnes = $this->__dataType->string_to_num($request->tonnes);
        $syn_mixed_juice->percent_on_cane = $this->__dataType->string_to_num($request->percent_on_cane);
        $syn_mixed_juice->brix = $this->__dataType->string_to_num($request->brix);
        $syn_mixed_juice->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_mixed_juice->apparent_purity = $this->__dataType->string_to_num($request->apparent_purity);
        $syn_mixed_juice->percent_sucrose = $this->__dataType->string_to_num($request->percent_sucrose);
        $syn_mixed_juice->gravity_purity = $this->__dataType->string_to_num($request->gravity_purity);

        $syn_mixed_juice->created_at = $this->carbon->now();
        $syn_mixed_juice->updated_at = $this->carbon->now();
        $syn_mixed_juice->ip_created = request()->ip();
        $syn_mixed_juice->ip_updated = request()->ip();
        $syn_mixed_juice->user_created = $this->auth->user()->user_id;
        $syn_mixed_juice->user_updated = $this->auth->user()->user_id;
        $syn_mixed_juice->save();
        
        return $syn_mixed_juice;

    }




    public function update($request, $slug){

        $syn_mixed_juice = $this->findBySlug($slug);
        $syn_mixed_juice->mill_id = $request->mill_id;
        $syn_mixed_juice->crop_year_id = $request->crop_year_id;

        $syn_mixed_juice->tonnes = $this->__dataType->string_to_num($request->tonnes);
        $syn_mixed_juice->percent_on_cane = $this->__dataType->string_to_num($request->percent_on_cane);
        $syn_mixed_juice->brix = $this->__dataType->string_to_num($request->brix);
        $syn_mixed_juice->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_mixed_juice->apparent_purity = $this->__dataType->string_to_num($request->apparent_purity);
        $syn_mixed_juice->percent_sucrose = $this->__dataType->string_to_num($request->percent_sucrose);
        $syn_mixed_juice->gravity_purity = $this->__dataType->string_to_num($request->gravity_purity);

        $syn_mixed_juice->updated_at = $this->carbon->now();
        $syn_mixed_juice->ip_updated = request()->ip();
        $syn_mixed_juice->user_updated = $this->auth->user()->user_id;
        $syn_mixed_juice->save();
        
        return $syn_mixed_juice;

    }




    public function destroy($slug){

        $syn_mixed_juice = $this->findBySlug($slug);
        $syn_mixed_juice->delete();

        return $syn_mixed_juice;

    }




    public function findBySlug($slug){

        $syn_mixed_juice = $this->cache->remember('syn_mixed_juice:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_mixed_juice->where('slug', $slug)
                                         ->with('mill', 'cropYear')
                                         ->first();
        }); 
        
        if(empty($syn_mixed_juice)){ abort(404); }

        return $syn_mixed_juice;

    }



    public function getByCropYearId($crop_year_id){

        $syn_mixed_juice = $this->cache->remember('syn_mixed_juice:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_mixed_juice = $this->syn_mixed_juice->newQuery();

            return $syn_mixed_juice->select('mill_id', 'tonnes', 'percent_on_cane', 'brix', 'percent_pol', 'apparent_purity', 'percent_sucrose', 'gravity_purity')
                                            ->with('mill')
                                            ->where('crop_year_id', $crop_year_id)
                                            ->get();

        });

        return $syn_mixed_juice;

    }




    public function getSynMixedJuiceIdInc(){

        $id = 'MJ1001';
        $syn_mixed_juice = $this->syn_mixed_juice->select('mixed_juice_id')->orderBy('mixed_juice_id', 'desc')->first();

        if($syn_mixed_juice != null){
            if($syn_mixed_juice->mixed_juice_id != null){
                $num = str_replace('MJ', '', $syn_mixed_juice->mixed_juice_id) + 1;
                $id = 'MJ' . $num;
            }
        }
        
        return $id;
        
    }




}