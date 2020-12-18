<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynPotentialRevenueInterface;

use App\Models\SynPotentialRevenue;


class SynPotentialRevenueRepository extends BaseRepository implements SynPotentialRevenueInterface {
	


    protected $syn_potential_revenue;



	public function __construct(SynPotentialRevenue $syn_potential_revenue){

        $this->syn_potential_revenue = $syn_potential_revenue;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_potential_revenue = $this->cache->remember('syn_potential_revenue:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_potential_revenue = $this->syn_potential_revenue->newQuery();
            
            if(isset($request->q)){
                $syn_potential_revenue->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_potential_revenue->select('slug', 'mill_id', 'crop_year_id', 'potential_revenue_id')
                                      ->with('mill', 'cropYear')
                                      ->sortable()
                                      ->orderBy('updated_at', 'desc')
                                      ->paginate($entries);

        });

        return $syn_potential_revenue;

    }




    public function store($request){

        $syn_potential_revenue = new SynPotentialRevenue;
        $syn_potential_revenue->slug = $this->str->random(16);
        $syn_potential_revenue->potential_revenue_id = $this->getSynPotentialRevenueIdInc();
        $syn_potential_revenue->mill_id = $request->mill_id;
        $syn_potential_revenue->crop_year_id = $request->crop_year_id;

        $syn_potential_revenue->due_bh = $this->__dataType->string_to_num($request->due_bh);
        $syn_potential_revenue->due_trash = $this->__dataType->string_to_num($request->due_trash);
        $syn_potential_revenue->total = $this->__dataType->string_to_num($request->total);
        $syn_potential_revenue->potential_revenue = $this->__dataType->string_to_num($request->potential_revenue);

        $syn_potential_revenue->created_at = $this->carbon->now();
        $syn_potential_revenue->updated_at = $this->carbon->now();
        $syn_potential_revenue->ip_created = request()->ip();
        $syn_potential_revenue->ip_updated = request()->ip();
        $syn_potential_revenue->user_created = $this->auth->user()->user_id;
        $syn_potential_revenue->user_updated = $this->auth->user()->user_id;
        $syn_potential_revenue->save();
        
        return $syn_potential_revenue;

    }




    public function update($request, $slug){

        $syn_potential_revenue = $this->findBySlug($slug);
        $syn_potential_revenue->mill_id = $request->mill_id;
        $syn_potential_revenue->crop_year_id = $request->crop_year_id;

        $syn_potential_revenue->due_bh = $this->__dataType->string_to_num($request->due_bh);
        $syn_potential_revenue->due_trash = $this->__dataType->string_to_num($request->due_trash);
        $syn_potential_revenue->total = $this->__dataType->string_to_num($request->total);
        $syn_potential_revenue->potential_revenue = $this->__dataType->string_to_num($request->potential_revenue);
        
        $syn_potential_revenue->updated_at = $this->carbon->now();
        $syn_potential_revenue->ip_updated = request()->ip();
        $syn_potential_revenue->user_updated = $this->auth->user()->user_id;
        $syn_potential_revenue->save();
        
        return $syn_potential_revenue;

    }




    public function destroy($slug){

        $syn_potential_revenue = $this->findBySlug($slug);
        $syn_potential_revenue->delete();

        return $syn_potential_revenue;

    }




    public function findBySlug($slug){

        $syn_potential_revenue = $this->cache->remember('syn_potential_revenue:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_potential_revenue->where('slug', $slug)
                                               ->with('mill', 'cropYear')
                                               ->first();
        }); 
        
        if(empty($syn_potential_revenue)){ abort(404); }

        return $syn_potential_revenue;

    }



    public function getByCropYearId($crop_year_id){

        $syn_potential_revenue = $this->cache->remember('syn_potential_revenue:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_potential_revenue = $this->syn_potential_revenue->newQuery();

            return $syn_potential_revenue->select('mill_id', 'due_bh', 'due_trash', 'total', 'potential_revenue')
                                      ->with('mill')
                                      ->where('crop_year_id', $crop_year_id)
                                      ->get();

        });

        return $syn_potential_revenue;

    }




    public function getSynPotentialRevenueIdInc(){

        $id = 'PR1001';
        $syn_potential_revenue = $this->syn_potential_revenue->select('potential_revenue_id')->orderBy('potential_revenue_id', 'desc')->first();

        if($syn_potential_revenue != null){
            if($syn_potential_revenue->potential_revenue_id != null){
                $num = str_replace('PR', '', $syn_potential_revenue->potential_revenue_id) + 1;
                $id = 'PR' . $num;
            }
        }
        
        return $id;
        
    }




}