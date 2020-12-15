<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynSyrupInterface;

use App\Models\SynSyrup;


class SynSyrupRepository extends BaseRepository implements SynSyrupInterface {
	


    protected $syn_syrup;



	public function __construct(SynSyrup $syn_syrup){

        $this->syn_syrup = $syn_syrup;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_syrup = $this->cache->remember('syn_syrup:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_syrup = $this->syn_syrup->newQuery();
            
            if(isset($request->q)){
                $syn_syrup->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_syrup->select('slug', 'mill_id', 'crop_year_id', 'syrup_id')
                             ->with('mill', 'cropYear')
                             ->sortable()
                             ->orderBy('updated_at', 'desc')
                             ->paginate($entries);

        });

        return $syn_syrup;

    }




    public function store($request){

        $syn_syrup = new SynSyrup;
        $syn_syrup->slug = $this->str->random(16);
        $syn_syrup->syrup_id = $this->getSynSyrupIdInc();
        $syn_syrup->mill_id = $request->mill_id;
        $syn_syrup->crop_year_id = $request->crop_year_id;

        $syn_syrup->brix = $this->__dataType->string_to_num($request->brix);
        $syn_syrup->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_syrup->apparent_purity = $this->__dataType->string_to_num($request->apparent_purity);
        $syn_syrup->percent_sucrose = $this->__dataType->string_to_num($request->percent_sucrose);
        $syn_syrup->gravity_purity = $this->__dataType->string_to_num($request->gravity_purity);
        $syn_syrup->ph = $this->__dataType->string_to_num($request->ph);
        $syn_syrup->inc_in_ap = $this->__dataType->string_to_num($request->inc_in_ap);

        $syn_syrup->created_at = $this->carbon->now();
        $syn_syrup->updated_at = $this->carbon->now();
        $syn_syrup->ip_created = request()->ip();
        $syn_syrup->ip_updated = request()->ip();
        $syn_syrup->user_created = $this->auth->user()->user_id;
        $syn_syrup->user_updated = $this->auth->user()->user_id;
        $syn_syrup->save();
        
        return $syn_syrup;

    }




    public function update($request, $slug){

        $syn_syrup = $this->findBySlug($slug);
        $syn_syrup->mill_id = $request->mill_id;
        $syn_syrup->crop_year_id = $request->crop_year_id;

        $syn_syrup->brix = $this->__dataType->string_to_num($request->brix);
        $syn_syrup->percent_pol = $this->__dataType->string_to_num($request->percent_pol);
        $syn_syrup->apparent_purity = $this->__dataType->string_to_num($request->apparent_purity);
        $syn_syrup->percent_sucrose = $this->__dataType->string_to_num($request->percent_sucrose);
        $syn_syrup->gravity_purity = $this->__dataType->string_to_num($request->gravity_purity);
        $syn_syrup->ph = $this->__dataType->string_to_num($request->ph);
        $syn_syrup->inc_in_ap = $this->__dataType->string_to_num($request->inc_in_ap);

        $syn_syrup->updated_at = $this->carbon->now();
        $syn_syrup->ip_updated = request()->ip();
        $syn_syrup->user_updated = $this->auth->user()->user_id;
        $syn_syrup->save();
        
        return $syn_syrup;

    }




    public function destroy($slug){

        $syn_syrup = $this->findBySlug($slug);
        $syn_syrup->delete();

        return $syn_syrup;

    }




    public function findBySlug($slug){

        $syn_syrup = $this->cache->remember('syn_syrup:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_syrup->where('slug', $slug)
                                   ->with('mill', 'cropYear')
                                   ->first();
        }); 
        
        if(empty($syn_syrup)){ abort(404); }

        return $syn_syrup;

    }



    public function getByCropYearId($crop_year_id){

        $syn_syrup = $this->cache->remember('syn_syrup:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_syrup = $this->syn_syrup->newQuery();

            return $syn_syrup->select('mill_id', 'brix', 'percent_pol', 'apparent_purity', 'percent_sucrose', 'gravity_purity', 'ph', 'inc_in_ap')
                             ->with('mill')
                             ->where('crop_year_id', $crop_year_id)
                             ->get();

        });

        return $syn_syrup;

    }




    public function getSynSyrupIdInc(){

        $id = 'S1001';
        $syn_syrup = $this->syn_syrup->select('syrup_id')->orderBy('syrup_id', 'desc')->first();

        if($syn_syrup != null){
            if($syn_syrup->syrup_id != null){
                $num = str_replace('S', '', $syn_syrup->syrup_id) + 1;
                $id = 'S' . $num;
            }
        }
        
        return $id;
        
    }




}