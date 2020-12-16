<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SynMolassesInterface;

use App\Models\SynMolasses;


class SynMolassesRepository extends BaseRepository implements SynMolassesInterface {
	


    protected $syn_molasses;



	public function __construct(SynMolasses $syn_molasses){

        $this->syn_molasses = $syn_molasses;
        parent::__construct();

    }



    public function fetch($request){
 
        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 10;

        $syn_molasses = $this->cache->remember('syn_molasses:fetch:' . $key, 240, function() use ($request, $entries){

            $syn_molasses = $this->syn_molasses->newQuery();
            
            if(isset($request->q)){
                $syn_molasses->whereHas('mill', function($mill) use ($request){
                                 $mill->where('name', 'LIKE', '%'. $request->q .'%');
                             })
                             ->orWhereHas('cropYear', function($cy) use ($request){
                                 $cy->where('name', 'LIKE', '%'. $request->q .'%');
                             });
            }

            return $syn_molasses->select('slug', 'mill_id', 'crop_year_id', 'molasses_id')
                                ->with('mill', 'cropYear')
                                ->sortable()
                                ->orderBy('updated_at', 'desc')
                                ->paginate($entries);

        });

        return $syn_molasses;

    }




    public function store($request){

        $syn_molasses = new SynMolasses;
        $syn_molasses->slug = $this->str->random(16);
        $syn_molasses->molasses_id = $this->getSynMolassesIdInc();
        $syn_molasses->mill_id = $request->mill_id;
        $syn_molasses->crop_year_id = $request->crop_year_id;

        $syn_molasses->tonnes_manufactured = $this->__dataType->string_to_num($request->tonnes_manufactured);
        $syn_molasses->tonnes_due_cane = $this->__dataType->string_to_num($request->tonnes_due_cane);
        $syn_molasses->percent_on_cane = $this->__dataType->string_to_num($request->percent_on_cane);
        $syn_molasses->brix = $this->__dataType->string_to_num($request->brix);
        $syn_molasses->apparent_purity = $this->__dataType->string_to_num($request->apparent_purity);
        $syn_molasses->gravity_purity = $this->__dataType->string_to_num($request->gravity_purity);
        $syn_molasses->percent_ash = $this->__dataType->string_to_num($request->percent_ash);
        $syn_molasses->percent_reducing_sugar = $this->__dataType->string_to_num($request->percent_reducing_sugar);
        $syn_molasses->expected_molasses_purity = $this->__dataType->string_to_num($request->expected_molasses_purity);

        $syn_molasses->created_at = $this->carbon->now();
        $syn_molasses->updated_at = $this->carbon->now();
        $syn_molasses->ip_created = request()->ip();
        $syn_molasses->ip_updated = request()->ip();
        $syn_molasses->user_created = $this->auth->user()->user_id;
        $syn_molasses->user_updated = $this->auth->user()->user_id;
        $syn_molasses->save();
        
        return $syn_molasses;

    }




    public function update($request, $slug){

        $syn_molasses = $this->findBySlug($slug);
        $syn_molasses->mill_id = $request->mill_id;
        $syn_molasses->crop_year_id = $request->crop_year_id;

        $syn_molasses->tonnes_manufactured = $this->__dataType->string_to_num($request->tonnes_manufactured);
        $syn_molasses->tonnes_due_cane = $this->__dataType->string_to_num($request->tonnes_due_cane);
        $syn_molasses->percent_on_cane = $this->__dataType->string_to_num($request->percent_on_cane);
        $syn_molasses->brix = $this->__dataType->string_to_num($request->brix);
        $syn_molasses->apparent_purity = $this->__dataType->string_to_num($request->apparent_purity);
        $syn_molasses->gravity_purity = $this->__dataType->string_to_num($request->gravity_purity);
        $syn_molasses->percent_ash = $this->__dataType->string_to_num($request->percent_ash);
        $syn_molasses->percent_reducing_sugar = $this->__dataType->string_to_num($request->percent_reducing_sugar);
        $syn_molasses->expected_molasses_purity = $this->__dataType->string_to_num($request->expected_molasses_purity);

        $syn_molasses->updated_at = $this->carbon->now();
        $syn_molasses->ip_updated = request()->ip();
        $syn_molasses->user_updated = $this->auth->user()->user_id;
        $syn_molasses->save();
        
        return $syn_molasses;

    }




    public function destroy($slug){

        $syn_molasses = $this->findBySlug($slug);
        $syn_molasses->delete();

        return $syn_molasses;

    }




    public function findBySlug($slug){

        $syn_molasses = $this->cache->remember('syn_molasses:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->syn_molasses->where('slug', $slug)
                                      ->with('mill', 'cropYear')
                                      ->first();
        }); 
        
        if(empty($syn_molasses)){ abort(404); }

        return $syn_molasses;

    }



    public function getByCropYearId($crop_year_id){

        $syn_molasses = $this->cache->remember('syn_molasses:getByCropYearId:' . $crop_year_id, 43200, function() use ($crop_year_id){

            $syn_molasses = $this->syn_molasses->newQuery();

            return $syn_molasses->select('mill_id', 'tonnes_manufactured', 'tonnes_due_cane', 'percent_on_cane', 'brix', 'apparent_purity', 'gravity_purity', 'percent_ash', 'percent_reducing_sugar', 'expected_molasses_purity')
                                ->with('mill')
                                ->where('crop_year_id', $crop_year_id)
                                ->get();

        });

        return $syn_molasses;

    }




    public function getSynMolassesIdInc(){

        $id = 'M1001';
        $syn_molasses = $this->syn_molasses->select('molasses_id')->orderBy('molasses_id', 'desc')->first();

        if($syn_molasses != null){
            if($syn_molasses->molasses_id != null){
                $num = str_replace('M', '', $syn_molasses->molasses_id) + 1;
                $id = 'M' . $num;
            }
        }
        
        return $id;
        
    }




}