<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynClarification extends Model{



    use Sortable;

    protected $table = 'syn_clarification';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'clarification_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'juice_apparent_purity' => 0.00000,
        'juice_brix' => 0.00000,
        'juice_ph' => 0.00000,
        'juice_clarity' => 0.00000,
        'lime_tonnes_used' => 0.00000,
        'lime_cao' => 0.00000,
        'lime_cao_per_tc' => 0.00000,
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
