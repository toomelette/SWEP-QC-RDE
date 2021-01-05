<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynTenYrFactoryPerformance extends Model{



    use Sortable;

    protected $table = 'syn_ten_yr_factory_performance';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'ten_yr_factory_performance_id' => '',
        'crop_year_id' => '',
        'rated_capacity' => 0.00000,
        'cap_utilization' => 0.00000,
        'pol_extraction' => 0.00000,
        'actual_bhr' => 0.00000,
        'reduced_overall_recovery' => 0.00000,
        'ave_num_of_grinding' => 0.00000,
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
