<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynNonSugar extends Model{



    use Sortable;

    protected $table = 'syn_non_sugars';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'non_sugar_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'first_expressed_juice' => 0.00000,
        'last_expressed_juice' => 0.00000,
        'mixed_juice' => 0.00000,
        'syrup' => 0.00000,
        'molasses' => 0.00000,
        'sugar' => 0.00000,
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
