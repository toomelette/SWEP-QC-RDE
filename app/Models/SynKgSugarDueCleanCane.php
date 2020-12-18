<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynKgSugarDueCleanCane extends Model{



    use Sortable;

    protected $table = 'syn_kg_sugar_due_clean_cane';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'kg_sugar_due_clean_cane_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'trash_percent_cane' => 0.00000,
        'percent_recovery' => 0.00000,
        'recoverable' => 0.00000,
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
