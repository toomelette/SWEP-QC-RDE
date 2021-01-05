<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynTenYrAgriParam extends Model{



    use Sortable;

    protected $table = 'syn_ten_yr_agri_param';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'ten_yr_agri_param_id' => '',
        'crop_year_id' => '',
        'area_harvested' => 0.00000,
        'tc_ha' => 0.00000,
        'lkg_tc' => 0.00000,
        'lkg_ha' => 0.00000,
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
