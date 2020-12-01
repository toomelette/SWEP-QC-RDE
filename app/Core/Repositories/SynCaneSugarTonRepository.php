<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynCaneSugarTonInterface;

use App\Models\SynCaneSugarTon;


class SynCaneSugarTonRepository extends BaseRepository implements SynCaneSugarTonInterface {
	


    protected $syn_cane_sugar_ton;



	public function __construct(SynCaneSugarTon $syn_cane_sugar_ton){

        $this->syn_cane_sugar_ton = $syn_cane_sugar_ton;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_cane_sugar_tons = $this->cache->remember('syn_cane_sugar_tons:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_cane_sugar_ton = $this->syn_cane_sugar_ton->newQuery();
            
            if(isset($request->q)){
                $syn_cane_sugar_ton->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_cane_sugar_ton->select('slug', 'mill_id', 'crop_year_id', 'cane_sugar_ton_id')
                                      ->with('mill', 'cropYear')
                                      ->sortable()
                                      ->orderBy('updated_at', 'desc')
                                      ->paginate($entries);

        });

        return $syn_cane_sugar_tons;

    }




    public function store($request){

        $syn_cane_sugar_ton = new SynCaneSugarTon;
        $syn_cane_sugar_ton->slug = $this->str->random(16);
        $syn_cane_sugar_ton->cane_sugar_ton_id = $this->getSynCaneSugarTonIdInc();
        $syn_cane_sugar_ton->mill_id = $request->mill_id;
        $syn_cane_sugar_ton->crop_year_id = $request->crop_year_id;
        $syn_cane_sugar_ton->sgrcane_gross_tonnes = $this->__dataType->string_to_num($request->sgrcane_gross_tonnes);
        $syn_cane_sugar_ton->sgrcane_net_tonnes = $this->__dataType->string_to_num($request->sgrcane_net_tonnes);
        $syn_cane_sugar_ton->rawsgr_tonnes_due_cane = $this->__dataType->string_to_num($request->rawsgr_tonnes_due_cane);
        $syn_cane_sugar_ton->rawsgr_tonnes_manufactured = $this->__dataType->string_to_num($request->rawsgr_tonnes_manufactured);
        $syn_cane_sugar_ton->equivalent = $this->__dataType->string_to_num($request->equivalent);
        $syn_cane_sugar_ton->created_at = $this->carbon->now();
        $syn_cane_sugar_ton->updated_at = $this->carbon->now();
        $syn_cane_sugar_ton->ip_created = request()->ip();
        $syn_cane_sugar_ton->ip_updated = request()->ip();
        $syn_cane_sugar_ton->user_created = $this->auth->user()->user_id;
        $syn_cane_sugar_ton->user_updated = $this->auth->user()->user_id;
        $syn_cane_sugar_ton->save();
        
        return $syn_cane_sugar_ton;

    }




    public function update($request, $slug){

        $syn_cane_sugar_ton = $this->findBySlug($slug);
        $syn_cane_sugar_ton->mill_id = $request->mill_id;
        $syn_cane_sugar_ton->crop_year_id = $request->crop_year_id;
        $syn_cane_sugar_ton->sgrcane_gross_tonnes = $this->__dataType->string_to_num($request->sgrcane_gross_tonnes);
        $syn_cane_sugar_ton->sgrcane_net_tonnes = $this->__dataType->string_to_num($request->sgrcane_net_tonnes);
        $syn_cane_sugar_ton->rawsgr_tonnes_due_cane = $this->__dataType->string_to_num($request->rawsgr_tonnes_due_cane);
        $syn_cane_sugar_ton->rawsgr_tonnes_manufactured = $this->__dataType->string_to_num($request->rawsgr_tonnes_manufactured);
        $syn_cane_sugar_ton->equivalent = $this->__dataType->string_to_num($request->equivalent);
        $syn_cane_sugar_ton->updated_at = $this->carbon->now();
        $syn_cane_sugar_ton->ip_updated = request()->ip();
        $syn_cane_sugar_ton->user_updated = $this->auth->user()->user_id;
        $syn_cane_sugar_ton->save();
        
        return $syn_cane_sugar_ton;

    }




    public function destroy($slug){

        $syn_cane_sugar_ton = $this->findBySlug($slug);
        $syn_cane_sugar_ton->delete();

        return $syn_cane_sugar_ton;

    }




    public function findBySlug($slug){

        $syn_cane_sugar_ton = $this->cache->remember('syn_cane_sugar_tons:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_cane_sugar_ton->where('slug', $slug)
                                            ->with('mill', 'cropYear')
                                            ->first();
        }); 
        
        if(empty($syn_cane_sugar_ton)){ abort(404); }

        return $syn_cane_sugar_ton;

    }




    public function getSynCaneSugarTonIdInc(){

        $id = 'CST1001';
        $syn_cane_sugar_ton = $this->syn_cane_sugar_ton->select('cane_sugar_ton_id')->orderBy('cane_sugar_ton_id', 'desc')->first();

        if($syn_cane_sugar_ton != null){
            if($syn_cane_sugar_ton->cane_sugar_ton_id != null){
                $num = str_replace('CST', '', $syn_cane_sugar_ton->cane_sugar_ton_id) + 1;
                $id = 'CST' . $num;
            }
        }
        
        return $id;
        
    }




}