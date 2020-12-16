<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynCapUtilization extends Model{



    use Sortable;

    protected $table = 'syn_cap_utilization';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'cap_utilization_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'normal_rate_cap' => 0.00000,
        'tonnes_cane_per_hr' => 0.00000,
        'ave_hr_actual_grinding' => 0.00000,
        'cap_utilization' => 0.00000,
        'mechanical_time_eff' => 0.00000,
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


    public function mill() {
        return $this->belongsTo('App\Models\Mill','mill_id','mill_id');
    }


    
}
