<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynLastExpressedJuiceInterface;

use App\Models\SynLastExpressedJuice;


class SynLastExpressedJuiceRepository extends BaseRepository implements SynLastExpressedJuiceInterface {
	


    protected $syn_last_expressed_juice;



	public function __construct(SynLastExpressedJuice $syn_last_expressed_juice){

        $this->syn_last_expressed_juice = $syn_last_expressed_juice;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_last_expressed_juice = $this->cache->remember('syn_last_expressed_juice:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_last_expressed_juice = $this->syn_last_expressed_juice->newQuery();
            
            if(isset($request->q)){
                $syn_last_expressed_juice->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_last_expressed_juice->select('slug', 'mill_id', 'crop_year_id', 'last_expressed_juice_id')
                                      ->with('mill', 'cropYear')
                                      ->sortable()
                                      ->orderBy('updated_at', 'desc')
                                      ->paginate($entries);

        });

        return $syn_last_expressed_juice;

    }




    public function store($request){

        $syn_last_expressed_juice = new SynLastExpressedJuice;
        $syn_last_expressed_juice->slug = $this->str->random(16);
        $syn_last_expressed_juice->last_expressed_juice_id = $this->getSynLastExpressedJuiceIdInc();
        $syn_last_expressed_juice->mill_id = $request->mill_id;
        $syn_last_expressed_juice->crop_year_id = $request->crop_year_id;
        $syn_last_expressed_juice->brix = $this->__dataType->string_to_num($request->brix);
        $syn_last_expressed_juice->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_last_expressed_juice->apparent_purity = $this->__dataType->string_to_num($request->apparent_purity);
        $syn_last_expressed_juice->created_at = $this->carbon->now();
        $syn_last_expressed_juice->updated_at = $this->carbon->now();
        $syn_last_expressed_juice->ip_created = request()->ip();
        $syn_last_expressed_juice->ip_updated = request()->ip();
        $syn_last_expressed_juice->user_created = $this->auth->user()->user_id;
        $syn_last_expressed_juice->user_updated = $this->auth->user()->user_id;
        $syn_last_expressed_juice->save();
        
        return $syn_last_expressed_juice;

    }




    public function update($request, $slug){

        $syn_last_expressed_juice = $this->findBySlug($slug);
        $syn_last_expressed_juice->mill_id = $request->mill_id;
        $syn_last_expressed_juice->crop_year_id = $request->crop_year_id;
        $syn_last_expressed_juice->brix = $this->__dataType->string_to_num($request->brix);
        $syn_last_expressed_juice->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_last_expressed_juice->apparent_purity = $this->__dataType->string_to_num($request->apparent_purity);
        $syn_last_expressed_juice->updated_at = $this->carbon->now();
        $syn_last_expressed_juice->ip_updated = request()->ip();
        $syn_last_expressed_juice->user_updated = $this->auth->user()->user_id;
        $syn_last_expressed_juice->save();
        
        return $syn_last_expressed_juice;

    }




    public function destroy($slug){

        $syn_last_expressed_juice = $this->findBySlug($slug);
        $syn_last_expressed_juice->delete();

        return $syn_last_expressed_juice;

    }




    public function findBySlug($slug){

        $syn_last_expressed_juice = $this->cache->remember('syn_last_expressed_juice:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_last_expressed_juice->where('slug', $slug)
                                                  ->with('mill', 'cropYear')
                                                  ->first();
        }); 
        
        if(empty($syn_last_expressed_juice)){ abort(404); }

        return $syn_last_expressed_juice;

    }



    public function getByCropYearId($crop_year_id){

        $syn_last_expressed_juice = $this->cache->remember('syn_last_expressed_juice:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_last_expressed_juice = $this->syn_last_expressed_juice->newQuery();

            return $syn_last_expressed_juice->select('mill_id', 'brix', 'percent_pol', 'apparent_purity')
                                            ->with('mill')
                                            ->where('crop_year_id', $crop_year_id)
                                            ->get();

        });

        return $syn_last_expressed_juice;

    }




    public function getSynLastExpressedJuiceIdInc(){

        $id = 'LEJ1001';
        $syn_last_expressed_juice = $this->syn_last_expressed_juice->select('last_expressed_juice_id')->orderBy('last_expressed_juice_id', 'desc')->first();

        if($syn_last_expressed_juice != null){
            if($syn_last_expressed_juice->last_expressed_juice_id != null){
                $num = str_replace('LEJ', '', $syn_last_expressed_juice->last_expressed_juice_id) + 1;
                $id = 'LEJ' . $num;
            }
        }
        
        return $id;
        
    }




}