<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynFirstExpressedJuice extends Model{



    use Sortable;

    protected $table = 'syn_first_expressed_juice';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'first_expressed_juice_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'brix' => 0.00000,
        'percent_pol' => 0.00000,
        'apparent_purity' => 0.00000,
        'decrease_in_ap' => 0.00000,
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
