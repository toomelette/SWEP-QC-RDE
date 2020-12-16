<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynMolasses extends Model{



    use Sortable;

    protected $table = 'syn_molasses';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'molasses_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'tonnes_manufactured' => 0.00000,
        'tonnes_due_cane' => 0.00000,
        'percent_on_cane' => 0.00000,
        'brix' => 0.00000,
        'apparent_purity' => 0.00000,
        'gravity_purity' => 0.00000,
        'percent_ash' => 0.00000,
        'percent_reducing_sugar' => 0.00000,
        'expected_molasses_purity' => 0.00000,
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
