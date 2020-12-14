<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynFirstExpressedJuiceInterface;

use App\Models\SynFirstExpressedJuice;


class SynFirstExpressedJuiceRepository extends BaseRepository implements SynFirstExpressedJuiceInterface {
	


    protected $syn_first_expressed_juice;



	public function __construct(SynFirstExpressedJuice $syn_first_expressed_juice){

        $this->syn_first_expressed_juice = $syn_first_expressed_juice;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_first_expressed_juice = $this->cache->remember('syn_first_expressed_juice:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_first_expressed_juice = $this->syn_first_expressed_juice->newQuery();
            
            if(isset($request->q)){
                $syn_first_expressed_juice->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_first_expressed_juice->select('slug', 'mill_id', 'crop_year_id', 'first_expressed_juice_id')
                                      ->with('mill', 'cropYear')
                                      ->sortable()
                                      ->orderBy('updated_at', 'desc')
                                      ->paginate($entries);

        });

        return $syn_first_expressed_juice;

    }




    public function store($request){

        $syn_first_expressed_juice = new SynFirstExpressedJuice;
        $syn_first_expressed_juice->slug = $this->str->random(16);
        $syn_first_expressed_juice->first_expressed_juice_id = $this->getSynFirstExpressedJuiceIdInc();
        $syn_first_expressed_juice->mill_id = $request->mill_id;
        $syn_first_expressed_juice->crop_year_id = $request->crop_year_id;
        $syn_first_expressed_juice->brix = $this->__dataType->string_to_num($request->brix);
        $syn_first_expressed_juice->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_first_expressed_juice->apparent_purity = $this->__dataType->string_to_num($request->apparent_purity);
        $syn_first_expressed_juice->decrease_in_ap = $this->__dataType->string_to_num($request->decrease_in_ap);
        $syn_first_expressed_juice->created_at = $this->carbon->now();
        $syn_first_expressed_juice->updated_at = $this->carbon->now();
        $syn_first_expressed_juice->ip_created = request()->ip();
        $syn_first_expressed_juice->ip_updated = request()->ip();
        $syn_first_expressed_juice->user_created = $this->auth->user()->user_id;
        $syn_first_expressed_juice->user_updated = $this->auth->user()->user_id;
        $syn_first_expressed_juice->save();
        
        return $syn_first_expressed_juice;

    }




    public function update($request, $slug){

        $syn_first_expressed_juice = $this->findBySlug($slug);
        $syn_first_expressed_juice->mill_id = $request->mill_id;
        $syn_first_expressed_juice->crop_year_id = $request->crop_year_id;
        $syn_first_expressed_juice->brix = $this->__dataType->string_to_num($request->brix);
        $syn_first_expressed_juice->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_first_expressed_juice->apparent_purity = $this->__dataType->string_to_num($request->apparent_purity);
        $syn_first_expressed_juice->decrease_in_ap = $this->__dataType->string_to_num($request->decrease_in_ap);
        $syn_first_expressed_juice->updated_at = $this->carbon->now();
        $syn_first_expressed_juice->ip_updated = request()->ip();
        $syn_first_expressed_juice->user_updated = $this->auth->user()->user_id;
        $syn_first_expressed_juice->save();
        
        return $syn_first_expressed_juice;

    }




    public function destroy($slug){

        $syn_first_expressed_juice = $this->findBySlug($slug);
        $syn_first_expressed_juice->delete();

        return $syn_first_expressed_juice;

    }




    public function findBySlug($slug){

        $syn_first_expressed_juice = $this->cache->remember('syn_first_expressed_juice:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_first_expressed_juice->where('slug', $slug)
                                                  ->with('mill', 'cropYear')
                                                  ->first();
        }); 
        
        if(empty($syn_first_expressed_juice)){ abort(404); }

        return $syn_first_expressed_juice;

    }



    public function getByCropYearId($crop_year_id){

        $syn_first_expressed_juice = $this->cache->remember('syn_first_expressed_juice:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_first_expressed_juice = $this->syn_first_expressed_juice->newQuery();

            return $syn_first_expressed_juice->select('mill_id', 'brix', 'percent_pol', 'apparent_purity', 'decrease_in_ap')
                                      ->with('mill')
                                      ->where('crop_year_id', $crop_year_id)
                                      ->get();

        });

        return $syn_first_expressed_juice;

    }




    public function getSynFirstExpressedJuiceIdInc(){

        $id = 'FEJ1001';
        $syn_first_expressed_juice = $this->syn_first_expressed_juice->select('first_expressed_juice_id')->orderBy('first_expressed_juice_id', 'desc')->first();

        if($syn_first_expressed_juice != null){
            if($syn_first_expressed_juice->first_expressed_juice_id != null){
                $num = str_replace('FEJ', '', $syn_first_expressed_juice->first_expressed_juice_id) + 1;
                $id = 'FEJ' . $num;
            }
        }
        
        return $id;
        
    }




}