<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynDetailOfStoppageB extends Model{



    use Sortable;

    protected $table = 'syn_detail_of_stoppage_b';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'detail_of_stoppage_b_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'due_cleaning_hrs' => 0.00000,
        'due_cleaning_tet' => 0.00000,
        'due_no_unavoidable_hrs' => 0.00000,
        'due_no_unavoidable_tet' => 0.00000,
        'due_miscellaneous_hrs' => 0.00000,
        'due_miscellaneous_tet' => 0.00000,
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
