<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynBHLossInterface;

use App\Models\SynBHLoss;


class SynBHLossRepository extends BaseRepository implements SynBHLossInterface {
	


    protected $syn_bh_loss;



	public function __construct(SynBHLoss $syn_bh_loss){

        $this->syn_bh_loss = $syn_bh_loss;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_bh_loss = $this->cache->remember('syn_bh_loss:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_bh_loss = $this->syn_bh_loss->newQuery();
            
            if(isset($request->q)){
                $syn_bh_loss->whereHas('mill', function($mill) use ($request){
                                $mill->where('name', 'LIKE', '%'. $request->q .'%');
                            })
                            ->orWhereHas('cropYear', function($cy) use ($request){
                                $cy->where('name', 'LIKE', '%'. $request->q .'%');
                            });
}

            return $syn_bh_loss->select('slug', 'mill_id', 'crop_year_id', 'bh_loss_id')
                               ->with('mill', 'cropYear')
                               ->sortable()
                               ->orderBy('updated_at', 'desc')
                               ->paginate($entries);

        });

        return $syn_bh_loss;

    }




    public function store($request){

        $syn_bh_loss = new SynBHLoss;
        $syn_bh_loss->slug = $this->str->random(16);
        $syn_bh_loss->bh_loss_id = $this->getSynBHLossIdInc();
        $syn_bh_loss->mill_id = $request->mill_id;
        $syn_bh_loss->crop_year_id = $request->crop_year_id;

        $syn_bh_loss->milling_loss = $this->__dataType->string_to_num($request->milling_loss);
        $syn_bh_loss->bagasse = $this->__dataType->string_to_num($request->bagasse);
        $syn_bh_loss->filter_cake = $this->__dataType->string_to_num($request->filter_cake);
        $syn_bh_loss->molasses = $this->__dataType->string_to_num($request->molasses);
        $syn_bh_loss->undetermined = $this->__dataType->string_to_num($request->undetermined);
        $syn_bh_loss->total = $this->__dataType->string_to_num($request->total);

        $syn_bh_loss->created_at = $this->carbon->now();
        $syn_bh_loss->updated_at = $this->carbon->now();
        $syn_bh_loss->ip_created = request()->ip();
        $syn_bh_loss->ip_updated = request()->ip();
        $syn_bh_loss->user_created = $this->auth->user()->user_id;
        $syn_bh_loss->user_updated = $this->auth->user()->user_id;
        $syn_bh_loss->save();
        
        return $syn_bh_loss;

    }




    public function update($request, $slug){

        $syn_bh_loss = $this->findBySlug($slug);
        $syn_bh_loss->mill_id = $request->mill_id;
        $syn_bh_loss->crop_year_id = $request->crop_year_id;

        $syn_bh_loss->milling_loss = $this->__dataType->string_to_num($request->milling_loss);
        $syn_bh_loss->bagasse = $this->__dataType->string_to_num($request->bagasse);
        $syn_bh_loss->filter_cake = $this->__dataType->string_to_num($request->filter_cake);
        $syn_bh_loss->molasses = $this->__dataType->string_to_num($request->molasses);
        $syn_bh_loss->undetermined = $this->__dataType->string_to_num($request->undetermined);
        $syn_bh_loss->total = $this->__dataType->string_to_num($request->total);

        $syn_bh_loss->updated_at = $this->carbon->now();
        $syn_bh_loss->ip_updated = request()->ip();
        $syn_bh_loss->user_updated = $this->auth->user()->user_id;
        $syn_bh_loss->save();
        
        return $syn_bh_loss;

    }




    public function destroy($slug){

        $syn_bh_loss = $this->findBySlug($slug);
        $syn_bh_loss->delete();

        return $syn_bh_loss;

    }




    public function findBySlug($slug){

        $syn_bh_loss = $this->cache->remember('syn_bh_loss:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_bh_loss->where('slug', $slug)
                                     ->with('mill', 'cropYear')
                                     ->first();
        }); 
        
        if(empty($syn_bh_loss)){ abort(404); }

        return $syn_bh_loss;

    }



    public function getByCropYearId($crop_year_id){

        $syn_bh_loss = $this->cache->remember('syn_bh_loss:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_bh_loss = $this->syn_bh_loss->newQuery();

            return $syn_bh_loss->select('mill_id', 'milling_loss', 'bagasse', 'filter_cake', 'molasses', 'undetermined', 'total')
                           ->with('mill')
                           ->where('crop_year_id', $crop_year_id)
                           ->get();

        });

        return $syn_bh_loss;

    }




    public function getSynBHLossIdInc(){

        $id = 'BHL1001';
        $syn_bh_loss = $this->syn_bh_loss->select('bh_loss_id')->orderBy('bh_loss_id', 'desc')->first();

        if($syn_bh_loss != null){
            if($syn_bh_loss->bh_loss_id != null){
                $num = str_replace('BHL', '', $syn_bh_loss->bh_loss_id) + 1;
                $id = 'BHL' . $num;
            }
        }
        
        return $id;
        
    }




}