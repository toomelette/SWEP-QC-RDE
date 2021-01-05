<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynTenYrRatioYield extends Model{



    use Sortable;

    protected $table = 'syn_ten_yr_ratio_yield';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'ten_yr_ratio_yield_id' => '',
        'crop_year_id' => '',
        'imbibition_fiber_ratio' => 0.00000,
        'rendement' => 0.00000,
        'quality_ratio' => 0.00000,
        'kg_mollasses_per_ton_cane' => 0.00000,
        'kg_bagasse_per_ton_cane' => 0.00000,
        'kg_fc_per_ton_cane' => 0.00000,
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];




    /** RELATIONSHIPS **/
    public function cropYear() {
    	return $this->belongsTo('App\Models\CropYear','crop_year_id','crop_year_id');
   	}


    
}
