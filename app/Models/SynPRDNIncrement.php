<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynPRDNIncrement extends Model{



    use Sortable;

    protected $table = 'syn_prdn_increment';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'prdn_increment_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'current_cy_prod' => 0.00000,
        'past_cy_prod' => 0.00000,
        'increase_decrease' => 0.00000,
        'sharing_ratio' => '',
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
