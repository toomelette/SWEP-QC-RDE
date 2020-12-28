<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynTenYrPrdn extends Model{



    use Sortable;

    protected $table = 'syn_ten_yr_prdn';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'ten_yr_prdn_id' => '',
        'crop_year_id' => '',
        'gross_cane_milled' => 0.00000,
        'raw_sugar_man' => 0.00000,
        'molasses_due_cane' => 0.00000,
        'bagasse' => 0.00000,
        'filter_cake' => 0.00000,
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
