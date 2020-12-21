<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynGrindStoppage extends Model{



    use Sortable;

    protected $table = 'syn_grind_stoppage';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'grind_stoppage_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'actual_grind_hrs' => 0.00000,
        'actual_grind_tet' => 0.00000,
        'total_delays_hrs' => 0.00000,
        'total_delays_tet' => 0.00000,
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
