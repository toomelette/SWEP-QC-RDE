<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynDetailOfStoppageAInterface;

use App\Models\SynDetailOfStoppageA;


class SynDetailOfStoppageARepository extends BaseRepository implements SynDetailOfStoppageAInterface {
	


    protected $syn_detail_of_stoppage_a;



	public function __construct(SynDetailOfStoppageA $syn_detail_of_stoppage_a){

        $this->syn_detail_of_stoppage_a = $syn_detail_of_stoppage_a;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_detail_of_stoppage_a = $this->cache->remember('syn_detail_of_stoppage_a:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_detail_of_stoppage_a = $this->syn_detail_of_stoppage_a->newQuery();
            
            if(isset($request->q)){
                $syn_detail_of_stoppage_a->whereHas('mill', function($mill) use ($request){
                                        $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                    })
                                    ->orWhereHas('cropYear', function($cy) use ($request){
                                        $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                    });
            }

            return $syn_detail_of_stoppage_a->select('slug', 'mill_id', 'crop_year_id', 'detail_of_stoppage_a_id')
                                      ->with('mill', 'cropYear')
                                      ->sortable()
                                      ->orderBy('updated_at', 'desc')
                                      ->paginate($entries);

        });

        return $syn_detail_of_stoppage_a;

    }




    public function store($request){

        $syn_detail_of_stoppage_a = new SynDetailOfStoppageA;
        $syn_detail_of_stoppage_a->slug = $this->str->random(16);
        $syn_detail_of_stoppage_a->detail_of_stoppage_a_id = $this->getSynDetailOfStoppageAIdInc();
        $syn_detail_of_stoppage_a->mill_id = $request->mill_id;
        $syn_detail_of_stoppage_a->crop_year_id = $request->crop_year_id;

        $syn_detail_of_stoppage_a->due_factory_hrs = $this->__dataType->string_to_num($request->due_factory_hrs);
        $syn_detail_of_stoppage_a->due_factory_tet = $this->__dataType->string_to_num($request->due_factory_tet);
        $syn_detail_of_stoppage_a->due_no_cane_hrs = $this->__dataType->string_to_num($request->due_no_cane_hrs);
        $syn_detail_of_stoppage_a->due_no_cane_tet = $this->__dataType->string_to_num($request->due_no_cane_tet);
        $syn_detail_of_stoppage_a->due_transport_hrs = $this->__dataType->string_to_num($request->due_transport_hrs);
        $syn_detail_of_stoppage_a->due_transport_tet = $this->__dataType->string_to_num($request->due_transport_tet);

        $syn_detail_of_stoppage_a->created_at = $this->carbon->now();
        $syn_detail_of_stoppage_a->updated_at = $this->carbon->now();
        $syn_detail_of_stoppage_a->ip_created = request()->ip();
        $syn_detail_of_stoppage_a->ip_updated = request()->ip();
        $syn_detail_of_stoppage_a->user_created = $this->auth->user()->user_id;
        $syn_detail_of_stoppage_a->user_updated = $this->auth->user()->user_id;
        $syn_detail_of_stoppage_a->save();
        
        return $syn_detail_of_stoppage_a;

    }




    public function update($request, $slug){

        $syn_detail_of_stoppage_a = $this->findBySlug($slug);
        $syn_detail_of_stoppage_a->mill_id = $request->mill_id;
        $syn_detail_of_stoppage_a->crop_year_id = $request->crop_year_id;

        $syn_detail_of_stoppage_a->due_factory_hrs = $this->__dataType->string_to_num($request->due_factory_hrs);
        $syn_detail_of_stoppage_a->due_factory_tet = $this->__dataType->string_to_num($request->due_factory_tet);
        $syn_detail_of_stoppage_a->due_no_cane_hrs = $this->__dataType->string_to_num($request->due_no_cane_hrs);
        $syn_detail_of_stoppage_a->due_no_cane_tet = $this->__dataType->string_to_num($request->due_no_cane_tet);
        $syn_detail_of_stoppage_a->due_transport_hrs = $this->__dataType->string_to_num($request->due_transport_hrs);
        $syn_detail_of_stoppage_a->due_transport_tet = $this->__dataType->string_to_num($request->due_transport_tet);

        $syn_detail_of_stoppage_a->updated_at = $this->carbon->now();
        $syn_detail_of_stoppage_a->ip_updated = request()->ip();
        $syn_detail_of_stoppage_a->user_updated = $this->auth->user()->user_id;
        $syn_detail_of_stoppage_a->save();
        
        return $syn_detail_of_stoppage_a;

    }




    public function destroy($slug){

        $syn_detail_of_stoppage_a = $this->findBySlug($slug);
        $syn_detail_of_stoppage_a->delete();

        return $syn_detail_of_stoppage_a;

    }




    public function findBySlug($slug){

        $syn_detail_of_stoppage_a = $this->cache->remember('syn_detail_of_stoppage_a:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_detail_of_stoppage_a->where('slug', $slug)
                                                  ->with('mill', 'cropYear')
                                                  ->first();
        }); 
        
        if(empty($syn_detail_of_stoppage_a)){ abort(404); }

        return $syn_detail_of_stoppage_a;

    }



    public function getByCropYearId($crop_year_id){

        $syn_detail_of_stoppage_a = $this->cache->remember('syn_detail_of_stoppage_a:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_detail_of_stoppage_a = $this->syn_detail_of_stoppage_a->newQuery();

            return $syn_detail_of_stoppage_a->select('mill_id', 'due_factory_hrs', 'due_factory_tet', 'due_no_cane_hrs', 'due_no_cane_tet', 'due_transport_hrs', 'due_transport_tet')
                                     ->with('mill')
                                     ->where('crop_year_id', $crop_year_id)
                                     ->get();

        });

        return $syn_detail_of_stoppage_a;

    }




    public function getSynDetailOfStoppageAIdInc(){

        $id = 'DOS-A1001';
        $syn_detail_of_stoppage_a = $this->syn_detail_of_stoppage_a->select('detail_of_stoppage_a_id')->orderBy('detail_of_stoppage_a_id', 'desc')->first();

        if($syn_detail_of_stoppage_a != null){
            if($syn_detail_of_stoppage_a->detail_of_stoppage_a_id != null){
                $num = str_replace('DOS-A', '', $syn_detail_of_stoppage_a->detail_of_stoppage_a_id) + 1;
                $id = 'DOS-A' . $num;
            }
        }
        
        return $id;
        
    }




}