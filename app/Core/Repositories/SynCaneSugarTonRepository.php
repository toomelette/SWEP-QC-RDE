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




    // public function store($request){

    //     $syn_cane_sugar_ton = new SynCaneSugarTon;
    //     $syn_cane_sugar_ton->slug = $this->str->random(16);
    //     $syn_cane_sugar_ton->cane_sugar_ton_id = $this->getSynCaneSugarTonIdInc();
    //     $syn_cane_sugar_ton->name = $request->name;
    //     $syn_cane_sugar_ton->address = $request->address;
    //     $syn_cane_sugar_ton->address_second = $request->address_second;
    //     $syn_cane_sugar_ton->address_third = $request->address_third;
    //     $syn_cane_sugar_ton->tel_no = $request->tel_no;
    //     $syn_cane_sugar_ton->tel_no_second = $request->tel_no_second;
    //     $syn_cane_sugar_ton->fax_no = $request->fax_no;
    //     $syn_cane_sugar_ton->fax_no_second = $request->fax_no_second;
    //     $syn_cane_sugar_ton->email = $request->email;
    //     $syn_cane_sugar_ton->region_id = $request->region_id;
    //     $syn_cane_sugar_ton->report_region = $request->report_region;
    //     $syn_cane_sugar_ton->officer = $request->officer;
    //     $syn_cane_sugar_ton->position = $request->position;
    //     $syn_cane_sugar_ton->salutation = $request->salutation;
    //     $syn_cane_sugar_ton->cover_letter_address = $request->cover_letter_address;
    //     $syn_cane_sugar_ton->billing_address = $request->billing_address;
    //     $syn_cane_sugar_ton->license_address = $request->license_address;
    //     $syn_cane_sugar_ton->created_at = $this->carbon->now();
    //     $syn_cane_sugar_ton->updated_at = $this->carbon->now();
    //     $syn_cane_sugar_ton->ip_created = request()->ip();
    //     $syn_cane_sugar_ton->ip_updated = request()->ip();
    //     $syn_cane_sugar_ton->user_created = $this->auth->user()->user_id;
    //     $syn_cane_sugar_ton->user_updated = $this->auth->user()->user_id;
    //     $syn_cane_sugar_ton->save();
        
    //     return $syn_cane_sugar_ton;

    // }




    // public function update($request, $slug){

    //     $syn_cane_sugar_ton = $this->findBySlug($slug);
    //     $syn_cane_sugar_ton->name = $request->name;
    //     $syn_cane_sugar_ton->address = $request->address;
    //     $syn_cane_sugar_ton->address_second = $request->address_second;
    //     $syn_cane_sugar_ton->address_third = $request->address_third;
    //     $syn_cane_sugar_ton->tel_no = $request->tel_no;
    //     $syn_cane_sugar_ton->tel_no_second = $request->tel_no_second;
    //     $syn_cane_sugar_ton->fax_no = $request->fax_no;
    //     $syn_cane_sugar_ton->fax_no_second = $request->fax_no_second;
    //     $syn_cane_sugar_ton->email = $request->email;
    //     $syn_cane_sugar_ton->region_id = $request->region_id;
    //     $syn_cane_sugar_ton->report_region = $request->report_region;
    //     $syn_cane_sugar_ton->officer = $request->officer;
    //     $syn_cane_sugar_ton->position = $request->position;
    //     $syn_cane_sugar_ton->salutation = $request->salutation;
    //     $syn_cane_sugar_ton->cover_letter_address = $request->cover_letter_address;
    //     $syn_cane_sugar_ton->billing_address = $request->billing_address;
    //     $syn_cane_sugar_ton->license_address = $request->license_address;
    //     $syn_cane_sugar_ton->updated_at = $this->carbon->now();
    //     $syn_cane_sugar_ton->ip_updated = request()->ip();
    //     $syn_cane_sugar_ton->user_updated = $this->auth->user()->user_id;
    //     $syn_cane_sugar_ton->save();
        
    //     return $syn_cane_sugar_ton;

    // }




    // public function destroy($slug){

    //     $syn_cane_sugar_ton = $this->findBySlug($slug);
    //     $syn_cane_sugar_ton->delete();

    //     return $syn_cane_sugar_ton;

    // }




    // public function findBySlug($slug){

    //     $syn_cane_sugar_ton = $this->cache->remember('syn_cane_sugar_tons:findBySlug:' . $slug, 240, function() use ($slug){
    //         return $this->syn_cane_sugar_ton->where('slug', $slug)->first();
    //     }); 
        
    //     if(empty($syn_cane_sugar_ton)){ abort(404); }

    //     return $syn_cane_sugar_ton;

    // }




    // public function getSynCaneSugarTonIdInc(){

    //     $id = 'M1001';
    //     $syn_cane_sugar_ton = $this->syn_cane_sugar_ton->select('cane_sugar_ton_id')->orderBy('cane_sugar_ton_id', 'desc')->first();

    //     if($syn_cane_sugar_ton != null){
    //         if($syn_cane_sugar_ton->cane_sugar_ton_id != null){
    //             $num = str_replace('M', '', $syn_cane_sugar_ton->cane_sugar_ton_id) + 1;
    //             $id = 'M' . $num;
    //         }
    //     }
        
    //     return $id;
        
    // }




}