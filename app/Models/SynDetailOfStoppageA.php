<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynDetailOfStoppageA extends Model{



    use Sortable;

    protected $table = 'syn_detail_of_stoppage_a';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'detail_of_stoppage_a_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'due_factory_hrs' => 0.00000,
        'due_factory_tet' => 0.00000,
        'due_no_cane_hrs' => 0.00000,
        'due_no_cane_tet' => 0.00000,
        'due_transport_hrs' => 0.00000,
        'due_transport_tet' => 0.00000,
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
