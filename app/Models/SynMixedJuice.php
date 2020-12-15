<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynMixedJuice extends Model{



    use Sortable;

    protected $table = 'syn_mixed_juice';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'mixed_juice_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'tonnes' => 0.00000,
        'percent_on_cane' => 0.00000,
        'brix' => 0.00000,
        'percent_pol' => 0.00000,
        'apparent_purity' => 0.00000,
        'percent_sucrose' => 0.00000,
        'gravity_purity' => 0.00000,
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
