<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynRatiosOnGrossCane extends Model{



    use Sortable;

    protected $table = 'syn_ratios_on_gross_cane';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'ratios_on_gross_cane_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'burnt_cane_percent' => 0.00000,
        'quality_ratio' => 0.00000,
        'rendement' => 0.00000,
        'total_sugar_recovered' => 0.00000,
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
