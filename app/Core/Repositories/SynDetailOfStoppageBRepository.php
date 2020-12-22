<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynDetailOfStoppageBInterface;

use App\Models\SynDetailOfStoppageB;


class SynDetailOfStoppageBRepository extends BaseRepository implements SynDetailOfStoppageBInterface {
	


    protected $syn_detail_of_stoppage_b;



	public function __construct(SynDetailOfStoppageB $syn_detail_of_stoppage_b){

        $this->syn_detail_of_stoppage_b = $syn_detail_of_stoppage_b;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_detail_of_stoppage_b = $this->cache->remember('syn_detail_of_stoppage_b:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_detail_of_stoppage_b = $this->syn_detail_of_stoppage_b->newQuery();
            
            if(isset($request->q)){
                $syn_detail_of_stoppage_b->whereHas('mill', function($mill) use ($request){
                                             $mill->where('name', 'LIKE', '%'. $request->q .'%');
                                         })
                                         ->orWhereHas('cropYear', function($cy) use ($request){
                                             $cy->where('name', 'LIKE', '%'. $request->q .'%');
                                         });
            }

            return $syn_detail_of_stoppage_b->select('slug', 'mill_id', 'crop_year_id', 'detail_of_stoppage_b_id')
                                            ->with('mill', 'cropYear')
                                            ->sortable()
                                            ->orderBy('updated_at', 'desc')
                                            ->paginate($entries);

        });

        return $syn_detail_of_stoppage_b;

    }




    public function store($request){

        $syn_detail_of_stoppage_b = new SynDetailOfStoppageB;
        $syn_detail_of_stoppage_b->slug = $this->str->random(16);
        $syn_detail_of_stoppage_b->detail_of_stoppage_b_id = $this->getSynDetailOfStoppageBIdInc();
        $syn_detail_of_stoppage_b->mill_id = $request->mill_id;
        $syn_detail_of_stoppage_b->crop_year_id = $request->crop_year_id;

        $syn_detail_of_stoppage_b->due_cleaning_hrs = $this->__dataType->string_to_num($request->due_cleaning_hrs);
        $syn_detail_of_stoppage_b->due_cleaning_tet = $this->__dataType->string_to_num($request->due_cleaning_tet);
        $syn_detail_of_stoppage_b->due_no_unavoidable_hrs = $this->__dataType->string_to_num($request->due_no_unavoidable_hrs);
        $syn_detail_of_stoppage_b->due_no_unavoidable_tet = $this->__dataType->string_to_num($request->due_no_unavoidable_tet);
        $syn_detail_of_stoppage_b->due_miscellaneous_hrs = $this->__dataType->string_to_num($request->due_miscellaneous_hrs);
        $syn_detail_of_stoppage_b->due_miscellaneous_tet = $this->__dataType->string_to_num($request->due_miscellaneous_tet);

        $syn_detail_of_stoppage_b->created_at = $this->carbon->now();
        $syn_detail_of_stoppage_b->updated_at = $this->carbon->now();
        $syn_detail_of_stoppage_b->ip_created = request()->ip();
        $syn_detail_of_stoppage_b->ip_updated = request()->ip();
        $syn_detail_of_stoppage_b->user_created = $this->auth->user()->user_id;
        $syn_detail_of_stoppage_b->user_updated = $this->auth->user()->user_id;
        $syn_detail_of_stoppage_b->save();
        
        return $syn_detail_of_stoppage_b;

    }




    public function update($request, $slug){

        $syn_detail_of_stoppage_b = $this->findBySlug($slug);
        $syn_detail_of_stoppage_b->mill_id = $request->mill_id;
        $syn_detail_of_stoppage_b->crop_year_id = $request->crop_year_id;

        $syn_detail_of_stoppage_b->due_cleaning_hrs = $this->__dataType->string_to_num($request->due_cleaning_hrs);
        $syn_detail_of_stoppage_b->due_cleaning_tet = $this->__dataType->string_to_num($request->due_cleaning_tet);
        $syn_detail_of_stoppage_b->due_no_unavoidable_hrs = $this->__dataType->string_to_num($request->due_no_unavoidable_hrs);
        $syn_detail_of_stoppage_b->due_no_unavoidable_tet = $this->__dataType->string_to_num($request->due_no_unavoidable_tet);
        $syn_detail_of_stoppage_b->due_miscellaneous_hrs = $this->__dataType->string_to_num($request->due_miscellaneous_hrs);
        $syn_detail_of_stoppage_b->due_miscellaneous_tet = $this->__dataType->string_to_num($request->due_miscellaneous_tet);

        $syn_detail_of_stoppage_b->updated_at = $this->carbon->now();
        $syn_detail_of_stoppage_b->ip_updated = request()->ip();
        $syn_detail_of_stoppage_b->user_updated = $this->auth->user()->user_id;
        $syn_detail_of_stoppage_b->save();
        
        return $syn_detail_of_stoppage_b;

    }




    public function destroy($slug){

        $syn_detail_of_stoppage_b = $this->findBySlug($slug);
        $syn_detail_of_stoppage_b->delete();

        return $syn_detail_of_stoppage_b;

    }




    public function findBySlug($slug){

        $syn_detail_of_stoppage_b = $this->cache->remember('syn_detail_of_stoppage_b:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_detail_of_stoppage_b->where('slug', $slug)
                                                  ->with('mill', 'cropYear')
                                                  ->first();
        }); 
        
        if(empty($syn_detail_of_stoppage_b)){ abort(404); }

        return $syn_detail_of_stoppage_b;

    }



    public function getByCropYearId($crop_year_id){

        $syn_detail_of_stoppage_b = $this->cache->remember('syn_detail_of_stoppage_b:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_detail_of_stoppage_b = $this->syn_detail_of_stoppage_b->newQuery();

            return $syn_detail_of_stoppage_b->select('mill_id', 'due_cleaning_hrs', 'due_cleaning_tet', 'due_no_unavoidable_hrs', 'due_no_unavoidable_tet', 'due_miscellaneous_hrs', 'due_miscellaneous_tet')
                                            ->with('mill')
                                            ->where('crop_year_id', $crop_year_id)
                                            ->get();

        });

        return $syn_detail_of_stoppage_b;

    }




    public function getSynDetailOfStoppageBIdInc(){

        $id = 'DOS-B1001';
        $syn_detail_of_stoppage_b = $this->syn_detail_of_stoppage_b->select('detail_of_stoppage_b_id')->orderBy('detail_of_stoppage_b_id', 'desc')->first();

        if($syn_detail_of_stoppage_b != null){
            if($syn_detail_of_stoppage_b->detail_of_stoppage_b_id != null){
                $num = str_replace('DOS-B', '', $syn_detail_of_stoppage_b->detail_of_stoppage_b_id) + 1;
                $id = 'DOS-B' . $num;
            }
        }
        
        return $id;
        
    }




}