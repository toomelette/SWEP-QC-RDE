<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynCaneSugarTon extends Model{



    use Sortable;

    protected $table = 'syn_cane_sugar_tons';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'cane_sugar_ton_id' => '',
        'crop_year_id' => '',
        'sgrcane_gross_tonnes' => 0.00,
        'sgrcane_net_tonnes' => 0.00,
        'rawsgr_tonnes_due_cane' => 0.00,
        'rawsgr_tonnes_manufactured' => 0.00,
        'equivalent' => 0.00,
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
